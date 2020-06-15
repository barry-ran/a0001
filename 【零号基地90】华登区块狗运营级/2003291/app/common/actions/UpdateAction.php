<?php

/*
 * @Filename     : UpdateAction
 * @Author       : shuang
 * @Email        : shuangbrother@126.com
 * @create_at    : 2014-6-18 11:29:15
 * @Description  : 更新数据控制器处理程序
 */
namespace common\actions;
use common\actions\MCAction;
use Yii;
class UpdateAction extends MCAction {

    public $renderTo = "update";   //默认渲染视图

    public function run() {
        $pk = $this->getRequestParam($this->pk);

        if (empty($pk)) {
            Yii::$app->getSession()->setFlash("success","请选择您要编辑的选项！");
            $this->controller->redirect(array($this->redirectTo));
        } else {
            $model = $this->getModel()->findOne($pk);

            if (!$model) {
                Yii::$app->getSession()->setFlash("success","对不起，您选择的数据不存在！");
                $this->controller->redirect(array($this->redirectTo));
            } else {
                if (Yii::$app->request->isPost) {
                    $res = $model::createData($pk);
                    if ($res === true) {
                        Yii::$app->getSession()->setFlash("success","修改成功!");
                        $this->controller->redirect($this->setRedirect($model));
                    }else{
                       return $this->controller->render($this->renderTo, array_merge($res,array("labels" => $model->attributeLabels(), $this->pk => $pk),$this->setRenderParams()));
                    }
                } else {
                   return $this->controller->render($this->renderTo, array_merge(array("model" => $model,"errors"=>array(),"labels" => $model->attributeLabels(), $this->pk => $pk),$this->setRenderParams()));
                }
            }
        }
    }
}
