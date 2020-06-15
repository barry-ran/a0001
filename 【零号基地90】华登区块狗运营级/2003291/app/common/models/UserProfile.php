<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_user_profile".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $icon
 * @property string $username
 * @property string $phone
 * @property string $email
 * @property string $truename
 * @property string $idcard
 * @property integer $tier
 * @property integer $is_act
 * @property string $wallet_token
 * @property string $wechat
 * @property string $alipay
 * @property string $wechat_img
 * @property string $alipay_img
 *
 * @property User $user
 */
class UserProfile extends \yii\db\ActiveRecord
{

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_user_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid'], 'required'],
            [['userid', 'referrerid', 'tier','created_at'], 'integer'],
            [['mobile_only', 'node', 'up_referrer_id', 'down_team_id'], 'string'],
            [['icon'], 'string', 'max' => 200],
            [['username', 'truename', 'referrer', 'sec_name', 'wechat_name', 'alipay_name'], 'string', 'max' => 50],
            [['quhao'], 'string', 'max' => 10],
            [['phone'], 'string', 'max' => 20],
            [['email', 'alipay', 'wechat', 'sec'], 'string', 'max' => 100],
            [['alipay_img', 'wechat_img', 'sec_img'], 'string', 'max' => 255],
            [['idcard'], 'string', 'max' => 25],
            [['wallet_token'], 'string', 'max' => 66],
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
            'userid' => '用户ID',
            'icon' => '头像',
            'username' => '姓名',
            'phone' => '手机号',
            'email' => '电邮地址',
            'alipay' => '支付宝',
            'wechat' => '微信号',
            'truename' => '真实姓名',
            'subord_id' => '下级id',
            'superior_id' => '上级id',
            'idcard' => '身份证',
            'tier' => '层级',
            'wallet_token' => '钱包地址',
            'referrer' => '推荐人',
            'referrerid' => '推荐人ID',
            'up_referrer_id' => '多代上级推荐人id',
            'down_team_id' => '多代下级id',
            'mobile_only' => '手机唯一标识'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userid']);
    }

    public static function findByUserid($userid) {
        return static::find()->where('userid=:userid', [':userid' => $userid])->one();
    }

    public static function findByUser($username) {
//        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
        return static::find()->select('username')->where('phone = :username or username = :username',[':username'=>$username, 'status' => self::STATUS_ACTIVE])->one();
    }
}
