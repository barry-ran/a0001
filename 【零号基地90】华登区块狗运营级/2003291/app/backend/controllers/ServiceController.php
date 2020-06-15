<?php

namespace backend\controllers;

/**
 * @author  shuang
 * @date    2016-12-8 16:24:48
 * @version V1.0
 * @desc    
 */
use common\components\BController;
use common\components\MTools;
use yii\helpers\Json;
use Yii;
use backend\models\MY_UserServer;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\HtmlPurifier;

class ServiceController extends BController {

    public function actions() {
        return [
            "list" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new MY_UserServer()
            ],
            "replay" => [
                "class" => "\common\actions\UpdateAction",
                "modelClass" => new MY_UserServer(),
                "renderTo" => "replay",
                "redirectTo" => "list",
                "renderParams" => ["action" => "replay"]
            ],
            "contactlist" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new MY_UserServer(),
                "renderTo" => "contactlist",
            ],
            "createcontanct" => [
                "class" => "\common\actions\CreateAction",
                "modelClass" => new MY_UserServer(),
                "renderParams"=>["action"=>"createcontanct"],
                "renderTo"=>"createcontanct",
                "redirectTo" => "contactlist",
            ],
        ];
    }

    public function actionAjaxlist() {
        $res = MY_UserServer::getList();
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $temp["rows"][] = [
                    "username" => HtmlPurifier::process($item["username"]),
                    //"problem" => $item["problem"],
                    "content" => HtmlPurifier::process($item["content"]),
                    //"picture" =>$item['picture'] ? "<img src=".Yii::getAlias('@frontend')."/".$item['picture']."/>" : null,
                    //"picture" => "<img src=".Yii::getAlias('@frontend')."/".$item['picture']."/>",   
                    //"picture" => \yii\bootstrap\Html::img(MTools::getWebPath($item['picture'])),
                    "picture" => \yii\bootstrap\Html::a(\yii\bootstrap\Html::img($item['picture'],["width" => 120, "height" => 100]),$item['picture'], ['target' => "_blank"]),
                    "status" => $item["status"] == 1 ? "未回复" : "已回复",
                    "created_at" => Yii::$app->formatter->asDatetime($item["created_at"]),
                    "replay" => HtmlPurifier::process($item["replay"]),
                    "replayd_at" => Yii::$app->formatter->asDatetime($item["replayd_at"]),
                    "action" => MTools::getStringActions($item["status"] == 1 ? [
                                "replay" => [
                                    "params" => ["id" => $item["id"]],
                                    "title" => "回复"
                                ]] : null )
                ];
            }
        }
        echo Json::encode($temp);
    }

    public function actionAjaxcontactlist() {
        $res = MY_UserServer::getList(4);
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $temp["rows"][] = [
                    'userid' => $item['userid'],
                    "username" => $item["username"],
                    "content" => $item["content"],
                    "created_at" => Yii::$app->formatter->asDatetime($item["created_at"]),

                ];
            }
        }
        echo Json::encode($temp);
    }

    
}
