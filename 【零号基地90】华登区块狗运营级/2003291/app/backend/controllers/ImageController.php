<?php

/*
 * @Filename     : ImageController
 * @Author       : shuangbrother
 * @Email        : shuangbrother@126.com
 * @create_at    : 2015-12-23
 * @Description  : 
 */

namespace backend\controllers;

use common\components\BController;
use backend\models\MY_Image;
use common\components\MTools;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\helpers\Html;
class ImageController extends BController {

    public function actions() {
        return [
            "list" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new MY_Image()
            ],
            "create" => [
                "class" => "\common\actions\CreateAction",
                "modelClass" => new MY_Image(),
                "renderParams" => ["action" => "create"]
            ],
            "delete" => [
                "class" => "\common\actions\DeleteAction",
                "modelClass" => new MY_Image(),
                "delpic"=>true,
                "imagefield"=>"picpath"
            ]
        ];
    }

    public function actionAjaxlist() {
        $res = MY_Image::getList();
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $temp["rows"][] = [
                    "picpath" => MTools::getPreviewImage($item["picpath"]),
                    "imageurl"=> Html::a(MTools::getWebPath($item["picpath"]),MTools::getWebPath($item["picpath"])),
                    "size" => $item["sizeType"] ? $item["sizeType"]["name"] : null,
                    "apptype" => $item["appType"] ? $item["appType"]["name"] : null,
                    "updated_at" => date("Y-m-d", $item["updated_at"]),
                     "action" => MTools::getStringActions([
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
