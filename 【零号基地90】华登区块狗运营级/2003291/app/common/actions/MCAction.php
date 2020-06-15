<?php

/*
 * @Filename     : MCAction
 * @Author       : shuang
 * @Email        : shuangbrother@126.com
 * @create_at    : 2014-6-18 14:57:39
 * @Description  : 控制器处理程序接口
 */

namespace common\actions;

use yii\base\Action;
use Yii;

class MCAction extends Action {

    public $pk = "id";    //默认主键
    public $redirectTo = "list";   //默认跳转
    public $redirectParams = array();    //跳转参数设置
    public $renderTo = "list";   //默认渲染视图
    public $renderParams = array();  //渲染视图参数设置
    public $modelClass = "";    //要处理的数据模型层
    public $breadcrumbs = []; //页面导航配置

    public function init() {
        parent::init();
    }

    public function getModel() {
        return $this->modelClass;
    }

    /*
     * 设置跳转参数
     * return array
     */

    public function setRedirect($model) {
        $temp = array($this->redirectTo);
        $model->load(Yii::$app->request->post());
        if ($this->redirectParams) {
            foreach ($this->redirectParams as $field => $value) {
                $temp[$field] = $value ? $value : ($this->getRequestParam($field) ? $this->getRequestParam($field) : (isset($model->$field) ? $model->$field : null) );
            }
        }
        return $temp;
    }

    /*
     * 设置视图渲染参数
     * return array
     */

    public function setRenderParams() {
        $temp = array();
        if ($this->renderParams) {
            foreach ($this->renderParams as $field => $value) {
                $temp[$field] = $value ? $value : $this->getRequestParam($field);
            }
        }
        return $temp;
    }

    /*
     * 重置$_GET参数
     */

    public function resetGetParams() {
        Yii::$app->request->isPost ? $_GET["page"] = "" : null;
    }
    /*
     * 获取get 、 post 数据
     * @params $param
     * @isget default true 以get获取数据为主 false 已post获取数据为主
     */
    public function getRequestParam($param, $isget = true){
        if($isget === true){
            return Yii::$app->request->get($param) ? Yii::$app->request->get($param) : Yii::$app->request->post($param);
        }else{
            return Yii::$app->request->post($param) ? Yii::$app->request->post($param) : Yii::$app->request->get($param);
        }
        
    }

}
