<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_bank".
 *
 * @property integer $id
 * @property string $name
 * @property string $en_name
 * @property integer $created_at
 * @property integer $updated_at
 */
class Bank extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_bank';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'en_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '自增ID'),
            'name' => Yii::t('app', '银行名称'),
            'en_name' => Yii::t('app', '英文名称'),
            'created_at' => Yii::t('app', '创建时间'),
            'updated_at' => Yii::t('app', '更新时间'),
        ];
    }
}
