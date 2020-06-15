<?php

/*
 * @Filename     : ListAction
 * @Author       : shuang
 * @Email        : shuangbrother@126.com
 * @create_at    : 2014-6-18 11:44:25
 * @Description  : 数据集列表控制器处理
 */

namespace common\actions;

use common\actions\MCAction;
use Yii;

class ListAction extends MCAction {

    public $getListFunc = "getList";    //获取数据集方法  ，该法在处理的数据模型层。
    public $searchParams = array();   //筛选参数设置
    public $iscallback = false;

    public function run() {
        $this->resetGetParams();

        $params = array();
        if ($this->searchParams) {
            foreach ($this->searchParams as $key => $field) {
                if (is_string($key)) {
                    $params[$key] = $field;
                } else {
                    $params[$field] = $this->getRequestParam($field); //isset($_REQUEST[$field]) ? $_REQUEST[$field] : null;
                }
            }
        }
        $funcdata = [];
        if ($this->iscallback) {
            $funcdata = call_user_func([$this->getModel(), $this->getListFunc]);
        }

        return $this->controller->render($this->renderTo, array_merge($params, array("labels" => $this->getModel()->attributeLabels()), $funcdata));
    }

}
