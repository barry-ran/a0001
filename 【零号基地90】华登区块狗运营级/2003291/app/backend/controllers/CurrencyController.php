<?php

namespace backend\controllers;

/**
 * @author  shuang
 * @date    2016-11-13 18:06:44
 * @version V1.0
 * @desc
 */
use backend\models\TaskparamsForm;
use common\components\BController;
use backend\models\MY_Level;
use common\components\MTools;
use common\models\Car;
use common\models\ZtslAward;
use common\models\LtAward;
use common\models\SellCare;
use common\models\CarePriceRecord;
use backend\models\MY_StockPriceRecord;
use yii\helpers\Json;
use common\models\TradeNum;
use yii\helpers\ArrayHelper;
use Yii;
use common\models\RegisterAward;
use common\models\Grade;

class CurrencyController extends BController {

    public function actions() {
        return [
            "list" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new MY_Level()
            ],
            "update" => [
                "class" => "\common\actions\UpdateAction",
                "modelClass" => new MY_Level(),
                "renderParams" => ["action" => "update"],
                "renderTo" => "create",
                "redirectParams" => ["id" => ""]
            ],
           "createprice" => [
                "class" => "\common\actions\CreateAction",
                "modelClass" => new MY_StockPriceRecord(),
                "renderTo" => "createprice",
                "redirectTo" => "price",
                "renderParams" => ["action" => "createprice"]
            ],
            "sellcare" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new SellCare(),
                "renderTo" => "sellcare",
            ],
            "createsellcare" => [
                "class" => "\common\actions\CreateAction",
                "modelClass" => new SellCare(),
                "renderTo" => "createsellcare",
                "redirectTo" => "sellcare",
                "renderParams" => ["action" => "createsellcare"]
            ],
            "careprice" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new CarePriceRecord(),
                "renderTo" => "careprice",
            ],
           "createcareprice" => [
                "class" => "\common\actions\CreateAction",
                "modelClass" => new CarePriceRecord(),
                "renderTo" => "createcareprice",
                "redirectTo" => "careprice",
                "renderParams" => ["action" => "createcareprice"]
            ],
        ];
    }

    public function actionAjaxlist() {
        $res = MY_Level::getList();
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $temp["rows"][] = [
                    "name" => $item["name"],
                    "reg_score_min" => Yii::$app->formatter->asDecimal($item["reg_score_min"]),
                    "reg_score_max" => Yii::$app->formatter->asDecimal($item["reg_score_max"]),
                    "peop_per" => Yii::$app->formatter->asPercent($item["peop_per"],2),
                    "team_per" => Yii::$app->formatter->asPercent($item["team_per"],2),
                    "updated_at" => Yii::$app->formatter->asDatetime($item["updated_at"]),
                    "action" => MTools::getStringActions([
                        "update" => [
                            "params" => ["id" => $item["id"]],
                            "title" => "编辑"
                        ]
                    ])
                ];
            }
        }
        echo Json::encode($temp);
    }


    //查询LKC列表
    public function actionAjaxsellcare() {
        $res = SellCare::getList();
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $temp["rows"][] = [
                    "id" => $item["id"],
                    //"price" => Yii::$app->formatter->asDecimal($item["price"]),
                    "sell_num" => Yii::$app->formatter->asDecimal($item["sell_num"]),
                    "remain_num" => Yii::$app->formatter->asDecimal($item["remain_num"]),
                    "admin_id" => $item["admin_id"],
                    "admin_name" => $item["admin_name"],
                    "ip" => $item["ip"],
                    "lv_limit" => $item["lv_limit"],
                    "lv0_limit" => $item["lv0_limit"],
                    "lv1_limit" => $item["lv1_limit"],
                    "lv2_limit" => $item["lv2_limit"],
                    "lv3_limit" => $item["lv3_limit"],
                    "img" => MTools::getPreviewImage($item["img"]),
                    "status" => SellCare::$status [$item["status"]],
                    "note" => $item["note"],
                    "sell_time" => Yii::$app->formatter->asDatetime($item["sell_time"]),
                    "end_time" => Yii::$app->formatter->asDatetime($item["end_time"]),
                    "created_at" => Yii::$app->formatter->asDatetime($item["created_at"]),
                ];
            }
        }
        echo Json::encode($temp);
    }

    //查询LKC价格列表
    public function actionAjaxcareprice() {
        $res = CarePriceRecord::getList();
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $temp["rows"][] = [
                    "note" => $item["note"],
                    "price" => Yii::$app->formatter->asDecimal($item["price"]),
                    "id" => $item["id"],
                    "created_at" => Yii::$app->formatter->asDatetime($item["created_at"])
                ];
            }
        }
        echo Json::encode($temp);
    }

    /*
     * LKC参数配置
     */

    public function actionTaskparams() {
        $model = new TaskparamsForm();
        foreach ($model->attributes() as $attribute) {
            $model->$attribute = ArrayHelper::getValue(Yii::$app->params, $attribute);
        };
        $res = array("errors" => array(), "model" => $model);
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
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
}
