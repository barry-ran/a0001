<?php

namespace backend\controllers;

/**
 * @author  shuang
 * @date    2016-7-1 11:34:47
 * @version V1.0
 * @desc    控制器管理
 */
use common\components\BController;
use backend\models\MY_Mgmt;
use common\components\MTools;
use yii\helpers\Url;
use yii\helpers\Json;
use Yii;

class MgmtController extends BController {

    public function actions() {
        return [
            "list" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new MY_Mgmt()
            ],
            "alist" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new MY_Mgmt(),
                "renderTo" => "alist",
                "searchParams" => array("controller"),
            ],
            "commonlist" => [
                "class" => "\common\actions\ViewAction",
                "renderTo" => "commonlist"
            ],
            "systemlist" => [
                "class" => "\common\actions\ViewAction",
                "renderTo" => "systemlist"
            ],
            "workbench" => [
                "class" => "\common\actions\ViewAction",
                "renderTo" => "workbench"
            ]
        ];
    }

    /*
     * 更新控制器
     */

    public function actionUpdate() {
        if (Yii::$app->request->isPost) {
            $name = Yii::$app->request->post("name");
            if ($name) {
                $condition = "name='$name' and controller is null";
                $model = new MY_Mgmt();
                $model->load(Yii::$app->request->post());
                $model->name = $name;
                $filename = Yii::$app->imgload->UploadPhoto($model, 'icon');
                if ($filename !== false) {
                    $model->icon = $filename;
                }
                $attributes = [
                    "ismenu" => $model->ismenu,
                    "menuname" => $model->menuname,
                    "description" => $model->description,
                    "module" => $model->module,
                    "sortid" => $model->sortid,
                    "icon" => $model->icon,
                    "shorttype" => $model->shorttype
                ];
                if ($model->validate()) {
                    MY_Mgmt::updateAll($attributes, $condition);
                    Yii::$app->getSession()->setFlash("success", "修改成功!");
                    $this->redirect(["list"]);
                } else {
                    $res = ["errors" => $model->errors, "model" => $model];
                    return $this->render("update", array_merge($res, array("labels" => $model->attributeLabels())));
                }
            } else {
                throw new \yii\web\NotAcceptableHttpException;
            }
        } else {
            $name = Yii::$app->request->get("name");
            $condition = "name='$name' and controller is null";
            $model = MY_Mgmt::find()->where($condition)->one();
            if ($model instanceof MY_Mgmt) {
                return $this->render("update", array_merge(array("model" => $model, "errors" => array(), "labels" => $model->attributeLabels())));
            } else {
                Yii::$app->getSession()->setFlash("error", "请选择您更新的控制器!");
                $this->redirect(["list"]);
            }
        }
    }

    /*
     * 更新控制器方法
     */

    public function actionUpdateact() {
        if (Yii::$app->request->isPost) {
            $name = Yii::$app->request->post("name");
            $controller = Yii::$app->request->post("controller");
            if ($name && $controller) {
                $condition = "name='$name' and controller='$controller'";
                $model = new MY_Mgmt();
                $model->load(Yii::$app->request->post());
                $model->name = $name;
                $model->controller = $controller;
                $filename = Yii::$app->imgload->UploadPhoto($model, 'icon');
                if ($filename !== false) {
                    $model->icon = $filename;
                }
                $attributes = [
                    "ismenu" => $model->ismenu,
                    "shortcut" => $model->shortcut,
                    "menuname" => $model->menuname,
                    "description" => $model->description,
                    "sortid" => $model->sortid,
                    "depends" => $model->depends,
                    "breadcrumbs" => $model->breadcrumbs,
                    "isallowed" => $model->isallowed,
                    "icon" => $model->icon,
                    "shorttype" => $model->shorttype
                ];
                if ($model->validate()) {
                    MY_Mgmt::updateAll($attributes, $condition);
                    Yii::$app->getSession()->setFlash("success", "修改成功!");
                    $this->redirect(["alist", "name" => $name, "controller" => $controller]);
                } else {
                    $res = ["errors" => $model->errors, "model" => $model];
                    return $this->render("updateact", array_merge($res, array("labels" => $model->attributeLabels())));
                }
            } else {
                throw new \yii\web\NotAcceptableHttpException;
            }
        } else {
            $name = Yii::$app->request->get("name");
            $controller = Yii::$app->request->get("controller");
            $condition = "name='$name' and controller='$controller'";
            $model = MY_Mgmt::find()->where($condition)->one();
            if ($model instanceof MY_Mgmt) {
                return $this->render("updateact", array_merge(array("model" => $model, "errors" => array(), "labels" => $model->attributeLabels())));
            } else {
                Yii::$app->getSession()->setFlash("error", "请选择您更新的控制器!");
                $this->redirect(["alist", "name" => $name, "controller" => $controller]);
            }
        }
    }

    /*
     * 导入控制器
     */

    public function actionImportcontroller() {
        $controllers = MY_Mgmt::getControllers();
        if ($controllers) {
            $db = Yii::$app->db;
            $trans = $db->beginTransaction();
            try {
                $flag = $db->createCommand()->batchInsert(MY_Mgmt::tableName(), ['name'], $controllers)->execute();
                if ($flag) {
                    Yii::$app->getSession()->setFlash('success', '导入控制器成功!');
                } else {
                    Yii::$app->getSession()->setFlash('error', '导入控制器失败!');
                }
                $trans->commit();
                $this->redirect(["list"]);
            } catch (Exception $ex) {
                $trans->rollBack();
                throw $ex;
            }
        } else {
            Yii::$app->getSession()->setFlash('error', '没有可导入的控制器了!');
            $this->redirect(["list"]);
        }
    }

    /*
     * 导入控制器方法
     */

    public function actionImportact() {
        $controller = Yii::$app->request->get("controller");
        $actions = MY_Mgmt::getActions($controller);
        if ($actions) {
            $db = Yii::$app->db;
            $trans = $db->beginTransaction();
            try {
                $flag = $db->createCommand()->batchInsert(MY_Mgmt::tableName(), ['name', 'controller'], $actions)->execute();
                if ($flag) {
                    Yii::$app->getSession()->setFlash('success', '导入方法成功!');
                } else {
                    Yii::$app->getSession()->setFlash('error', '导入方法失败!');
                }
                $trans->commit();
                $this->redirect(["alist", "controller" => $controller]);
            } catch (Exception $ex) {
                $trans->rollBack();
                throw $ex;
            }
        } else {
            Yii::$app->getSession()->setFlash('error', '控制器已无可导入方法!');
            $this->redirect(["alist", "controller" => $controller]);
        }
    }

    /*
     * 控制列表数据
     */

    public function actionAjaxlist() {
        $res = MY_Mgmt::getList();
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $temp["rows"][] = [
                    "name" => $item["name"],
                    "description" => $item["description"],
                    "ismenu" => MTools::setFontColor($item["ismenu"], ($item["ismenu"] > 0 ? "是" : "否")),
                    "menuname" => $item["menuname"],
                    "action" => MTools::getStringActions([
                        "update" => [
                            "params" => [ "name" => $item["name"]],
                            "title" => "编辑",
                            "icon"=>"edit"
                        ],
                        "alist" => [
                            "params" => [ "controller" => $item["name"]],
                            "title" => "方法列表",
                            "icon"=>"plus-sign"
                        ]
                    ])
                ];
            }
        }
        echo Json::encode($temp);
    }

    /*
     * 控制器方法数据列表
     */

    public function actionAjaxalist() {
        $res = MY_Mgmt::getList();
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $temp["rows"][] = [
                    "name" => $item["name"],
                    "description" => $item["description"],
                    "ismenu" => MTools::setFontColor($item["ismenu"], ($item["ismenu"] > 0 ? "是" : "否")),
                    "menuname" => $item["menuname"],
                    "depends" => $item["depends"] > 0 ? $item["depends"] : "无",
                    "isallowed" => MTools::setFontColor($item["isallowed"], ($item["isallowed"] > 0 ? "是" : "否")),
                    "action" => MTools::getStringActions([
                        "updateact" => [
                            "params" => [ "name" => $item["name"],"controller" => $item["controller"]],
                            "title" => "编辑"
                        ]
                    ])
                ];
            }
        }
        echo Json::encode($temp);
    }

}
