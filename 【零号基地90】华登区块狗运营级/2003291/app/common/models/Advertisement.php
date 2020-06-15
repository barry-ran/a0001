<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_advertisement".
 *
 * @property integer $id
 * @property string $img
 * @property string $url
 * @property integer $created_at
 * @property string $content
 * @property integer $updated_at
 */
class Advertisement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_advertisement';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['img', 'content'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['img', 'url', 'content'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img' => '图片',
            'url' => '链接',
            'created_at' => '创建时间',
            'content' => '标题',
            'updated_at' => '更新时间',
        ];
    }
}
