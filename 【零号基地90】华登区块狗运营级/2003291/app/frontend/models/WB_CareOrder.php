<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/21
 * Time: 20:46
 */

namespace frontend\models;

use common\models\CareOrder;

class WB_CareOrder extends CareOrder {
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
        0 => '订单已挂售', 1 => '买家已下单', 2 => '买家已付款', 3 => '订单已成交', 4 => '订单已取消', 5 => '付款已超时', 6 => '收款已超时', 7 => '卖家已下单'
    ];

    public static $type = [
        1 => "买入", 2 => "卖出"
    ];


}