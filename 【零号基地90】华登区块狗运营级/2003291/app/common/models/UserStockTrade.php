<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_user_stock_trade".
 *
 * @property integer $id
 * @property integer $in_userid
 * @property string $in_username
 * @property integer $out_userid
 * @property string $out_username
 * @property string $number
 * @property string $re_num
 * @property string $price
 * @property string $sysprice
 * @property string $transprice
 * @property string $re_transprice
 * @property integer $status
 * @property integer $type
 * @property string $created_at
 * @property string $traded_at
 * @property string $update_at
 */
class UserStockTrade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_user_stock_trade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['in_userid', 'out_userid', 'status', 'type'], 'integer'],
            [['number', 'type'], 'required'],
            [['number', 're_num', 'price', 'sysprice', 'transprice', 're_transprice'], 'number'],
            [['in_username'], 'string', 'max' => 50],
            [['out_username'], 'string', 'max' => 255],
            [['created_at', 'traded_at', 'update_at'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'in_userid' => Yii::t('app', '买入会员ID'),
            'in_username' => Yii::t('app', '买入会员账号'),
            'out_userid' => Yii::t('app', '卖出会员ID'),
            'out_username' => Yii::t('app', '卖出会员账号'),
            'number' => Yii::t('app', '交易数量'),
            're_num' => Yii::t('app', '剩余数量'),
            'price' => Yii::t('app', '交易价格'),
            'sysprice' => Yii::t('app', '系统时价'),
            'transprice' => Yii::t('app', '交易总金额'),
            're_transprice' => Yii::t('app', '交易手续费比例'),
            'status' => Yii::t('app', '交易状态'),
            'type' => Yii::t('app', '交易类型'),
            'created_at' => Yii::t('app', '创建时间'),
            'traded_at' => Yii::t('app', '交易时间'),
            'update_at' => Yii::t('app', '更新时间'),
        ];
    }
}
