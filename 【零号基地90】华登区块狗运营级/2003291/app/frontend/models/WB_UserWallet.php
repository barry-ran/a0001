<?php

namespace frontend\models;

/**
 * @author  shuang
 * @date    2016-12-6 23:41:35
 * @version V1.0
 * @desc    
 */
use common\models\UserWallet;
use yii;

class WB_UserWallet extends UserWallet {

    public static $wallet_type = [
        1 => "注册钱包", 2 => "现金现金", 3 => "关联钱包",
    ];
    
    public static function deleteShop($userid,$price){
        $wallet = WB_UserWallet::find()->where("userid=$userid")->one();
        $wallet->shop_wa = $wallet->shop_wa-$price;
        if($wallet->save()){
            return true;
        }else{
            return false;
        }
    }
    
    public static function getShop($userid,$amount){
        $wallet = WB_UserWallet::find()->where("userid=$userid")->one();
        $wallet->shop_wa = $wallet->shop_wa-$amount;
        if($wallet->shop_wa - $amount >= 0){
            return true;
        }else{
            return false;
        }
    }

}
