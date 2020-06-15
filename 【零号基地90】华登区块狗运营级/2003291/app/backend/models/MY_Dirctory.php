<?php

namespace backend\models;

use common\models\Dirctory;
use Yii;
use common\components\MTools;

class MY_Dirctory extends Dirctory {

    public function rules() {
        return array_merge(parent::rules(), [
            ['name', 'match', 'pattern' => '/^[a-z]\w*$/i']
        ]);
    }

    /*
     * 配置列表查询数据
     * return object
     */

    public static function getList() {
        $query = MY_Dirctory::find()->orderBy("id desc");
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
        $model = $id ? MY_Dirctory::findOne($id) : new MY_Dirctory();
        try {
            $model->load(Yii::$app->request->post());
            $dir = MTools::setfilepath() . '/' . $model->name;
            if (MTools::createDir($dir)) {
               return MTools::saveModel($model);
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

}
