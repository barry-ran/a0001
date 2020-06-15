<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_hcaredata".
 *
 * @property integer $id
 * @property string $hprice
 * @property string $htime
 * @property integer $created_at
 * @property integer $updated_at
 */
class Hcaredata extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_hcaredata';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['hprice'], 'number'],
            [['htime'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hprice' => 'Hprice',
            'htime' => 'Htime',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
