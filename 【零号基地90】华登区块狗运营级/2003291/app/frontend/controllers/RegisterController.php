<?php

namespace frontend\controllers;

/**
 * @author  shuang
 * @date    2016-12-8 21:15:44
 * @version V1.0
 * @desc
 */
use common\models\Grade;
use common\models\LtAward;
use common\models\ShareRewards;
use common\models\User;
use common\models\UserBank;
use common\models\UserConver;
use common\models\UserProfile;
use common\models\UserTransform;
use Yii;
use common\components\MController;
use frontend\models\WB_UserProfile;
use frontend\models\WB_User;
use frontend\models\WB_UserTransform;
use common\components\MTools;
use frontend\models\WB_UserWalletRecord;
use yii\helpers\HtmlPurifier;
use dosamigos\qrcode\QrCode;

class RegisterController extends MController {

}
