<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_user_stock_trade_record".
 *
 * @property integer $id
 * @property integer $trid
 * @property integer $buserid
 * @property string $busername
 * @property integer $suserid
 * @property string $susername
 * @property integer $trade_type
 * @property integer $pay_type
 * @property double $amount
 * @property integer $created_at
 * @property integer $updated_at
 */
class UserStockTradeRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_user_stock_trade_record';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trid', 'buserid', 'suserid', 'trade_type', 'pay_type', 'created_at', 'updated_at'], 'integer'],
            [['buserid', 'busername', 'suserid', 'susername', 'amount'], 'required'],
            [['amount'], 'number'],
            [['busername'], 'string', 'max' => 50],
            [['susername'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '自增ID'),
            'trid' => Yii::t('app', '交易ID'),
            'buserid' => Yii::t('app', '买入会员ID'),
            'busername' => Yii::t('app', '买入会员账号'),
            'suserid' => Yii::t('app', '卖出会员ID'),
            'susername' => Yii::t('app', '卖出会员账号'),
            'trade_type' => Yii::t('app', '交易类型'),
            'pay_type' => Yii::t('app', '支付类型'),
            'amount' => Yii::t('app', '交易数量'),
            'created_at' => Yii::t('app', '创建时间'),
            'updated_at' => Yii::t('app', '更新时间'),
        ];
    }
}
