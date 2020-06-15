<?php

namespace frontend\controllers;

/**
 * @author  shuang
 * @date    2016-12-8 22:02:38
 * @version V1.0
 * @desc
 */
use common\models\Grade;
use common\models\LtAward;
use common\models\UserProfile;
use common\models\UserSign;
use common\models\UserWallet;
use common\models\UserWalletRecord;
use Yii;
use common\components\MController;
use common\components\MTools;
use common\models\Level;
use common\models\UserFreeze;
use frontend\models\WB_UserWalletRecord;
use common\models\User;
use yii\helpers\HtmlPurifier;

class ProfileController extends MController {
    
    public $flag = false;
    public $message;

    // 挖矿页面
    public function actionFreezecare(){
        if(Yii::$app->request->isPost) {

            //  获取数据
            $post = Yii::$app->request->post();
            //  判断验签
            $sign = MTools::validsign($post);
            if (!$sign) {
                $this->retjson('0002', Yii::t('app', '验签错误'));
            }

            // 获取当前用户信息
            $userdata = Yii::$app->user->identity;
            // BBA余额
            $cash = $userdata->wallet->cash_wa;

            // 挖矿数据
//            $freeze = UserFreeze::find()->where('userid = :userid and expire = 0', [':userid' => $userdata->id])->all();
//            foreach ($freeze as $item) {
//                $data[] = [
//                    'id' => $item['id'],
//                    'profit' => $item['profit'],
//                    'time' => $item['created_at'] + 15 * 86400
//                ];
//            }
            $this->retjson('0001', Yii::t('app', '获取成功'), ['cash' => Yii::t('app','当前BBA余额：').$cash]);//, 'lsit' => $data
        }
    }

    // 挖矿请求
    public function actionDofreezecare(){
        if(Yii::$app->request->isPost) {

            //  获取数据
            $post = Yii::$app->request->post();
            //  判断验签
            $sign = MTools::validsign($post);
            if (!$sign) {
                $this->retjson('0002', Yii::t('app', '验签错误'));
            }

            // 获取当前用户信息
            $userdata = Yii::$app->user->identity;

            // 挖矿数量
            $fixed_num = HtmlPurifier::process($post['fixed_num']);

            // 校验挖矿数量
            if ($fixed_num <= 0) {
                $this->retjson('0002', Yii::t('app', '请输入挖矿数量'));
            }
            if ($fixed_num > $userdata->wallet->cash_wa) {
                $this->retjson('0002', Yii::t('app', 'BBA余额不足'));
            }

            // 用户挖矿轮数
            $freeze = UserFreeze::find()->where('userid = :userid and expire = 1',[':userid' => $userdata->id])->count();

            // 用户当前挖矿等级
            $level = Level::find()->where('buy_min <= :num', [':num' => $userdata->wallet->total_buy])->orderBy('id desc')->one();
            $level_round = Level::find()->where('round <= :round',[':round' => $freeze])->orderBy('id desc')->one();
            $level_id = min($level->id,$level_round->id);

            // 执行save操作
            $trans = Yii::$app->db->beginTransaction();//事件开始

            try {
                $userdata->wallet->cash_wa -= $fixed_num;   // BBA余额减少
                $userdata->wallet->free_wa += $fixed_num;   // 挖矿BBA增加

                // 产生挖矿记录
                $record = UserFreeze::createRecord($userdata->id, $userdata->username, $level_id, $fixed_num);

                // 产生账户记录
                $del_care = $this->Createwalletrecord($userdata->id, $fixed_num, 16, 2, 2, $userdata->wallet->cash_wa, '开始挖矿');
                $add_release = $this->Createwalletrecord($userdata->id, $fixed_num, 16, 1, 6, $userdata->wallet->free_wa, '开始挖矿');

                if ($userdata->wallet->save() && $record && $del_care && $add_release) {
                    $trans->commit();
                    $this->retjson('0001', Yii::t('app', '成功'));
                } else {
                    $this->retjson('0002', Yii::t('app', '提交失败'));
                }
            } catch (Exception $e) {
                $trans->rollBack();
                throw $e;
            }
        }
    }

    // 领取挖矿收益
    public function actionReceive(){
        if(Yii::$app->request->isPost){

            //  获取数据
            $post = Yii::$app->request->post();
            //  判断验签
            $sign = MTools::validsign($post);
            if (!$sign) {
                $this->retjson('0002', Yii::t('app', '验签错误'));
            }

            // 校验是否传参
            $id = HtmlPurifier::process($post['id']);
            if(!$id){
                $this->retjson('0002', Yii::t('app', '参数错误'));
            }

            // 用户id
            $userid = Yii::$app->user->id;
            $user = User::find()->where('id = :id',[':id' => $userid])->one();

            // 获取记录
            $freeze = UserFreeze::find()->where('userid = :userid and id = :id and expire = 0',[':userid' => $userid,':id' => $id])->one();
            if(!$freeze){
                $this->retjson('0002', Yii::t('app', '挖矿记录不存在或已到期'));
            }

            // 获取挖矿等级配置
            $level = Level::find()->where('id = :id',[':id' => $freeze->level_id])->one();

            // 获取后台参数配置->测试用户
            $testUser = MTools::getYiiParams('release');
            $userAry = explode(',',$testUser);
            if($userAry && in_array($userid,$userAry)){
                // 测试用户不需要有领取的时间限制
                if($freeze->level_id == 1){
                    // 临时会员，领取收益率为0.1%
                    $amount = $freeze->amount * $level->increase;
                }else{
                    // 正式会员，领取收益率为当前等级的收益率
                    $days = floor($freeze->days / 3);
                    $base = $level->profit + $level->increase * $days;
                    $amount = $freeze->amount * $base;
                }
                $continuity = true;
            }else {
                // 购买过24小时才能领取收益
                $time = time();
                if ($time - $freeze->created_at < 86400) {
                    $this->retjson('0002', Yii::t('app', '挖矿24小时后才能领取收益'));
                }

                // 上一次领取时间
                $last_sign = UserSign::find()->where('userid = :userid and freeze_id = :freeze_id and type = 2', [':userid' => $userid, ':freeze_id' => $id])->orderBy('sign_time desc')->one();

                $continuity = false;
                if (!$last_sign) {
                    // 首次领取
                    if ($freeze->level_id == 1) {
                        // 临时会员，领取收益率为0.1%
                        $amount = $freeze->amount * $level->increase;
                    } else {
                        // 正式会员，领取收益率为当前等级的收益率
                        $amount = $freeze->amount * $level->profit;
                    }
                    $continuity = true;
                } else {
                    $all = ($time - $freeze->created_at) / 86400;                   // 当前时间 - 挖矿时间
                    // 判断是否可领取
                    $days_time = floor($all);                           // 天数向下取整，获得满足多少个24小时
                    $star = $freeze->created_at + $days_time * 86400;   // 计算每日可领取的时间范围（开始）
                    $end = $freeze->created_at + $days_time * 172799;   // 计算每日可领取的时间范围（结束）
                    if ($last_sign->sign_time >= $star && $last_sign->sign_time <= $end) {
                        $this->retjson('0002', Yii::t('app', '未到可领取时间'));
                    }

                    if($freeze->level_id == 1){
                        // 临时会员，领取收益率为0.1%
                        $amount = $freeze->amount * $level->increase;
                    }else {
                        // 正式会员，领取收益率为当前等级的收益率
                        $last = ($last_sign->sign_time - $freeze->created_at) / 86400;  // 最后签到时间 - 挖矿时间
                        // 判断是否连续领取
                        if ($all - $last >= 2) {
                            // 中断领取 从第一开开始重新计算收益
                            $amount = $freeze->amount * $level->profit;
                        } else {
                            // 连续签到
                            // 天数取整
                            $days = floor($freeze->days / 3);
                            $base = $level->profit + $level->increase * $days;
                            $amount = $freeze->amount * $base;
                            $continuity = true;
                        }
                    }
                }
            }

            // 开启事务
            $affair = Yii::$app->db->beginTransaction();

            if($amount != 0 ) {

                // 用户钱包表
                $wallet = UserWallet::find()->where('userid = :userid', [':userid' => $userid])->one();
                $wallet->cash_wa += $amount;
                $wallet->save();

                // 钱包记录 bba余额增加
                UserWalletRecord::insertrecord($userid, $amount, 17, 1, 2, $wallet->cash_wa, '挖矿收益');

                // 更新累计收益
                $freeze->profit += $amount;

                // 动态奖励
                $this->dynamic($userid,$amount);
            }

            // 签到记录表
            $sign_record = UserSign::createrecord($userid,$freeze->username,$amount,2,$freeze->id);

            // 更新连续领取天数
            if($continuity){
                $freeze->days += 1;
                $message = Yii::t('app','领取成功，连续签到第').$freeze->days.Yii::t('app','天');
            }else{
                $freeze->days = 1;
                $message = Yii::t('app','领取成功');
            }

            if($sign_record && $freeze->save() && Grade::upgrade($user)){
                $affair->commit();
                $this->retjson('0001', $message);
            }else{
                $affair->rollBack();
                $this->retjson('0002', Yii::t('app','领取失败'));
            }
        }
    }

    // 动态收益
    public function dynamic($userid,$num){ //
        // 获取用户所有上级
        $profile = UserProfile::find()->select('up_referrer_id')->where('userid = :userid',[':userid' => $userid])->one();

        if($profile->up_referrer_id) {
            $up_user = explode('-',$profile->up_referrer_id);
            $up_users = array_reverse($up_user);
            $count = count($up_users);
            if($count > 10){
                $length = 10;
            }else{
                $length = $count;
            }

            for($i=0;$i<$length;$i++){
                // 判断是否正式会员
                $user_level = User::find()->select('level_id')->where('id = :id', [':id' => $up_users[$i]])->one();
                if($user_level->level_id < 2){
                    continue;
                }

                // 计算所有上级分别有多少个直推
                $mycode = User::find()->select('mycode')->where('id = :id', [':id' => $up_users[$i]])->one();
                $direct = User::find()->where('invite_code = :invite_code', [':invite_code' => $mycode->mycode])->count();

                if($direct >= $i + 1){
                    // 静态收益表
                    $award = LtAward::find()->where('layer_num = :layer_num', [':layer_num' => $i + 1])->one();
                    $amount = $num * $award->award_per;

                    if ($amount != 0) {
                        // 钱包表
                        $wallet = UserWallet::find()->where('userid = :userid', [':userid' => $up_users[$i]])->one();
                        $wallet->cash_wa += $amount;

                        // 产生记录
                        $record = UserWalletRecord::insertrecord($up_users[$i], $amount, 18, 1, 2, $wallet->cash_wa, '伞下前十代成员获得挖矿收益，产生静态收益');

                        if ($wallet->save() && $record) {
                            continue;
                        } else {
                            break;
                        }
                    }
                }else{
                    continue;
                }
            }

            // 获取10代以后
            $eleven = array_slice(array_reverse($up_user), 10);
            if($eleven) {

                // 排除所有临时和正式会员
                $usersid = implode(',', $eleven);
                $screen = User::find()->select('id')->where("id in ($usersid) and grade_id > 2")->asArray()->all();
                // 转一维数组
                $result = array_reduce($screen, function ($result, $value) {
                    return array_merge($result, array_values($value));
                }, array());

                if ($result) {
                    $grade = 0;
                    foreach ($eleven as $k => $v) {
                        // 用户表
                        $user = User::find()->select('grade_id')->where('id = :id', [':id' => $v])->one();
                        // 等级表
                        $user_grade = Grade::find()->where('id = :id', [':id' => $user->grade_id])->one();
                        // 钱包表
                        $user_wallet = UserWallet::find()->where('userid = :userid', [':userid' => $v])->one();

                        // 第11代（第一次循环）
                        if ($k == 0) {
                            // 无限代静态收益
                            $user_amout = $num * $user_grade->static_sum;
                            if($user_amout != 0){
                                $user_wallet->cash_wa += $user_amout;
                                $user_wallet->save();
                                UserWalletRecord::insertrecord($v, $user_amout, 4, 1, 2, $user_wallet->cash_wa, '伞下十代后成员获得挖矿收益，产生无限代静态收益');
                            }
                            $static_sum = $user_grade->static_sum;  // 重新赋值静态收益
                            $grade = $user->grade_id;               // 重新赋值等级
                            continue;
                        }

                        // 若当前用户等级小于赋值等级 跳过
                        if ($user->grade_id < $grade) {
                            continue;
                        }

                        // 若当前用户等级等于赋值等级 发放平级动态收益
                        if ($grade == $user->grade_id) {
                            // 平级动态收益
                            $same = $user_amout * $user_grade->dynamic_sum;
                            if($same != 0){
                                $user_wallet->cash_wa += $same;
                                $user_wallet->save();
                                UserWalletRecord::insertrecord($v, $same, 5, 1, 2, $user_wallet->cash_wa, '伞下十代后成员获得挖矿收益，产生平级动态收益');
                            }
                            $grade = $user->grade_id + 0.5; // 赋值等级 +0.5 （为了标识是否拿过平级动态奖）
                            continue;
                        }

                        // 若当前用户等级大于赋值等级 发放极差奖励
                        if ($user->grade_id > $grade) {
                            // 无限代静态收益（极差）
                            $user_amout = $num * ($user_grade->static_sum - $static_sum);
                            if($user_amout){
                                $user_wallet->cash_wa += $user_amout;
                                $user_wallet->save();
                                UserWalletRecord::insertrecord($v, $user_amout, 4, 1, 2, $user_wallet->cash_wa, '伞下十代后成员获得挖矿收益，产生无限代静态收益（极差）');
                            }
                            $static_sum = $user_grade->static_sum;  // 重新赋值静态收益
                            $grade = $user->grade_id;               // 重新赋值等级
                            continue;
                        }
                    }
                }
            }
        }
        return true;
    }

    // 挖矿记录
    public function actionFreezerecord(){
        //  获取数据
        $post  = Yii::$app->request->post();
        //  判断验签
        $sign =  MTools::validsign($post);
        if(!$sign){
            $this->retjson('0002', Yii::t('app', '验签错误'));
        }
        $userdata = Yii::$app->user->identity; // 获取用户信息
        $page =  HtmlPurifier::process($post['page']); // 分页
        $record = UserFreeze::getMyCareOrder($userdata->id,$page);
        if($record){
            $this->retjson('0001', Yii::t('app', '获取成功'), $record);
        }else{
            $record = [
                'status' => '0001',
                'message' => Yii::t('app', '暂无数据'),
                'data' => [],
            ];
            return json_encode($record);
        }
    }

    // 取出矿机
    public function actionTakeout(){
        if(Yii::$app->request->isPost){
            //  获取数据
            $post  = Yii::$app->request->post();
            //  判断验签
            $sign =  MTools::validsign($post);
            if(!$sign){
                $this->retjson('0002', Yii::t('app', '验签错误'));
            }

            // 参数校验
            $id = HtmlPurifier::process($post['id']);
            $number = HtmlPurifier::process($post['number']);
            $num = round($number,4);
            if(!$id || $num <= 0){
                $this->retjson('0002', Yii::t('app', '参数错误'));
            }

            // 用户信息
            $user = Yii::$app->user->identity;

            // 获取挖矿记录
            $freeze = UserFreeze::find()->where('userid = :userid and id = :id and expire = 0',[':userid' => $user->id,':id' => $id])->one();
            if(!$freeze){
                $this->retjson('0002', Yii::t('app', '挖矿记录不存在或已到期'));
            }

            // 获取当前时间戳
            $time = time();
            // 判断矿机是否满足24小时
            if($time - $freeze->created_at < 86400){
                $this->retjson('0002', Yii::t('app', '未满24小时不可取出'));
            }

            // 判断数量是否足够
            if($num > $freeze->amount){
                $this->retjson('0002', Yii::t('app', '数量不足'));
            }

            // 开启事务
            $model = Yii::$app->db->beginTransaction();

            // 若取出全部矿机，改变矿机状态
            if($freeze->amount - $num == 0){
                $endtime = 15 * 86400;
                if($time - $freeze->created_at >= $endtime){
                    // 若满15天 状态->到期
                    $freeze->expire = 1;
                }else{
                    // 若不满15天 状态->未到期全部取出
                    $freeze->expire = 2;
                }
            }

            // 执行取出操作
            $freeze->amount -= $num;        // 减少挖矿数量
            $user->wallet->free_wa -= $num; // 减少自由区
            $user->wallet->cash_wa += $num; // 增加bba余额

            // 产生账户记录 减少自由区
            $record = UserWalletRecord::insertrecord($user->id,$num,6,2,6,$user->wallet->free_wa,'取出矿机');
            // 增加bba余额
            $record1 = UserWalletRecord::insertrecord($user->id,$num,6,1,2,$user->wallet->cash_wa,'取出矿机');

            if($freeze->save() && $user->wallet->save() && $record && $record1){
                $model->commit();
                $this->retjson('0001', Yii::t('app', '取出成功'));
            }else{
                $this->retjson('0002', Yii::t('app', '取出失败'));
                $model->rollBack();
            }
        }
    }

    //账户流水
    public function actionWalletrecord(){//卢呗转换记录
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');

        $req = Yii::$app->request;
        $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
        if($token == '') {
            $data['status'] = '0002';
            $data['message'] = Yii::t('app', '无效参数');
            echo json_encode($data);
            exit;
        }
        $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
        if(!$userdata) {
            $data['status'] = '0003';
            $data['message'] = Yii::t('app', '已登出');
            echo json_encode($data);
            exit;
        }
        if(Yii::$app->request->isPost){
            // 事件类型
            $all_events = WB_UserWalletRecord::$event_type;
            // 隐藏系统拨发和系统扣除
            unset($all_events[1]);
            unset($all_events[2]);
            foreach ($all_events as $key => $val){
                $events[] = [
                    'id' => $key,
                    'name' => Yii::t('app',$val)
                ];
            }

            // 钱包类型
            $all_wallet = WB_UserWalletRecord::$wallet_type;
            foreach ($all_wallet as $k => $v){
                $wallet[] = [
                    'id' => $k,
                    'name' => Yii::t('app',$v)
                ];
            }

            $this->retjson('0001',Yii::t('app','获取成功'),['even_type' => $events, 'wallet_type' => $wallet]);
        }
    }

    //  账户流水加载
    public function actionWalletrecordload(){
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        if(Yii::$app->request->isPost){
            $req = Yii::$app->request;
            $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
            if($token == '') {
                $data['status'] = '0002';
                $data['message'] = Yii::t('app', '无效参数');
                echo json_encode($data);
                exit;
            }
            $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
            if(!$userdata) {
                $data['status'] = '0003';
                $data['message'] = Yii::t('app', '已登出');
                echo json_encode($data);
                exit;
            }

            $post = Yii::$app->request->post();
            $event_type =  HtmlPurifier::process(isset($post['event_type'])?$post['event_type']:0);
            $wallet_type =  HtmlPurifier::process(isset($post['wallet_type'])?$post['wallet_type']:0);

            $page = HtmlPurifier::process(isset($post['page'])?$post['page']:1);
            $userid = Yii::$app->user->id;
            // 获取订单列表
            $tradeList = WB_UserWalletRecord::getWalletRecordLoad($userid,$event_type,$wallet_type,$page);
            $data = [];
            if($tradeList){
                foreach($tradeList as $key => $value){
                    $data[$key] = [
                        'event_type' => Yii::t('app',$value['event_type']),
                        'event_type_name' => Yii::t('app',$value['event_type_name']),
                        'wallet_type' => Yii::t('app',$value['wallet_type']),
                        'wallet_type_name' => Yii::t('app',$value['wallet_type_name']),
                        'amount' => $value['amount'],
                        'created_at' => $value['created_at'],
                    ];
                }
                $this->retjson('0001',Yii::t('app','成功'),$data);exit;
            }else{
                $res = [
                    'status' => '0001',
                    'message' => Yii::t('app','暂无数据'),
                    'data' => $data,
                ];
                return json_encode($res);
            }
        }else{
            $this->retjson('0002',Yii::t('app','非法请求'));exit;
        }
    }

    //产生账户记录
    public function Createwalletrecord($userid,$amount,$event_type,$pay_type,$wallet_type,$wallet_amount,$note){
        $UserWalletRecord1 = new WB_UserWalletRecord();
        $UserWalletRecord1->userid = $userid;//  会员id
        $UserWalletRecord1->amount = $amount;//  发生金额
        $UserWalletRecord1->event_type = $event_type;//  事件类型
        $UserWalletRecord1->pay_type = $pay_type;//  收支类型
        $UserWalletRecord1->wallet_type = $wallet_type;//  钱包类型
        $UserWalletRecord1->wallet_amount = $wallet_amount;//  钱包总额
        $UserWalletRecord1->note = $note;//  备注
        $UserWalletRecord1->created_at = time();//  创建时间
        $UserWalletRecord1->updated_at = time();//  更新时间
        $UserWalletRecord1->ip = Yii::$app->getRequest()->getUserIP();//  当前ip

        return $UserWalletRecord1->save();
    }
    
}
