<?php

namespace backend\controllers;

/**
 * @author  shuang
 * @date    2016-8-4 16:13:15
 * @version V1.0
 * @desc    
 */
use common\components\BController;
use backend\models\MY_StaticFile;
use yii\helpers\Url;
use yii\helpers\Json;
use common\components\MTools;
use Yii;

class StaticfileController extends BController {

    public function actions() {
        return [
            "list" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new MY_StaticFile()
            ],
            "create" => [
                "class" => "\common\actions\CreateAction",
                "modelClass" => new MY_StaticFile(),
                "renderParams" => ["action" => "create"],
            ],
            "update" => [
                "class" => "\common\actions\UpdateAction",
                "modelClass" => new MY_StaticFile(),
                "renderParams" => ["action" => "update"],
                "renderTo" => "create",
                "redirectTo" => "list",
                "redirectParams" => ["id" => ""]
            ]
        ];
    }

    public function actionAjaxlist() {
        $res = MY_StaticFile::getList();
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $temp["rows"][] = [
                    "description" => $item["description"],
                    "http" => '<a href="' . $item["dHttp"]["name"] . $item["action"] . ".html" . '" target="_blank">' . $item["dHttp"]["name"] . $item["action"] . ".html" . '</a>',
                    "dir" => $item["dDir"]["name"],
                    "filename" => $item["filename"] . "." . $item["dFiletype"]["name"],
                    "frequency" => $item["frequency"],
                    "flag" => MTools::setFontColor($item["flag"], ($item["flag"] > 0 ? "已存在" : "未生成")),
                    "updated_at" => date("Y-m-d", $item["updated_at"]),
                    "action" => MTools::getStringActions([
                        "update" => [
                            "params" => [ "id" => $item["id"]],
                            "title" => "编辑"
                        ],
                        "makefile" => [
                            "params" => [ "id" => $item["id"]],
                            "title" => "生成文件"
                        ]
                    ])
                ];
            }
        }
        echo Json::encode($temp);
    }

    /*
     * 生成文件
     */

    public function actionMakefile() {
        $id = Yii::$app->request->get("id");
        if (empty($id)) {
            Yii::$app->getSession()->setFlash('success', '请选择您要生成的选项！');
        } else {
            $res = MY_StaticFile::findOne($id);
            if ($res instanceof MY_StaticFile) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($this->createfile($res) !== false) { //更新记录
                        $res->flag = 1;
                        $res->update();
                    }
                    Yii::$app->getSession()->setFlash("success", "访问成功！");
                    $transaction->commit();
                } catch (Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                }
            } else {
                Yii::$app->getSession()->setFlash("success", "对不起，您选择的选项数据已经不存在！");
            }
        }
        $this->redirect(["list"]);
    }

    /*
     * 执行生成文件
     * @params $item
     * return boolean
     */

    private function createfile($item) {
        $http = \backend\models\MY_Dictionary::getOneForID($item["http"]);
        if ($http !== false) {
            $url = $http->name . $item["action"] . ".html";
            $params = $item["params"];
            //访问url,获取内容
            $content = Yii::$app->curl->post($url);
            if ($content !== false) {
                $dir = \backend\models\MY_Dictionary::getOneForID($item["dir"]);
                $filetype = \backend\models\MY_Dictionary::getOneForID($item["filetype"]);
                //创建保存文件内容的目录
                MTools::createDir(MTools::setfilepath($dir->name));
                //将内容写入文件
                return file_put_contents(MTools::setfilepath($dir->name) ."/". $item->filename . "." . $filetype->name, $content);
            }
        }
        return false;
    }

}
