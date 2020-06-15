<?php

/*
 * file : DictController
 * author: shuang
 * email : shuangbrother@126.com
 * created_at : 2015-12-9 -- 10:45:46
 */

namespace backend\controllers;

use common\components\BController;
use backend\models\MY_Dictionary;
use Yii;
use yii\helpers\Url;
use common\components\MTools;
use yii\helpers\Json;

class DictController extends BController {

    public function actions() {
        return [
            "create" => [
                "class" => "\common\actions\CreateAction",
                "modelClass" => new MY_Dictionary(),
                "renderParams" => ["action" => "create"],
                "redirectTo" => "create"
            ],
            "update" => [
                "class" => "\common\actions\UpdateAction",
                "modelClass" => new MY_Dictionary(),
                "renderParams" => ["action" => "update"],
                "renderTo" => "create",
                "redirectTo" => "update",
                "redirectParams" => ["id" => ""]
            ],
            "createChild" => array(
                "class" => "\common\actions\CreateAction",
                "modelClass" => new MY_Dictionary(),
                "redirectTo" => "createChild",
                "redirectParams" => array("column_id" => "", "id" => ""),
                "renderTo" => "createChild",
                "renderParams" => array("column_id" => "", "action" => "createChild"),
            ),
            "updateChild" => array(
                "class" => "\common\actions\UpdateAction",
                "modelClass" => new MY_Dictionary(),
                "redirectTo" => "updateChild",
                "redirectParams" => array("column_id" => "", "id" => ""),
                "renderTo" => "createChild",
                "renderParams" => array("column_id" => "", "action" => "updateChild"),
            ),
        ];
    }

    public function actionAjaxlist() {
        $column_id = Yii::$app->request->get("column_id", 0);
        $res = MY_Dictionary::getList($column_id);
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                //操作按钮
                if (Yii::$app->request->get("child") == 1) {
                    $operate = MTools::getStringActions([
                                "updateChild" => [
                                    "params" => ["column_id" => $column_id, "id" => $item["id"]],
                                    "title" => "编辑",
                                    "icon" => "edit"
                                ],
                                "sort1" => [
                                    "params" => ["column_id" => $column_id, "id" => $item["id"], "listorder" => 1],
                                    "title" => "上移",
                                    "icon" => "circle-arrow-up"
                                ],
                                "sort2" => [
                                    "params" => ["column_id" => $column_id, "id" => $item["id"], "listorder" => 2],
                                    "title" => "下移",
                                    "icon" => "circle-arrow-down"
                                ],
                                "sort3" => [
                                    "params" => ["column_id" => $column_id, "id" => $item["id"], "listorder" => 3],
                                    "title" => "置顶",
                                    "icon" => "circle-arrow-left"
                                ],
                                "sort4" => [
                                    "params" => ["column_id" => $column_id, "id" => $item["id"], "listorder" => 4],
                                    "title" => "置末",
                                    "icon" => "circle-arrow-right"
                                ]], ["sort1" => ["url" => "sort"], "sort2" => ["url" => "sort"], "sort3" => ["url" => "sort"], "sort3" => ["url" => "sort"]]);
                } else {
                    $operate = MTools::getStringActions([
                        "update"=>[
                            "params"=>["id"=>$item["id"]],
                            "title"=>"编辑",
                            "icon"=>"edit"
                        ],
                        "createChild"=>[
                            "params"=>["column_id" => $item["id"]],
                            "title"=>"添加子项",
                            "icon"=>"plus-sign"
                        ]
                    ]);
                }
                $temp["rows"][] = [
                    "id" => $item["id"],
                    "name" => $item["name"],
                    "description" => $item["description"],
                    "created_at" => date("Y-m-d", $item["created_at"]),
                    "updated_at" => date("Y-m-d", $item["updated_at"]),
                    "action" => $operate
                ];
            }
        }
        echo Json::encode($temp);
    }

    /*
     * 设置排序
     */

    public function actionSort() {
        $id = Yii::$app->request->get("id");
        $column_id = Yii::$app->request->get("column_id");
        $listorder = Yii::$app->request->get("listorder");

        $data = MY_Dictionary::getSortId($column_id);
        $this->_moveData($listorder, $data, $id);
        foreach ($data as $val) {
            $model = MY_Dictionary::find()->where(["id" => $val["id"]])->one();
            $model->sortid = $val["sortid"];
            $model->update();
        }
        $this->redirect(array("createChild", "column_id" => $column_id));
    }

    /*
     * @params $listorder
     */

    private function _moveData($listorder, &$data, $id) {
        switch ($listorder) {
            case 1:    //上移
                foreach ($data as $key => $var) {
                    if ($var["id"] == $id) {
                        if ($key != 0) {
                            $sortid = $data[$key]["sortid"];
                            $data[$key]["sortid"] = $data[$key - 1]["sortid"];
                            $data[$key - 1]["sortid"] = $sortid;
                        }
                    }
                }
                break;
            case 2:   //下移
                foreach ($data as $key => $var) {
                    if ($var["id"] == $id) {
                        if ($key != count($data) - 1) {
                            $sortid = $data[$key]["sortid"];
                            $data[$key]["sortid"] = $data[$key + 1]["sortid"];
                            $data[$key + 1]["sortid"] = $sortid;
                        }
                    }
                }
                break;
            case 3:    //首位
                foreach ($data as $key => $var) {
                    if ($var["id"] == $id) {
                        if ($key != 0) {
                            $data[$key]["sortid"] = $data[0]["sortid"] + 1;
                        }
                    }
                }
                break;
            case 4:    //末位
                foreach ($data as $key => $var) {
                    if ($var["id"] == $id) {
                        if ($key != count($data) - 1) {
                            $data[$key]["sortid"] = $data[count($data) - 1]["sortid"] - 1;
                        }
                    }
                }
                break;
            default :
                break;
        }
        return $data;
    }

}
