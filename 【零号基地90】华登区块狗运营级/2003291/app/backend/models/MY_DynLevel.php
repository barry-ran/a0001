<?php

namespace backend\models;

/**
 * @author  shuang
 * @date    2016-12-1 20:36:05
 * @version V1.0
 * @desc    
 */
use common\models\DynLevel;
use yii\behaviors\TimestampBehavior;
use Yii;
use common\components\MTools;

class MY_DynLevel extends DynLevel {
   /*
     * 设置表操作行为动作
     */

    public function behaviors() {
        return[
            [
                'class' => TimestampBehavior::className()
            ]
        ];
    }

    /*
     * 配置列表查询数据
     * return object
     */

    public static function getList() {
        $query = MY_DynLevel::find()->orderBy("created_at desc");
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
        $model = $id ? MY_DynLevel::findOne($id) : new MY_DynLevel();
        try {
            $model->load(Yii::$app->request->post());
            $model->era1_per = $model->era1_per / 100;
            $model->era2_per = $model->era2_per / 100;
            $model->era3_per = $model->era3_per / 100;
            return MTools::saveModel($model);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
