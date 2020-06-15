<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\models;

use common\models\Flink;
use yii\behaviors\TimestampBehavior;
use Yii;
use common\components\MTools;
use backend\models\MY_Dictionary;

class MY_Flink extends Flink {
    /*
     * 设置表操作行为动作
     * return array
     */

    public function behaviors() {
        return[
            [
                'class' => TimestampBehavior::className()
            ]
        ];
    }
    public function rules() {
        return array_merge(parent::rules(),[
            ['url', 'url', 'defaultScheme' => 'http'],
            ['typeid', 'compare', 'compareValue' => 0, 'operator' => '>','message'=>"是比选项"]
        ]);
    }

    /*
     * 配置列表查询数据
     * return object
     */

    public static function getList() {
        $query = MY_Flink::find()->with(["catType"])->orderBy("created_at desc");
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["total" => $totalCount, "data" => $res];
    }

    /*
     * 关联字典表   应用类型
     */

    public function getCatType() {

        return $this->hasOne(MY_Dictionary::className(), ['id' => 'typeid']);
    }

    /*
     * 插入、更新数据
     * @params $data array
     * @params $id int 主键
     * return boolean 
     */

    public static function createData($id = null) {
        $model = $id ? MY_Flink::findOne($id) : new MY_Flink();
        try {
            $model->load(Yii::$app->request->post());
            $filename = Yii::$app->imgload->UploadPhoto($model, 'logo');
            if ($filename !== false) {
                $model->logo = $filename;
            }
           return MTools::saveModel($model);
        } catch (Exception $e) {
            throw $e;
        }
    }

}
