<?php

namespace frontend\models;

/**
 * @author  shuang
 * @date    2016-12-6 23:41:35
 * @version V1.0
 * @desc    
 */
use common\models\Currency;
use yii;

class WB_Currency extends Currency {

    
    public static function deleteShop($userid){
        $wallet =  WB_Currency::find()->where("id=$id")->one();
       
        if($wallet->save()){
            return true;
        }else{
            return false;
        }
    }
    
  

}