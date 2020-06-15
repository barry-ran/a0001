<?php

namespace common\models;

use common\components\MTools;
use frontend\models\WB_UserAmountTrade;
use frontend\models\WB_UserBank;
use frontend\models\WB_UserProfile;
use frontend\models\WB_UserWalletRecord;
use frontend\models\WB_Wallet_address;
use Yii;
use frontend\models\WB_ZodiacApply;
use frontend\models\WB_ZodiacIssue;

/**
 * This is the model class for table "me_user_amount_trade".
 *
 * @property integer $id
 * @property integer $in_userid
 * @property string $in_username
 * @property integer $out_userid
 * @property string $out_username
 * @property string $wallet_token
 * @property string $bank
 * @property string $realname
 * @property string $bank_num
 * @property string $alipay
 * @property string $wechat
 * @property string $phone
 * @property string $buyer_phone
 * @property string $amount
 * @property string $samount
 * @property string $number
 * @property string $price
 * @property string $sysprice
 * @property string $terrace_fee
 * @property string $discount_fee
 * @property string $note
 * @property integer $type
 * @property integer $status
 * @property integer $traded_at
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $method
 * @property integer $order_type
 * @property integer $old_order_id
 * @property string $picture
 * @property string $wechat_img
 * @property string $alipay_img
 */
class UserAmountTrade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_user_amount_trade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['in_userid', 'out_userid', 'type', 'status', 'traded_at', 'created_at', 'updated_at', 'method', 'order_type', 'branch_id', 'old_order_id', 'areaid'], 'integer'],
            [['amount', 'samount', 'number', 'price', 'sysprice', 'terrace_fee', 'discount_fee'], 'number'],
            [['number', 'price', 'sysprice', 'type'], 'required'],
            [['in_username', 'out_username', 'realname'], 'string', 'max' => 50],
            [['wallet_token'], 'string', 'max' => 66],
            [['bank', 'bank_num'], 'string', 'max' => 30],
            [['alipay', 'wechat'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 20],
            [['picture', 'note'], 'string', 'max' => 255],
            [['alipay_img', 'wechat_img'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'in_userid' => Yii::t('app', '买入会员ID'),
            'in_username' => Yii::t('app', '买入会员账号'),
            'out_userid' => Yii::t('app', '卖出会员ID'),
            'out_username' => Yii::t('app', '卖出会员账号'),
            'wallet_token' => Yii::t('app', '发生钱包地址'),
            'alipay' => Yii::t('app', '支付宝账号'),
            'wechat' => Yii::t('app', '微信账号'),
            'phone' => Yii::t('app', '卖家电话'),
            'buyer_phone' => Yii::t('app', '买家电话'),
            'bank' => Yii::t('app', '银行名称'),
            'realname' => Yii::t('app', '户名'),
            'bank_num' => Yii::t('app', '银行卡号'),
            'amount' => Yii::t('app', '实际交易额'),
            'samount' => Yii::t('app', '交易总额'),
            'number' => Yii::t('app', '交易数量'),
            'price' => Yii::t('app', '用户设置价格'),
            'sysprice' => Yii::t('app', '系统时价'),
            'terrace_fee' => Yii::t('app', '平台手续费率'),
            'discount_fee' => Yii::t('app', '折扣优惠费率'),
            'note' => Yii::t('app', '备注'),
            'type' => Yii::t('app', '交易类型'),
            'status' => Yii::t('app', '交易状态'),
            'traded_at' => Yii::t('app', '交易时间'),
            'created_at' => Yii::t('app', '创建时间'),
            'updated_at' => Yii::t('app', '更新时间'),
            'method' => Yii::t('app', '交易方式'),
            'order_type' => Yii::t('app', '订单类型'),
            'old_order_id' => Yii::t('app', '原订单ID'),
            'picture'   => Yii::t('app', '付款凭证'),
            'deposit'   => Yii::t('app', '保证金数量')
        ];
    }

    public static $status = [
        0 => "订单已挂出",1 => "买家已下单", 2 => "买家已付款",3 => "订单已成交",4 => "订单已取消", 5 => "付款已超时", 6 => "收款已超时", 7 => "卖家已下单", 8 => '卖家申诉中',
        9 => '卖家申诉成功', 10 => '付款超时，订单取消'
    ];

    public static $order_type = [
        1 => "zodiac"
    ];

    public static function getList() {
        $query = UserAmountTrade::find();
        $begin_at = Yii::$app->request->get("begin_at");
        $end_at = Yii::$app->request->get("end_at");
        $searchin = Yii::$app->request->get("searchin");
        $searchout = Yii::$app->request->get("searchout");
        $searchorderid = Yii::$app->request->get('searchorderid');
        $status = Yii::$app->request->get('status');

        if($searchorderid) {    // 根据订单ID搜索
            $query->andFilterWhere(["like", "id", $searchorderid]);
        }
        if ($status) {          // 根据订单状态搜索
            $query->andFilterWhere(["=", "status", $status]);
        }
        if ($begin_at) {        // 订单创建时间
            $query->andFilterWhere([">=", "created_at", strtotime($begin_at)]);
        }
        if ($end_at) {          // 订单创建时间
            $query->andFilterWhere(["<=", "created_at", strtotime($end_at)]);
        }
        if ($searchin) {        // 根据买家id或用户名
                $query->andFilterWhere(["like","in_userid",$searchin]);
                $query->orFilterWhere(["like","in_username",$searchin]); 
        }
        if ($searchout) {       // 根据卖家id或用户名
                $query->andFilterWhere(["like","out_userid",$searchout]);
                $query->orFilterWhere(["like","out_username",$searchout]); 
        }

//        $sort = Yii::$app->request->get("sort", "traded_at");
//        $order = Yii::$app->request->get("order", "desc");
//        $query->orderBy($sort . " " . $order);
        $query->orderBy("traded_at desc");
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
       // var_dump($res);die;
        return ["total" => $totalCount, "data" => $res];
    }

    // 判断此订单是否为该用户所有
    public static function isMyOrder($id, $userid) {
        $ismyorder = UserAmountTrade::find()
            ->where('id=:id AND (out_userid=:out_userid or in_userid=:in_userid)', [':id' => $id, ':out_userid' => $userid, ':in_userid' => $userid])
            ->one();

        if($ismyorder)
            return true;
        else
            return false;
    }

    // 创建订单(save版)
    public static function createOrder($in_userid, $in_username, $out_userid, $out_username,
                                       $userbank, $userprofile, $walletaddr, $amount, $samount, $number,
                                       $price, $sysprice, $status, $type, $method, $order_type,
                                       $old_order_id = null, $areaid, $traded_at, $note) {
        $UserAmountTrade = new UserAmountTrade();
        $UserAmountTrade->in_userid         = $in_userid;                // 买家id
        $UserAmountTrade->in_username       = $in_username;              // 买家用户名
        $UserAmountTrade->out_userid        = $out_userid;               // 卖家id
        $UserAmountTrade->out_username      = $out_username;             // 卖家用户名
        $UserAmountTrade->wallet_token      = '';                        // 钱包地址（）

        if($userbank != null) {
            $UserAmountTrade->bank          = $userbank['bank'];           // 卖家 -> 银行名称
            $UserAmountTrade->realname      = $userbank['truename'];       // 卖家 -> 户名
            $UserAmountTrade->bank_num      = $userbank['bank_number'];    // 卖家 -> 银行卡号
        }

        if($userprofile != null) {
//            $UserAmountTrade->alipay        = $userprofile->alipay;      // 卖家 -> 支付宝账号
//            $UserAmountTrade->wechat        = $userprofile->wechat;      // 卖家 -> 微信账号
//            $UserAmountTrade->wechat_img    = $userprofile->wechat_img;  // 卖家 -> 微信二维码
//            $UserAmountTrade->alipay_img    = $userprofile->alipay_img;  // 卖家 -> 支付宝二维码
            $UserAmountTrade->phone         = $userprofile->phone;         // 卖家 -> 手机号码
        }

        if($walletaddr != null) {
            $UserAmountTrade->wallet_token  = $walletaddr['wallet_token']; // 卖家 -> 钱包地址
        }

        $UserAmountTrade->amount            = $amount;                   // 实际交易额
        $UserAmountTrade->samount           = $samount;                  // 交易总额
        $UserAmountTrade->number            = $number;                   // 交易数量
        $UserAmountTrade->price             = $price;                    // 交易时的单价
        $UserAmountTrade->sysprice          = $sysprice;                 // 系统时价
        $UserAmountTrade->note              = $note;                     // 描述
        $UserAmountTrade->type              = $type;                     // 交易类型, 1: 买入, 2: 卖出
        $UserAmountTrade->status            = $status;                   // 交易状态, 0: 订单已挂出, 1: 买家已下单, 7: 卖家已下单
        $UserAmountTrade->traded_at         = $traded_at;                // 交易时间
        $UserAmountTrade->created_at        = time();                    // 创建时间
        $UserAmountTrade->updated_at        = time();                    // 更新时间
        $UserAmountTrade->method            = $method;                   // 交易方式设置为, 1: 线下, 2: 线上
        $UserAmountTrade->order_type        = $order_type;               // 订单类型设置为，1: BBA订单
        $UserAmountTrade->old_order_id      = $old_order_id;             // 如果是拆分订单，则存储原订单ID
        $UserAmountTrade->areaid            = $areaid;                   // 数量区间id

        return $UserAmountTrade->save();
    }

    // 创建订单(未save版)
    public static function nsCreateOrder($in_userid, $in_username, $out_userid, $out_username,
                                         $userbank, $userprofile, $walletaddr, $amount, $samount, $number,
                                         $price, $sysprice, $status, $type, $method, $order_type,
                                         $old_order_id = null, $areaid, $traded_at,$note) {
        $UserAmountTrade = new UserAmountTrade();
        $UserAmountTrade->in_userid         = $in_userid;                // 买家id
        $UserAmountTrade->in_username       = $in_username;              // 买家用户名
        $UserAmountTrade->out_userid        = $out_userid;               // 卖家id
        $UserAmountTrade->out_username      = $out_username;             // 卖家用户名
        $UserAmountTrade->wallet_token      = '';                        // 钱包地址（）

        if($userbank != null) {
            $UserAmountTrade->bank          = $userbank['bank'];           // 卖家 -> 银行名称
            $UserAmountTrade->realname      = $userbank['truename'];       // 卖家 -> 户名
            $UserAmountTrade->bank_num      = $userbank['bank_number'];    // 卖家 -> 银行卡号
        }

        if($userprofile != null) {
            $UserAmountTrade->alipay        = $userprofile->alipay;      // 卖家 -> 支付宝账号
            $UserAmountTrade->wechat        = $userprofile->wechat;      // 卖家 -> 微信账号
            $UserAmountTrade->wechat_img    = $userprofile->wechat_img;  // 卖家 -> 微信二维码
            $UserAmountTrade->alipay_img    = $userprofile->alipay_img;  // 卖家 -> 支付宝二维码
            $UserAmountTrade->phone         = $userprofile->phone;         // 卖家 -> 手机号码
        }

        if($walletaddr != null) {
            $UserAmountTrade->wallet_token  = $walletaddr['wallet_token']; // 卖家 -> 钱包地址
        }

        $UserAmountTrade->amount            = $amount;                   // 实际交易额
        $UserAmountTrade->samount           = $samount;                  // 交易总额
        $UserAmountTrade->number            = $number;                   // 交易数量
        $UserAmountTrade->price             = $price;                    // 交易时的单价
        $UserAmountTrade->sysprice          = $sysprice;                 // 系统时价
        $UserAmountTrade->note              = $note;                     // 描述
        $UserAmountTrade->type              = $type;                     // 交易类型, 1: 买入, 2: 卖出
        $UserAmountTrade->status            = $status;                   // 交易状态, 0: 订单已挂出, 1: 买家已下单, 7: 卖家已下单
        $UserAmountTrade->traded_at         = $traded_at;                // 交易时间
        $UserAmountTrade->created_at        = time();                    // 创建时间
        $UserAmountTrade->updated_at        = time();                    // 创建时间
        $UserAmountTrade->method            = $method;                   // 交易方式设置为, 1: 线下, 2: 线上
        $UserAmountTrade->order_type        = $order_type;               // 订单类型设置为，1: BBA订单
        $UserAmountTrade->old_order_id      = $old_order_id;             // 如果是拆分订单，则存储原订单ID
        $UserAmountTrade->areaid            = $areaid;                   // 发行表id

        return $UserAmountTrade;
    }

    // 获取某个区间内所有未挂买订单， $type, 1: 查询挂买订单(挂卖方法调用), 2: 查询挂卖订单(挂买方法调用)
    public static function getUnorders($userid, $areaid, $type) {
        if($type == 2) {        // 卖家id不能为自己
            $userid = ['!=', 'out_userid', $userid];
        } else {                // 买家id不能为自己
            $userid = ['!=', 'in_userid', $userid];
        }

        $unorders = \common\models\UserAmountTrade::find()
            ->andFilterWhere($userid)
            ->andFilterWhere(['=', 'areaid', $areaid])
            ->andFilterWhere(['=', 'type', $type])
            ->andFilterWhere(['=', 'status', 0])
            ->orderBy('created_at asc')     // 根据创建时间排序，早创建的订单优先匹配
            ->all();

        return $unorders;
    }

    // 获取未撮合的订单
    public static function getAllUnorders($areaid, $type) {
        $unorders = \common\models\UserAmountTrade::find()
            ->andFilterWhere(['=', 'areaid', $areaid])
            ->andFilterWhere(['=', 'type', $type])
            ->andFilterWhere(['=', 'status', 0])
            ->orderBy('created_at asc')     // 根据创建时间排序，早创建的订单优先匹配
//            ->asArray()
            ->all();

        return $unorders;
    }

    // 挂卖：自动匹配订单
    public static function sellerAutoMatch($unorders, $user, $userbank, $walletaddr, $data) {
        $my_number = $data['number'];                  // 挂卖数量
        $sysprice = $data['currSysPrice'];             // 系统价格
//        $text = Yii::t('app', '订单匹配成功，请您及时打款');
        $text = 'The order was matched, please pay for it.';

        foreach($unorders as $order) {
            if($my_number == $order->number) {         // 场景一：匹配到相同数量，直接下单
                $order->bank = $userbank['bank'];
                $order->bank_num = $userbank['bank_number'];
                $order->realname = $userbank['truename'];
                $order->out_userid = $user->id;
                $order->out_username = $user->username;
                $order->traded_at = time();
                $order->status = 1;

                // 冻结卖家BBA
                $user->wallet->cash_wa -= $order->number;
                // 卖家冻结BBA钱包记录
                $res = UserWalletRecord::insertrecord($user->id, $order->number, 3, 2, 2, $user->wallet->cash_wa, '挂卖匹配冻结BBA');

                if($order->save() && $user->wallet->save() && $res) {
                    MTools::sendmail($order->in_username, 'BBA', 1, $text);
                    return true;
                } else {
                    return false;
                }


            } elseif($my_number < $order->number) {    // 场景二：如果挂卖数量小于当前循环的挂买订单数量，则拆分该订单
                // 减少挂买订单数量
                $order->number -= $my_number;

                // 创建新订单
                $neworder = WB_UserAmountTrade::nsCreateOrder($order->in_userid, $order->in_username, $user->id, $user->username, $userbank, $user->userprofile, $walletaddr,
                    $my_number * $sysprice, $my_number * $sysprice, $my_number, $sysprice,$sysprice,
                    7, $order->type,1,1,$order->id, $data['areaid'], time(),'拆分原挂买订单'
                );

                // 冻结卖家BBA
                $user->wallet->cash_wa -= $my_number;
                // 卖家冻结BBA钱包记录
                $res = UserWalletRecord::insertrecord($user->id, $my_number, 3, 2, 2, $user->wallet->cash_wa, '挂卖匹配冻结BBA');

                if($order->save() && $neworder->save() && $user->wallet->save() && $res) {
                    MTools::sendmail($order->in_username, 'BBA', 1, $text);
                    return true;
                } else {
                    return false;
                }


            } elseif($data['number'] > $order->number) {    // 场景三：如果挂卖数量大于当前循环的挂买订单数量，则全额卖出当前原订单数量，之后继续匹配其他订单
                // 先创建新订单，之后再更改旧订单的number和status
                $neworder = WB_UserAmountTrade::nsCreateOrder($order->in_userid, $order->in_username, $user->id, $user->username, $userbank, $user->userprofile, $walletaddr,
                    $order->number * $sysprice, $order->number * $sysprice, $order->number, $sysprice, $sysprice,
                    7, $order->type,1,1,$order->id, $data['areaid'], time(),'全额卖出原挂买订单'
                );

                // 冻结卖家BBA
                $user->wallet->cash_wa -= $order->number;
                // 卖家冻结BBA钱包记录
                $res = UserWalletRecord::insertrecord($user->id, $order->number, 3, 2, 2, $user->wallet->cash_wa, '挂卖匹配冻结BBA');

                $my_number -= $order->number;
                $order->number = 0;
                $order->status = 50;
                $old_save = $order->save();
                $new_save = $neworder->save();
                $seller_wallet_save = $user->wallet->save();
                MTools::sendmail($order->in_username, 'BBA', 1, $text);

                if($my_number == 0) {
                    if($old_save && $new_save && $seller_wallet_save) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    continue;
                }
            }
        }

        if($my_number > 0) {            // 场景四：如果前三种场景都不满足，则创建新挂卖订单，等待市场再次匹配
            $isordered = WB_UserAmountTrade::nsCreateOrder('', '', $user->id, $user->username, $userbank,$user->userprofile, $walletaddr,
                $my_number * $sysprice, $my_number * $sysprice,
                $my_number, $sysprice, $sysprice, 0, 2, 1, 1, null,$data['areaid'],null,'卖家创建订单，等待自动撮合'
            );
            $user->wallet->cash_wa -= $my_number;        // 冻结卖家BBA数量
            // 添加卖家其他货币钱包记录
            $OutUserWalletRecord = WB_UserWalletRecord::nsinsertrecord($user->id, $my_number, 3, 2, 2, $user->wallet->cash_wa, '挂卖冻结BBA');
            if($isordered->save() && $user->wallet->save() && $OutUserWalletRecord->save()) {
                return true;
            } else {
                return false;
            }
        }
    }

    // 挂买：自动匹配订单
    public static function buyerAutoMatch($unorders, $user, $data) {
        $my_number = $data['number'];                  // 挂买数量
        $sysprice = $data['currSysPrice'];             // 系统价格
//        $text = Yii::t('app', '订单匹配成功，请您及时打款');
        $text = 'The order was matched, please pay for it.';

        foreach($unorders as $order) {
            if($my_number == $order->number) {         // 场景一：匹配到相同数量，直接下单
                $order->in_userid = $user->id;
                $order->in_username = $user->username;
                $order->traded_at = time();
                $order->status = 1;

                if($order->save()) {
                    MTools::sendmail($user->username, 'BBA', 1, $text);
                    return true;
                } else {
                    return false;
                }


            } elseif($my_number < $order->number) {    // 场景二：如果挂买数量小于当前循环的挂卖订单数量，则拆分该订单
                // 减少挂卖订单数量
                $order->number -= $my_number;

                // 获取卖家默认银行卡信息
                $out_userbank = WB_UserBank::getMyDefaultBank($order->out_userid);

                // 获取卖家user_profile
                $out_user_profile = UserProfile::findByUserid($order->out_userid);

                // 创建新订单
                $neworder = WB_UserAmountTrade::nsCreateOrder($user->id, $user->username, $order->out_userid, $order->out_username, $out_userbank, $out_user_profile, null,
                    $my_number * $sysprice, $my_number * $sysprice, $my_number, $sysprice,$sysprice,
                    1, $order->type,1,1,$order->id, $data['areaid'],time(), '拆分原挂卖订单'
                );

                if($order->save() && $neworder->save()) {
                    MTools::sendmail($user->username, 'BBA', 1, $text);
                    return true;
                } else {
                    return false;
                }

            } elseif($data['number'] > $order->number) {    // 场景三：如果挂买数量大于当前循环的挂卖订单数量，则将当前原订单全额买入，之后继续匹配其他订单
                // 获取卖家默认银行卡信息
                $out_userbank = WB_UserBank::getMyDefaultBank($order->out_userid);

                // 获取卖家user_profile
                $out_user_profile = UserProfile::findByUserid($order->out_userid);

                // 先创建新订单，之后再更改旧订单的number和status
                $neworder = WB_UserAmountTrade::nsCreateOrder($user->id, $user->username, $order->out_userid, $order->out_username, $out_userbank, $out_user_profile,null,
                    $order->number * $sysprice, $order->number * $sysprice,$order->number, $sysprice, $sysprice,
                    1, $order->type,1,1,$order->id, $data['areaid'], time(),'全额买入原挂卖订单'
                );
                $my_number -= $order->number;
                $order->number = 0;
                $order->status = 50;
                $old_save = $order->save();
                $new_save = $neworder->save();
                MTools::sendmail($user->username, 'BBA', 1, $text);

                if($my_number == 0) {
                    if($old_save && $new_save) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    continue;
                }
            }
        }

        if($my_number > 0) {            // 场景四：如果前三种场景都不满足，则创建新挂买订单，等待市场再次匹配
            $isordered = WB_UserAmountTrade::nsCreateOrder($user->id, $user->username, null, null,null,null,null,
                $my_number * $sysprice, $my_number * $sysprice,
                $my_number, $sysprice, $sysprice, 0, 1, 1, 1, null, $data['areaid'],null, '买家创建订单，等待自动撮合'
            );
           if($isordered->save()) {
                return true;
            } else {
                return false;
            }
        }
    }

    // 手动撮合
    public static function semiAutoMatch($num, $areaid) {
        $sysprice = StockPriceRecord::getCurrentPrice();                 // 获取当前系统价格

        $unsellorders = self::getAllUnorders($areaid, 2);       // 查询出某分区所有未挂卖订单

//        $unbuyorders = self::getAllUnorders($areaid, 1);        // 查询出某分区所有未挂买订单
//        var_dump($areaid);die();
//        $text = Yii::t('app', '订单匹配成功，请您及时打款');
        $text = 'The order was matched, please pay for it.';

        if(!$unsellorders || empty($unsellorders)) {
            return 'nosellorders';
        }

//        if(!$unbuyorders || empty($unbuyorders)) {
//            return 'nobuyorders';
//        }
        $matched_buy_orders     = [];                                 // 已被完全拆分挂买订单

//        $trans = Yii::$app->db->beginTransaction();                   // 开启事务
        $ch_total = 0;
        try {
            for($i = 0; $i < count($unsellorders); $i++) {
                if($ch_total >= $num){
                    return 'done';
                }
                $unbuyorders = self::getAllUnorders($areaid, 1);        // 查询出某分区所有未挂买订单
                if(!$unbuyorders || empty($unbuyorders)) {
                    return 'done';
                }

                for($j = 0; $j < count($unbuyorders); $j++) {
                    if($ch_total >= $num){
                        return 'done';
                    }
                    if(in_array($unbuyorders[$j]['id'], $matched_buy_orders)) {
                        continue;
                    } else {

                        if($unsellorders[$i]['out_userid'] == $unbuyorders[$j]['in_userid']) {              // 判断卖家买家是否为同一人，是的话进入下次循环
                            continue;
                        }
                        $out_userbank = WB_UserBank::getMyDefaultBank($unsellorders[$i]['out_userid']);     // 获取卖家默认银行卡信息
                        $out_user_profile = UserProfile::findByUserid($unsellorders[$i]['out_userid']);     // 获取卖家user_profile
                    }

                    if($unsellorders[$i]['number'] == $unbuyorders[$j]['number']) {         // 两两匹配场景，将挂买订单状态设置为50
                        $ch_total += $unsellorders[$i]['number'];

                        //  买家订单状态改为50
                        $unbuyorders[$j]['number'] = 0;
                        $unbuyorders[$j]['amount'] = 0;
                        $unbuyorders[$j]['samount'] = 0;
                        $unbuyorders[$j]['status'] = 50;

                        // 将卖家信息存入买家订单中
                        $unsellorders[$i]['in_userid'] = $unbuyorders[$j]['in_userid'];
                        $unsellorders[$i]['in_username'] = $unbuyorders[$j]['in_username'];
                        $unsellorders[$i]['traded_at'] = time();
                        $unsellorders[$i]['status'] = 1;
                        $unsellorders[$i]['note'] = '双方数量刚好匹配';

                        if($unbuyorders[$j]->save() && $unsellorders[$i]->save()) {
                            Mtools::sendmail($unbuyorders[$j]['in_username'], 'BBA', 1, $text); // 发送打款邮件给买家
                            break;
                        } else {
//                            $trans->rollBack();
                            return 'failed';
                        }
                    }
                    elseif($unsellorders[$i]['number'] < $unbuyorders[$j]['number']) {              // 挂卖数量小于挂买数量，拆分挂买订单
                        if($unsellorders[$i]['out_userid'] == $unbuyorders[$j]['in_userid']) {      // 判断卖家买家是否为同一人，是的话进入下次循环
                            break;
                        }

                        $unbuyorders[$j]['number']  -= $unsellorders[$i]['number'];                      // 减少挂买订单数量
                        $unbuyorders[$j]['amount']  -= $unsellorders[$i]['number'] * $sysprice;          // 修改挂买订单总额
                        $unbuyorders[$j]['samount'] -= $unsellorders[$i]['number'] * $sysprice;          // 修改挂买订单总额

                        $ch_total += $unsellorders[$i]['number'];

                        // 将买家信息写入到挂卖订单里
                        $unsellorders[$i]['in_userid']      = $unbuyorders[$j]['in_userid'];        // 买家用户ID
                        $unsellorders[$i]['in_username']    = $unbuyorders[$j]['in_username'];      // 买家用户名
                        $unsellorders[$i]['old_order_id']   = $unbuyorders[$j]['id'];               // 原挂买订单ID
                        $unsellorders[$i]['status']         = 1;                                    // 买家已下单
                        $unsellorders[$i]['updated_at']     = time();                               // 更新时间
                        $unsellorders[$i]['traded_at']      = time();                               // 交易时间

                        if($unbuyorders[$j]->save() && $unsellorders[$i]->save()) {
                            Mtools::sendmail($unbuyorders[$j]['in_username'], 'BBA', 1, $text); // 发送打款邮件给买家
                            break;
                        } else {
//                            $trans->rollBack();
                            return 'failed';
                        }
                    }
                    elseif($unsellorders[$i]['number'] > $unbuyorders[$j]['number']) {              // 挂卖数量大于挂买数量，拆分挂卖订单
                        if($unsellorders[$i]['out_userid'] == $unbuyorders[$j]['in_userid']) {      // 判断卖家买家是否为同一人，是的话进入下次循环
                            break;
                        }

                        // 先创建新订单，之后再更改旧订单的number和status
                        $neworder = WB_UserAmountTrade::nsCreateOrder($unbuyorders[$j]['in_userid'], $unbuyorders[$j]['in_username'],
                            $unsellorders[$i]['out_userid'], $unsellorders[$i]['out_username'], $out_userbank, $out_user_profile, null,
                            $unbuyorders[$j]['number'] * $sysprice, $unbuyorders[$j]['number'] * $sysprice,$unbuyorders[$j]['number'],
                            $sysprice, $sysprice,1, $unsellorders[$i]['type'],1,1,$unsellorders[$i]['id'],
                            $areaid, time(),'全额卖出原挂买订单'
                        );


                        // 修改卖家订单
                        $unsellorders[$i]['number'] -= $unbuyorders[$j]['number'];
                        $unsellorders[$i]['amount'] = $unsellorders[$i]['number'] * $sysprice;
                        $unsellorders[$i]['samount'] = $unsellorders[$i]['number'] * $sysprice;
                        $save_sell = $unsellorders[$i]->save();

                        $ch_total += $unbuyorders[$j]['number'];

                        // 修改买家订单
                        $unbuyorders[$j]['number'] = 0;
                        $unbuyorders[$j]['amount'] = 0;
                        $unbuyorders[$j]['samount'] = 0;
                        $unbuyorders[$j]['status'] = 50;
                        $save_buy = $unbuyorders[$j]->save();
                            if($neworder->save() && $save_buy && $save_sell) {
                                Mtools::sendmail($unbuyorders[$j]['in_username'], 'BBA', 1, $text); // 发送打款邮件给买家
                                $matched_buy_orders[] = $unbuyorders[$j]['id'];
                                continue;
                            } else {
//                                $trans->rollBack();
                                return 'failed';
                            }
//                        }
                    }
                }
            }
//            $trans->commit();
            return 'done';
        } catch(Exception $e) {
//            $trans->rollBack();
            return 'failed';
        }
    }

    //抢购    2019-07-09      小余
    public static function issueAutoMatch($userid,$zodiac_id,$my_apply) {
        // 匹配一个满足要求的宠物
//        $is_get = WB_ZodiacIssue::getUnbelong($userid,$zodiac_id);

        $count= Yii::$app->redis->lpop('zodiac_issue:'.$zodiac_id); // 踢除redis存储的数量
        if(!$count){
            $redis_num = count(Yii::$app->redis->lrange("zodiac_issue:".$zodiac_id,0,-1));
            file_put_contents('../runtime/logs/redis_log.txt', '时间：'.time().'，用户ID：'.$userid.'，抢购宠物'.$zodiac_id.'子失败，原因：redis没有宠物'.'num:'.$redis_num.PHP_EOL,FILE_APPEND);
            $is_get = false;
        }else{
            $is_get = WB_ZodiacIssue::find()->where('issel = 0 and zodiac_id = :zodiac_id and belong_id != :userid',[':zodiac_id'=>$zodiac_id,':userid'=>$userid])->orderBy('created_at asc')->one();
            $redis_num = count(Yii::$app->redis->lrange("zodiac_issue:".$zodiac_id,0,-1));
            file_put_contents('../runtime/logs/redis_log.txt', '时间：'.time().'，用户ID：'.$userid.'，抢购宠物'.$zodiac_id.'子成功，发行ID:'.$is_get->id.'num:'.$redis_num.PHP_EOL,FILE_APPEND);
        }
        $flag = true;       //初始化变量
        if($is_get){
            //如果是预约后才抢购
            if($my_apply){
                $my_apply->status = 1;                 //已完成
                $my_apply->kill_status = 1;            //抢购成功
                $my_apply->updated_at = time();
                if($my_apply->save()){
                    $flag = true;
                }
            }
            //改变发行表状态
            $is_get->issel = 1;                 //已卖出
            $is_get->updated_at = time();

            //获取买家信息
            $buyer = User::findOne($userid);

            //获取卖家信息
            $seller = User::findOne($is_get->belong_id);

            //获取买家银行卡
            $sellerBank = WB_UserBank::getMyDefaultBank($is_get->belong_id);

            $isordered = WB_UserAmountTrade::nsCreateOrder(
                $buyer->id, $buyer->username,$seller->id, $seller->username,$sellerBank,$seller->userprofile,null,$is_get->hcg, $is_get->hcg,1,0,0,7,1,1,1, null,$is_get->id,time(), '等待买家付款'
            );

            if($flag && $isordered->save() && $is_get->save()){
                return 1;
            }else{
                Yii::$app->redis->lpush('zodiac_issue:'.$zodiac_id, 1);
                $redis_num = count(Yii::$app->redis->lrange("zodiac_issue:".$zodiac_id,0,-1));
                file_put_contents('../runtime/logs/redis_log.txt', '时间：'.time().'，用户ID：'.$buyer->id.'，抢购宠物'.$zodiac_id.'子失败，发行ID:'.$is_get->id.'原因：保存数据失败'.'num:'.$redis_num.PHP_EOL,FILE_APPEND);
                return 0;
            }
        }else{
            return 2;
        }
    }
}
