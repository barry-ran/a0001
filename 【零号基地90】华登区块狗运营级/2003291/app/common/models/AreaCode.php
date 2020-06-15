<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_area_code".
 *
 * @property integer $id
 * @property string $code
 * @property string $country
 */
class AreaCode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_area_code';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code'], 'string'],
            [['country'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'country' => 'Country',
        ];
    }
}
