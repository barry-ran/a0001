<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\controllers;

use common\components\BController;
use backend\models\MY_Flink;
use common\components\MTools;
use yii\helpers\Url;
use yii\helpers\Json;
class FlinkController extends BController{
    
   public function actions() {
        return [
            "list" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new MY_Flink()
            ],
            "create" => [
                "class" => "\common\actions\CreateAction",
                "modelClass" => new MY_Flink(),
                "renderParams" => ["action" => "create"]
            ],
            "update" => [
                "class" => "\common\actions\UpdateAction",
                "modelClass" => new MY_Flink(),
                "renderParams" => ["action" => "update"],
                "renderTo" => "create",
                "redirectParams" => ["id" => ""]
            ],
            "delete" => [
                "class" => "\common\actions\DeleteAction",
                "modelClass" => new MY_Flink()
            ]
        ];
    }

    public function actionAjaxlist() {
        $res = MY_Flink::getList();
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $temp["rows"][] = [
                    "webname" => $item["webname"],
                    "url"=>$item["url"],
                    "typeid" => $item["catType"] ? $item["catType"]["name"] : null,
                    "updated_at" => date("Y-m-d", $item["updated_at"]),
                     "action" => MTools::getStringActions([
                        "update" => [
                            "params" => [ "id" => $item["id"]],
                            "title" => "编辑"
                        ],
                        "delete" => [
                            "params" => [ "id" => $item["id"]],
                            "title" => "删除"
                        ]
                    ])
                ];
            }
        }
        echo Json::encode($temp);
    }
}
