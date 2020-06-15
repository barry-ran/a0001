<?php

namespace backend\controllers;

use common\components\BController;
use backend\models\MY_Dirctory;
use backend\models\MY_Dirfile;
use common\components\MTools;
use yii\helpers\Url;
use yii\helpers\Json;
use Yii;

class FileController extends BController {

    public function actions() {
        return [
            "dirlist" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new MY_Dirctory(),
                "renderTo" => "dirlist"
            ],
            "createdir" => [
                "class" => "\common\actions\CreateAction",
                "modelClass" => new MY_Dirctory(),
                "renderParams" => ["action" => "createdir"],
                "renderTo" => "createdir",
                "redirectTo" => "dirlist"
            ],
            "updatedir" => [
                "class" => "\common\actions\UpdateAction",
                "modelClass" => new MY_Dirctory(),
                "renderParams" => ["action" => "updatedir"],
                "renderTo" => "createdir",
                "redirectTo" => "dirlist"
            ],
            "filelist" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new MY_Dirfile(),
                "renderTo" => "filelist",
                "searchParams" => [
                    "cid" => Yii::$app->request->get("cid")
                ]
            ],
            "createfile" => [
                "class" => "\common\actions\CreateAction",
                "modelClass" => new MY_Dirfile(),
                "renderParams" => ["cid" => "", "action" => "createfile"],
                "renderTo" => "createfile",
                "redirectParams" => ["cid" => Yii::$app->request->get("cid")],
                "redirectTo" => "filelist"
            ],
            "updatefile" => [
                "class" => "\common\actions\UpdateAction",
                "modelClass" => new MY_Dirfile(),
                "renderTo" => "createfile",
                "redirectTo" => "filelist",
                "redirectParams" => ["cid" => Yii::$app->request->get("cid")],
                "renderParams" => ["cid" => "", "action" => "updatefile"]
            ]
        ];
    }

    /*
     * ajax目录数据列表
     */

    public function actionAjaxdirlist() {
        $res = MY_Dirctory::getList();
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                //操作按钮
                $temp["rows"][] = [
                    "id" => $item["id"],
                    "title" => $item["title"],
                    "name" => $item["name"],
                    "action" => MTools::getStringActions([
                        "updatedir" => [
                            "params" => [ "id" => $item["id"]],
                            "title" => "编辑"
                        ],
                        "deletedir" => [
                            "params" => [ "id" => $item["id"]],
                            "title" => "删除"
                        ],
                        "filelist" => [
                            "params" => [ "cid" => $item["id"]],
                            "title" => "添加文件"
                        ]
                    ])
                ];
            }
        }
        echo Json::encode($temp);
    }

    /*
     * ajax文件数据列表
     */

    public function actionAjaxfilelist() {
        $res = MY_Dirfile::getList();
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $temp["rows"][] = [
                    "id" => $item["id"],
                    "title" => $item["title"],
                    "name" => $item["name"],
                    "url" => \yii\helpers\Html::a($item["name"],  MTools::getWebPath(MTools::getYiiParams("fileRootDir").$item["dirID"]["name"]."/".$item["name"])),
                    "action" => MTools::getStringActions([
                        "updatefile" => [
                            "params" => [ "cid" => $item["id"]],
                            "title" => "编辑"
                        ],
                        "deletefile" => [
                            "params" => [ "cid" => $item["id"]],
                            "title" => "删除"
                        ]
                    ])
                ];
            }
        }
        echo Json::encode($temp);
    }

    /*
     * 删除文件
     */

    public function actionDeletefile() {
        $id = Yii::$app->request->get("id");
        $cid = Yii::$app->request->get("cid");
        if (MY_Dirfile::deleteData($cid, $id)) {
            Yii::$app->getSession()->setFlash('success', '删除成功！');
            $this->redirect(array("filelist", "cid" => $cid));
        } else {
            Yii::$app->getSession()->setFlash('error', '删除失败！');
        }
    }

    /*
     * 删除文件夹及里面的文件
     */

    public function actionDeletedir() {
        $id = Yii::$app->request->get("id");
        $model = MY_Dirctory::findOne($id);
        $transaction = Yii::$app->db->beginTransaction();
        try {
            //删除目录的文件记录  目录记录
            if (MY_Dirfile::deleteAll(["cid" => $id]) && $model->delete()) {
                MTools::deleteDir($model->name);
                Yii::$app->getSession()->setFlash('success', '删除成功！');
                $this->redirect(["dirlist"]);
            } else {
                Yii::$app->getSession()->setFlash('success', '删除失败！');
            }
            $transaction->commit();
        } catch (Exception $ex) {
            $transaction->rollBack();
            throw $ex;
        }
    }
}
