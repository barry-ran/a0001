<?php

/*
 * @Filename     : DeleteAction
 * @Author       : shuang
 * @Email        : shuangbrother@126.com
 * @create_at    : 2014-6-18 10:27:26
 * @Description  : 删除数据功能
 */

namespace common\actions;

use common\actions\MCAction;
use Yii;

class DeleteAction extends MCAction {

    public $delpic = false;
    public $imagefield = null;

    public function run() {
        $ids = Yii::$app->request->get($this->pk);
        if (empty($ids)) {
            Yii::$app->getSession()->setFlash("error", "请选择您要删除的选项！");
        } else {
            $pk = strpos($ids, ",") !== false ? explode(",", $ids) : array($ids);
            $model = $this->getModel();
            $condition = "$this->pk in ('" . implode(",", $pk) . "')";
            $items = $model->find()->where($condition)->all();
            if (!$model->deleteAll($condition)) {
                Yii::$app->getSession()->setFlash("error", "对不起服务器异常，删除操作失败！");
            } else {
                if ($this->delpic === true) {
                    $picfiled = $this->imagefield;
                    foreach ($items as $item) {
                        $picpath = Yii::getAlias("@webroot/") . $item->$picfiled;
                        if (file_exists($picpath)) {
                            unlink($picpath);
                        }
                    }
                }
                Yii::$app->getSession()->setFlash("success", "删除成功！");
            }
        }
        $this->controller->redirect(array($this->redirectTo));
    }

}
