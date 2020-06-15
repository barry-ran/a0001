<?php

namespace backend\models;

/**
 * @author  shuang
 * @date    2016-8-2 10:58:26
 * @version V1.0
 * @desc    
 */
use \common\models\Advertisement;
use yii\behaviors\TimestampBehavior;
use common\components\MTools;
use Yii;

class MY_Advertisement extends Advertisement {
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
        $query = MY_Advertisement::find()->orderBy("created_at desc");
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["total" => $totalCount, "data" => $res];
    }
    
    public static function createData($id = null) {
        $model = $id ? MY_Advertisement::findOne($id) : new MY_Advertisement();
        try {
            $model->load(Yii::$app->request->post());

            if($_FILES['MY_Advertisement']['tmp_name']['img'] != ''){
                $filename = Yii::$app->imgload->UploadPhotoQn($model, 'img');
                if ($filename !== false) {
                    $model->img = $filename;
                }
            }
            $model->content = $model->content;
            $model->created_at = time();
            \common\models\Actionlog::setLog('新增轮播图，描述为：'.$model->content);
            return MTools::saveModel($model);
        } catch (Exception $e) {
            throw $e;
        }
    }
}