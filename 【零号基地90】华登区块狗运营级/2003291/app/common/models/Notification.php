<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_notification".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $out_userid
 * @property string $out_username
 * @property integer $in_userid
 * @property string $in_username
 * @property integer $msg_type
 * @property integer $isread
 * @property integer $status
 * @property integer $type
 * @property integer $method
 * @property integer $order_type
 * @property integer $created_at
 * @property integer $updated_at
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_notification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'out_userid', 'in_userid', 'msg_type', 'isread', 'status', 'type', 'method', 'order_type', 'created_at', 'updated_at'], 'integer'],
            [['out_username', 'in_username'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => '订单ID',
            'out_userid' => '卖家ID',
            'out_username' => '卖家用户名',
            'in_userid' => '买家ID',
            'in_username' => '买家用户名',
            'msg_type' => '消息类型',
            'isread' => '消息状态',
            'status' => '订单状态',
            'type' => '交易类型',
            'method' => '交易方式',
            'order_type' => '订单类型',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
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
        0 => "订单已挂出",1 => "买家已下单", 2 => "买家已付款",3 => "订单已成交",4 => "订单已取消", 5 => "付款已超时", 6 => "收款已超时", 7 => "卖家已下单", 8 => '卖家申诉中',
        9 => '卖家申诉成功', 10 => '付款超时，订单取消'
    ];
    public static function getList() {
        $query = self::find();
        $query->orderBy("created_at desc");
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();

        return ["total" => $totalCount, "data" => $res];
    }
}
