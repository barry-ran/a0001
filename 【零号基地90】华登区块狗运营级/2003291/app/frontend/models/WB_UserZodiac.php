<?php

namespace frontend\models;

/**
 * @author  shuang
 * @date    2016-12-10 21:14:06
 * @version V1.0
 * @desc    
 */
use common\models\UserZodiac;
use yii\behaviors\TimestampBehavior;
use Yii;
use yii\helpers\ArrayHelper;
use common\components\MTools;

class WB_UserZodiac extends UserZodiac {
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

}
