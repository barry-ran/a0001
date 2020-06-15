<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_flink".
 *
 * @property integer $id
 * @property integer $typeid
 * @property string $webname
 * @property string $url
 * @property string $logo
 * @property string $email
 * @property string $introduce
 * @property integer $sortid
 * @property integer $created_at
 * @property integer $updated_at
 */
class Flink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_flink';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['typeid', 'webname', 'url'], 'required'],
            [['typeid', 'sortid', 'created_at', 'updated_at'], 'integer'],
            [['introduce'], 'string'],
            [['webname', 'url', 'email'], 'string', 'max' => 50],
            [['logo'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'typeid' => '所属分类',
            'webname' => '网站名称',
            'url' => '网站地址',
            'logo' => '网站LOGO',
            'email' => '站长Email',
            'introduce' => '网站简况',
            'sortid' => '排序位置',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
}
