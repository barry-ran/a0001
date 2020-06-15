<?php

/*
 * @Filename     : CreateAction
 * @Author       : shuang
 * @Email        : shuangbrother@126.com
 * @create_at    : 2014-6-18 11:14:57
 * @Description  : 添加数据控制器处理程序
 */
namespace common\actions;
use common\actions\MCAction;
use Yii;
class CreateAction extends MCAction {

    public $renderTo = "create";   //默认渲染视图

    public function run() {
        $model = $this->getModel();
        $res = array("errors"=>array(),"model"=>$model);
        if (Yii::$app->request->isPost) {
            $res = $model::createData();
            if ($res === true) {
                Yii::$app->getSession()->setFlash('success', '添加成功!');
                $this->controller->redirect($this->setRedirect($model));
            }else{
                Yii::$app->getSession()->setFlash('error',$res["errors"]);
            }
        }

        return $this->controller->render($this->renderTo,  array_merge($res,array("labels" => $model->attributeLabels()),$this->setRenderParams()));
    }
}
