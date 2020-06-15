<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_user".
 *
 * @property integer $id
 * @property string $username
 * @property integer $level_id
 * @property integer $grade
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_hash2
 * @property string $password_reset_token
 * @property string $login_ip
 * @property integer $status
 * @property integer $isactivate
 * @property integer $issend
 * @property integer $issell
 * @property integer $isout
 * @property integer $iseal
 * @property integer $last_login_at
 * @property string $invite_code
 * @property string $mycode
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $out_limit
 * @property integer $start
 * @property integer $is_turn_reg
 * @property string $app_token
 * @property integer $overtime_num
 * @property string $seal_reason
 */
class MeUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'password_hash2'], 'required'],
            [['level_id', 'grade_id', 'status', 'isactivate', 'issend', 'issell', 'isout', 'iseal', 'last_login_at', 'created_at', 'updated_at', 'start', 'is_turn_reg', 'overtime_num','branch_id'], 'integer'],
            [['out_limit'], 'number'],
            [['username', 'app_token'], 'string', 'max' => 50],
            [['share_qrcode', 'sendin_qrcode'], 'string', 'max' => 60],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_hash2', 'password_reset_token'], 'string', 'max' => 255],
            [['login_ip'], 'string', 'max' => 100],
            [['invite_code', 'mycode'], 'string', 'max' => 10],
            [['username'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', '用户名'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_hash2' => Yii::t('app', 'Password Hash2'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'login_ip' => Yii::t('app', '最后登陆IP'),
            'levelid' => Yii::t('app', '级别ID'),
          //  'status' => Yii::t('app', '信用等级'),
            'grade_id' => Yii::t('app', '等级id'),
            'branch_id' => Yii::t('app', '分公司id'),
            'iseal' => Yii::t('app', '是否被封'),
            'isout' => Yii::t('app', '是否出局'),
            'last_login_at' => Yii::t('app', '最后登陆时间'),
            'trapass' => Yii::t('app', '交易密码'),
            'syscode' => Yii::t('app', '分支码'),
            'is_center' => Yii::t('app', '是否为调币中心'),
            'created_at' => Yii::t('app', '创建时间'),
            'updated_at' => Yii::t('app', '更新时间'),
            'isactivate' => Yii::t('app', '是否实名认证'),
            'issend' => Yii::t('app', '冻结保单'),
            'issell' => Yii::t('app', 'BBA交易限制'),
            'is_turn_reg' => Yii::t('app', '转出母B'),
            'app_token' => Yii::t('app', '秘钥'),
            'overtime_num' => Yii::t('app', '交易超时次数'),
            'except_num' => Yii::t('app', '交易异常次数'),
        ];
    }
}
