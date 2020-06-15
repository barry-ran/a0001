<?php

namespace frontend\models;

/**
 * @author  shuang
 * @date    2016-12-15 20:56:07
 * @version V1.0
 * @desc    
 */
use common\models\UserStockTrade;
use Yii;

class WB_UserStockTrade extends UserStockTrade {
    
    public static $status = [
         0 => "挂单中", 1 => "交易成功", 2 => "交易失败", 
    ];
    public static $type = [
        1 => "VM购买", 2 => "VM出售", 3 => "撮合订单" 
    ];
    
    /* 
     * 查询会员的股票交易
     * @params $userid
     */

    public static function getStockTradeSellRecordForUser($userid) {
        $query = WB_UserStockTrade::find()->where("userid=:userid && type = 2", [":userid" => $userid])->orderBy("created_at desc");
        $countQuery = clone $query;
        $pagesize = 10;
        $pager = new \yii\data\Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => $pagesize]);
        $offset = (Yii::$app->request->get("page")-1)*$pagesize;
        $limit = Yii::$app->request->get("limit",$pagesize);
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["pager" => $pager, "data" => $res];
    }
    /*
     * 查询会员的购买成功记录
     * @params $userid
     */

    public static function getStockTradeBuyRecordForUser($userid) {
        $query = WB_UserStockTrade::find()->where("userid=:userid && type in(1,3)", [":userid" => $userid])->orderBy("created_at desc");
        $countQuery = clone $query;
        $pagesize = 10;
        $pager = new \yii\data\Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => $pagesize]);
        $offset = (Yii::$app->request->get("page")-1)*$pagesize;
        $limit = Yii::$app->request->get("limit",$pagesize);
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["pager" => $pager, "data" => $res];
    }
    /*
     * 查询会员的股票交易
     * @params $userid
     */

    public static function getStockTradeListForUser($userid) {
        $query = WB_UserStockTrade::find()->where("userid=:userid or suserid=:userid", [":userid" => $userid])->orderBy("created_at desc");
        $type = Yii::$app->request->post("type");
        if ($type) {
            $query->andWhere("type=:type", [":type" => Yii::$app->request->post("type")]);
        }
        $countQuery = clone $query;
        $pagesize = 10;
        $pager = new \yii\data\Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => $pagesize]);
        $offset = (Yii::$app->request->get("page")-1)*$pagesize;
        $limit = Yii::$app->request->get("limit",$pagesize);
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["pager" => $pager, "data" => $res];
    }
    
    /*
     * 查询交易大厅
     */
    public static function getStockTradeListSys() {
        $query = WB_UserStockTrade::find();
        $type="6-6";
        $post=Yii::$app->request->post()?Yii::$app->request->post():null;
        if($post){
            $selecttype=$post['type'];
            $status= (int)substr($selecttype,0,1);
            $type= (int)substr($selecttype, -1,1);
            if($status==6){
                //$query->orderBy("created_at desc")->andWhere("created_at <> traded_at");
                $query->orderBy("created_at desc");
            }elseif($status==0 && $type==1){
                  $query->andWhere("type=1")->orderBy("created_at desc");
            }elseif($status==0 && $type==2){
                   $query->andWhere("type=2")->orderBy("created_at desc");
            }
        }else{
            //$query->orderBy("created_at desc")->andWhere("created_at <> traded_at");
           // $query->andWhere("status=1 && created_at <> traded_at && userid>0 && suserid>0")->orderBy("traded_at desc");
            $query->orderBy("created_at desc");
        }
//        $type = Yii::$app->request->post("type")?Yii::$app->request->post("type"):1;
//        if ($type) {
//            $query = WB_UserStockTrade::find()->where("status = 0")->orderBy("created_at desc");
//            $query->andWhere("type=:type", [":type" => Yii::$app->request->post("type")]);  
//        }
        $countQuery = clone $query;
        $pagesize = 30;
        $pager = new \yii\data\Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => $pagesize]);
        $offset = (Yii::$app->request->get("page")-1)*$pagesize;
        $limit = Yii::$app->request->get("limit",$pagesize);
        //$res = $query->offset($offset)->limit($limit)->orderBy("traded_at desc")->asArray()->all();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["pager" => $pager, "data" => $res,"type"=>$type];
    }
    
    /*
     * 查询会员排队购买列表
     * @author huang
     * @params 
     */
    public static function getStockTradeList() {
        $query = WB_UserStockTrade::find()->where("type=1 && status=0")->orderBy("created_at asc");
        //$query = WB_UserStockTrade::find()->where("type=:type and status=:status", [":type" => 1,":status"=>0])->orderBy("created_at asc");
        $countQuery = clone $query;
        $pagesize = 10;
        $pager = new \yii\data\Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => $pagesize]);
        $offset = (Yii::$app->request->get("page")-1)*$pagesize;
        $limit = Yii::$app->request->get("limit",$pagesize);
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["pager" => $pager, "data" => $res];
    }
    
    /*
     * 查询会员排队购买列表
     * @author huang
     * @params 
     */
    public static function getStockTradeSell() {
        $query = WB_UserStockTrade::find()->where("type=2 && status=0")->orderBy("created_at asc");
        //$query = WB_UserStockTrade::find()->where("type=:type and status=:status", [":type" => 1,":status"=>0])->orderBy("created_at asc");
        $countQuery = clone $query;
        $pagesize = 10;
        $pager = new \yii\data\Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => $pagesize]);
        $offset = (Yii::$app->request->get("page")-1)*$pagesize;
        $limit = Yii::$app->request->get("limit",$pagesize);
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["pager" => $pager, "data" => $res];
    }
    
    /*
     * 判断购买队列
     */
    public static function getBuyList($price){
        $res = WB_UserStockTrade::find()->where("price >=:price && type = 1 && status = 0",[":price"=>$price])->orderBy("created_at asc,price desc")->all();
        return $res;
    }
    
    /*
     * 判断出售队列
     */
    public static function getSellList($price){
        $res = WB_UserStockTrade::find()->where("price <=:price && type = 2 && status = 0",[":price"=>$price])->orderBy("created_at asc,price asc")->all();
        return $res;
    }


    /*
     * 查询会员排队购买列表中可购买的股票数量
     * @author huang
     * @params $userid
     * @return number
     */
    public static function getStockTradeListStockCount(){
        $price = \backend\models\MY_StockPriceRecord::searchStockCurrentPrice();
        $results = \frontend\models\WB_UserStockTrade::find()->where("type=1 && status=0")->asArray()->all();
        $stocknumCount = 0;
        foreach ($results as $res){
            $stocknum = intval($res['transprice']/$price);
            $stocknumCount += $stocknum;
        }
        return $stocknumCount;
    }
    
    /*
     * 查询会员排队出售队列是否存在
     * @author huang
     * @params $userid
     */
    public static function getStockTradeSellList(){
        $results = \frontend\models\WB_UserStockTrade::find()->where("type=2 && status=0")->orderBy("created_at asc")->all();
        return $results;
    }
    
    /*
     * 查询排队出售队列第一条记录是否是系统
     * @author huang
     * @params $userid
     */
    public static function getStockTradeSysSell(){
        $results = \frontend\models\WB_UserStockTrade::find()->where("type=:type && status=:status && suserid=:suserid && susername=:susername",[":type"=>2,":status"=>0,":suserid"=>0,":susername"=>"平台"])->one();
        return $results;
    }
    /*
     * 查询排队出售队列是否是系统
     * @author huang
     * @params $userid
     */
    public static function getStockTradeSellIsSys(){
        $results = \frontend\models\WB_UserStockTrade::find()->where("type=:type && status=:status && suserid=:suserid && susername=:susername",[":type"=>2,":status"=>0,":suserid"=>0,":susername"=>"平台"])->all();
        return $results;
    }
}
