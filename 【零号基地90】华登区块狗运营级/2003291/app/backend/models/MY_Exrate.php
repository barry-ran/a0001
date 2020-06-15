<?php

namespace backend\models;

/**
 * @author  shuang
 * @date    2016-12-8 15:39:01
 * @version V1.0
 * @desc    
 */
use common\models\Exrate;
use yii\behaviors\TimestampBehavior;
use Yii;
use common\components\MTools;

class MY_Exrate extends Exrate {
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
        $query = MY_Exrate::find()->orderBy("created_at desc");
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
        $model = $id ? MY_Exrate::findOne($id) : new MY_Exrate();
        try {
            $model->load(Yii::$app->request->post());
            $model->load(Yii::$app->request->post());
            $filename = Yii::$app->imgload->UploadPhoto($model, 'icon');
            if ($filename !== false) {
                $model->icon = $filename;
            }
            return MTools::saveModel($model);
        } catch (Exception $e) {
            throw $e;
        }
    }

}
