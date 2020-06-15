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
use common\models\Notification;
use common\models\SmsCode;

class LevelController extends BController {

    public function actions() {
        return [
            "car" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new Car(),
                "renderTo" => "car",
            ],
            "updatecar" => [
                "class" => "\common\actions\UpdateAction",
                "modelClass" => new Car(),
                "renderParams" => ["action" => "updatecar"],
                "renderTo" => "createcar",
                "redirectParams" => ["id" => ""],
                "redirectTo" => "car",
            ],
            "ltaward" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new LtAward(),
                "renderTo" => "ltaward",
            ],
            "updateltaward" => [
                "class" => "\common\actions\UpdateAction",
                "modelClass" => new LtAward(),
                "renderParams" => ["action" => "updateltaward"],
                "renderTo" => "createltaward",
                "redirectParams" => ["id" => ""],
                "redirectTo" => "ltaward",
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
            "tradenum" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new TradeNum(),
                "renderTo" => "tradenum",
            ],
            "updatetradenum" => [
                "class" => "\common\actions\UpdateAction",
                "modelClass" => new TradeNum(),
                "renderParams" => ["action" => "updatetradenum"],
                "renderTo" => "createtradenum",
                "redirectParams" => ["id" => ""],
                "redirectTo" => "tradenum",
            ],
            "spreadlist" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new RegisterAward(),
                "renderTo" => "spreadlist",
            ],
            "spreadupdate" => [
                "class" => "\common\actions\UpdateAction",
                "modelClass" => new RegisterAward(),
                "renderParams" => ["action" => "spreadupdate"],
                "renderTo" => "spreadcreate",
                "redirectParams" => ["id" => ""],
                "redirectTo" => "spreadlist",
            ],
            "grade" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new Grade(),
                "renderTo" => "grade",
            ],
            "updategrade" => [
                "class" => "\common\actions\UpdateAction",
                "modelClass" => new Grade(),
                "renderParams" => ["action" => "updategrade"],
                "renderTo" => "updategrade",
                "redirectParams" => ["id" => ""],
                "redirectTo" => "grade",
            ],
            //新增收益配置
            "createaward" => [
                "class" => "\common\actions\CreateAction",
                "modelClass" => new LtAward(),
                "renderTo" => "createaward",
                "redirectTo" => "ltaward",
                "renderParams" => ["action" => "createaward"]
            ],
            //删除收益配置
            "deleteaward"=>[
                "class" => "\common\actions\DeleteAction",
                "modelClass" => new LtAward(),
                "redirectTo" => "ltaward",
            ],
            //交易消息列表
            "notification" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new Notification(),
                "renderTo" => "notification",
            ],
            //短信消息列表
            "smscode" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new SmsCode(),
                "renderTo" => "smscode",
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
                    "buy_min" => Yii::$app->formatter->asDecimal($item["buy_min"]),
                    "profit" => ($item["profit"] * 100).'%',
                    "increase" => ($item["increase"] * 100).'%',
                    "round" => $item["round"],
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
    //会员等级列表
    public function actionAjaxgrade() {
        $res = Grade::getList();


        echo Json::encode($res);
    }
    //查询加速器列表
    public function actionAjaxcar() {
        $res = Car::getList();
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $temp["rows"][] = [
                    "name" => $item["name"],
                    "en_name" => $item["en_name"],
                    "level" => $item["level"],
                    "img" => MTools::getPreviewImage($item["img"]),
                    "price" => Yii::$app->formatter->asDecimal($item["price"]),
                    "out_times" => $item["out_times"],
                    "award_per" => Yii::$app->formatter->asPercent($item["award_per"],3),
                    "updated_at" => Yii::$app->formatter->asDatetime($item["updated_at"]),
                    "action" => MTools::getStringActions([
                        "updatecar" => [
                            "params" => ["id" => $item["id"]],
                            "title" => "编辑"
                        ]
                    ])
                ];
            }
        }
        echo Json::encode($temp);
    }
    
    //查询流通奖列表
    public function actionAjaxltaward() {
        $res = LtAward::getList();
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $temp["rows"][] = [
                    "layer_num" => $item["layer_num"],
                    "award_per" => Yii::$app->formatter->asPercent($item["award_per"],4),
                    "updated_at" => Yii::$app->formatter->asDatetime($item["updated_at"]),
                    "action" => MTools::getStringActions([
                        "updateltaward" => [
                            "params" => ["id" => $item["id"]],
                            "title" => "编辑"
                        ],
                        "deleteaward" => [
                            "params" => ["id" => $item["id"]],
                            "title" => "删除"
                        ]
                    ])
                ];
            }
        }
        echo Json::encode($temp);
    }
    //交易消息ajax
    public function actionAjaxnotification() {
        $res = Notification::getList();
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $temp["rows"][] = [
                    "order_id" => $item["order_id"],
                    "out_userid" => $item["out_userid"],
                    "in_userid" => $item["in_userid"],
                    "in_username" => $item["in_username"],
                    "out_username" => $item["out_username"],
                    "msg_type" => $item["msg_type"]==1?'确认付款':'确认收款',
                    "created_at" =>Yii::$app->formatter->asDatetime($item["created_at"]),
                ];
            }
        }
        echo Json::encode($temp);
    }
    //验证码消息ajax
    public function actionAjaxsmscode() {
        $res = SmsCode::getList();
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $temp["rows"][] = [
                    "phone" => $item["phone"],
                    "code" => $item["code"],
                    "ip" => $item["ip"],
                    "create_at" =>Yii::$app->formatter->asDatetime($item["create_at"]),
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
    
    //查询卢宝价格列表
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
    
    //查询加速器列表
    public function actionAjaxtradenum() {
        $res = TradeNum::getList();
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $temp["rows"][] = [
                    "id" => $item["id"],
                    "num" => $item["num"],
                    "created_at" => Yii::$app->formatter->asDatetime($item["created_at"]),
                    "updated_at" => Yii::$app->formatter->asDatetime($item["updated_at"]),
                    "action" => MTools::getStringActions([
                        "updatetradenum" => [
                            "params" => ["id" => $item["id"]],
                            "title" => "编辑"
                        ]
                    ])
                ];
            }
        }
        echo Json::encode($temp);
    }

    //查询推广赠送卢呗列表
    public function actionAjaxspreadlist() {
        $res = RegisterAward::getList();
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $temp["rows"][] = [
                    "number" => $item["number"],
                    "present_integral" => Yii::$app->formatter->asDecimal($item["present_integral"]),
                    "updated_at" => Yii::$app->formatter->asDatetime($item["updated_at"]),
                    "action" => MTools::getStringActions([
                        "spreadupdate" => [
                            "params" => ["id" => $item["id"]],
                            "title" => "编辑"
                        ]
                    ])
                ];
            }
        }
        echo Json::encode($temp);
    }

    /*
     * 卢宝参数配置
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
