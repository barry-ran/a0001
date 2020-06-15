<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "me_user_stock_trade".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $username
 * @property integer $suserid
 * @property string $susername
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
            [['userid', 'suserid', 'status', 'type'], 'integer'],
            [['number', 'type'], 'required'],
            [['number', 're_num', 'price', 'sysprice', 'transprice', 're_transprice'], 'number'],
            [['username'], 'string', 'max' => 50],
            [['susername'], 'string', 'max' => 255],
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
            'userid' => 'Userid',
            'username' => 'Username',
            'suserid' => 'Suserid',
            'susername' => 'Susername',
            'number' => 'Number',
            're_num' => 'Re Num',
            'price' => 'Price',
            'sysprice' => 'Sysprice',
            'transprice' => 'Transprice',
            're_transprice' => 'Re Transprice',
            'status' => 'Status',
            'type' => 'Type',
            'created_at' => 'Created At',
            'traded_at' => 'Traded At',
            'update_at' => 'Update At',
        ];
    }
}
