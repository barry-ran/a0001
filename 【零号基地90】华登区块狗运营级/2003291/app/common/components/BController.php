<?php

namespace common\components;

/**
 * @author  shuang
 * @date    2016-12-10 10:20:02
 * @version V1.0
 * @desc    
 */
use Yii;
use yii\web\Controller;
use backend\models\MY_Admin;

class BController extends Controller{
    
    public $breadcrumb;

    public function beforeAction($action) {
        if(parent::beforeAction($action)){  
            $admin = \backend\models\MY_Admin::find()->where("id=:userid", [":userid" => Yii::$app->user->id])->one();
            // 互踢
            $now_token = Yii::$app->session['token'];
            if($admin->app_token != $now_token){
                Yii::$app->user->logout();
                return $this->goHome();
            }
            // 长时间未进行操作，退到登录页面
            if(!$admin instanceof MY_Admin){
                Yii::$app->user->logout();
                return $this->goHome();
            }
            return true;
        }
        return false;
    }
}
