<?php

namespace common\widgets;

/**
 * @author  shuang
 * @date    2016-8-2 11:54:23
 * @version V1.0
 * @desc    
 */
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

class Ueditor extends InputWidget {

    public $attributes;
    public $labelClass = "control-label col-sm-2";
    public $contentClass = "col-sm-7";

    public function init() {
        parent::init();
    }

    public function run() {
        $view = $this->getView();
        $this->attributes['id'] = $this->options['id'];
        echo '<div class = "form-group">';
        echo Html::activeLabel($this->model, $this->attribute, ["class" => "control-label " .$this->labelClass]);
        echo '<div class="' . $this->contentClass . '">';
        if ($this->hasModel()) {
            $input = Html::activeTextarea($this->model, $this->attribute, $this->attributes);
        } else {
            $input = Html::textarea($this->name, '', $this->attributes);
        }
        echo $input;
        echo '</div></div>';
        UeditorAsset::register($view); //将Ueditor用到的脚本资源输出到视图
        $js = 'var ue = UE.getEditor("' . $this->options['id'] . '",' . $this->getOptions() . ');'; //Ueditor初始化脚本
        $view->registerJs($js); //将Ueditor初始化脚本也响应到视图中
    }

    public function getOptions() {
        unset($this->options['id']); //Ueditor识别不了id属性,故而删之
        return Json::encode($this->options);
    }

}
