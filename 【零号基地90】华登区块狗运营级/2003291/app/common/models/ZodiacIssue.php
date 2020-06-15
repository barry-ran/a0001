<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_zodiac_issue".
 *
 * @property integer $id
 * @property integer $zodiac_id
 * @property string $zodiac_name
 * @property integer $zodiac_grade_id
 * @property string $zodiac_grade_name
 * @property string $hcg
 * @property string $cash
 * @property integer $created_at
 * @property integer $updated_at
 */
class ZodiacIssue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_zodiac_issue';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zodiac_id','zodiac_name','hcg','belong_id'], 'required'],
            [['zodiac_id','issel', 'created_at', 'updated_at'], 'integer'],
            [['zodiac_name'], 'string', 'max' => 100],
            [['hcg'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'zodiac_id' => '飞龙ID',
            'zodiac_name' => '飞龙名称',
            'zodiac_grade_id' => '等级ID',
            'zodiac_grade_name' => '等级名称',
            'hcg' => '价格',
            'cash' => 'GTC',
            'issel' => '是否可卖出',
            'created_at' => '发行时间',
            'updated_at' => '更新时间',
            'belong_id' => '归属人',
        ];
    }

    public function getUser(){
        return $this->hasOne(User::className(),['id'=>'belong_id']);
    }
    public static function getlist(){
        $query = self::find()->where('issel = 0')->orderBy("id desc");
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->all();
        return ["total" => $totalCount, "data" => $res];
    }
    public static function createData($id = null) {
        $model = $id ? ZodiacIssue::findOne($id) : new ZodiacIssue();

        try {
            $model->load(Yii::$app->request->post());
            $zodiac = Zodiac::findOne($model->zodiac_id);
            $zodiacGrade = ZodiacGrade::findOne($model->zodiac_grade_id);
            $model->zodiac_name = $zodiac->name;
            $model->zodiac_grade_name = $zodiacGrade->name;

            if(!$model->validate()){
                return array("errors" => $model->getErrors(), "model" => $model);
            }else{
                if($zodiacGrade->hcg_min>$model->hcg || $zodiacGrade->hcg_max<$model->hcg){
                    return array("errors" => ['hcg'=>['发行的商品积分不在所选积分区间内']], "model" => $model);
                }
                if($zodiacGrade->cash_min>$model->cash || $zodiacGrade->cash_max<$model->cash){
                    return array("errors" => ['hcg'=>['发行的商品GTC不在所选等级区间内']], "model" => $model);
                }
                $admindata = Yii::$app->user->identity;
                $model->created_at = time();
                $model->updated_at = time();
                $model->issel = 0;
                $model->belong_id = 1;
                \common\models\Actionlog::setLog('管理员'.$admindata->username.'发布飞龙'.$model->zodiac_name);
                return $model->save();
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
}
