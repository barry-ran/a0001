<?php

namespace backend\controllers;

/**
 * @author  shuang
 * @date    2016-8-5 9:53:59
 * @version V1.0
 * @desc    
 */
use common\models\Coins;
use common\models\EmailConfig;
use common\models\TradeNum;
use common\components\BController;
use \backend\models\SystemForm;
use Yii;
use yii\helpers\ArrayHelper;
use backend\models\TaskparamsForm;
use backend\models\UserForm;
use backend\models\MY_Bank;
use backend\models\MY_SysbonusRecord;
use yii\helpers\Json;
use common\components\MTools;

class SystemController extends BController {

    public function actions() {
        return [

        ];
    }

    //站点设置
    public function actionSitesetting() {
        $model = new SystemForm();
        foreach ($model->attributes() as $attribute) {
            $model->$attribute = ArrayHelper::getValue(Yii::$app->params, $attribute);
        };
        $res = array("errors" => array(), "model" => $model);
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $flag = $model->updateParams();
            if ($flag !== false) {
                Yii::$app->getSession()->setFlash('success', '更新成功!');
            } else {
                $res = $flag;
                Yii::$app->getSession()->setFlash('error', $res["errors"]);
            }
        }
        return $this->render("sitesetting", array_merge($res, array("action" => "sitesetting", "labels" => $model->attributeLabels())));
    }

    //unicode转换
    public function actionUtf8tounicode() {
        $string = Yii::$app->request->get("content");
        return $this->render("unicode", ["content" => json_encode($string)]);
    }

    // 参数配置
    public function actionTaskparams() {
        $model = new TaskparamsForm();
        foreach ($model->attributes() as $attribute) {
            $model->$attribute = ArrayHelper::getValue(Yii::$app->params, $attribute);
        };

        $res = array("errors" => array(), "model" => $model);
        if (Yii::$app->request->isPost) {

            $model->load(Yii::$app->request->post());
            if($_FILES['TaskparamsForm']['tmp_name']['weixin_code'] != ''){
                $filename = Yii::$app->imgload->UploadPhotoQn($model, 'weixin_code');
                if ($filename !== false) {
                    $model->weixin_code = $filename;
                }
            }
            if($_FILES['TaskparamsForm']['tmp_name']['qq_code'] != ''){
                $filename1 = Yii::$app->imgload->UploadPhotoQn($model, 'qq_code');
                if ($filename1 !== false) {
                    $model->qq_code = $filename1;
                }
            }
            $flag = $model->updateParams();
            if ($flag !== false) {
                \common\models\Actionlog::setLog('修改配置参数');
                Yii::$app->getSession()->setFlash('success', '更新成功!');
            } else {
                $res = $flag;
                Yii::$app->getSession()->setFlash('error', $res["errors"]);
            }
        }
        return $this->render("taskparams", array_merge($res, array("action" => "taskparams", "labels" => $model->attributeLabels())));
    }

    //初始化账号登陆密码
    public function actionUploginpass() {
        $model =  new \common\models\User();
        $res = array("errors" => array(), "model" => $model);
        if (Yii::$app->request->isPost) {
            $username = ArrayHelper::getValue(Yii::$app->request->post(),"User.username");
            $user = \common\models\User::find()->where("username=:username",[":username"=>$username])->one();
            if($user instanceof \common\models\User){
                $user->setPassword(12345678);
                $user->setPassword2(12345678);
                if($user->save()){
                    Yii::$app->getSession()->setFlash('success', '更新成功!');
                }else{
                    Yii::$app->getSession()->setFlash('error', "更新失败");
                }
            }else{
                Yii::$app->getSession()->setFlash('error', "您填写的账号不存在！");
            }
        }
        return $this->render("uploginpass", array_merge($res, array("action" => "uploginpass", "labels" => $model->attributeLabels())));
    }

}
