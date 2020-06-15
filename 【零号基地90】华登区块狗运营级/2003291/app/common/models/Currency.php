<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_currency".
 *
 * @property integer $id
 * @property string $currency
 * @property string $rate
 * @property string $country
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_currency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rate'], 'number'],
            [['currency', 'country'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'currency' => Yii::t('app', '货币名称'),
            'rate' => Yii::t('app', '汇率'),
            'country' => Yii::t('app', '所属国家或地区'),
        ];
    }
}
