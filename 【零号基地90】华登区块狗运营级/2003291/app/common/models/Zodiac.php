<?php

namespace common\models;

use Yii;
use common\components\MTools;

/**
 * This is the model class for table "me_zodiac".
 *
 * @property integer $id
 * @property string $name
 * @property integer $zodiac_grade_id
 * @property integer $begin_at_hour
 * @property integer $begin_at_minu
 * @property integer $end_at_hour
 * @property integer $end_at_minu
 * @property integer $created_at
 * @property integer $is_show
 * @property string $picture
 * @property integer $subscribe
 * @property integer $seckill
 * @property integer $due
 * @property integer $click_num
 * @property string $award
 * @property integer $updated_at
 */
class Zodiac extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_zodiac';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'begin_at_hour', 'begin_at_minu', 'end_at_hour', 'end_at_minu', 'updated_at'], 'required'],
            [['begin_at_hour', 'begin_at_minu', 'end_at_hour', 'end_at_minu', 'created_at', 'is_show', 'subscribe',
                'seckill', 'fee', 'due', 'click_num', 'updated_at', 'issue_num', 'hcg_min', 'hcg_max', 'cash','kill_num'], 'integer'],
            [['award', 'kmd'], 'number'],
            [['name'], 'string', 'max' => 100],
            [['picture'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '飞龙名称',
            'begin_at_hour' => '开抢时间（时）',
            'begin_at_minu' => '开抢时间（分）',
            'end_at_hour' => '结束时间（时）',
            'end_at_minu' => '结束时间（分）',
            'created_at' => '创建时间',
            'is_show' => '是否显示',
            'picture' => '图片',
            'subscribe' => '预约花费',
            'seckill' => '抢购花费',
            'fee' => '手续费',
            'due' => '周期',
            'click_num' => '活跃度',
            'award' => '收益比例',
            'updated_at' => '更新时间',
            'issue_num' => '发行数量',
            'hcg_min' => "宠物价格下限",
            "hcg_max" => '宠物价格上限',
            "kmd" => '可挖KMD',
            "cash" => ""
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
            if($_FILES['Zodiac']['tmp_name']['picture'] != ''){
                $filename = Yii::$app->imgload->UploadPhotoQn($model, 'picture',$user);
                if ($filename !== false) {
                    $model->picture = $filename;
                }
            }
            $model->updated_at = time();
            if (!$model->validate()) {
                return array("errors" => $model->getErrors(), "model" => $model);
            }
            if($id){
                \common\models\Actionlog::setLog('编辑宠物：'.$model->name.'的信息');
            }else{
                $model->created_at = time();
                \common\models\Actionlog::setLog('新增宠物：'.$model->name);
            }
            return MTools::saveModel($model);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static $onOroff = [
        ["id" => 0, "name" => "不显示"],
        ["id" => 1, "name" => "显示"]
    ];

    //获取所有宠物名称
    public static function getZodiacname(){
        $all_name = Zodiac::find()->select('id,name')->asArray()->all();
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
