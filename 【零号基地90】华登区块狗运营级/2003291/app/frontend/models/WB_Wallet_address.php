<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "me_wallet_address".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $username
 * @property string $coinname
 * @property string $wallet_token
 */
class WB_Wallet_address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_wallet_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'username'], 'required'],
            [['userid'], 'integer'],
            [['username', 'wallet_token'], 'string', 'max' => 50],
            [['coinname'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => '用户ID',
            'username' => '用户名',
            'coinname' => '货币名',
            'wallet_token' => '钱包地址',
        ];
    }
    /*
     * 关联用户信息
     */

    public function getUser() {
        return $this->hasOne(WB_User::className(), ['id' => 'userid']);
    }

    // 获取用户钱包地址（返回数组）
    public static function getWalletAddr($userid) {
        $res = self::find()->where('userid=:userid', [':userid' => $userid])->asArray()->one();

        return $res;
    }

    // 获取用户所有钱包地址（返回数组）
    public static function getAllWalletAddr($userid) {
        $res = self::find()->where('userid=:userid', [':userid' => $userid])->asArray()->all();

        return $res;
    }
}
