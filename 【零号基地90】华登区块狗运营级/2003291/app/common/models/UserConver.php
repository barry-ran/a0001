<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_user_conver".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $username
 * @property string $hcg_amount
 * @property string $cash_amount
 * @property string $care_amount
 * @property integer $created_at
 */
class UserConver extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_user_conver';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid'], 'required'],
            [['userid', 'created_at','branch_id'], 'integer'],
            [['hcg_amount', 'cash_amount'], 'number'],
            [['username'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => '会员ID',
            'username' => '会员账号',
            'hcg_amount' => '卢呗数量',
            'cash_amount' => '卢宝数量',
            'created_at' => '创建时间',
        ];
    }
    
    public static function getMyRecord($userid) {
        $query = UserConver::find()->where("userid = :userid",[":userid"=>$userid ])->orderBy("created_at desc");
        $countQuery = clone $query;
        $pagesize = 10;
        $pager = new \yii\data\Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => $pagesize]);
        $offset = (Yii::$app->request->get("page")-1)*$pagesize;
        $limit = Yii::$app->request->get("limit")?Yii::$app->request->get("limit"):$pagesize;
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["pager" => $pager, "data" => $res];
        
    }
    
    public static function getMyRecordLoad($userid,$page){
        $query = UserConver::find()->where("userid = :userid",[":userid"=>$userid ])->orderBy("created_at desc");

        $pagesize = 10;

        $offset = ($page - 1)*$pagesize;
        $limit = Yii::$app->request->get("limit", $pagesize);
        $res = $query->offset($offset)->limit($limit)->asArray()->all();

        for($i = 0;$i < count($res);$i++){
            $res[$i]['created_at'] = Yii::$app->formatter->asDatetime($res[$i]["created_at"]);
        }

        return $res;
    }
    
    public static function getList() {
        $query = UserConver::find()->with(["user"]);
        $begin_at = Yii::$app->request->get("begin_at");
        $end_at = Yii::$app->request->get("end_at");
        $search = Yii::$app->request->get("search");
        
        if ($begin_at) {
            $query->andFilterWhere([">=", "created_at", strtotime($begin_at)]);
        }
        if ($end_at) {
            $query->andFilterWhere(["<=", "created_at", strtotime($end_at)]);
        }
        if ($search) {
                $query->andFilterWhere(["=","userid",$search]);
                $query->orFilterWhere(["like","username",$search]); 
        }
        if(Yii::$app->user->identity->branch_id > 0){
            if(Yii::$app->user->identity->branch_id == '1863'){
                $query->andFilterWhere(["in", "branch_id", ['1863', '1872', '1875', '1889']]);
            }else {
                $query->andFilterWhere(["=","branch_id",Yii::$app->user->identity->branch_id]);
            }
        }
        
//        $sort = Yii::$app->request->get("sort");
//        $order = Yii::$app->request->get("order");
//        $query->orderBy($sort . " " . $order);
        $query->orderBy("created_at desc");
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        //var_dump($res);die;
        return ["total" => $totalCount, "data" => $res];
    }
    
    /*
     * 关联会员
     */

    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'userid']);
    }
    
}
