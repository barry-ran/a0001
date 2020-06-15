<?php

namespace backend\controllers;

use backend\models\MY_Guide;
use backend\models\MY_Advertisement;
use common\components\BController;
use yii\helpers\Url;
use common\models\Coins;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use common\components\MTools;
use Yii;
class GuideController extends BController
{

    public function actions() {
        return [
            "list" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new MY_Guide(),
                "searchParams"=>[
                    "typeid"=>ArrayHelper::getValue(Yii::$app->request->post(), "MY_Article.typeid"),
                    "title"=>ArrayHelper::getValue(Yii::$app->request->post(), "MY_Article.title")
                ]
            ],
            "update" => [
                "class" => "\common\actions\UpdateAction",
                "modelClass" => new MY_Guide(),
                "renderParams"=>["action"=>"update"],
                "renderTo"=>"create",
                "redirectTo" => "list",
                "redirectParams"=>["id"=>""]
            ],
            "create" => [
                "class" => "\common\actions\CreateAction",
                "modelClass" => new MY_Guide(),
                "renderParams"=>["action"=>"create"],
            ],
        ];
    }

    public function actionAjaxlist(){
        $pid = Yii::$app->request->get("pid");

        $typeid = Yii::$app->request->get("typeid");
        $title = Yii::$app->request->get("title");

        $res = MY_Guide::getList($pid, $typeid , $title);
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $temp["rows"][] = [
                    "title" => $item["title"],
                    "title_en" => $item["title_en"],
                    "thumb" => MTools::getPreviewImage($item["thumb"]),
//                    "typeid" => ArrayHelper::getValue($item, "typeID.name"),
//                    "audit" => MTools::setFontColor($item["audit"], ($item["audit"] > 0 ? "已审核" : "未审核")),
//                    "senddate" => $item["senddate"] ? date("Y-m-d",$item["senddate"]) : null,
                    "updated_at"=>date("Y-m-d",$item["updated_at"]),
//                    "hits" => $item["hits"],
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
    //删除常见问题
    public function actionDelete(){
        $id = Yii::$app->request->get("id");
        if (empty($id)) {
            Yii::$app->getSession()->setFlash('success', "请选择要删除的新手指南！");
        } else {
            $faq = MY_Guide::find()->where("id = :id",[":id"=>$id])->one();
            $res = Yii::$app->db->createCommand() ->delete('me_guide',"id = $id") ->execute();

            if($res){
                \common\models\Actionlog::setLog('删除标题为：'.$faq->title.'的常见问题');
                Yii::$app->getSession()->setFlash('success', "删除成功！");
            }else{
                Yii::$app->getSession()->setFlash('error', "删除操作失败！");
            }
        }
        $this->redirect(["list"]);
    }
}
