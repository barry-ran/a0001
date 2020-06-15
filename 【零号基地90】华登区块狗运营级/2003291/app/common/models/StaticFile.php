<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_static_file".
 *
 * @property integer $id
 * @property integer $http
 * @property string $action
 * @property string $params
 * @property integer $dir
 * @property string $filename
 * @property integer $filetype
 * @property integer $frequency
 * @property string $description
 * @property integer $flag
 * @property integer $created_at
 * @property integer $updated_at
 */
class StaticFile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_static_file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['http', 'action', 'dir', 'filename', 'filetype'], 'required'],
            [['http', 'dir', 'filetype', 'frequency', 'flag', 'created_at', 'updated_at'], 'integer'],
            [['params'], 'string'],
            [['action', 'description'], 'string', 'max' => 255],
            [['filename'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'http' => '访问地址',
            'action' => '访问方法',
            'params' => '参数',
            'dir' => '存储目录',
            'filename' => '文件名称',
            'filetype' => '文件类型',
            'frequency' => '执行频率',
            'description' => '文件描述',
            'flag' => '文件是否存在',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
}
