<?php

namespace common\widgets;

use yii\helpers\Html;
use yii\widgets\InputWidget;

class FileInput extends InputWidget {
    
    public $options = [
       "multiple"=>true,
    ];
    public $browseClass = "btn btn-warning";
    public $labelclass;
    public $contentClass = 'col-sm-6';
    public $name;

    public function init() {
        $this->mergeOption();
        echo '<div class = "form-group">';
        echo Html::activeLabel($this->model, $this->attribute,["class"=>"control-label ".$this->labelclass]);
        echo Html::activeInput('file', $this->model, $this->attribute, $this->options);
        echo '</div>';
    }

    public function run() {
        $view = $this->getView();
        FileInputAsset::register($view);
        $value = Html::getAttributeValue($this->model, $this->attribute);
        if ($value) {
            echo '<div class = "form-group">';
            echo Html::activeLabel($this->model, $this->attribute,["class"=>"control-label ".$this->labelclass,"label"=>""]);
            echo '<div class="'.$this->contentClass.'">';
            echo Html::tag('img', '', ['src' => "".$value, 'class' => 'img-thumbnail']);
            echo '</div></div>';
        }
        $id = Html::getInputId($this->model, $this->attribute);
        $view->registerJs('$("#'.$id.'").fileinput({"showUpload":false,"allowedFileExtensions":["jpg", "png","gif"],"browseClass":"'.$this->browseClass.'","contentClass":"'.$this->contentClass.'"});');
        echo Html::hiddenInput(Html::getInputName($this->model, $this->attribute), $value);
    }
    private function mergeOption(){
        return $this->options = array_merge($this->options,["name"=>$this->name]);
    }

}
