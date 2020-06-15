<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_sms_code".
 *
 * @property integer $id
 * @property string $phone
 * @property string $code
 * @property integer $create_at
 * @property integer $ip
 */
class SmsCode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_sms_code';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone', 'code'], 'required'],
            [['create_at'], 'integer'],
            [['phone'], 'string', 'max' => 20],
            [['code'], 'string', 'max' => 10],
            [['ip'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => '手机号',
            'code' => '验证码',
            'create_at' => '时间',
            'ip' => 'Ip地址',
        ];
    }
    
    public static function sendSms($quhao,$strphone)
    {
        //  发送短信次数的判断
        //  一分钟之内只能发送一次
        $time = time() - 60;
        $sendnum = SmsCode::find()->where('phone = :phone && create_at >= :create_at', [':phone' => $strphone, 'create_at' => $time])->orderBy('create_at desc')->count();
        if ($sendnum >= 1) {
            return -1;
        }

        // 一天只能发送10次
        // php获取今日开始时间戳
        $beginToday = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $sendnum = SmsCode::find()->where('phone = :phone && create_at >= :create_at', [':phone' => $strphone, 'create_at' => $beginToday])->orderBy('create_at desc')->count();
        if ($sendnum >= 10) {
            return -2;
        }

        //  一个IP地址一天只能发送15次
        $ip = Yii::$app->getRequest()->getUserIP();
        $sendnum = SmsCode::find()->where('phone = :phone && create_at >= :create_at && ip = :ip', [':phone' => $strphone, 'create_at' => $beginToday, 'ip' => $ip])->orderBy('create_at desc')->count();
        if ($sendnum >= 15) {
            return -3;
        }

        $flag = \common\components\MTools::SendMsg($quhao, $strphone);
        $flag = json_decode(json_encode($flag), true);

        if ($flag > 0) {
            return 1;
        } else {
            return -4;
        }
    }
    public static function getList() {
        $query = self::find();
        $query->orderBy("create_at desc");
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();

        return ["total" => $totalCount, "data" => $res];
    }
}
