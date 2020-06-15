<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_permission".
 *
 * @property integer $id
 * @property string $name
 * @property string $authitems
 * @property integer $created_at
 * @property integer $updated_at
 */
class Permission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_permission';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'authitems'], 'required'],
            [['authitems'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '权限名称',
            'authitems' => '包含方法',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
}
