<?php

namespace frontend\controllers;

/**
 * @author  shuang
 * @date    2016-12-8 22:06:38
 * @version V1.0
 * @desc    
 */

use common\models\Zodiac;
use common\models\ZodiacApply;
use common\models\ZtslAward;
use frontend\models\WB_Notification;
use common\models\User;
use common\models\UserAmountTrade;
use common\models\UserBank;
use common\models\UserZodiac;
use common\models\UserProfile;
use common\models\UserWallet;
use common\models\ZodiacGrade;
use common\models\ZodiacIssue;
use yii\web\Controller;
use Yii;
use common\components\MTools;
use common\models\UserWalletRecord;
use \frontend\models\WB_UserWalletRecord;
use frontend\models\WB_UserAmountTrade;
use common\models\SnapJudgment;
use yii\db;


class DaytimeController extends Controller {
    private $count = 0;
    private $time = 1527857400;

    //  (宠物九子)定时任务->收款、付款超时（半小时调用1次）
    public function actionOvertime(){
        set_time_limit(0);
		$ip = Yii::$app->getRequest()->getUserIP();
        if($ip != '43.226.156.71') { // 填服务器IP
            file_put_contents('../runtime/logs/clearcash_err_ip.txt', '非本站ip:' . $ip . '访问 —— 时间：' . date("Y-m-d H:i:s") . "\r\n", FILE_APPEND);
            echo "非本站ip:" . $ip . "访问";
            exit();
        }

        //  设置超时时间
        $buyertradeovertime = MTools::getYiiParams('buyertradeovertime');       // 买家付款超时时间
        $sellertradeovertime = MTools::getYiiParams('sellertradeovertime');     // 卖家收款超时时间
        $buyeruntradelimit = MTools::getYiiParams('buyeruntradelimit') ? MTools::getYiiParams('buyeruntradelimit') : 1 ;         // 买家未付款次数
        $buyerovertime = time() - 3600 * $buyertradeovertime;
        $sellerovertime = time() - 3600 * $sellertradeovertime;

        //  获取付款超时的买家
        $query = WB_UserAmountTrade::find()->select('id, in_userid, out_userid, number')->where("traded_at <= :traded_at", [":traded_at" => $buyerovertime]);
        $query->andFilterWhere(['in', 'status', [7]]);
        $res = $query->asArray()->all();

        //  付款超时处罚
        foreach ($res as $val){
            // 增加对应付款超时次数
            $user = \common\models\User::findOne($val['in_userid']);
            if($user->overtime_num >= 0 && $user->overtime_num < $buyeruntradelimit){
                $user->overtime_num += 1;
                if($user->overtime_num == $buyeruntradelimit) {
                    $user->iseal = 1;
                }
                $user->save(false);
            }
            // 修改订单状态为：付款超时，订单取消
            $UserAmountTrade = WB_UserAmountTrade::findOne($val['id']);
            $UserAmountTrade->updated_at = time();
            $UserAmountTrade->status = 10;
            $UserAmountTrade->note = '付款超时，订单取消';

            // 卖家宠物卖出状态变更为未卖出
            $zodiac_issue = ZodiacIssue::find()->where('id = :id',[':id' => $UserAmountTrade->areaid])->one();    //获取发布信息
            $zodiac_issue->issel = 0;
            $ss = SnapJudgment::findOne($zodiac_issue->id);
            $ss->issue_id = $ss->userid.'_'.time();
            Yii::$app->redis->lpush('zodiac_issue:'.$zodiac_issue->zodiac_id, 1);   //返还该宠物数量
            $redis_num = count(Yii::$app->redis->lrange("zodiac_issue:".$zodiac_issue->zodiac_id,0,-1));

            if($UserAmountTrade->save() && $zodiac_issue->save() && $ss->save(false)){
                file_put_contents('../runtime/logs/redis_log.txt', '时间：'.time().'，定时任务付款超时宠物'.$zodiac_issue->zodiac_id.'子，发行ID:'.$zodiac_issue->id.'num:'.$redis_num.PHP_EOL,FILE_APPEND);
            } else {
                if(!$ss->save(false)){
                    file_put_contents('../runtime/logs/redis_log.txt', '时间：'.time().'，定时任务付款超时宠物执行失败'.$zodiac_issue->zodiac_id.'子，发行ID:'.$zodiac_issue->id.'num:'.$redis_num.PHP_EOL,FILE_APPEND);
                }

            }

        }

        //  获取收款超时的卖家
        $query2 = WB_UserAmountTrade::find()->select('id, in_userid, out_userid')->where("traded_at<=:traded_at", [":traded_at" => $sellerovertime]);
        $query2->andFilterWhere(['in', 'status', [2]]);
        $res2 = $query2->asArray()->all();

        //  收款超时自动完结订单
        foreach ($res2 as $val2){
            //  修改订单状态
            $UserAmountTrade2 = WB_UserAmountTrade::findOne($val2['id']);
            if($UserAmountTrade2->status == 3) {
                continue;
            } else {
                // 自动完结订单
                $UserAmountTrade2->traded_at = time();
                $UserAmountTrade2->updated_at = time();
                $UserAmountTrade2->status = 3;
                $UserAmountTrade2->note = '收款已超时,订单完结';

                if($UserAmountTrade2->save()){
                    //先获取旧的issue_id
                    $zodiac_issue_id = $UserAmountTrade2->areaid;
                    $zodiac_issue = ZodiacIssue::findOne($zodiac_issue_id);
                    //zodiac不变
                    $zodiac_id = $zodiac_issue->zodiac_id;
                    $zodiac = Zodiac::findOne($zodiac_id);
                    //生成一条新的发行记录
                    $new_issue = new ZodiacIssue();
                    $new_issue->zodiac_id = $zodiac->id;
                    $new_issue->zodiac_name = $zodiac->name;
                    $new_issue->zodiac_grade_id = '';
                    $new_issue->zodiac_grade_name = '';
                    $new_issue->hcg = $zodiac_issue->hcg;
                    $new_issue->cash = $zodiac_issue->cash;
                    $new_issue->issel = 2;
                    $new_issue->created_at = time();
                    $new_issue->updated_at = time();
                    $new_issue->belong_id = $UserAmountTrade2->in_userid;
                    $new_issue->save();
                    if($new_issue->save()){
                        //创建领养记录
                        $userzodiac = new UserZodiac();
                        $userzodiac->zodiac_id = $zodiac_id;
                        $userzodiac->issue_id = $new_issue->id;
                        $userzodiac->zodiac_grade_id = 0;
                        $userzodiac->userid = $UserAmountTrade2->in_userid;
                        $userzodiac->username = $UserAmountTrade2->in_username;
                        $userzodiac->hcg = $zodiac_issue->hcg;
                        $userzodiac->old_hcg = $zodiac_issue->hcg;
                        $userzodiac->due = $zodiac->due;
                        $userzodiac->award = $zodiac->award;
                        $userzodiac->source = 0;
                        $userzodiac->allow_rack = 0;
                        // 当天零点时间戳
                        $zerotimestamp = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
                        $over_time = $zerotimestamp + 86400 * ($zodiac->due);
                        $userzodiac->over_time = $over_time;
                        $userzodiac->is_rack = 0;           //是否上架(0:未上架, 1:已上架)
                        $userzodiac->is_overtime = 0;       //是否过期(0:未过期, 1:已过期)
                        $userzodiac->created_at = time();
                        $userzodiac->updated_at = time();
                        $userzodiac->rise_num = 0;
                        $zodiac_issue->issel = 1;   // 0:待匹配 1:已卖出 2:成长中
                        $UserAmountTrade2->areaid = $new_issue->id;
                        $UserAmountTrade2->save();
                        // 添加消息
                        WB_Notification::create_notify($UserAmountTrade2->id, $UserAmountTrade2->out_userid, $UserAmountTrade2->out_username, $UserAmountTrade2->in_userid, $UserAmountTrade2->in_username, $UserAmountTrade2->status, $UserAmountTrade2->type, $UserAmountTrade2->method, $UserAmountTrade2->order_type,1);
                        //执行保存
                        $userzodiac->save();
                        $zodiac_issue->save();
                    }
                }

            }
        }
    }

    // (宠物九子)定时任务->宠物增值(每天0点执行一次)
    public function actionAddzodiacaward(){
        $ip = Yii::$app->getRequest()->getUserIP();
        if($ip != '43.226.156.71') { // 填服务器IP
            file_put_contents('../runtime/logs/clearcash_err_ip.txt', '非本站ip:' . $ip . '访问 —— 时间：' . date("Y-m-d H:i:s") . "\r\n", FILE_APPEND);
            echo "非本站ip:" . $ip . "访问";
            exit();
        }
        // 获取当日零点时间戳
        $time = mktime(0, 0, 0, date('m'), date('d'), date('Y'));   //获取当日零点时间戳

        $flag = file_exists('../runtime/logs/addzodiacaward_log.txt');   //检测文件是否存在
        if($flag){
            $param = file_get_contents('../runtime/logs/addzodiacaward_log.txt');
            if($param){
                $param_one = explode(';',$param);
                $count = count($param_one)-2;
                $ary_one = $param_one[$count];  //获取最后一条记录
                $ary = explode(',',$ary_one);
                $strtime = strtotime($ary[0]);  //获取最后一条记录的时间戳
//                如果今天0点时间小于最后一次记录时间(表示已经执行过转换)
/*
                if($strtime > $time){
                    return ;
                }
                */
            }

        }
        //获取所有用户的宠物领养记录(未过期)
        $all_zodiac = UserZodiac::find()->where('is_overtime = 0')->andWhere('over_time < :time', [':time' => time()])->all();
        if($all_zodiac){
            foreach ($all_zodiac as $item){
            	//if ($item->over_time > time()) continue;
            	
                $item->rise_num += 1;   //增值次数增加
                //每日增值数量
                $award = floor((($item->award)/100 * $item->old_hcg / $item->due)*100)/100;     //保留2位小数
                if($award){
                    //当期产品最新价格
                    $new_price = $item->hcg + $award;
                    $item->hcg = $new_price;     //产品价格增加
                    $item->updated_at = time();
                    //更新发布表
                    $issue = ZodiacIssue::find()->where('id = :id',[':id'=>$item->issue_id])->one();
                    $issue->hcg += $award;   //更新产品价格
                    $id = $item->zodiac_id;
                    // 当次数和周期一致时,产品过期
                    if($item->rise_num == $item->due && time() >= $item->over_time){
                        // 获取当前产品的收益
                        $item->is_overtime = 1;      //产品过期
                        //如果允许出售
                        if($item->allow_rack == 0){
                            //检查产品价格是否达到下一级,是则自动升级
                            $new_grade = Zodiac::find()->where('hcg_min <= :hcg_min',[':hcg_min'=>$new_price])->orderBy('hcg_min desc')->one();
                            
                            if($new_grade && $new_grade->hcg_min > $item->old_hcg){
                                if($new_grade->id != $issue->zodiac_id){
                                    //更新发行表
                                    $issue->zodiac_id = $new_grade->id;      // 更新对应发布表的宠物id
                                    $issue->zodiac_name = $new_grade->name;  // 更新对应
                                    $id = $new_grade->id ;
                                }
                            }
                            $item->is_rack = 1;                      // 变更为上架
                            $issue -> issel = 0;                     // 变更为位待匹配
                            $issue -> updated_at = time();           // 更新时间
                            Yii::$app->redis->lpush('zodiac_issue:'.$id,'1');   // redis缓存数量增加一个
                            $redis_num = count(Yii::$app->redis->lrange("zodiac_issue:".$id,0,-1));

                            file_put_contents('../runtime/logs/redis_log.txt', '时间：'.time().'，定时任务到期上架宠物'.$id.'子，发行ID:'.$issue->id.'num:'.$redis_num.PHP_EOL,FILE_APPEND);
                        }

                    }
                    $zodiac_name = Zodiac::find()->select('name')->where('id = :id',[':id'=>$item->zodiac_id])->one();
                    //插入增值记录表
                    $ltzs_award = new ZtslAward();
                    $ltzs_award->award = $award;
                    $ltzs_award->zodiac_id = $item->zodiac_id;
                    $ltzs_award->zodiac_name = $zodiac_name->name;
                    $ltzs_award->userid = $item->userid;
                    $ltzs_award->created_at = time();

                    //上级获取推广收益
                    $userdata = User::find()->where('id = :id',[':id'=>$item->userid])->one();
                    $direct = $this->actionDirectaward($award,$userdata,$item->id);
                    //执行保存
                    if($issue->save() && $item->save() && $direct && $item->save() && $ltzs_award->save()){
                        //成功时,不做操作
                    }else{
                        file_put_contents('../runtime/logs/function_error_log.txt', date('Y-m-d H:i:s',time()).',用户id:'.$item->userid.'增值失败'.PHP_EOL,FILE_APPEND);
                        continue;
                    }
                }else{
                    continue;
                }

            }

        }
        file_put_contents('../runtime/logs/addzodiacaward_log.txt', date('Y-m-d H:i:s',time()).',宠物产品增值--执行成功;'.PHP_EOL,FILE_APPEND);
    }
	
    // (宠物九子)定时任务 平台回购(1小时调用一次)
    public function actionAutobuy(){
		$ip = Yii::$app->getRequest()->getUserIP();
        if($ip != '43.226.156.71') { // 填服务器IP
            file_put_contents('../runtime/logs/clearcash_err_ip.txt', '非本站ip:' . $ip . '访问 —— 时间：' . date("Y-m-d H:i:s") . "\r\n", FILE_APPEND);
            echo "非本站ip:" . $ip . "访问";
            exit();
        }
        //获取所有没卖出去的产品(不包含平台账号)
        $all_issue = ZodiacIssue::find()->where('issel = 0 and belong_id != 1')->all();
        if($all_issue){
            foreach ($all_issue as $item){
                //获取对该产品的抢购时间
                $time = mktime(0, 0, 0, date('m'), date('d'), date('Y'));   //获取当日零点时间戳
                $zodiac = Zodiac::find()->where('id = :id',[':id'=>$item->zodiac_id])->one();
                //确认产品是否超出了抢购时间
                $end_time = $zodiac->end_at_hour * 3600 + $zodiac->end_at_minu * 60 + $time;        //产品结束时间
                // 若超出抢购时间(由平台回购)
                if(time() > $end_time){
                    $out_userid = $item->belong_id;     // 原归属人
                    $item->issel = 1;           // 更改状态
                    // 获取买家信息
                    $buyer = User::find()->where('id = :id',[':id'=>1])->one();
                    //获取当前卖家的信息
                    $userprofile = UserProfile::find()->where('userid = :userid',[':userid'=>$out_userid])->one();
                    //获取卖家实名认证银行卡信息
                    $userbank = UserBank::find()->where('userid = :userid',[':userid'=>$out_userid])->one();
                    //插入交易表
                    $note = '平台回购,等待平台付款';
                    $trade = UserAmountTrade::nsCreateOrder($buyer->id,$buyer->username,$out_userid,$userprofile->username,$userbank,$userprofile,null,$item->hcg
                        ,$item->hcg,1,0,0,7,1,1,1,null,$item->id,time(),$note);
                    if($trade->save()){
                        $item->save();
                    }else{
                        file_put_contents('../runtime/logs/function_error_log.txt', date('Y-m-d H:i:s',time()).',用户id:'.$item->belong_id.'被回购失败'.PHP_EOL,FILE_APPEND);
                    }

                }else{
                    continue;
                }

            }
        }

    }

    // (宠物九子)定时任务 返还预约积分操作(每日0点30执行一次)
    public function actionReturnhcg(){
		$ip = Yii::$app->getRequest()->getUserIP();
        if($ip != '43.226.156.71') { // 填服务器IP
            file_put_contents('../runtime/logs/clearcash_err_ip.txt', '非本站ip:' . $ip . '访问 —— 时间：' . date("Y-m-d H:i:s") . "\r\n", FILE_APPEND);
            echo "非本站ip:" . $ip . "访问";
            exit();
        }
        //获取预约记录表中所有未抢购或抢购失败的数据
        $time = mktime(0, 0, 0, date('m'), date('d'), date('Y'));   //获取当日零点时间戳

        $flag = file_exists('../runtime/logs/returnhcg_log.txt');   //检测文件是否存在
        if($flag){
            $param = file_get_contents('../runtime/logs/returnhcg_log.txt');
            if($param){
                $param_one = explode(';',$param);
                $count = count($param_one)-2;
                $ary_one = $param_one[$count];  //获取最后一条记录
                $ary = explode(',',$ary_one);
                $strtime = strtotime($ary[0]);  //获取最后一条记录的时间戳
//                如果今天0点时间小于最后一次记录时间(表示已经执行过转换)
                if($strtime > $time){
                    return ;
                }
            }
        }
        $apply = ZodiacApply::find()->where('kill_status = 0 and moneyed = 0 and money != 0')->all();

        if($apply){
            foreach ($apply as $item){
                //获取用户的信息
                $user = User::findOne($item->userid);
                //更新钱包数据
                $user->wallet->hcg_wa += $item->money;
                $note = '未抢购/抢购失败返还积分';
                $record = UserWalletRecord::insertrecord($item->userid,$item->money,10,1,1,$user->wallet->hcg_wa,$note);
                //更新预约表信息
                $item->moneyed += $item->money;
                $item->money = 0;
                $item->status = 1;
                if($item->save() && $user->wallet->save() && $record){
                    //成功时,不做操作
                }else{
                    file_put_contents('../runtime/logs/returnhcg_error_log.txt', date('Y-m-d H:i:s',time()).',账号:'.$user->username.'返还积分--执行失败;'.PHP_EOL,FILE_APPEND);
                    continue;
                }

            }

        }
        file_put_contents('../runtime/logs/returnhcg_log.txt', date('Y-m-d H:i:s',time()).',返还积分--执行成功;'.PHP_EOL,FILE_APPEND);

    }

    // (宠物九子)定时任务 每日清空抢购次数(每日0:10执行)
    public function actionClearkillnum(){
		$ip = Yii::$app->getRequest()->getUserIP();
        if($ip != '43.226.156.71') { // 填服务器IP
            file_put_contents('../runtime/logs/clearcash_err_ip.txt', '非本站ip:' . $ip . '访问 —— 时间：' . date("Y-m-d H:i:s") . "\r\n", FILE_APPEND);
            echo "非本站ip:" . $ip . "访问";
            exit();
        }
        // 获取当日零点时间戳
        $time = mktime(0, 0, 0, date('m'), date('d'), date('Y'));   //获取当日零点时间戳

        $flag = file_exists('../runtime/logs/clearkillnum_log.txt');   //检测文件是否存在
        if($flag){
            $param = file_get_contents('../runtime/logs/addzodiacaward_log.txt');
            if($param){
                $param_one = explode(';',$param);
                $count = count($param_one)-2;
                $ary_one = $param_one[$count];  //获取最后一条记录
                $ary = explode(',',$ary_one);
                $strtime = strtotime($ary[0]);  //获取最后一条记录的时间戳
//                如果今天0点时间小于最后一次记录时间(表示已经执行过转换)
                if($strtime > $time){
                    return ;
                }
            }

        }
        //获取所有的宠物
        $zodiac = Zodiac::find()->all();
        if($zodiac){
            foreach ($zodiac as $item) {
                $item->kill_num = 0;
                $item->save();
            }
        }
        file_put_contents('../runtime/logs/clearkillnum_log.txt', date('Y-m-d H:i:s',time()).',宠物每日抢购数清空--执行成功;'.PHP_EOL,FILE_APPEND);
    }

    // (宠物九子)定时任务 更新缓存数据(1小时执行一次)
    public function actionUpdateredisnum(){
		$ip = Yii::$app->getRequest()->getUserIP();
        if($ip != '43.226.156.71') { // 填服务器IP
            file_put_contents('../runtime/logs/clearcash_err_ip.txt', '非本站ip:' . $ip . '访问 —— 时间：' . date("Y-m-d H:i:s") . "\r\n", FILE_APPEND);
            echo "非本站ip:" . $ip . "访问";
            exit();
        }
        //获取所有的宠物
        $zodiac = Zodiac::find()->all();
        if($zodiac){
            foreach ($zodiac as $item) {
                //获取当前该宠物的缓存数量
                $redis_num = count(Yii::$app->redis->lrange("zodiac_issue:".$item->id,0,-1));
                //获取当前宠物在发行表中的数据
                $issue_num = ZodiacIssue::find()->where('zodiac_id = :zodiac_id and issel = 0',[':zodiac_id'=>$item->id])->count();
                //判断redis缓存的宠物数量和发行表中宠物的数量是否一致
                $last = $redis_num - $issue_num;
                //如果redis缓存数量大于发行数量,则redis缓存数量减少
                if($last > 0){
                    for($i=0;$i<$last;$i++){
                        Yii::$app->redis->lpop('zodiac_issue:'.$item->id);
                    }
                }
                //如果redis缓存数量小于发行数量,则redis缓存数量增加
                if($last < 0){
                    $newlast = $issue_num - $redis_num;
                    for($i=0;$i<$newlast;$i++){
                        Yii::$app->redis->lpush('zodiac_issue:'.$item->id ,'1');
                    }
                }
                $new_num = count(Yii::$app->redis->lrange("zodiac_issue:".$item->id,0,-1));
                file_put_contents('../runtime/logs/redis_log.txt', '时间：'.time().'，定时更新宠物'.$item->id.'子缓存，当前num:'.$new_num.PHP_EOL,FILE_APPEND);
            }
        }
        file_put_contents('../runtime/logs/updateredis_log.txt', date('Y-m-d H:i:s',time()).',更新缓存--执行成功;'.PHP_EOL,FILE_APPEND);
    }


    /**
     * 获取直推奖励
     * @param $number
     * @param $userdata
     */
    public static function actionDirectaward($number,$userdata,$user_zodiac_id){
        //获取用户的多代上级推荐人
        $profile = UserProfile::find()->select('up_referrer_id')->where('userid = :userid',[':userid'=>$userdata->id])->one();
        if($profile->up_referrer_id){
            //获取前3代推荐人
            $up_user = array_slice(array_reverse(explode('-', $profile->up_referrer_id)),0,3);
            $count = count($up_user);
            for($i = 0;$i < $count;$i++){
                // 静态收益表
                $award = \common\models\LtAward::find()->where('layer_num = :layer_num', [':layer_num' => $i + 1])->one();
                $amount = $number * $award->award_per;
                // 钱包表
                $wallet = UserWallet::find()->where('userid = :userid', [':userid' => $up_user[$i]])->one();
                $wallet->care_wa += $amount;
                $note = '直推第'.($i+1).'代成员'.$userdata->username.'，用户宠物表id: '.$user_zodiac_id.'增值，获得推广收益';
                // 产生记录
                $record = UserWalletRecord::insertrecord($up_user[$i], $amount, 7, 1, 3, $wallet->care_wa, $note);
                if($wallet->save() && $record){
                    continue;
                }else{
                    break;
                }
            }
        }
        return true;

    }


}
