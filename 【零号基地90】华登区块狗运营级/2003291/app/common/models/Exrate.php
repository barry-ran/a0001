<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_exrate".
 *
 * @property integer $id
 * @property string $currency
 * @property string $icon
 * @property double $receipt_rate
 * @property double $drawal_rate
 * @property integer $created_at
 * @property integer $updated_at
 */
class Exrate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_exrate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['currency', 'receipt_rate', 'drawal_rate'], 'required'],
            [['receipt_rate', 'drawal_rate'], 'number'],
            [['created_at', 'updated_at'], 'integer'],
            [['currency'], 'string', 'max' => 100],
            [['icon'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '自增ID'),
            'currency' => Yii::t('app', '货币'),
            'icon' => Yii::t('app', '图标'),
            'receipt_rate' => Yii::t('app', '进货率'),
            'drawal_rate' => Yii::t('app', '提款率'),
            'created_at' => Yii::t('app', '创建时间'),
            'updated_at' => Yii::t('app', '更新时间'),
        ];
    }
}
