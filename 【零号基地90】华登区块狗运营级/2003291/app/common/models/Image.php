<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_image".
 *
 * @property integer $id
 * @property string $picpath
 * @property string $size
 * @property integer $apptype
 * @property integer $created_at
 * @property integer $updated_at
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['picpath', 'size', 'apptype'], 'required'],
            [['apptype', 'created_at', 'updated_at'], 'integer'],
            [['picpath'], 'string', 'max' => 200],
            [['size'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'picpath' => '图片路径',
            'size' => '图片尺寸',
            'apptype' => '应用类型',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
}
