<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_user_zodiac".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $username
 * @property integer $issue_id
 * @property integer $zodiac_id
 * @property integer $zodiac_grade_id
 * @property string $price
 * @property integer $hcg
 * @property integer $created_at
 */
class UserZodiac extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_user_zodiac';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'issue_id', 'zodiac_id', 'zodiac_grade_id', 'created_at', 'due', 'over_time', 'is_rack', 'is_overtime', 'updated_at', 'rise_num','source','allow_rack'], 'integer'],
            [['old_hcg', 'hcg', 'award'], 'number'],
            [['username'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'userid'        => '用户id',
            'username'      => '用户账号',
            'issue_id'     => '宠物发行id',
            'zodiac_id'     => '宠物id',
            'zodiac_grade_id'     => '宠物等级id',
            'old_hcg'       => '宠物价格(原价)',
            'hcg'           => '宠物价格(现价)',
            'created_at'    => '创建时间',
            'due'           => '宠物周期',
            'award'         => '宠物收益比例',
            'over_time'     => '宠物到期时间',
            'is_overtime'   => '是否到期',
            'updated_at'    => '更新时间',
            'is_rack'       => '是否上架',
            'rise_num'      => '增值次数',
            'source'      => '来源',
            'allow_rack'      => '是否允许出售',
        ];
    }

    public static function getlist(){
        $search = Yii::$app->request->get("search");
        $allow_rack = Yii::$app->request->get("allow_rack");
        $is_rack = Yii::$app->request->get("is_rack");

        $query = self::find()->orderBy("created_at desc");
        if ($allow_rack != '') {
            $query->andFilterWhere(["=","allow_rack",$allow_rack]);
        }
        if ($is_rack != '') {
            $query->andFilterWhere(["=","is_rack",$is_rack]);
        }
        if ($search != '') {
            $query->andFilterWhere(["=","userid",$search]);
            $query->orFilterWhere(["like","username",$search]);
        }
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["total" => $totalCount, "data" => $res];
    }

    public static function createData($id = null) {
        $model = $id ? self::findOne($id) : new self();
        echo '<pre>';
        var_dump($model);exit;
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
}
