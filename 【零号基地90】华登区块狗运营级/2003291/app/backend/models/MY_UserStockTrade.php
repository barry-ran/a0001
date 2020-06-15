<?php

namespace backend\models;

/**
 * @author  shuang
 * @date    2016-12-15 13:35:54
 * @version V1.0
 * @desc    
 */
use common\models\UserStockTrade;
use Yii;
use yii\behaviors\TimestampBehavior;
use common\components\MTools;

class MY_UserStockTrade extends UserStockTrade {
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
        $time = time() - 3600*24*15;
        $query = MY_UserStockTrade::find()->where("created_at >".$time);
        $status = Yii::$app->request->get("status");
        $type = Yii::$app->request->get("type");
        $search = Yii::$app->request->get("search");
//        var_dump($status);
//        var_dump($type);exit;
        if($type){
            $query->andFilterWhere(['=', 'type', $type]);
        }
//        if($status>0){
//            $query->andFilterWhere(['=', 'status', $status]);
//        }
//        if(Yii::$app->request->isGet){
//            $query->andFilterWhere(['=', 'type', $type]);
//            $query->andFilterWhere(['=', 'status', $status]);
//        }
        if($status){
            $query->andFilterWhere(['=', 'status', $status]);
        }
        if($search){
            $query->andFilterWhere(["like","username",$search]); 
        }
        $sort = Yii::$app->request->get("sort");
        $order = Yii::$app->request->get("order");
        $query->orderBy($sort . " " . $order);
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["total" => $totalCount, "data" => $res];
    }
    
        public static function getList2() {
        $query = MY_UserStockTrade::find()->where('status = 1');
        $search = Yii::$app->request->get("search");
        $begin_at = Yii::$app->request->get("begin_at");
        $end_at = Yii::$app->request->get("end_at");
        if ($search) {
            $query->andFilterWhere(['like', 'username', $search]);
        }
        if ($begin_at) {
            $query->andFilterWhere([">=", "traded_at", strtotime($begin_at)]);
        }
        if ($end_at) {
            $query->andFilterWhere(["<=", "traded_at", strtotime($end_at)]);
        }
        $sort = Yii::$app->request->get("sort");
        $order = Yii::$app->request->get("order");
        $query->orderBy($sort . " " . $order);
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["total" => $totalCount, "data" => $res];
    }
    
    
    public static function getList3() {
        $query = MY_UserStockTrade::find();
        if(true){
            $query->andFilterWhere([">=", "created_at", time()-2592000]);
        }
        $sort = Yii::$app->request->get("sort");
        $order = Yii::$app->request->get("order");
        $query->orderBy($sort . " " . $order);
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["total" => $totalCount, "data" => $res];
    }
}
