<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_user_wallet".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $hcg_wa
 * @property string $cash_wa
 * @property string $care_wa
 * @property string $get_release
 * @property string $turnout_limit
 * @property User $user
 * @property string $permanent_wa
 * @property string $free_wa
 * @property string $total_buy
 */
class UserWallet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_user_wallet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid'], 'integer'],
            [['hcg_wa', 'cash_wa', 'care_wa', 'kmd', 'total_buy'], 'number'],
            [['userid'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => '用户id',
            'hcg_wa' => '积分',
            'cash_wa' => 'GTC',
            'care_wa' => '推广收益',
            'total_buy' => '累计购买',
            'kmd' => '可挖kmd',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userid']);
    }

    // 获取用户钱包
    public static function getWallet($userid) {
        return UserWallet::find()->where('userid=:userid', [':userid' => $userid])->one();
    }
}
