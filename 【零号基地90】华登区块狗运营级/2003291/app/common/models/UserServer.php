<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_user_server".
 *
 * @property integer $id
 * @property string $content
 * @property string $replay
 * @property integer $userid
 * @property string $username
 * @property integer $adminid
 * @property string $adminname
 * @property integer $status
 * @property string $picture
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $replayd_at
 * @property integer $type
 * @property integer $order_id
 */
class UserServer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_user_server';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid','username'], 'required'],
            [['content', 'replay'], 'string'],
            [['userid', 'adminid', 'status', 'created_at', 'updated_at', 'replayd_at', 'type', 'order_id','branch_id'], 'integer'],
            [['username', 'adminname'], 'string', 'max' => 100],
            [['picture'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '自增ID'),
            'content' => Yii::t('app', '提问内容'),
            'replay' => Yii::t('app', '回复内容'),
            'userid' => Yii::t('app', '会员ID'),
            'username' => Yii::t('app', '会员名称'),
            'adminid' => Yii::t('app', '管理员ID'),
            'adminname' => Yii::t('app', '管理员名称'),
            'status' => Yii::t('app', '状态'),
            'picture' => Yii::t('app', '上传问题图片'),
            'created_at' => Yii::t('app', '创建时间'),
            'updated_at' => Yii::t('app', '更新时间'),
            'replayd_at' => Yii::t('app', '回复时间'),
            'type' => Yii::t('app', '类型'),
            'order_id' => Yii::t('app', '超时ID'),
        ];
    }
}
