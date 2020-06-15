<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_exchange_rate_new".
 *
 * @property integer $id
 * @property string $exchange_rate
 * @property integer $created_at
 */
class ExchangeRateNew extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_exchange_rate_new';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exchange_rate'], 'string'],
            [['created_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'exchange_rate' => Yii::t('app', '货币汇率'),
            'created_at' => Yii::t('app', '创建时间'),
        ];
    }
}
