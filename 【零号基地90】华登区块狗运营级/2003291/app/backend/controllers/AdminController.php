<?php

/*
 * file : AdminController
 * author: shuang
 * email : shuangbrother@126.com
 * created_at : 2015-12-8 -- 11:14:02
 */

namespace backend\controllers;

use common\components\BController;
use backend\models\MY_Admin;
use backend\models\MY_Permission;
use yii\helpers\Json;
use common\components\MTools;
use common\models\Actionlog;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class AdminController extends BController {

    public function actions() {
        return [
            "list" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new MY_Admin(),
                "searchParams" => array("id")
            ],
//            "delete" => [
//                "class" => "\common\actions\DeleteAction",
//                "modelClass" => new MY_Admin(),
//                "redirectTo"=>"site/logout"
//            ],
            "create" => [
                "class" => "\common\actions\CreateAction",
                "modelClass" => new MY_Admin(),
                "renderParams" => ["action" => "create"],
            ],
            "update" => [
                "class" => "\common\actions\UpdateAction",
                "modelClass" => new MY_Admin(),
                "renderParams" => ["action" => "update"],
                "renderTo" => "create",
                "redirectTo" => "list",
                "redirectParams" => ["id" => ""]
            ],
            "perlist" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new MY_Permission(),
                "redirectTo" => "perlist",
                "renderTo" => "perlist"
            ],
            "createper" => [
                "class" => "\common\actions\CreateAction",
                "modelClass" => new MY_Permission(),
                "renderParams" => ["action" => "createper"],
                "renderTo" => "createper",
                "redirectTo" => "perlist",
            ],
            "updateper" => [
                "class" => "\common\actions\UpdateAction",
                "modelClass" => new MY_Permission(),
                "renderParams" => ["action" => "updateper"],
                "renderTo" => "createper",
                "redirectTo" => "perlist",
                "redirectParams" => ["id" => ""]
            ],
//            "deleteper" => [
//                "class" => "\common\actions\DeleteAction",
//                "modelClass" => new MY_Permission(),
//                "redirectTo" => "perlist"
//            ],
            "updataadminpwd" => [
                "class" => "\common\actions\CreateAction",
                "modelClass" => new MY_Admin(),
                "renderParams" => ["action" => "updataadminpwd"],
                "renderTo" => "updataadminpwd",
                "redirectTo" => "list",
                "redirectParams" => ["id" => ""]
            ],
            "actionlog" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new Actionlog(),
                "redirectTo" => "actionlog",
                "renderTo" => "actionlog"
            ],
        ];
    }

    public function actionAjaxlist() {
        $res = MY_Admin::getList();
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $temp["rows"][] = [
                    "id" => $item["id"],
                    "username" => $item["username"],
                    "email" => $item["email"],
                    "phone" => $item["phone"],
                    "updated_at" => date("Y-m-d", $item["updated_at"]),
                    "action" => MTools::getStringActions([
                        "update" => [
                            "params" => [ "id" => $item["id"]],
                            "title" => "编辑"
                        ],
                        "delete" => [
                            "params" => [ "id" => $item["id"]],
                            "title" => "删除"
                        ],
                    ])
                ];
            }
        }
        echo Json::encode($temp);
    }

    public function actionAjaxperlist() {
        $res = MY_Permission::getList();
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $temp["rows"][] = [
                    "id" => $item["id"],
                    "name" => $item["name"],
                    "updated_at" => date("Y-m-d", $item["updated_at"]),
                    "action" => MTools::getStringActions([
//                        "admin/updateper" => [
//                            "params" => [ "id" => $item["id"]],
//                            "title" => "编辑"
//                        ],
                        "admin/deleteper" => [
                            "params" => [ "id" => $item["id"]],
                            "title" => "删除"
                        ]
                    ])
                ];
            }
        }
        echo Json::encode($temp);
    }
    
     //删除管理员
    public function actionDelete(){
        $id = Yii::$app->request->get("id");
        if (empty($id)) {
            Yii::$app->getSession()->setFlash('success', "请选择要删除的管理员！");
        } else {
            $admin = MY_Admin::find()->where("id = :id",[":id"=>$id])->one();
            $res = Yii::$app->db->createCommand() ->delete('me_admin',"id = $id") ->execute();  
            
            if($res){
                \common\models\Actionlog::setLog('删除管理员：'.$admin->username);
                Yii::$app->getSession()->setFlash('success', "删除成功！");
            }else{
                Yii::$app->getSession()->setFlash('error', "删除操作失败！");
            }
        }
        $this->redirect(["list"]);
    }
    
    //删除权限
    public function actionDeleteper(){
        $id = Yii::$app->request->get("id");
        if (empty($id)) {
            Yii::$app->getSession()->setFlash('success', "请选择要删除的权限！");
        } else {
            $permission = MY_Permission::find()->where("id = :id",[":id"=>$id])->one();
            $res = Yii::$app->db->createCommand() ->delete('me_permission',"id = $id") ->execute();  
            
            if($res){
                \common\models\Actionlog::setLog('删除权限：'.$permission->name);
                Yii::$app->getSession()->setFlash('success', "删除成功！");
            }else{
                Yii::$app->getSession()->setFlash('error', "删除操作失败！");
            }
        }
        $this->redirect(["perlist"]);
    }
    //管理员日志
    public function actionAjaxactionlog() {
        $res = Actionlog::getList();
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $temp["rows"][] = [
                    "id" => $item["id"],
                    "userid" => $item["userid"],
                    "username" => $item["username"],
                    "ip" => $item["ip"],
                    "note" => $item["note"],
                    "created_at" => date("Y-m-d H:i", $item["created_at"]),
                ];
            }
        }
        echo Json::encode($temp);
    }

}
