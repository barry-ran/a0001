<?php

namespace common\widgets;

/**
 * @author  shuang
 * @date    2016-7-8 10:33:30
 * @version V1.0
 * @desc    
 */
use yii\helpers\Html;
use yii\widgets\InputWidget;
use yii\helpers\Json;

class DropDown extends InputWidget {

    public $dropdata;
    public $callback;
    public $selected;
    public $width;
    public $disabled = true;
    public $options;
    protected $_class = "drop-input ";
    protected $_id;
    protected $_menuClass = "drop-menu-list " ;
    protected $_label;
    protected $_labelClass = "control-label col-sm-1";

    protected function getOptions() {
        $this->_class = isset($this->options["class"]) ? $this->_class . $this->options["class"] : null;
        $this->_menuClass = isset($this->options["menuClass"]) ? $this->_menuClass . $this->options["menuClass"] : null;
        $this->_id = isset($this->options["id"]) ? $this->options["id"] : null;
        $this->_label = isset($this->options["label"]) ? $this->options["label"] : $this->model->getAttributeLabel($this->attribute);
        $this->_labelClass = isset($this->options["labelClass"]) ? $this->options["labelClass"] : $this->_labelClass;
    }

    public function run() {
        $view = $this->getView();
        DropDownAsset::register($view);
        $this->getOptions();
        echo '<div class = "form-group">';
        echo Html::activeLabel($this->model, $this->attribute, ["class" => "$this->_labelClass", "label" => $this->_label]);
        echo '<div class="dropdown ' . $this->_class . '" id="' . $this->_id . '">';
        echo '<input class="text form-control" value="" type="text" >';
        echo '<span class="aca">▼</span>';
        echo '<span class="arrow"></span>';
        echo Html::hiddenInput(Html::getInputName($this->model, $this->attribute));
        echo '<div class="dropdown-menu ' . $this->_menuClass . '"><ul></ul></div>';
        echo '</div></div>';
        $view->registerJs('$("#' . $this->_id . '").dropdown({data:' . Json::encode($this->dropdata) . ',width:"' . ($this->width ? $this->width : "''") . '",def_value:"' . ($this->selected ? $this->selected : "''") . '",callback:' . ($this->callback ? $this->callback : "function(v){}") . ',disabled:' . ($this->disabled ? $this->disabled : "false") . '});');
    }

}
