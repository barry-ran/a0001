<?php

namespace common\models;

use Yii;
use common\components\MTools;

/**
 * This is the model class for table "me_zodiac_grade".
 *
 * @property integer $id
 * @property string $name
 * @property integer $hcg_min
 * @property integer $hcg_max
 * @property integer $cash_min
 * @property integer $cash_max
 * @property integer $created_at
 * @property integer $updated_at
 */
class ZodiacGrade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_zodiac_grade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hcg_min', 'hcg_max', 'cash_min', 'cash_max', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '等级名称',
            'hcg_min' => '价格最小值',
            'hcg_max' => '价格最大值',
            'cash_min' => '最小值',
            'cash_max' => '最大值',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    public static function getlist(){
        $query = self::find()->orderBy("created_at asc");
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["total" => $totalCount, "data" => $res];
    }

    public static function createData($id = null) {
        $model = $id ? self::findOne($id) : new self();
        try {
            $model->load(Yii::$app->request->post());
            $user = Yii::$app->user->identity;
            $model->updated_at = time();
            if (!$model->validate()) {
                return array("errors" => $model->getErrors(), "model" => $model);
            }
            if($id){
                \common\models\Actionlog::setLog('编辑宠物等级：'.$model->name.'的信息');
            }else{
                $model->created_at = time();
                \common\models\Actionlog::setLog('新增宠物等级：'.$model->name);
            }
            return MTools::saveModel($model);
        } catch (Exception $e) {
            throw $e;
        }
    }


    //获取所有宠物等级名称
    public static function getGradename(){
        $all_name = ZodiacGrade::find()->select('id,name')->asArray()->all();
        $event_type = array();
        $i = 0;
        foreach ($all_name as $key=>$val){
            $event_type[$i]['id'] = $key+1;
            $event_type[$i]['name'] = $val['name'];
            $i++;
        }
        return $event_type;
    }


}
