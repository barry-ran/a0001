<?php

namespace common\widgets;

/**
 * @author  shuang
 * @date    2016-7-29 18:53:04
 * @version V1.0
 * @desc    
 */
use yii\bootstrap\ActiveForm;
use common\widgets\FileInput;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class MYActiveForm extends ActiveForm {

    public $enctype = true;  //是否有上传图片字段
    public $model;  //表单数据模型
    public $fields; //创建表单字段
    public $buttons = [
        [
            "class" => "btn btn-primary",
            "title" => "确定保存"
        ]
    ]; //表单按钮配置
    public $buttonClass = [
        'offset' => 'col-sm-2',
        'wrapper' => 'col-sm-4',
    ]; //表单按钮样式
    public $layout = 'horizontal';  //表单默认模板
    public $fieldConfig = [
        'horizontalCssClasses' => [
            'label' => 'col-sm-2',
            'offset' => 'col-sm-offset-2',
            'wrapper' => 'col-sm-4',
            'error' => '',
            'hint' => '',
        ],
        'inline' => true
    ];
    public $options = ['class' => 'form-section', "id" => ""];

    public function init() {
        $this->setEnctype();
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
     * 是否存在上传图片属性
     */

    protected function setEnctype() {
        if ($this->enctype) {
            $this->options = array_merge($this->options, ["enctype" => "multipart/form-data"]);
        }
    }

    /*
     * 配置表单字段
     * @params $field
     * @params $item
     */

    protected function setField($field, $item) {
        switch ($item["type"]) {
            case "file":
                echo FileInput::widget(['model' => $this->model, 'name' => ArrayHelper::getValue($item, "name"), 'attribute' => $field, 'browseClass' => $this->buttons[0]["class"], "contentClass" => $this->fieldConfig["horizontalCssClasses"]["wrapper"], "labelclass" => $this->fieldConfig["horizontalCssClasses"]["label"]]);
                break;
            case "text":
                echo $this->field($this->model, $field, ArrayHelper::getValue($item, "fieldOptions",[]))->input("text", ArrayHelper::getValue($item, "options",[]))->hint(ArrayHelper::getValue($item, "hints"));
                break;
            case "pass":
                echo $this->field($this->model, $field, ArrayHelper::getValue($item, "fieldOptions",[]))->input("password", ArrayHelper::getValue($item, "options",[]))->hint(ArrayHelper::getValue($item, "hints"));
                break;
            case "textarea":
                echo $this->field($this->model, $field, ArrayHelper::getValue($item, "fieldOptions",[]))->textarea(ArrayHelper::getValue($item, "options",[]))->hint(ArrayHelper::getValue($item, "hints"));
                break;
            case "hidden":
                echo Html::hiddenInput(ArrayHelper::getValue($item, "name", $field), ArrayHelper::getValue($item, "value", $this->model->$field));
                break;
            case "select":
                echo DropDown::widget([
                    'model' => $this->model,
                    'attribute' => $field,
                    "dropdata" => $item["dropdata"],
                    "selected" => ArrayHelper::getValue($item, "options.selected", $this->model->$field),
                    'width' => ArrayHelper::getValue($item, "options.width"),
                    'options' => [
                        'class' => ArrayHelper::getValue($item, "options.class", "drop-input " . " " . $this->fieldConfig["horizontalCssClasses"]["wrapper"]),
                        'menuClass' => ArrayHelper::getValue($item, "options.menuClass", "drop-menu-list "),
                        "labelClass" => "control-label " . $this->fieldConfig["horizontalCssClasses"]["label"]
                    ],
                    "callback" => ArrayHelper::getValue($item, "callback")
                ]);
                break;
            case "radiolist":
                $object = $this->field($this->model, $field);
                $object->inline(ArrayHelper::getValue($item, "options.inline", false));
                $object->radioList(ArrayHelper::getValue($item, "options.data",[]), ArrayHelper::getValue($item, "options.otheroption",[]));
                echo $object;
                break;
            case "date":
                $view = $this->getView();
                $id = Html::getInputId($this->model, $field,ArrayHelper::getValue($item, "fieldOptions",[]));
                echo $this->field($this->model, $field)->input("text", ArrayHelper::getValue($item, "options",[]));
                $view->registerCssFile("js/plugins/datepicker/css/datetimepicker.css", ["depends" => "backend\assets\AppAsset"]);
                $view->registerJsFile("js/plugins/datepicker/datetimepicker.js", ["depends" => "backend\assets\AppAsset"]);
                $view->registerJs('$("#' . $id . '").datetimepicker({lang: "ch",timepicker: false,format: "Y-m-d",formatDate: "Y-m-d"});');
                break;
            case "checklist":
                $object = $this->field($this->model, $field);
                $object->inline(ArrayHelper::getValue($item, "options.inline", false));
                $object->checkboxList(ArrayHelper::getValue($item, "options.data",[]));
                echo $object;
                break;
            case "ueditor":
                echo Ueditor::widget([
                    'name' => ArrayHelper::getValue($item, "name"),
                    //'name' => 'content',
                    'model' => $this->model,
                    'attribute' => $field,
                    //'attribute' => "content",
                    "contentClass" => $this->fieldConfig["horizontalCssClasses"]["wrapper"],
                    "labelClass" => $this->fieldConfig["horizontalCssClasses"]["label"],
                    'options' => [
                        'id' => 'txtContent'
                    ],
                    'attributes' => [
                        'style' => 'height:200px'
                    ]
                ]);
                break;
            case "ueditor_en":
                echo Ueditor::widget([
                    'name' => ArrayHelper::getValue($item, "name"),
                    //'name' => 'content',
                    'model' => $this->model,
                    'attribute' => $field,
                    //'attribute' => "content",
                    "contentClass" => $this->fieldConfig["horizontalCssClasses"]["wrapper"],
                    "labelClass" => $this->fieldConfig["horizontalCssClasses"]["label"],
                    'options' => [
                        'id' => 'txtContent_en'
                    ],
                    'attributes' => [
                        'style' => 'height:200px'
                    ]
                ]);
                break;
        }
    }

    /*
     * 表单按钮配置
     */

    protected function setBtns() {
        $string = null;
        if ($this->buttons) {
            $string .= '<div class="form-group">';
            foreach ($this->buttons as $button) {
                $string .= '<label  class="control-label ' . $this->buttonClass["offset"] . '"></label>';
                $string .= '<div class="' . $this->buttonClass["wrapper"] . '">';
                $string .= Html::submitButton($button["title"], ['class' => $button["class"]]);
                $string .= '</div>';
            }
            $string .= '</div>';
        }
        return $string;
    }

}
