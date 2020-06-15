<?php

/*
 * @Filename     : ViewAction
 * @Author       : shuang
 * @Email        : shuangbrother@126.com
 * @create_at    : 2014-7-17 16:37:15
 * @Description  : 
 */

namespace common\actions;

use common\actions\MCAction;
use Yii;

class ViewAction extends MCAction {

    public $renderData = array();  //渲染视图数据设置

    public function run() {
        $params = array();
        if ($this->renderData) {
            foreach ($this->renderData as $field => $value) {
                $params[$field] = $value;
            }
        }
        return $this->controller->render($this->renderTo, array_merge($params, $this->setRenderParams()));
    }

}
