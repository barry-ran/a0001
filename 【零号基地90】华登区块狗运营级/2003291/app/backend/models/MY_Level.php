<?php

namespace backend\models;

/**
 * @author  shuang
 * @date    2016-11-13 17:43:57
 * @version V1.0
 * @desc    
 */
use common\models\Level;
use yii\behaviors\TimestampBehavior;
use Yii;
use common\components\MTools;

class MY_Level extends Level {
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
        
        $query = MY_Level::find();

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
        $model = $id ? MY_Level::findOne($id) : new MY_Level();
        try {
            $model->load(Yii::$app->request->post());
            $model->profit = $model->profit / 100;
            $model->increase = $model->increase / 100;
            \common\models\Actionlog::setLog('修改id为：'.$model->id.'的挖矿级别配置');
            return MTools::saveModel($model);
        } catch (Exception $e) {
            throw $e;
        }
    }


}
