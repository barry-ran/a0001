<?php

/*
 * file : FormWidgets
 * author: shuang
 * email : shuangbrother@126.com
 * created_at : 2015-12-9 -- 11:43:10
 */

namespace common\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class DatalistWidgets extends Widget {

    public $data_url; //数据URL
    public $columns = []; //显示字段
    public $labels; //字段名称
    public $toolbar = null; //操作按钮ID
    public $page_size = 10; //数据显示默认行数
    public $pagination = true; //是否使用分页
    public $tableOtherAttributes = []; //表格其他属性
    public $fieldAttributes = []; //字段属性
    public $tableClass = "imgtable"; //表格Class
    protected $actionClass = "table-action-class"; //管理操作样式Class
    protected $_options = []; //表格属性

    /*
     * 设置表格属性
     */

    private function tableAttribute() {
        $this->_options = [
            "id" => "table",
            "class" => $this->tableClass,
            "data-toggle" => "table",
            "data-url" => $this->data_url,
            "data-side-pagination" => "server",
            "data-search-align" => "left",
            "data-buttons-align" => "left",
            "data-toolbar-align" => "right"
        ];
        if ($this->pagination) {  //判断是否启用分页功能
            $this->_options = ArrayHelper::merge($this->_options, [
                        "data-page-size" => $this->page_size,
                        "data-pagination" => "true",
            ]);
        }
        //判断是否启用toolbar
        if ($this->toolbar) {
            $this->_options = ArrayHelper::merge($this->_options, [
                        "data-toolbar" => $this->toolbar
            ]);
        }
        if (!empty($this->tableOtherAttributes)) {
            foreach ($this->tableOtherAttributes as $attribute => $value) {
                $this->_options[$attribute] = $value;
            }
        }
    }

    /*
     * 获取表格列字符串
     */

    protected function getColumnString() {
        $string = '';
        foreach ($this->columns as $field) {
            $string .= Html::tag("th", ArrayHelper::getValue($this->labels, $field), $this->columnAttribute($field));
        }
        return $string;
    }

    /*
     * 配置表格列属性（字段属性）
     * @params $field
     * return array
     */

    protected function columnAttribute($field) {
        $options = ["data-field" => $field];
        if (ArrayHelper::keyExists($field, $this->fieldAttributes, false)) {
            foreach ($this->fieldAttributes[$field] as $attribute => $value) {
                $options[$attribute] = $value;
            }
        }
        return $options;
    }

    /*
     * 配置管理操作属性
     */

    protected function actionConfig() {
        $this->labels = ArrayHelper::merge($this->labels, ["action" => ArrayHelper::getValue($this->labels, "action", "管理操作")]);
        $this->fieldAttributes = ArrayHelper::merge($this->fieldAttributes, [
                    "action" => [
                        "data-class" => $this->actionClass
                    ]
        ]);
    }

    public function init() {
        $this->tableAttribute();
        $this->actionConfig();
        echo Html::beginTag("table", $this->_options);
        echo '<thead><tr>';
        echo $this->getColumnString();
        echo '</tr></thead>';
        echo Html::endTag("table");
    }

    public function run() {
        $view = $this->getView();
        DatalistWidgetsAsset::register($view);
    }

}
