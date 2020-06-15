<?php

namespace common\widgets;

/**
 * @author  shuang
 * @date    2016-7-29 18:53:04
 * @version V1.0
 * @desc    
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

class MYSearchForm extends ActiveForm {

    public $model;  //表单数据模型
    public $fields; //创建表单字段
    public $layout = 'horizontal';  //表单默认模板
    public $special = [
        "label" => "control-label pull-left",
        "wrapper" => "col-sm-8"
    ];
    public $buttons = [
        [
            "class" => "btn btn-primary",
            "title" => "查 询",
            "submit" => true
        ],
//        [
//            "class" => "btn btn-primary",
//            "title" => "重 置",
//            "submit" => false
//        ]
    ]; //表单按钮配置
    public $fieldConfig = [
        'horizontalCssClasses' => [
            'label' => 'col-sm-4',
            'offset' => 'col-sm-offset-4',
            'wrapper' => 'col-sm-8',
            'error' => '',
            'hint' => '',
        ],
        'inline' => true
    ];
    public $options = ['class' => 'form-search-section'];

    public function init() {
        parent::init();
    }

    public function run() {
        if ($this->fields) {
            foreach ($this->fields as $field => $item) {
                $this->setField($field, $item);
            }
        }
        echo $this->setBtns();
        echo '<div class="clearfix"></div>';
        parent::run();
    }

    /*
     * 配置表单字段
     * @params $field
     * @params $item
     */

    protected function setField($field, $item) {
        switch ($item["type"]) {
            case "text":
                $this->setText($field, isset($item["options"]) ? $item["options"] : []);
                break;
            case "select":
                echo DropDown::widget([
                    'model' => $this->model,
                    'attribute' => $field,
                    "dropdata" => $item["dropdata"],
                    "selected" => isset($item["options"]["selected"]) ? $item["options"]["selected"] : $this->model->$field,
                    'width' => isset($item["options"]["width"]) ? $item["options"]["width"] : null,
                    'options' => [
                        'class' => isset($item["options"]["class"]) ? $item["options"]["class"] : "drop-input " . " " . $this->fieldConfig["horizontalCssClasses"]["wrapper"],
                        'menuClass' => isset($item["options"]["menuClass"]) ? $item["options"]["menuClass"] : "drop-menu-list ",
                        "labelClass" => "control-label " . $this->fieldConfig["horizontalCssClasses"]["label"]
                    ],
                    "callback" => isset($item["callback"]) ? $item["callback"] : null
                ]);
                break;
            case "date":
                $view = $this->getView();
                $id = Html::getInputId($this->model, $field);
                if (isset($item["options"])) {
                    echo $this->field($this->model, $field)->input("text", $item["options"]);
                } else {
                    echo $this->field($this->model, $field);
                }
                $view->registerCssFile("js/plugins/datepicker/css/datetimepicker.css", ["depends" => "backend\assets\AppAsset"]);
                $view->registerJsFile("js/plugins/datepicker/datetimepicker.js", ["depends" => "backend\assets\AppAsset"]);
                $view->registerJs('$("#' . $id . '").datetimepicker({lang: "ch",timepicker: false,format: "Y-m-d",formatDate: "Y-m-d"});');
                break;
        }
    }

    /*
     * 表单按钮配置
     */

    protected function setBtns() {
        $string = null;
        $string .= '<div class="form-btns">';
        foreach ($this->buttons as $button) {
            if ($button["submit"] === true) {
                $string .= Html::submitButton($button["title"], ["class" => $button["class"]]);
            } else {
                $string .= Html::resetButton($button["title"], ["class" => $button["class"]]);
            }
        }
        $string .= '</div>';
        return $string;
    }

    /*
     * 设置输入框
     * @params $field
     * @params $options
     */

    protected function setText($field, $options = []) {
        echo '<div class="form-group">';
        echo Html::activeLabel($this->model, $field, ["class" => $this->special["label"]]);
        echo '<div class="' . $this->special["wrapper"] . '">';
        echo Html::activeInput("text", $this->model, $field, array_merge($options, ["class" => "form-control","autocomplete"=>"off"]));
        echo "</div></div>";
    }

}
