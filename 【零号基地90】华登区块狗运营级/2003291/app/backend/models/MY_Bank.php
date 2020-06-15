<?php

namespace backend\models;

/**
 * @author  shuang
 * @date    2016-12-14 20:43:54
 * @version V1.0
 * @desc    
 */
use common\models\Bank;
use Yii;
use yii\behaviors\TimestampBehavior;
use common\components\MTools;
class MY_Bank extends Bank{
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
     /*
     * 配置列表查询数据
     * return object
     */

    public static function getList() {
        $query = MY_Bank::find()->orderBy("created_at desc");
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
        $model = $id ? MY_Bank::findOne($id) : new MY_Bank();
        try {
            $model->load(Yii::$app->request->post());
           return MTools::saveModel($model);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
