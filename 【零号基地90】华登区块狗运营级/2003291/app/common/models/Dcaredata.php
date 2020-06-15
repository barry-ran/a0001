<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_dcaredata".
 *
 * @property integer $id
 * @property string $dtime
 * @property string $first
 * @property string $last
 * @property string $high
 * @property string $low
 * @property integer $created_at
 * @property integer $updated_at
 */
class Dcaredata extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_dcaredata';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['first', 'last', 'high', 'low'], 'number'],
            [['dtime'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dtime' => 'Dtime',
            'first' => 'First',
            'last' => 'Last',
            'high' => 'High',
            'low' => 'Low',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
