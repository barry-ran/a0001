<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_care_order".
 *
 * @property integer $id
 * @property integer $sell_id
 * @property integer $userid
 * @property string $useername
 * @property string $num
 * @property string $price
 * @property string $my_num
 * @property string $remain_num
 * @property string $ip
 * @property string $note
 * @property integer $status
 * @property integer $type
 * @property integer $is_gold
 * @property integer $created_at
 * @property integer $buy_time
 * @property integer $updated_at
 * @property integer $branch_id
 */
class CareOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_care_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sell_id', 'userid'], 'required'],
            [['sell_id', 'userid', 'status', 'type', 'is_gold', 'created_at', 'buy_time', 'updated_at', 'branch_id'], 'integer'],
            [['num', 'price', 'my_num', 'remain_num'], 'number'],
            [['note'], 'string'],
            [['username'], 'string', 'max' => 50],
            [['ip'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sell_id' => '出售ID',
            'userid' => '会员ID',
            'username' => '会员账号',
            'num' => '购买数量',
            'price' => '价格',
            'my_num' => '拥有数量',
            'remain_num' => '卖方剩余数量',
            'ip' => 'Ip',
            'note' => '备注',
            'status' => '状态',
            'type' => '类型',
            'is_gold' => '是否金钻会员',
            'created_at' => '创建时间',
            'buy_time' => '交易时间',
            'updated_at' => '更新时间',
            'branch_id' => '分公司ID',
        ];
    }
    
    public static function getList() {
        $query = CareOrder::find();
        $begin_at = Yii::$app->request->get("begin_at");
        $end_at = Yii::$app->request->get("end_at");
        $search = Yii::$app->request->get("search");
        $is_gold = Yii::$app->request->get("is_gold");
        $type = Yii::$app->request->get("type");
        $status = Yii::$app->request->get("status");
        
        if ($is_gold != "") {
            $query->andFilterWhere(["=", "is_gold", $is_gold]);
        }
        if ($type != "") {
            $query->andFilterWhere(["=", "type", $type]);
        }
        if ($status != "") {
            $query->andFilterWhere(["=", "status", $status]);
        }
        if ($begin_at) {
            $query->andFilterWhere([">=", "created_at", strtotime($begin_at)]);
        }
        if ($end_at) {
            $query->andFilterWhere(["<=", "created_at", strtotime($end_at)]);
        }
        if ($search) {
                $query->andFilterWhere(["like","userid",$search]);
                $query->orFilterWhere(["like","username",$search]); 
        }
        if(Yii::$app->user->identity->branch_id != 0){
            if(Yii::$app->user->identity->branch_id == '1863'){
                $query->andFilterWhere(["in", "branch_id", ['1863', '1872', '1875', '1889']]);
            }else{
                $query->andFilterWhere(["=","branch_id",Yii::$app->user->identity->branch_id]);
            }
        }
       
        $query->orderBy('created_at desc');
//        $sort = Yii::$app->request->get("sort");
//        $order = Yii::$app->request->get("order");
//        $query->orderBy($sort . " " . $order);
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        
        return ["total" => $totalCount, "data" => $res];
    }
    
    public static function getMyCareOrder($userid) {
        $query = CareOrder::find()->where("userid = :userid",[":userid"=>$userid ])->orderBy("created_at desc");
        
        $countQuery = clone $query;
        $pagesize = 10;
        $pager = new \yii\data\Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => $pagesize]);
        $offset = (Yii::$app->request->get("page")-1)*$pagesize;
        $limit = Yii::$app->request->get("limit")?Yii::$app->request->get("limit"):$pagesize;
        $res = $query->offset($offset)->limit($limit)->asArray()->all();

        foreach($res as $key=>$val){
           $res[$key]['status'] = self::$status[$val['status']];
        }
        
        return ["pager" => $pager, "data" => $res];
    }
    
    public static function getMyCareOrderLoad($userid,$page){
        $query = CareOrder::find()->where("userid = :userid",[":userid"=>$userid ])->orderBy("created_at desc");

        $pagesize = 10;
        $offset = ($page - 1)*$pagesize;
        $limit = Yii::$app->request->get("limit", $pagesize);
        $res = $query->offset($offset)->limit($limit)->asArray()->all();

        for($i = 0;$i < count($res);$i++){
            $res[$i]['created_at'] = Yii::$app->formatter->asDatetime($res[$i]["created_at"]);
            $res[$i]['buy_time'] = Yii::$app->formatter->asDatetime($res[$i]["buy_time"]);
            $res[$i]['status'] = self::$status[$res[$i]['status']];
        }
        return $res;
    }
    
    public static $status = [1 => '成功', 2 => '待处理', 3 => '失败'];
    
    public static $type = [1 => '普通订单', 2 => '预约订单'];
}
