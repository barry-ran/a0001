<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_dirfile".
 *
 * @property integer $id
 * @property integer $cid
 * @property string $name
 * @property string $title
 * @property integer $created_at
 * @property integer $updated_at
 */
class Dirfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_dirfile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cid', 'name', 'title'], 'required'],
            [['cid', 'created_at', 'updated_at'], 'integer'],
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
            'cid' => '目录ID',
            'name' => '文件名称',
            'title' => '文件说明',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
}
