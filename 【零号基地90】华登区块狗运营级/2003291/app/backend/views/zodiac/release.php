<?php

/**
 * @author shuang
 * @date 2016-12-14 19:45:37
 */
use yii\helpers\Url;
use common\widgets\MYActiveForm;
use common\components\MTools;
use common\models\Zodiac;
use common\models\ZodiacGrade;

$zodiac = Zodiac::find()->select('id,name')->asArray()->all();
//$zodiac_grade = common\models\ZodiacGrade::findOne($zodiac->zodiac_grade_id);
echo $this->render("/layouts/prompt", array("labels" => $labels));
$buttons = [['class'=>'btn btn-primary','title'=> '确定发行']];
/* --表单域-start- */
MYActiveForm::begin([
    "action" => Url::toRoute($action),
    "model" => $model,
    "buttons" =>$buttons,
    "fields" => [
        "zodiac_id" => [
            "type" => "select",
            "dropdata" => MTools::getDropDownListData($zodiac),
        ],
        "num" => [
            "type" => "text",
            "options" => [
                "value" => ''
            ],
            'hints' => '必须是大于零的整数',
        ],
        "hcg" => [
            "type" => "text",
            "options" => [
                "value" => ''
            ],
            'hints' => '必须在所选宠物的价格区间内，价格区间可在宠物列表中查看',
        ],
        "belong" => [
            "type" => "text",
            "options" => [
                "value" => ''
            ],
            'hints' => '请填写用户ID，可以在会员列表里查看',
        ],
    ]
]);
MYActiveForm::end();
/* --表单域-end- */