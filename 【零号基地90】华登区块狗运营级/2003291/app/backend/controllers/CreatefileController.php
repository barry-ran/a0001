<?php

namespace backend\controllers;

/**
 * @author  shuang
 * @date    2016-8-4 17:13:37
 * @version V1.0
 * @desc    
 */
use yii\web\Controller;

class CreatefileController extends Controller {

    public $layout = false;

    //获取后台管理菜单数据
    public function actionGetmenus() {
        $res = \backend\models\MY_Mgmt::getMenuData();
        echo "<?php\n return \n'" . json_encode($res) . "';";
    }

    //获取后台字典信息
    public function actionGetdicts() {
        $temp = \backend\models\MY_Dictionary::getDictAllInfo();
        echo "<?php\n return \n'" . json_encode($temp) . "';";
    }

    /*
     * 获取公告权限
     */

    public function actionGetPublicAuth() {
        $res = \backend\models\MY_Mgmt::getPublicFunctions();
        echo "<?php\n return \n'" . json_encode($res) . "';";
    }

}
