<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_mcaredata".
 *
 * @property integer $id
 * @property string $mprice
 * @property string $mtime
 * @property integer $created_at
 * @property integer $updated_at
 */
class Mcaredata extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_mcaredata';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['mprice'], 'number'],
            [['mtime'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mprice' => 'Mprice',
            'mtime' => 'Mtime',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
