<?php

namespace backend\controllers;

/**
 * @author  shuang
 * @date    2016-8-2 11:01:16
 * @version V1.0
 * @desc    
 */
use backend\models\MY_Article;
use backend\models\MY_Advertisement;
use common\components\BController;
use yii\helpers\Url;
use common\models\Coins;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use common\components\MTools;
use Yii;
class ArticleController extends BController{
     public function actions() {
        return [
            "list" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new MY_Article(),
                "searchParams"=>[
                    "typeid"=>ArrayHelper::getValue(Yii::$app->request->post(), "MY_Article.typeid"),
                    "title"=>ArrayHelper::getValue(Yii::$app->request->post(), "MY_Article.title")
                ]
            ],
            "create" => [
                "class" => "\common\actions\CreateAction",
                "modelClass" => new MY_Article(),
                "renderParams"=>["action"=>"create"],
            ],
            "update" => [
                "class" => "\common\actions\UpdateAction",
                "modelClass" => new MY_Article(),
                "renderParams"=>["action"=>"update"],
                "renderTo"=>"create",
                "redirectTo" => "list",
                "redirectParams"=>["id"=>""]
            ],
            "addeuarticle" => [
                "class" => "\common\actions\UpdateAction",
                "modelClass" => new MY_Article(),
                "renderParams"=>["action"=>"addeuarticle"],
                "renderTo"=>"addeuarticle",
                "redirectTo" => "list",
                "redirectParams"=>["id"=>""]
            ],
//             "delete"=>[
//                "class" => "\common\actions\DeleteAction",
//                "modelClass" => new MY_Article(),
//            ],
            "advertisement" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new MY_Advertisement(),
                "redirectTo" => "advertisement",
                "renderTo" => "advertisement",
            ],
            "addadvertisement" => [
                "class" => "\common\actions\CreateAction",
                "modelClass" => new MY_Advertisement(),
                "renderTo"=>"addadvertisement",
                "redirectTo" => "advertisement",
                "renderParams"=>["action"=>"addadvertisement"],
            ],
//            "deleteadv"=>[
//                "class" => "\common\actions\DeleteAction",
//                "modelClass" => new MY_Advertisement(),
//                "redirectTo" => "advertisement",
//            ],
        ];
    }
    public function actionAjaxlist(){
        $pid = Yii::$app->request->get("pid");
        $typeid = Yii::$app->request->get("typeid");
        $title = Yii::$app->request->get("title");
        $res = MY_Article::getList($pid, $typeid , $title);
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $temp["rows"][] = [
                    "title" => $item["title"],
                    "title_en" => $item["title_en"],
                    "thumb" => MTools::getPreviewImage($item["thumb"]),
                    "typeid" => ArrayHelper::getValue($item, "typeID.name"),
                    "audit" => MTools::setFontColor($item["audit"], ($item["audit"] > 0 ? "已审核" : "未审核")),
                    "senddate" => $item["senddate"] ? date("Y-m-d",$item["senddate"]) : null,
                    "updated_at"=>date("Y-m-d",$item["updated_at"]),
                    "hits" => $item["hits"],
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
    
    public function actionAjaxadvertisement(){//添加轮播图
        $res = MY_Advertisement::getList();
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $a = "<img src=".'"'.$item["img"].'"'."/>";
                $temp["rows"][] = [
                    "content" => $item["content"],
                    "img" => MTools::getPreviewImage2($item["img"]),
                    "id" => ArrayHelper::getValue($item, "id"),
                    "created_at"=>date("Y-m-d",$item["created_at"]),
                    "action" => MTools::getStringActions([
                        "deleteadv" => [
                            "params" => [ "id" => $item["id"]],
                            "title" => "删除"
                        ]
                    ])
                ];
            }
        }
        echo Json::encode($temp);
    }
    

    //删除新闻
    public function actionDelete(){
        $id = Yii::$app->request->get("id");
        if (empty($id)) {
            Yii::$app->getSession()->setFlash('success', "请选择要删除的新闻！");
        } else {
            $article = MY_Article::find()->where("id = :id",[":id"=>$id])->one();
            $res = Yii::$app->db->createCommand() ->delete('me_article',"id = $id") ->execute();  
            
            if($res){
                \common\models\Actionlog::setLog('删除标题为：'.$article->title.'的新闻');
                Yii::$app->getSession()->setFlash('success', "删除成功！");
            }else{
                Yii::$app->getSession()->setFlash('error', "删除操作失败！");
            }
        }
        $this->redirect(["list"]);
    }
    
    //删除轮播图
    public function actionDeleteadv(){
        $id = Yii::$app->request->get("id");
        if (empty($id)) {
            Yii::$app->getSession()->setFlash('success', "请选择要删除的轮播图！");
        } else {
            //$article = \common\models\Advertisement::find()->where("id = :id",[":id"=>$id])->one();
            $res = Yii::$app->db->createCommand() ->delete('me_advertisement',"id = $id") ->execute();  
            
            if($res){
                \common\models\Actionlog::setLog('删除轮播图');
                Yii::$app->getSession()->setFlash('success', "删除成功！");
            }else{
                Yii::$app->getSession()->setFlash('error', "删除操作失败！");
            }
        }
        $this->redirect(["advertisement"]);
    }
    
}
