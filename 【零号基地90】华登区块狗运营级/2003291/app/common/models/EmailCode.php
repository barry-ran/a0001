<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_email_code".
 *
 * @property integer $id
 * @property string $email
 * @property string $code
 * @property integer $create_at
 * @property string $ip
 */
class EmailCode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_email_code';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            ['email', 'email',"message" => "邮箱格式不正确"],
            [['create_at'], 'integer'],
            [['email', 'ip'], 'string', 'max' => 100],
            [['code'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'code' => 'Code',
            'create_at' => 'Create At',
            'ip' => 'Ip',
        ];
    }
}
