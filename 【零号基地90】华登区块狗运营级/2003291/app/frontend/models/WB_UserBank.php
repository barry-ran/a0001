<?php

namespace frontend\models;

/**
 * @author  shuang
 * @date    2016-12-6 23:41:35
 * @version V1.0
 * @desc    
 */
use common\models\UserBank;
use yii;

class WB_UserBank extends UserBank {

    // 获取我的默认银行卡
    public static function getMyDefaultBank($userid) {
        $bankinfo = WB_UserBank::find()->where('userid=:userid && state=1 && isdefault=2', [':userid' => $userid])->asArray()->one();

        return $bankinfo;
    }
    
  

}