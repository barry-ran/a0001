<?php

namespace frontend\models;

/**
 * @author  shuang
 * @date    2016-12-15 21:18:26
 * @version V1.0
 * @desc    
 */
use common\models\Exrate;
use Yii;

class WB_Exrate extends Exrate {
    /*
     * 配置列表查询数据
     * return object
     */

    public static function getList() {
        $query = WB_Exrate::find()->orderBy("created_at desc");
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["total" => $totalCount, "data" => $res];
    }

}
