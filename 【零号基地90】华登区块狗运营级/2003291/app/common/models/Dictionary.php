<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_dictionary".
 *
 * @property integer $id
 * @property integer $column_id
 * @property string $name
 * @property string $description
 * @property double $min
 * @property double $max
 * @property integer $sortid
 * @property string $icon
 * @property integer $created_at
 * @property integer $updated_at
 */
class Dictionary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_dictionary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['column_id', 'sortid', 'created_at', 'updated_at'], 'integer'],
            [['min', 'max'], 'number'],
            [['name', 'icon'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '自增ID'),
            'column_id' => Yii::t('app', '父级ID'),
            'name' => Yii::t('app', '字典名称'),
            'description' => Yii::t('app', '字典描述'),
            'min' => Yii::t('app', '最小值'),
            'max' => Yii::t('app', '最大值'),
            'sortid' => Yii::t('app', '排序ID'),
            'icon' => Yii::t('app', '图标路径'),
            'created_at' => Yii::t('app', '创建时间'),
            'updated_at' => Yii::t('app', '更新时间'),
        ];
    }
}
