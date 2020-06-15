<?php

namespace frontend\models;

/**
 * @author  shuang
 * @date    2016-12-6 23:41:35
 * @version V1.0
 * @desc    
 */
use common\models\StockPriceRecord;
use yii;

class WB_StockPriceRecord extends StockPriceRecord {

    
    public static function deleteShop($userid){
        $wallet = WB_UserWallet::find()->where("userid=$userid")->one();
       
        if($wallet->save()){
            return true;
        }else{
            return false;
        }
    }
    
  

}