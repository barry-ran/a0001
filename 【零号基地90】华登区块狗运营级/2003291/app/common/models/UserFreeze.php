<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_user_freeze".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $username
 * @property integer $level_id
 * @property string $amount
 * @property string $profit
 * @property integer $days
 * @property integer $expire
 * @property integer $created_at
 */
class UserFreeze extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_user_freeze';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid'], 'required'],
            [['userid', 'level_id', 'days', 'expire', 'created_at'], 'integer'],
            [['amount', 'profit'], 'number'],
            [['username'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '自增ID',
            'userid' => '用户ID',
            'username' => '用户账号',
            'level_id' => '挖矿等级',
            'amount' => '挖矿数量',
            'profit' => '累计收益',
            'days' => '连续领取天数',
            'expire' => '是否到期',
            'created_at' => '创建时间',
        ];
    }
    
    public static function getMyCareOrder($userid,$page) {
        $query = UserFreeze::find()->where("userid = :userid and expire = 0",[":userid"=>$userid ])->orderBy("created_at desc");
        $pagesize = 10;
        $offset = ($page - 1)*$pagesize;
        $limit = Yii::$app->request->get("limit", $pagesize);
        $res = $query->offset($offset)->limit($limit)->asArray()->all();

        // 获取当前时间
        $time = time();
        $temp = [];
        for($i = 0;$i < count($res);$i++){
            $temp[$i]['id'] = $res[$i]["id"];
            $temp[$i]['profit'] = $res[$i]["profit"];
            $temp[$i]['amount'] = $res[$i]["amount"];
            $temp[$i]['time'] = ($res[$i]["created_at"] + 15 * 86400) - $time;
            if($time - $res[$i]['created_at'] >= 86400){
                $temp[$i]['satisfy'] = 1;
            }else{
                $temp[$i]['satisfy'] = 0;
            }
        }

        return $temp;
    }

    // 插入一条新数据
    public static function createRecord($userid,$username,$level_id,$amount){
        $model = new UserFreeze();
        $model->userid = $userid;
        $model->username = $username;
        $model->level_id = $level_id;
        $model->amount = $amount;
        $model->created_at = time();
        return $model->save();
    }

    // 查询数据
    public static function getList() {
        $query = UserFreeze::find();
        $status = Yii::$app->request->get("status");
        $search = Yii::$app->request->get("search");

        if ($status) {
            if($status == 1){
                $query->andFilterWhere(["=", "expire", 1]);
            }else{
                $query->andFilterWhere(["=", "expire", 0]);
            }
        }
        if ($search) {
            $query->andFilterWhere(["=","userid",$search]);
            $query->orFilterWhere(["like","username",$search]);
        }

        $query->orderBy("created_at desc");
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["total" => $totalCount, "data" => $res];
    }
}
