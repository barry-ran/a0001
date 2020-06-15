<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_user_transform".
 *
 * @property integer $id
 * @property integer $in_userid
 * @property string $in_username
 * @property integer $out_userid
 * @property string $out_username
 * @property string $trueamount
 * @property string $amount
 * @property string $transfer_fee
 * @property string $sysprice
 * @property string $samount
 * @property integer $currency_type
 * @property string $currency_rates
 * @property integer $event_type
 * @property integer $created_at
 * @property integer $updated_at
 */
class UserTransform extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_user_transform';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['in_userid', 'out_userid'], 'required'],
            [['in_userid', 'out_userid', 'created_at', 'updated_at'], 'integer'],
            [['amount', 'cash_amount', 'hcg_amount', 'award'], 'number'],
            [['in_username', 'out_username'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'in_userid' => Yii::t('app', '转入会员ID'),
            'in_username' => Yii::t('app', '转入会员账号'),
            'out_userid' => Yii::t('app', '转出会员ID'),
            'out_username' => Yii::t('app', '转出会员账号'),
            'amount' => Yii::t('app', '转出卢宝数量'),
            'cash_amount' => '获得卢宝数量',
            'hcg_amount' => '获得卢呗数量',
            'award' => '对冲奖励',
            'created_at' => Yii::t('app', '创建时间'),
            'updated_at' => Yii::t('app', '修改时间'),
        ];
    }
    
    public static function getList() {
        $query = UserTransform::find();
        $begin_at = Yii::$app->request->get("begin_at");
        $end_at = Yii::$app->request->get("end_at");
        $searchin = Yii::$app->request->get("searchin");
        $searchout = Yii::$app->request->get("searchout");
        
        if ($begin_at) {
            $query->andFilterWhere([">=", "created_at", strtotime($begin_at)]);
        }
        if ($end_at) {
            $query->andFilterWhere(["<=", "created_at", strtotime($end_at)]);
        }
        if ($searchin) {
                $query->andFilterWhere(["=","in_userid",$searchin]);
                $query->orFilterWhere(["like","in_username",$searchin]); 
        }
        if ($searchout) {
                $query->andFilterWhere(["=","out_userid",$searchout]);
                $query->orFilterWhere(["like","out_username",$searchout]); 
        }
        $branch_id = Yii::$app->user->identity->branch_id;
        if($branch_id != 0){
            if(Yii::$app->user->identity->branch_id == '1863'){
                $query->andFilterWhere(["in", "branch_id", ['1863', '1872', '1875', '1889']]);
            }else{
                $query->andFilterWhere(["=","branch_id",$branch_id]);
            }
        }
        
//        $sort = Yii::$app->request->get("sort");
//        $order = Yii::$app->request->get("order");
        $query->orderBy('created_at desc');
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["total" => $totalCount, "data" => $res];
    }
    
}
