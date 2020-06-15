<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_zodiac_apply".
 *
 * @property integer $id
 * @property integer $userid
 * @property integer $zodiac_issue_id
 * @property string $pre_hcg
 * @property integer $result
 * @property integer $created_at
 * @property integer $updated_at
 */
class ZodiacApply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_zodiac_apply';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'zodiac_id', 'created_at'], 'required'],
            [['money','moneyed'], 'number'],
            [['userid', 'zodiac_id', 'zodiac_grade_id', 'created_at', 'status', 'updated_at','islock',"kill_status"], 'integer'],
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
            'userid' => '预约用户ID',
            'zodiac_id' => '宠物表ID',
            'zodiac_grade_id' => '宠物等级表ID',
            'created_at' => '预约时间',
            'money' => '预约冻结的金额',
            'moneyed' => '预约失败返还金额',
            'updated_at' => '更新时间',
            'status' => '预约状态',
            'islock' => '是否被限制抢购',
            "kill_status" => "抢购状态"
        ];
    }

    public static function getlist(){
        $zodiac_name = Yii::$app->request->get("zodiac_name");
        $grade_name = Yii::$app->request->get("grade_name");

        $query = self::find()->where('status = 0')->orderBy("created_at asc");
        if($zodiac_name){
            $query->andFilterWhere(["=","zodiac_id",$zodiac_name]);
        }
//        if($grade_name){
//            $query->andFilterWhere(["=","zodiac_grade_id",$grade_name]);
//        }
        $query = $query->orderBy("created_at desc");
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["total" => $totalCount, "data" => $res];
    }

}
