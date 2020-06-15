<?php

namespace backend\models;

/**
 * @author  shuang
 * @date    2016-12-7 10:08:51
 * @version V1.0
 * @desc    
 */
use common\models\UserWallet;

class MY_UserWallet extends UserWallet {
    //put your code here
    public static $wallet_type = [
        1 => "注册卢呗", 2 => "现金卢呗", 3 => "保管币", 4 => "娱乐卢呗", 5 => "DFC卢呗", 6 => "保管卢呗"
    ];
}
