<?php

namespace frontend\controllers;

/**
 * @author  shuang
 * @date    2016-12-3 22:22:03
 * @version V1.0
 * @desc
 */
use common\components\MController;
use common\models\User;
use common\models\UserAmountTrade;
use common\models\UserWallet;
use common\models\UserWalletRecord;
use common\models\UserZodiac;
use common\models\Zodiac;
use common\models\ZodiacApply;
use common\models\ZodiacGrade;
use frontend\models\WB_UserWalletRecord;
use frontend\models\WB_UserZodiac;
use frontend\models\WB_Wallet_address;
use Yii;
use common\components\MTools;
use frontend\models\WB_UserAmountTrade;
use frontend\models\WB_UserBank;
use yii\db\Exception;
use yii\helpers\HtmlPurifier;
use frontend\models\WB_UserServer;
use frontend\models\WB_UserWallet;
use frontend\models\WB_UserProfile;
use \common\models\StockPriceRecord;
use common\models\TradeNum;
use common\models\ZodiacIssue;
use common\models\SnapJudgment;
use frontend\models\WB_ZodiacApply;
use frontend\models\WB_ZodiacIssue;
use common\models\UserBank;

class TradeController extends MController {

    public $message;
    public $flag = false;

    //预约飞龙产品    2019-07-05  小余
    public function actionApplyzodiac(){
        //跨域请求
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        $tradeswitch = MTools::getYiiParams('tradeswitch');             // 交易系统,  0: 关闭, 1: 开启
        $applytradeswitch = MTools::getYiiParams('applytradeswitch');   // 预约交易,  0: 关闭, 1: 开启
        if(Yii::$app->request->isPost){

            $req = Yii::$app->request;
            $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
            $zodiac_id = trim(HtmlPurifier::process($req->post('zodiac_id')));      //宠物表id
            if($token == '')    $this->retjson('0002', Yii::t('app', '无效参数'));
            //获取登录用户信息
            $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
            if(!$userdata)      $this->retjson('0003', Yii::t('app', '已登出'));
            //判断交易系统是否开放
            if($tradeswitch == 0) $this->retjson('0002', Yii::t('app', '交易系统暂未开放'));
            if($userdata->isactivate != 1){
                $this->retjson('0002', Yii::t('app', '账号未实名，无法进行操作！'));
            }
            //判断预约是否开放
            if($applytradeswitch == 0) $this->retjson('0002', Yii::t('app', '预约功能暂未开放'));
            $zodiac = Zodiac::findOne($zodiac_id);
            if(empty($zodiac))  $this->retjson('0002', Yii::t('app', '未找到该预约商品'));
            $zodiac_apply = WB_ZodiacApply::find()->where('zodiac_id = :zodiac_id and userid = :userid and status = 0',[':zodiac_id'=>$zodiac_id,':userid'=>$userdata->id])->asArray()->all();
            if(!empty($zodiac_apply))   $this->retjson('0002', Yii::t('app', '你已预约过该商品'));
            // 当天零点时间戳
            $zerotimestamp = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
            $endtimestamp = mktime($zodiac->begin_at_hour, $zodiac->begin_at_minu, 0, date('m'),
                date('d'), date('Y'));
            // 预约结束时间戳
            $nowtime = time();
            if($nowtime<$zerotimestamp || $nowtime>$endtimestamp)   $this->retjson('0002', Yii::t('app', '不在预约时间内'));

            if($userdata->wallet->hcg_wa < $zodiac->subscribe)     $this->retjson('0002', Yii::t('app', '你的积分不足,请充值！'));
            //  开启事务
            $trans = Yii::$app->db->beginTransaction();
            
            try {
                //扣除预约花费
                $userdata->wallet->hcg_wa -= $zodiac->subscribe;
                if($userdata->wallet->hcg_wa <0 ){
                    $trans->rollBack();
                    $this->retjson('0002', Yii::t('app', '预约失败'));
                }
                //插入钱包记录
                $note = "预约飞龙ID：".$zodiac_id."，冻结积分".$zodiac->subscribe;
                $record = WB_UserWalletRecord::nsinsertrecord($userdata->id,$zodiac->subscribe,6,2,1,$userdata->wallet->hcg_wa,$note);

                //插入用户预约表
                $res = WB_ZodiacApply::insertrecord($userdata->id,$zodiac_id,$zodiac->subscribe);
				
                $zodiac->click_num +=1;             //活跃度增加
                if($userdata->wallet->save() && $record->save() && $res && $zodiac->save()){
                    $trans->commit();
                    $this->retjson('0001', Yii::t('app', '预约成功'));
                }else{
                    $trans->rollBack();
                    $this->retjson('0002', Yii::t('app', '预约失败'));
                }
            } catch (Exception $e) {
                $trans->rollBack();
                $this->retjson('0002', json_encode($e));
            }
        }else{
            $this->retjson('0002', '非法请求');
        }
    }

    //预约列表      2019-07-08小余
    public function actionApplylist(){
        //跨域请求
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        if(Yii::$app->request->isPost){
            $req = Yii::$app->request;
            $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
            $page = trim(HtmlPurifier::process($req->post('page')))?trim(HtmlPurifier::process($req->post('page'))):1;
            if($token == '')    $this->retjson('0002', Yii::t('app', '无效参数'));
            //获取登录用户信息
            $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
            if(!$userdata)      $this->retjson('0003', Yii::t('app', '已登出'));
            $zodiac_apply = WB_ZodiacApply::get_list($userdata->id,$page);
            $data = ["total" => $zodiac_apply['total'],"list" => []];
            foreach ($zodiac_apply['data'] as $k => $v){
                $item['id'] = $v['id'];
                $item['created_at'] = date("Y-m-d H:i:s",$v['updated_at']);
                $zodiac = Zodiac::findOne($v['zodiac_id']);
                $item['name'] = $zodiac->name;
                $item['status'] = $v['status'];
                if($v['money'] ==0){
                    $item['hcg_text'] = "预约退回";
                    $item['hcg'] = $v['moneyed'];
                }else{
                    $item['hcg_text'] = "预约冻结";
                    $item['hcg'] = $v['money'];
                }
                array_push($data['list'],$item);
            }
            $data['total'] = $zodiac_apply['total'];

            $this->retjson('0001', '获取成功',$data);
        }else{
            $this->retjson('0002', '非法请求');
        }
    }

    //抢购        2019-07-08小余
    public function actionTradebuy() {
        //跨域请求
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        // 多次请求设置延时
        $this->timedelay();
        $tradeswitch = MTools::getYiiParams('tradeswitch');             // 交易系统,  0: 关闭, 1: 开启
        $applytradeswitch = MTools::getYiiParams('applytradeswitch');   // 预约交易,  0: 关闭, 1: 开启
        if(Yii::$app->request->isPost){
            $req = Yii::$app->request;
            $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
            $zodiac_id = trim(HtmlPurifier::process($req->post('zodiac_id')));      //宠物表id
            if($token == '')    $this->retjson('0002', Yii::t('app', '无效参数'));
            //获取登录用户信息
            $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
            if(!$userdata)      $this->retjson('0003', Yii::t('app', '已登出'));
            
            $userbank = UserBank::find()->where('userid = :userid and state = 1',[':userid' => $userdata->id])->one();
            if(!$userdata->userprofile->alipay && !$userdata->userprofile->wechat && !$userbank){
                $this->retjson('0002', Yii::t('app', '该用户未绑定支付方式'));
            }
            if($userdata->iseal == 1) $this->retjson('0002', Yii::t('app', '您的账号已被禁止交易，请申请后台解封'));

            if($userdata->isactivate != 1){
                $this->retjson('0002', Yii::t('app', '账号未实名，无法进行操作！'));
            }

        //判断交易系统是否开放
        if($tradeswitch == 0) $this->retjson('0002', Yii::t('app', '交易系统暂未开放'));

        $zodiac = Zodiac::findOne($zodiac_id);
        if(empty($zodiac))  $this->retjson('0002', Yii::t('app', '未找到该商品'));

        // 当天零点时间戳
        $zerotimestamp = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $nowtime = time();
        $begin_time = $zerotimestamp + $zodiac->begin_at_hour * 3600 + $zodiac->begin_at_minu * 60;     //开始抢购时间

        $end_time = $zerotimestamp + $zodiac->end_at_hour * 3600 + $zodiac->end_at_minu * 60;     //结束抢购时间

        if($nowtime < $begin_time || $nowtime > $end_time)   $this->retjson('0002', Yii::t('app', '不在抢购时间内'));
        //判断用户是否抢购过
        $snap = SnapJudgment::find()->where('userid = :userid and zodiacid = :zodiacid and created_at >= :zerotimestamp',[':userid'=>$userdata->id,':zodiacid'=>$zodiac_id,':zerotimestamp'=>$zerotimestamp])->all();
        if(!empty($snap)){
            $this->retjson('0002', Yii::t('app', '同一场次宠物只限抢购一次'.$userdata->id));
        }

        //判断用户是否预约过
        $my_apply = ZodiacApply::find()->where('created_at>:zerotimestamp and userid = :id and zodiac_id = :zodiac_id  and status = 0 ',[':id'=>$userdata->id,':zodiac_id'=>$zodiac_id,':zerotimestamp'=>$zerotimestamp])->one();

        //  开启事务
//            $trans = Yii::$app->db->beginTransaction();
//
//            try {
        if($my_apply){
            //如果该用户是被限制的,则无法抢购
            if($my_apply->islock){
                $newsnap = new SnapJudgment();
                $newsnap->zodiacid = $zodiac_id;
                $newsnap->created_at = time();
                $newsnap->updated_at = time();
                $newsnap->userid = $userdata->id;
                $newsnap->status = 2;
                $newsnap->issue_id = $userdata->id.'_'.time();
                if($newsnap->save()){
                    $this->retjson('0001', Yii::t('app', '抢购失败'));
                }else{
                    $this->retjson('0002', Yii::t('app', '数据异常'));
                }

            }
            $cost_hcg = 0;
        }else{
            $cost_hcg = $zodiac->seckill;
            if($userdata->wallet->hcg_wa < $cost_hcg ){
                $this->retjson('0002', Yii::t('app', '你的积分不足,请充值！'));
            }
        }
        // 自动匹配
//                $isdone = UserAmountTrade::issueAutoMatch($userdata->id,$zodiac_id,$my_apply);
        //  从redis获取队列是否有队列值
        $count = Yii::$app->redis->lpop('zodiac_issue:'.$zodiac_id); // 踢除redis存储的数量
        //  队列值不足,抢购失败
        if(!$count){
            $redis_num = count(Yii::$app->redis->lrange("zodiac_issue:".$zodiac_id,0,-1));
            file_put_contents('../runtime/logs/redis_log.txt', '时间：'.time().'，用户ID：'.$userdata->id.'，抢购宠物'.$zodiac_id.'子失败，原因：redis没有宠物'.'num:'.$redis_num.PHP_EOL,FILE_APPEND);

            //插入抢购记录表
            $issul_id = $userdata->id.'_'.time();
            $sql="INSERT ignore INTO me_snap_judgment ( `zodiacid`,`issue_id`,`created_at`,`updated_at`,`userid`,`status`) VALUES (".$zodiac_id.",'".$issul_id."',".time().",".time().",".$userdata->id.",2)";
            $resj =  Yii::$app->db->createCommand($sql)->execute();
            if($resj){
//                        $trans->commit();
                $this->retjson('0001', Yii::t('app', '抢购失败'));
            }else{
//                        $trans->rollBack();
                $this->retjson('0002', Yii::t('app', '响应失败'));
            }
        }
        //获取所有出售订单信息
        $list = WB_ZodiacIssue::find()->where('issel = 0 and zodiac_id = :zodiac_id and belong_id != :userid',[':zodiac_id'=>$zodiac_id,':userid'=>$userdata->id])->all();

        foreach ($list as $k => $v){
            $shu2 = SnapJudgment::find()->where('zodiacid=:zodiac_id && userid=:userid && created_at>=:created_at ', [':zodiac_id' => $zodiac_id,':userid' => $userdata->id,':created_at' => $zerotimestamp])->count();

            if (!$shu2){
                // 插入抢购记录表
                $sql="INSERT ignore INTO me_snap_judgment ( `zodiacid`,`issue_id`,`created_at`,`updated_at`,`userid`,`status`) VALUES (".$zodiac_id.",".$v->id.",".time().",".time().",".$userdata->id.",1)";
                $resi =  Yii::$app->db->createCommand($sql)->execute();
                if($resi){
                    // 如有预约,更改预约状态
                    $my_apply_save = true;

                    // 如是抢购,扣除钱包钱,新增钱包记录
                    $record_save = true;
                    $wallet_save = true;

                    //如果是预约后才抢购
                    if($my_apply){
                        $my_apply->status = 1;                 //已完成
                        $my_apply->kill_status = 1;            //抢购成功
                        $my_apply->updated_at = time();
                        $my_apply_save = $my_apply->save(false);
                    }else{
                        //扣除费用
                        $userdata->wallet->hcg_wa -= $cost_hcg;
                        $wallet_save = $userdata->wallet->save(false);

                        //插入钱包记录
                        $note = "抢购飞龙ID：".$zodiac_id."，无预约，冻结积分".$cost_hcg;
                        $record_save = UserWalletRecord::insertrecord($userdata->id,$zodiac->seckill,9,2,1,$userdata->wallet->hcg_wa,$note);
//                        $record_save = WB_UserWalletRecord::insertrecord($userdata->id,$zodiac->seckill,9,2,1,$userdata->wallet->hcg_wa,$note);
                    }

                    //  更改发行表状态
                    $v->issel = 1;
                    $v->updated_at = time();

                    //获取卖家信息
                    $seller = User::findOne($v->belong_id);
                    //获取买家银行卡
                    $sellerBank = WB_UserBank::getMyDefaultBank($v->belong_id);
                    //  新增订单记录c
                    $isordered = WB_UserAmountTrade::createOrder(
                        $userdata->id, $userdata->username,$seller->id, $seller->username,$sellerBank,$seller->userprofile,null,$v->hcg, $v->hcg,1,0,0,7,1,1,1, null,$v->id,time(), '等待买家付款'
                    );
                    //  更改预约状态,新增订单记录,改变发行表状态,钱包记录,钱包,抢购记录
                    if($my_apply_save && $isordered && $v->save() && $record_save && $wallet_save){
//                                $trans->commit();
                            $this->retjson('0001', Yii::t('app', '抢购成功'));
                    }
                }
            }
        }
//                $trans->rollBack();
        Yii::$app->redis->lpush('zodiac_issue:'.$zodiac_id, 1);
        $redis_num = count(Yii::$app->redis->lrange("zodiac_issue:".$zodiac_id,0,-1));
        file_put_contents('../runtime/logs/redis_log.txt', '时间：'.time().'，用户ID：'.$userdata->id.'，抢购宠物'.$zodiac_id.'子失败，原因：钱包记录或钱包没保存成功'.'redis返还'.'num:'.$redis_num.PHP_EOL,FILE_APPEND);
        $this->retjson('0002', Yii::t('app', '抢购失败'));



//            } catch (Exception $e) {
//                $trans->rollBack();
//                $this->retjson('0002', Yii::t('app', '响应失败'));
//            }
        }else{
            $this->retjson('0002', '非法请求');
        }


    }

    //  确认付款    2019-07-08小余
    public function actionBuyconfirm() {
        //跨域请求
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        // 多次请求设置延时
        $this->timedelay();
        if(Yii::$app->request->isPost){
            $request = Yii::$app->request;
            $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($request->post('token') ? $request->post('token') : $request->get('token')));
            $id = HtmlPurifier::process($request->post('id'));                      // 获取订单号
            $src = HtmlPurifier::process($request->post('src'));                    // 付款凭证路径
            $jy_pwd = trim(HtmlPurifier::process($request->post('jy_pwd')));        // 交易密码

            if($token == '')    $this->retjson('0002', Yii::t('app', '无效参数'));
            //获取登录用户信息
            $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
            if(!$userdata)      $this->retjson('0003', Yii::t('app', '已登出'));
            $userid = $userdata->id;       // 当前用户ID
            $order = UserAmountTrade::findOne($id);
            if(!$order) $this->retjson('0002', Yii::t('app', '订单获取失败'));
            //校验交密码
            if(!$userdata->validatePassword2($jy_pwd)){
                $this->retjson('0002', Yii::t('app', '交易密码错误'));
            }

            // 判断是否绕过下单直接确认付款（判断是否为买家本人）
            if($order->in_userid != $userid)        $this->retjson('0002',Yii::t('app','请先下单'));
            // 判断是否已经确认付款
            if($order->status == 2) $this->retjson('app',Yii::t('app','您已确认付款'));
            // zodiac购买确认付款

            if($order->order_type == 1){
                $res = WB_UserAmountTrade::buyConfirm($id, $src);
            }
            if($res){
                //$text = Yii::t('app', '【宠物九子】尊敬的用户，您有宠物九子已被抢购，请尽快登录系统进行处理，否则2小时后将自动交易！');
                //$quhao = '86';
                $outuser = User::findOne($order->out_userid);
                $phone = $outuser->userprofile->phone;
                //$strphone = $quhao . "" . $phone;
                MTools::smsg($phone,'2');
                $this->retjson('0001',Yii::t('app','成功'));
            }else{
                $this->retjson('0002',Yii::t('app','失败'));
            }
        }else{
            $this->retjson('0002', '非法请求');
        }

    }

    //  确认收款（交易完结）      2019-07-08小余
    public function actionSellconfirm() {
        //跨域请求
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');

        if(Yii::$app->request->isPost){
            $request = Yii::$app->request;
            $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($request->post('token') ? $request->post('token') : $request->get('token')));
            $id = HtmlPurifier::process($request->post('id'));       // 获取订单号
            $jy_pwd = trim(HtmlPurifier::process($request->post('jy_pwd')));        // 交易密码

            if($token == '')    $this->retjson('0002', Yii::t('app', '无效参数'));
            //获取登录用户信息
            $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
            if(!$userdata)      $this->retjson('0003', Yii::t('app', '已登出'));
            // 当前用户ID
            $userid = $userdata->id;
            if(empty($userid) || $userid == null)   $this->retjson('0003',Yii::t('app','您已登出'));
            // 多次请求设置延时
            $this->timedelay();

            // 判断是否重复提交“确认收款”
            $order = UserAmountTrade::findOne($id);
            if(!$order) $this->retjson('0002', Yii::t('app', '订单获取失败'));
            //校验交密码
            if(!$userdata->validatePassword2($jy_pwd)){
                $this->retjson('0002', Yii::t('app', '交易密码错误'));
            }

            // 判断是否为卖家本人
            if($order->out_userid != $userid)  $this->retjson('0002',Yii::t('app','你不是卖家'));

            if($order->status == 3) $this->retjson('0003',Yii::t('app','您已确认收款'));

            if($order->order_type == 1) $res = WB_UserAmountTrade::sellConfirm($id);      // zodiac卖出确认收款

            if ($res) {
                $inuser = User::findOne($order->in_userid);
                $phone = $inuser->userprofile->phone;
                MTools::smsg($phone,'3');
                $this->retjson('0001',Yii::t('app','成功'));
            } else {
                $this->retjson('0002',Yii::t('app','失败'));
            }
        }else{
            $this->retjson('0002', '非法请求');
        }
    }

    // AJAX 获取单条订单详细信息      2019-07-08小余
    public function actionOrderdetail() {
        //跨域请求
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');

        if(Yii::$app->request->isPost){
            $request = Yii::$app->request;
            $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($request->post('token') ? $request->post('token') : $request->get('token')));
            $id = HtmlPurifier::process($request->post('id'));       // 获取订单号
            $type = HtmlPurifier::process($request->post('type'));       // 获取订单号

            if($token == '')    $this->retjson('0002', Yii::t('app', '无效参数'));
            //获取登录用户信息
            $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
            if(!$userdata)      $this->retjson('0003', Yii::t('app', '已登出'));
            // 当前用户ID
            $userid = $userdata->id;
            if(empty($userid) || $userid == null)   $this->retjson('0003',Yii::t('app','您已登出'));
            // 多次请求设置延时
            $this->timedelay();
            $data = WB_UserAmountTrade::getOrderDetails($userid, $id,$type);
            $this->retjson('0001', Yii::t('app', '成功'), $data);

        }else{
            $this->retjson('0002', '非法请求');
        }
    }

    //转让记录              2019-07-10  小余
    public function actionTranstrade(){
        //跨域请求
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        if(Yii::$app->request->isPost){
            $req = Yii::$app->request;
            $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
            $type = trim(HtmlPurifier::process($req->post('type')));       //type
            if($token == '')    $this->retjson('0002', Yii::t('app', '无效参数'));
            //获取登录用户信息
            $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
            if(!$userdata)      $this->retjson('0003', Yii::t('app', '已登出'));
            // 当前用户ID
            $userid = $userdata->id;
            $data = [];
            //待转让
            if($type==0){
                // 当天零点时间戳
                $zerotimestamp = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
                $zodiac_issue = ZodiacIssue::find()->where('belong_id = :belong and issel=0',[':belong'=>$userid])->asArray()->all();
                foreach ($zodiac_issue as $k =>$v){
                    $zodiac = Zodiac::findOne($v['zodiac_id']);
                    //抢购开始时间
//                    $time = $zerotimestamp + $zodiac->begin_at_hour*60*60 + $zodiac->begin_at_minu * 60;
//                    if($time<time()){
                    $temp['name'] = $zodiac->name;
                    $temp['due'] = $zodiac->due;
                    $temp['award'] = (floor($zodiac->award *100)/100).'%';
                    $temp['hcg'] = floor($v['hcg']*10)/10;
                    array_push($data,$temp);
//                    }
                }
                $this->retjson('0001','获取成功',$data);
            }
            //已转让
            if($type == 1){
                $order = WB_UserAmountTrade::find()->where('out_userid = :out_userid and status=3',[':out_userid'=>$userid])->asArray()->all();
                foreach ($order as $k =>$v){
                    $zodiac_issue_id = $v['areaid'];
                    $zodiac_issue = ZodiacIssue::findOne($zodiac_issue_id);
                    $zodiac = Zodiac::findOne($zodiac_issue->zodiac_id);
                    $temp['order_id'] = $v['id'];
                    $temp['name'] = $zodiac->name;
                    $temp['in_userid'] = $v['in_userid'];
                    $temp['out_userid'] = $v['out_userid'];
                    $temp['due'] = $zodiac->due;
                    $temp['award'] = (floor($zodiac->award *100)/100).'%';
                    $temp['hcg'] = floor($zodiac_issue['hcg']*10)/10;
                    array_push($data,$temp);

                }
                $this->retjson('0001','获取成功',$data);
            }
            //转让中
            if($type == 2){
                $sellertradeovertime = MTools::getYiiParams('sellertradeovertime');     // 卖家收款超时时间
                $order = WB_UserAmountTrade::find()->where('out_userid = :out_userid and status in (0,1,2,7) ',[':out_userid'=>$userid])->asArray()->all();
                foreach ($order as $k =>$v){
                    $zodiac_issue_id = $v['areaid'];
                    $zodiac_issue = ZodiacIssue::findOne($zodiac_issue_id);
                    $zodiac = Zodiac::findOne($zodiac_issue->zodiac_id);
                    $temp['order_id'] = $v['id'];
                    $temp['name'] = $zodiac->name;
                    $temp['in_userid'] = $v['in_userid'];
                    $temp['out_userid'] = $v['out_userid'];
                    $temp['status'] = $v['status'];
                    //如果买家已付款，显示收款倒计时
                    if($temp['status'] == 7 || $temp['status'] == 2){
                        $temp['countdown'] = $v['created_at']+7200;
                    }

                    $temp['due'] = $zodiac->due;
                    $temp['award'] = (floor($zodiac->award *100)/100).'%';
                    $temp['hcg'] = floor($zodiac_issue['hcg']*10)/10;
                    array_push($data,$temp);
                }
                $this->retjson('0001','获取成功',$data);
            }
            //取消/申诉
            if($type == 3){
                $order = WB_UserAmountTrade::find()->where('out_userid = :out_userid and status in (4,5,6,8,9,10) ',[':out_userid'=>$userid])->asArray()->all();
                $order_status = WB_UserAmountTrade::$status;
                foreach ($order as $k =>$v){
                    $zodiac_issue_id = $v['areaid'];
                    $zodiac_issue = ZodiacIssue::findOne($zodiac_issue_id);
                    $zodiac = Zodiac::findOne($zodiac_issue->zodiac_id);
                    $temp['order_id'] = $v['id'];
                    $temp['name'] = $zodiac->name;
                    $temp['in_userid'] = $v['in_userid'];
                    $temp['out_userid'] = $v['out_userid'];
                    $temp['due'] = $zodiac->due;
                    $temp['award'] = (floor($zodiac->award *100)/100).'%';
                    $temp['hcg'] = floor($zodiac_issue['hcg']*10)/10;
                    $temp['status'] = $order_status[$v['status']];
                    array_push($data,$temp);
                }
                $this->retjson('0001','获取成功',$data);
            }
        }else{
            $this->retjson('0002', '非法请求');
        }
    }

    //领养记录              2019-07-10 小余
    public function actionAdoptrecord(){
        //跨域请求
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        if(Yii::$app->request->isPost){
            $req = Yii::$app->request;
            $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
            $type = trim(HtmlPurifier::process($req->post('type')));       //type
            if($token == '')    $this->retjson('0002', Yii::t('app', '无效参数'));
            //获取登录用户信息
            $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
            if(!$userdata)      $this->retjson('0003', Yii::t('app', '已登出'));
            // 当前用户ID
            $userid = $userdata->id;
            $data = [];
            //领养中
            if($type == 1){
                $order = WB_UserAmountTrade::find()->where('in_userid = :in_userid and status in (0,1,2,7) ',[':in_userid'=>$userid])->asArray()->all();
                $buyertradeovertime = MTools::getYiiParams('buyertradeovertime');       // 买家付款超时时间
                $sellertradeovertime = MTools::getYiiParams('sellertradeovertime');     // 卖家收款超时时间
                foreach ($order as $k =>$v){
                    $zodiac_issue_id = $v['areaid'];
                    $zodiac_issue = ZodiacIssue::findOne($zodiac_issue_id);
                    $zodiac = Zodiac::findOne($zodiac_issue->zodiac_id);
                    $temp['order_id'] = $v['id'];
                    $temp['in_userid'] = $v['in_userid'];
                    $temp['out_userid'] = $v['out_userid'];
                    $temp['status'] = $v['status'];
                    $temp['name'] = $zodiac->name;
                    $temp['due'] = $zodiac->due;
                    if($temp['status'] == 7 || $temp['status'] == 2){
                        $temp['countdown'] = $v['created_at']+7200;
                    }
                    $temp['award'] = (floor($zodiac->award*100)/100).'%';
                    $temp['hcg'] = floor($zodiac_issue['hcg'] * 10 )/10;
                    array_push($data,$temp);
                }
                $this->retjson('0001','获取成功',$data);
            }
            //已领养
            if($type == 2){
                $myzodiac = WB_UserZodiac::find()->where('is_rack = 0 and is_overtime = 0 and userid = :userid',[':userid'=>$userdata->id])->all();

                foreach ($myzodiac as $k =>$v){
                    $zodiac = Zodiac::findOne($v->zodiac_id);
                    $zodiac_issue = ZodiacIssue::findOne($v->issue_id);
                    $order = WB_UserAmountTrade::find()->where('areaid = :areaid',[':areaid' =>$zodiac_issue->id])->one();
                    $temp['order_id'] = $order->id;
                    $temp['in_userid'] = $order->in_userid;
                    $temp['out_userid'] = $order->out_userid;
                    $temp['over_time'] = date("Y-m-d",$v->over_time);         //到期时间
                    $temp['over_timetamp'] = $v->over_time;         //到期时间
                    $temp['totalhcg'] = $v->hcg - $v->old_hcg;  //累计收益
                    $temp['name'] = $zodiac->name;
                    $temp['due'] = $zodiac->due;
                    $temp['award'] = (floor($zodiac->award*100)/100).'%';
                    $temp['hcg'] = floor($zodiac_issue->hcg *10)/10;
                    array_push($data,$temp);
                }
                $this->retjson('0001','获取成功',$data);
            }
            //取消/申诉
            if($type == 3){
                $order = WB_UserAmountTrade::find()->where('in_userid = :in_userid and status in (4,5,6,8,9,10)',[':in_userid'=>$userid])->asArray()->all();
                foreach ($order as $k =>$v){
                    $zodiac_issue_id = $v['areaid'];
                    $zodiac_issue = ZodiacIssue::findOne($zodiac_issue_id);
                    $zodiac = Zodiac::findOne($zodiac_issue->zodiac_id);
                    $temp['order_id'] = $v['id'];
                    $temp['in_userid'] = $v['in_userid'];
                    $temp['out_userid'] = $v['out_userid'];
                    $temp['name'] = $zodiac->name;
                    $temp['due'] = $zodiac->due;
                    $temp['award'] = (floor($zodiac->award*100)/100).'%';
                    $temp['hcg'] = floor($zodiac_issue['hcg']*10)/10;
                    array_push($data,$temp);
                }
                $this->retjson('0001','获取成功',$data);
            }
        }else{
            $this->retjson('0002', '非法请求');
        }
    }


    // 交易主界面
    public function actionTradecenter() {
        $req = Yii::$app->request;
        $sign = Mtools::validsign($req->post());
        if(!$sign) $this->retjson('0002', '验签错误');

        $userid = Yii::$app->user->id;

        if($userid == null) $this->retjson('0003', '您已登出');

        // 返回价格下拉, app端需要根据价格区间去判断用户输入的数量
        $tradenum = TradeNum::getAreaNum();

        $data['tradenum'] = $tradenum;

        $data['price'] = StockPriceRecord::getCurrentPrice();

        $data['cash_wa'] = UserWallet::getWallet($userid)->cash_wa;

        $this->retjson('0001', Yii::t('app', '成功'), $data);
    }

    // 我的订单列表 -> AJAX
    public function actionTradeorderlistload(){
        $req = Yii::$app->request;

//        $sign = Mtools::validsign($req->post());
//        if(!$sign){
//            $res = [
//                'status' => '0002',
//                'message' => '验签错误',
//            ];
//            return json_encode($res);
//            exit;
//        }

        $userid = Yii::$app->user->id;

        $order_type = HtmlPurifier::process($req->post('order_type'));                          // 订单类型, 1: BBA订单
        $sort       = HtmlPurifier::process($req->post("sort", 'created_at'));     // 排序字段
        $order      = HtmlPurifier::process($req->post("order",'desc'));           // 排序方式
        $page       = HtmlPurifier::process($req->post("page"));                                // 分页页数
        $limit      = (int)HtmlPurifier::process($req->post("limit"));                          // 每个分页的数据量

        $tradeOrderList = WB_UserAmountTrade::getTradeOrderListLoad($userid, $order_type, $sort, $order, $page, $limit);

        $data['orderlist'] = $tradeOrderList;

        $this->retjson('0001', Yii::t('app', '成功'), $data);
    }

    //  通用->取消订单
    public function actionCancel() {
        $request = Yii::$app->request;
        // 多次请求设置延时
        $this->timedelay();

        $id = HtmlPurifier::process($request->post('id'));

        $userid = Yii::$app->user->id;

        if(empty($userid) || $userid == null) $this->retjson('0003',Yii::t('app','您已登出'));

        $order = UserAmountTrade::findOne($id);

        if(!$order) $this->retjson('0002', '取消失败');

        $ismyorder = UserAmountTrade::isMyOrder($id, $userid);

        if(!$ismyorder) $this->retjson('0002', $this->retjson('0002', '取消失败'));

        $order_type = $order->order_type;

        // 卖出取消订单
        if ($order->type == 2 && $order->out_userid == $userid) {     // 此订单未被下单，为出售订单，且卖家ID为本人ID
            if ($order->status == 3) $this->retjson('0002','app',Yii::t('app','无法取消已成交订单'));

            $res = WB_UserAmountTrade::sellCancel($id, $userid, $order_type);
            if ($res == 'success') {
                $this->retjson('0001', Yii::t("app", "成功！"));
            } elseif ($res == 'buyerplaced') {
                $this->retjson('0002', Yii::t('app', '买家已下单，订单无法取消!'));
            } elseif ($res == 'buyerpaid') {
                $this->retjson('0002', Yii::t('app', '买家已付款，订单无法取消!'));
            } else {
                $this->retjson('0002', Yii::t("app", "取消失败！"));
            }
        } elseif ($order->type == 1 && $order->in_userid == $userid) {        // 买入取消订单
            if ($order->status == 3) $this->retjson('0002','app',Yii::t('app','无法取消已成交订单'));

            $res = WB_UserAmountTrade::buyCancel($id);
            if ($res == 'success') {
                $this->retjson('0001',Yii::t('app','成功！'));
            } elseif ($res == 'sellerplaced') {
                $this->retjson('0002',Yii::t('app','卖家已下单，订单无法取消'));
            } elseif ($res == 'buyerpaid') {
                $this->retjson('0002',Yii::t('app','买家已付款，订单无法取消'));
            } else {
                $this->retjson('0002',Yii::t('app','取消失败！'));
            }
        } else {
            $this->retjson('0002',Yii::t('app','取消失败！'));
        }
    }

    // 全部订单列表 -> AJAX
    public function actionAllorders() {
        $req = Yii::$app->request;
        // 多次请求设置延时
        $this->timedelay();

        $order_type = HtmlPurifier::process($req->post('order_type'));                          // 订单类型, 1: BBA订单
        $sort       = HtmlPurifier::process($req->post("sort", 'created_at'));     // 排序字段
        $order      = HtmlPurifier::process($req->post("order",'desc'));           // 排序方式
        $page       = HtmlPurifier::process($req->post("page"));                                // 分页页数
        $limit      = (int)HtmlPurifier::process($req->post("limit"));                          // 每个分页的数据量

        $userid = Yii::$app->user->id;

        if(empty($userid) || $userid == null) $this->retjson('0003',Yii::t('app','您已登出'));

        $status = [0];          // 要查询的订单状态

        $allorders = WB_UserAmountTrade::getAllOrders($status, $order_type, $sort, $order, $page, $limit);

        $data['orderlist'] = $allorders;

        $this->retjson('0001', Yii::t('app', '成功'), $data);
    }
}

