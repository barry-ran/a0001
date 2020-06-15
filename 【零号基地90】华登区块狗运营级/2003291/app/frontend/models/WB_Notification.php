<?php

namespace frontend\models;

/**
 * @author
 * @date    2018-08-28 17:39:11
 * @version V1.0
 * @asc
 */

use Yii;
use yii\behaviors\TimestampBehavior;
use common\models\Notification;
use yii\helpers\HtmlPurifier;

class WB_Notification extends Notification {
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

    // 消息类型
    public static $msg_type = [1 => '交易消息'];

    // 消息状态
    public static $isread = [1 => '未读', 2 => '已读'];

    // 交易方式
    public static $method = [1 => '现金交易', 2 => '余额交易'];

    // 交易类型
    public static $type = [1 => '买入', 2 => '卖出'];

    // 订单类型
    public static $order_type = [1 => '卢宝订单', 2 => 'LKC订单'];

    // 订单状态
    public static $status = [
        0 => "订单已挂出",1 => "买家已下单", 2 => "已确认付款",3 => "已完成交易",4 => "订单已取消", 5 => "付款已超时", 6 => "收款已超时", 7 => "卖家已下单", 8 => '卖家申诉中',
        9 => '卖家申诉成功', 10 => '付款超时，订单取消'
    ];

    // 创建消息
    public static function create_notify($order_id, $out_userid, $out_username, $in_userid, $in_username, $status, $type, $method, $order_type,$msg_type) {
        $notify = new Notification();
        $notify->order_id = $order_id;                  // 订单ID
        $notify->out_userid = $out_userid;              // 卖家ID
        $notify->out_username = $out_username;          // 卖家用户名
        $notify->in_userid = $in_userid;                // 买家ID
        $notify->in_username = $in_username;            // 买家用户名
        $notify->msg_type = $msg_type;                          // 消息类型, 1: 交易消息
        $notify->isread = 1;                            // 消息状态, 1: 未读, 2: 已读
        $notify->status = $status;                      // 订单状态
        $notify->type = $type;                          // 交易类型, 1: 买入, 2: 卖出
        $notify->method = $method;                      // 交易方式, 1: 现金交易, 2: 余额交易
        $notify->order_type = $order_type;              // 订单类型, 1: 余额订单, 2: TNB订单
        $notify->created_at = time();                   // 创建时间
        $notify->updated_at = time();                   // 更新时间

        if($notify->save()) {
            return true;
        } else {
            return false;
        }
    }

    // 获取单个用户的交易消息
    public static function getMyTradeMsg($userid,$page) {

        $query = WB_Notification::find()
            ->where("(out_userid=:out_userid and status in(1,2)) or (in_userid=:in_userid and status in(3,7))", [':out_userid' => $userid, ':in_userid' => $userid]);

        $sort = Yii::$app->request->get("sort", 'created_at');
        $order = Yii::$app->request->get("order",'desc');
        $query->orderBy($sort . " " . $order);

        $pagesize = 10;
        $offset = ($page-1)*$pagesize;
        $limit = HtmlPurifier::process(Yii::$app->request->get("limit", $pagesize));
        $res = $query->offset($offset)->limit($limit)->asArray()->all();

        foreach($res as &$item) {
            $item['created_at'] = date('Y/m/d',$item["created_at"]);
            switch($item['status']) {
                case 0:
                    break;
                case 1:
                    $item['status'] = Yii::t('app', '您好: 您的').WB_Notification::$order_type[$item['order_type']].'('.$item['order_id'].') '.Yii::t('app', '买家已下单。');
                    break;
                case 2:
                    $item['status'] = Yii::t('app', '您好: 您的').WB_Notification::$order_type[$item['order_type']].'('.$item['order_id'].') '.Yii::t('app', '买家已付款，请及时收款。');
                    break;
                case 3:
                    $item['status'] = Yii::t('app', '您好: 您的').WB_Notification::$order_type[$item['order_type']].'('.$item['order_id'].') '.WB_Notification::$status[$item['status']];
                    break;
                case 7:
                    $item['status'] = Yii::t('app', '您好: 您的').WB_Notification::$order_type[$item['order_type']].'('.$item['order_id'].') '.Yii::t('app', '卖家已下单，请及时付款。');
                    break;
                default:
                    break;
            }
        }

        return $res;
    }

    // 根据ID获取单条消息
    public static function getSingleNotify($id) {
        $data = WB_Notification::find()->where('id=:id', [':id' => $id])->one();

        switch($data['status']) {
            case 0:
                break;
            case 1:
                $data['status'] = Yii::t('app', '您好: 您的').WB_Notification::$order_type[$data['order_type']].'('.$data['order_id'].')'.Yii::t('app', '买家已下单。');
                break;
            case 2:
                $data['status'] = Yii::t('app', '您好: 您的').WB_Notification::$order_type[$data['order_type']].'('.$data['order_id'].')'.Yii::t('app', '买家已付款，请及时收款。');
                break;
            case 3:
                $data['status'] = Yii::t('app', '您好: 您的').WB_Notification::$order_type[$data['order_type']].'('.$data['order_id'].') '.WB_Notification::$status[$data['status']];
                break;
            case 7:
                $data['status'] = Yii::t('app', '您好: 您的').WB_Notification::$order_type[$data['order_type']].'('.$data['order_id'].') '.Yii::t('app', '卖家已下单，请及时付款。');
                break;
            default:
                break;
        }

        return $data;
    }

}
