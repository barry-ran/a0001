<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_dirctory".
 *
 * @property integer $id
 * @property string $name
 * @property string $title
 */
class Dirctory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_dirctory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'title'], 'required'],
            [['name', 'title'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '目录名称',
            'title' => '目录说明',
        ];
    }
}
