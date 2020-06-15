<?php

namespace backend\models;

/**
 * @author  shuang
 * @date    2016-12-9 20:39:08
 * @version V1.0
 * @desc    
 */
use common\models\Area;
use yii\behaviors\TimestampBehavior;
use common\components\MTools;
use Yii;

class MY_Area extends Area {
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

    public static function getList() {
        $query = MY_Area::find()->orderBy("created_at desc");
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["total" => $totalCount, "data" => $res];
    }

    /*
     * 插入、更新数据
     * @params $data array
     * @params $id int 主键
     * return boolean 
     */

    public static function createData($id = null) {
        $model = $id ? MY_Area::findOne($id) : new MY_Area();
        try {
            $model->load(Yii::$app->request->post());
            return MTools::saveModel($model);
        } catch (Exception $e) {
            throw $e;
        }
    }

}
