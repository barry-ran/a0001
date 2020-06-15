<?php

namespace frontend\models;

/**
 * @author  shuang
 * @date    2016-12-14 14:07:34
 * @version V1.0
 * @desc
 */
use common\models\User;
use common\models\UserAmountTrade;
use common\models\UserProfile;
use common\models\UserZodiac;
use common\models\Zodiac;
use common\models\ZodiacIssue;
use yii\behaviors\TimestampBehavior;
use Yii;
use common\components\MTools;
use common\models\UserWallet;
use yii\helpers\HtmlPurifier;
use common\models\TradeNum;
use common\models\Grade;
use frontend\models\WB_UserZodiac;
use common\models\UserBank;

class WB_UserAmountTrade extends UserAmountTrade {
    /*
     * 设置表操作行为动作
     * return array
     */

    public function behaviors() {
        return[
            [
                'class' => TimestampBehavior::className()
            ]
        ];
    }

    public static $status = [
        0 => '订单已挂出', 1 => '买家已下单', 2 => '买家已付款', 3 => '订单已成交', 4 => '订单已取消', 5 => '付款已超时', 6 => '收款已超时', 7 => '卖家已下单', 8 => '卖家申诉中', 9 => '卖家申诉成功', 10 => '付款超时，订单取消'
    ];

    public static $status_en = [
        0 => 'RestingOrder', 1 => 'BuyerOrdered', 2 => 'BuyerPaid', 3 => 'OrderFinished', 4 => 'OrderCancelled', 5 => 'PaymentOvertime', 6 => 'CollectedOvertime',
        7 => 'SellerOrdered', 8 => 'SellerAppeal', 9 => 'SellerAppealSuccess', 10 => 'PaymentOvertime,CancelTheOrder'
    ];


    public static $type = [
        1 => "买入", 2 => "卖出"
    ];

    public static $method = [
        1 => "线下", 2 => "线上"
    ];

    // zodiac交易买家确认付款   2019-07-09  小余
    public static function buyConfirm($id, $src){
        $order = WB_UserAmountTrade::find()->where("id=:id", [":id" => $id])->one();
        $order->picture = $src;
        $order->status = 2;
        $order->traded_at = time();
        $order->updated_at = time();
        $order->note = '买家已付款';

        // 添加消息
        $notify = WB_Notification::create_notify($order->id, $order->out_userid, $order->out_username, $order->in_userid, $order->in_username, $order->status, $order->type, $order->method, $order->order_type,1);

        if($order->save() && $notify) {
            return true;
        } else {
            return false;
        }
    }

    // zodiac交易卖家确认收款（交易完结）     2019-07-10小余
    public static function sellConfirm($id){
        //  开启事务
        $trans = Yii::$app->db->beginTransaction();

        $query = WB_UserAmountTrade::find()->where("id=:id", [":id" => $id])->one();

        $query->status = 3;
        $query->traded_at = time();
        $query->updated_at = time();
        $query->note = '卖家已确认付款，订单完结';

        if($query->save()){
            //根据订单中发行表id,获取发行表中的对应宠物发行数据
            $zodiac_issue_id = $query->areaid;
            $zodiac_issue = ZodiacIssue::findOne($zodiac_issue_id);
            $zodiac_id = $zodiac_issue->zodiac_id;
            $zodiac = Zodiac::findOne($zodiac_id);  //获取当前发行宠物信息

            $inuser = User::findOne($query->in_userid);
            $inuser->wallet->cash_wa += $zodiac_issue->cash;
            $inuser->wallet->kmd += $zodiac_issue->hcg * $zodiac->kmd;

            //生成一条新的发行记录
            $new_issue = new ZodiacIssue();
            $new_issue->zodiac_id = $zodiac->id;
            $new_issue->zodiac_name = $zodiac->name;
            $new_issue->zodiac_grade_id = '';
            $new_issue->zodiac_grade_name = '';
            $new_issue->hcg = $zodiac_issue->hcg;
            $new_issue->cash = $zodiac_issue->cash;
            $new_issue->issel = 2;  //状态为成长中
            $new_issue->created_at = time();
            $new_issue->updated_at = time();
            $new_issue->belong_id = $query->in_userid;
            if($new_issue->save()){
                //创建一条新的用户宠物数据
                $userzodiac = new WB_UserZodiac();
                $userzodiac->zodiac_id = $zodiac_id;
                $userzodiac->issue_id = $new_issue->id;
                $userzodiac->zodiac_grade_id = 0;
                $userzodiac->userid = $query->in_userid;
                $userzodiac->username = $query->in_username;
                $userzodiac->hcg = $zodiac_issue->hcg;
                $userzodiac->old_hcg = $zodiac_issue->hcg;
                $userzodiac->due = $zodiac->due;
                $userzodiac->award = $zodiac->award;
                // 当天零点时间戳
                $zerotimestamp = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
                $over_time = $zerotimestamp + 86400 * ($zodiac->due);
                $userzodiac->over_time = $over_time;
                $userzodiac->is_rack = 0;           //是否上架(0:未上架, 1:已上架)
                $userzodiac->is_overtime = 0;       //是否过期(0:未过期, 1:已过期)
                $userzodiac->created_at = time();
                $userzodiac->updated_at = time();
                $userzodiac->rise_num = 0;
                $userzodiac->source = 0;        //0:购买 1:提现/后台发布
                $userzodiac->allow_rack = 0;    //0:允许出售
                //更新原宠物发行表数据为已完结
                $zodiac_issue->issel = 1; //已结束
                $query->areaid = $new_issue->id;

            }
            if($userzodiac->save()&&$zodiac_issue->save()&&$inuser->wallet->save()&&$query->save()){
                // 添加消息
                WB_Notification::create_notify($query->id, $query->out_userid, $query->out_username, $query->in_userid, $query->in_username, $query->status, $query->type, $query->method, $query->order_type,2);
                $trans->commit();
                $res = true;
            }else{
                $trans->rollBack();
                $res = false;
            }
        }else{
            $trans->rollBack();
            $res = false;
        }
        return $res;
    }

    // 获取订单详情           2019-07-10  小余
    public static function getOrderDetails($userid, $id,$type) {

        if($type ==1 ){
            $res = WB_UserAmountTrade::find()->where('(in_userid = :in_userid) && id = :id',[':in_userid' => $userid,':id' => $id])->one();
        }else{
            $res = WB_UserAmountTrade::find()->where('(out_userid = :out_userid) && id = :id',[':out_userid' => $userid,':id' => $id])->one();
        }
        $temp = [];
        $zodiac_issue = ZodiacIssue::findOne($res->areaid);
        $zodiac = Zodiac::findOne($zodiac_issue->zodiac_id);

        if($res) {
            //订单信息
            $temp['orderid'] = $res->id;   //订单id
            $temp['zodiac_name'] = $zodiac->name;   //商品名称
            $temp['hcg'] =  Yii::$app->formatter->asDecimal($zodiac_issue->hcg,2);      //价格
            $temp['due'] = $zodiac->due;            //收益周期
            $temp['award'] = $zodiac->award;        //收益比例
            switch ($res['status']){
                case 0: $temp['status_text'] = Yii::t('app','待撮合');
                    break;
                case 1:
                case 7: $temp['status_text'] = Yii::t('app','待凭证');
                    break;
                case 2: $temp['status_text'] = Yii::t('app','待确认');
                    break;
                case 5:
                case 6:
                case 8: $temp['status_text'] = Yii::t('app','申诉中');
                    break;
                case 3:
                case 9: $temp['status_text'] = Yii::t('app','已完成');
                    break;
                default: $temp['status_text'] = Yii::t('app','已取消');
            }       //订单状态

            //买家信息
            $temp['in_userid'] = $res->in_userid;
            $in_user = User::findOne($res->in_userid);
//            $in_user = UserProfile::find()->where('userid = :id',[':id'=>$userid])->one();
            $temp['in_username'] = $in_user->username ? $in_user->username : '';
            $temp['in_userphone'] = $in_user->userprofile->phone ? $in_user->userprofile->phone : '';
            $userdata = User::findOne($res->in_userid);

            $userbank = UserBank::getUserbankLoad($userdata,'1');
            //卖家信息
            $temp['out_userid'] = $res->out_userid;
            $out_user = User::findOne($res->out_userid);
            $temp['out_username'] = $out_user->username ? $out_user->username : '';
            $temp['out_userphone'] = $out_user->userprofile->phone ? $out_user->userprofile->phone : '';
            $userbank = UserBank::find()->where('userid = :userid and state = 1',[':userid' => $out_user->id])->orderBy('id desc')->one();
            $temp['alipay'] = $out_user->userprofile->alipay?$out_user->userprofile->alipay:'';
            $temp['alipay_img'] = $out_user->userprofile->alipay_img?$out_user->userprofile->alipay_img:'';
            $temp['wechat'] = $out_user->userprofile->wechat?$out_user->userprofile->wechat:'';
            $temp['wechat_img'] = $out_user->userprofile->wechat_img?$out_user->userprofile->wechat_img:'';
            $temp['bank'] = $userbank['bank']?$userbank['bank']:'';
            $temp['bank_num'] = $userbank['bank_number']?$userbank['bank_number']:'';
            $temp['realname'] = $userbank['truename']?$userbank['truename']:'';
            $temp['img_url'] =  $res->picture?$res->picture:''; // 凭证路径
            $temp['zodiac_issue_id'] = $res->areaid;
            $temp['created_at'] = Yii::$app->formatter->asDatetime($res->created_at);       // 创建时间
            $temp['status'] = $res['status'];
            $temp['amount'] = floor($res['amount']*1000)/1000;
            $temp['dragons'] = $zodiac->cash;
            //  当前账号为买入账号
            if ($res['in_userid'] == $userid){
                $temp['left_btn'] = Yii::t("app", "联系客服");
                $temp['right_btn'] = Yii::t("app", "确认付款");
            }else{
                $temp['left_btn'] = Yii::t("app", "卖家申诉");
                $temp['right_btn'] = Yii::t("app", "确认收款");
            }
        }
        return $temp;
    }

    // 获取我的订单列表
    public static function getTradeOrderListLoad($userid, $order_type, $sort, $order, $page, $limit) {
        $user = \common\models\User::find()->where('id=:id', [':id' => $userid])->one();

        $query = WB_UserAmountTrade::find()->select('id, in_userid, out_userid, areaid, number, type, status')->where("((out_userid=:out_userid) || (in_userid=:in_userid)) && order_type=:order_type && status != 50", [":out_userid" => $user->id, ":in_userid" => $user->id, ":order_type" => $order_type]);

        $query->orderBy($sort . " " . $order);

        $pagesize = 6;
        $limit = $limit ? $limit : $pagesize;
        $offset = ($page-1) * $pagesize;
        $res = $query->offset($offset)->limit($limit)->asArray()->all();

        for($i = 0;$i < count($res);$i++){
            $res[$i]['number'] = $res[$i]['number'].' BBA';

            if($res[$i]['in_userid'] && $res[$i]['in_userid'] == $userid) {
                $res[$i]['areaname'] = TradeNum::$area_name[$res[$i]['areaid']].Yii::t('app', 'Area').Yii::t('app', '买入');
            }

            if($res[$i]['out_userid'] && $res[$i]['out_userid'] == $userid) {
                $res[$i]['areaname'] = TradeNum::$area_name[$res[$i]['areaid']].Yii::t('app', 'Area').Yii::t('app', '卖出');
            }

            switch ($res[$i]['status']){
                case 0: $res[$i]['status'] = Yii::t('app','待撮合');
                    break;
                case 1:
                case 7: $res[$i]['status'] = Yii::t('app','待凭证');
                    break;
                case 2: $res[$i]['status'] = Yii::t('app','待确认');
                    break;
                case 5:
                case 6:
                case 8: $res[$i]['status'] = Yii::t('app','申诉中');
                    break;
                case 3:
                case 9: $res[$i]['status'] = Yii::t('app','已完成');
                    break;
                default: $res[$i]['status'] = Yii::t('app','已取消');
            }
            unset($res[$i]['areaid']);
            unset($res[$i]['type']);
        }

        return $res;
    }

    // 取消卖出订单
    public static function sellCancel($id, $userid, $order_type) {
        //  开启事务
        $trans = Yii::$app->db->beginTransaction();

        $query = WB_UserAmountTrade::find()->where("id=:id", [":id" => $id])->one();
        if($query->status == 1) {
            $res = 'buyerplaced';
            return $res;
        }

        if($query->status == 2) {
            $res = 'buyerpaid';
            return $res;
        }

        //  获取当前取消的订单BBA数量
        $number = $query->number;

        $query->status = 4;
        $query->updated_at = time();
        if($query->save()){
            $userWallet = UserWallet::getWallet($userid);
            if($order_type == 1) {
                $userWallet->cash_wa += $number;            // 返还BBA
                $outuserwalletrecord = WB_UserWalletRecord::insertrecord($query->out_userid, $query->number, 3, 1, 2, $userWallet->cash_wa, $query->out_username."挂卖取消订单，返还BBA");
            }

            if($userWallet->save() && $outuserwalletrecord){
                $trans->commit();
                $res = 'success';
            }else{
                $trans->rollBack();
                $res = false;
            }
        }else{
            $trans->rollBack();
            $res = false;
        }
        return $res;
    }

    // 取消买入订单
    public static function buyCancel($id){

        $userid = Yii::$app->user->id;                          // 获取用户ID

        $in_user_wallet = UserWallet::getWallet($userid);       // 获取用户钱包

        $order = WB_UserAmountTrade::find()->where("id=:id", [":id" => $id])->one();
        if($order->status == 7) {
            $res = 'sellerplaced';
            return $res;
        }

        if($order->status == 2) {
            $res = 'buyerpaid';
            return $res;
        }

        $order->status = 4;
        $order->updated_at = time();//  经测试，未设置更新时间，系统会自己插入更新时间

        if($order->save()) {
            if($order->order_type == 2) {
                $in_user_wallet->save();
                WB_UserWalletRecord::insertrecord($userid, $order->number * $order->price, 3, 1, 2, $in_user_wallet->cash_wa, '挂买取消订单, 返还BBA');
            }
            $res = 'success';
        } else {
            return false;
        }
        return $res;
    }

    /**
     * 获取数字货币最新价格
     * @param $type     //btc_usdt:比特币    ltc_usdt :莱特币    eth_usdt :以太坊     etc_usdt :以太经典    bch_usdt :比特现金
     * @return mixed    //result:状态 baseVolume: 交易量  high24hr:24小时最高价    highestBid:买方最高价    last:最新成交价  low24hr:24小时最低价 lowestAsk:卖方最低价 percentChange:涨跌百分比 quoteVolume: 兑换货币交易量
     *
     */
    public static function getOkcoin($type){
        $url = 'http://data.gateio.co/api2/1/ticker/'.$type;
        $data = self::curlGet($url);
        return $data;
    }

    // 通用curl GET 方法
    public static function curlGet($url){
        $ch = curl_init();
//        $header=array(
//            "Accept: application/json",
//            "Content-Type: application/x-www-form-urlencoded",
//        );
        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT,10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//绕过ssl验证
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        //执行并获取HTML文档内容
        $output = curl_exec($ch);
        //释放curl句柄
        curl_close($ch);
//        var_dump($output);die;
        $output = json_decode($output, true);
        return $output;
    }

    // 获取单条订单详细信息
//    public static function orderdetail($userid, $id) {
//        $user = \common\models\User::find()->where('id=:id', [':id' => $userid])->one();
//
//        //  wwc 进行中 ； qr 待处理 ； ywc 已完成
//        // 查询出 3: 订单已成交， 4: 订单已取消， 5: 付款已超时，6: 收款已超时
//        $order = WB_UserAmountTrade::find()->where("id=:id && (in_userid=:in_userid OR out_userid=:out_userid)", [":id" => $id, ":in_userid" => $user->id,  ":out_userid" => $user->id])->asArray()->one();
//
//        // 根据订单号和用户ID判断当前订单是买入订单还是卖出订单
//
//        // 获得当前用户选择的语言
////        $key = $userid."language";
////        $lang = Yii::$app->cache->get($key);
////
////        if($lang == 'en_US') {
////            $status_note = WB_UserAmountTrade::$status_en[$order['status']];
////        } else {
////            $status_note = WB_UserAmountTrade::$status[$order['status']];
////        }
//        $status_note = WB_UserAmountTrade::$status[$order['status']];
//
//        if($order['in_userid'] != null) {
//            $buyer = \common\models\UserProfile::find()->where('userid=:userid', [':userid' => $order['in_userid']])->asArray()->one();
//            $order['buyer_phone'] = $buyer['phone'];                           //  买家电话
//        } else {
//            $order['buyer_phone'] = '-';
//        }
//
//        if($order['wechat'] == null ) {
//            $order['wechat'] = '-';
//        }
//        if($order['alipay'] == null ) {
//            $order['alipay'] = '-';
//        }
//        if($order['wechat_img'] == null ) {
//            $order['wechat_img'] = '#';
//        }
//        if($order['alipay_img'] == null ) {
//            $order['alipay_img'] = '#';
//        }
////        unset($order['alipay']);
////        unset($order['wechat']);
////        unset($order['alipay_img']);
////        unset($order['wechat_img']);
//        $order['description'] = Yii::t('app', $status_note);    //  状态描述
////        $order['description'] = Yii::t('app', '{status}', array('status' => $status_note));    //  状态描述
//        $order['traded_at'] = Yii::$app->formatter->asDatetime($order["traded_at"])?Yii::$app->formatter->asDatetime($order["traded_at"]):'-';  //  交易时间
//        $order['created_at'] = Yii::$app->formatter->asDatetime($order["created_at"]);                        //  创建时间
//        $order['updated_at'] = Yii::$app->formatter->asDatetime($order["updated_at"])?Yii::$app->formatter->asDatetime($order["updated_at"]):'-';  //  修改时间
//
//        return $order;
//    }



    // 获取平台内所有待撮合订单
    public static function getAllOrders($status, $order_type, $sort, $order, $page, $limit) {
        $query = UserAmountTrade::find()->where(['in', 'status', $status]);

        $query->andFilterWhere(['=', 'type', 1]);

        $query->andFilterWhere(['=', 'order_type', $order_type]);

        $query->orderBy($sort . " " . $order);

        $pagesize = 6;
        $limit = $limit?$limit:$pagesize;
        $offset = ($page-1) * $pagesize;
        $res = $query->offset($offset)->limit($limit)->asArray()->all();

        $temp = array();

        for($i = 0;$i < count($res);$i++){
            $temp[$i]['number'] = $res[$i]['number'].' BBA';
            $temp[$i]['updated_at'] = Yii::$app->formatter->asDatetime($res[$i]["updated_at"]);
            if($res[$i]['type'] == 1) {
                $temp[$i]['areaname'] = TradeNum::$area_name[$res[$i]['areaid']].Yii::t('app', '买入');
            } else {
                $temp[$i]['areaname'] = TradeNum::$area_name[$res[$i]['areaid']].Yii::t('app', '卖出');
            }
            switch ($res[$i]['status']){
                case 0: $temp[$i]['status'] = Yii::t('app','待撮合');
                    break;
                case 1:
                case 7: $temp[$i]['status'] = Yii::t('app','待凭证');
                    break;
                case 2: $temp[$i]['status'] = Yii::t('app','待确认');
                    break;
                case 5:
                case 6:
                case 8: $temp[$i]['status'] = Yii::t('app','申诉中');
                    break;
                case 3:
                case 9: $temp[$i]['status'] = Yii::t('app','已完成');
                    break;
                default: $temp[$i]['status'] = Yii::t('app','已取消');
            }
        }

        $fake = self::genFakeOrder();           // 生成Fake订单

        $new = array_merge($temp, $fake);

//        $time = array();
//        foreach($new as $n) {
//            $time[] =  $n['updated_at'];
//        }
        $time = array_column($new, 'updated_at');
        array_multisort($time,SORT_DESC,$new);

        return $new;
    }

    // 自动生成Fake订单
    public static function genFakeOrder() {
        $areas = TradeNum::getAreaNum();            // 获取交易区间信息

        unset($areas[2]);                           // 去掉B3区间

        $first_area = $areas[0];                                    // 交易区间第一个元素
        $last_area = array_slice($areas,-1,1)[0];    // 交易区间最后一个元素

        $temp = array();

        $buy_text = Yii::t('app', '买入');
        $sell_text = Yii::t('app', '卖出');

        $trade_type_text = [$buy_text, $sell_text];

        $one_hour_ago = time() - 60 * 60;                                       // 获取一小时前的时间戳

        for($i = 0; $i <= 30; $i++) {                                           // 生成50个随机订单
            $areaid = mt_rand($first_area['areaid'], $last_area['areaid']);     // 随机生成areaid
            $trade_type = mt_rand(0, 1);
            $area = TradeNum::getSpecAreaInfo($areaid);

            $num = mt_rand($area['min'], $area['max']);

            $temp[$i]['areaname'] = $area['areaname'].$trade_type_text[$trade_type];

            $temp[$i]['number'] = Yii::$app->formatter->asDecimal($num, 4).' BBA';

            $temp[$i]['updated_at'] = self::randDate($one_hour_ago);

            if($trade_type == 0) {
                $temp[$i]['status'] = Yii::t('app','待撮合');
            } else {
                $temp[$i]['status'] = Yii::t('app','已完成');

            }
        }

        return $temp;
    }

    // 随机生成时间戳
    public static function randDate($begintime, $endtime="", $now = true) {
        $begin = $begintime;
        $end = $endtime == "" ? time() : $endtime;
        $timestamp = rand($begin, $end);

        return $now ? date("Y-m-d H:i:s", $timestamp) : $timestamp;
    }
}
