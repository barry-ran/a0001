<?php

namespace frontend\controllers;

/**
 * @author  shuang
 * @date    2016-12-3 20:56:43
 * @version V1.0
 * @desc    
 */
use common\components\MController;
use frontend\models\WB_Article;
use Yii;
use yii\helpers\Json;

class ArticleController extends MController {

    public function actionList() {
        die();
        $res = WB_Article::getList();
        return $this->render("list", $res);
    }

    public function actionDetail() {
        die();
        $id = Yii::$app->request->get("id");
        $res = WB_Article::findOne($id);
        return $this->render("detail", ["data" => $res]);
    }

    public function actionAjaxlist() {
        $res = WB_Article::getList();
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $temp["rows"][] = [
                    "title" => $item["title"],
                    "senddate" => $item["senddate"] ? date("Y-m-d", $item["senddate"]) : null,
                    "updated_at" => date("Y-m-d", $item["updated_at"])
                ];
            }
        }
        echo Json::encode($temp);
    }

}
