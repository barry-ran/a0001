<?php

namespace common\models;

use common\components\MTools;
use frontend\models\WB_UserProfile;
use Yii;

/**
 * This is the model class for table "me_send_currency".
 *
 * @property integer $id
 * @property integer $in_userid
 * @property string $in_username
 * @property integer $out_userid
 * @property string $out_username
 * @property string $amount
 * @property string $service_charge
 * @property string $actual_amount
 * @property integer $created_at
 * @property integer $updated_at
 */
class SendCurrency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_send_currency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'in_userid', 'out_userid'], 'required'],
            [['id', 'in_userid', 'out_userid', 'created_at', 'updated_at'], 'integer'],
            [['amount', 'service_charge', 'actual_amount'], 'number'],
            [['in_username', 'out_username'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'in_userid' => 'In Userid',
            'in_username' => 'In Username',
            'out_userid' => 'Out Userid',
            'out_username' => 'Out Username',
            'amount' => 'Amount',
            'service_charge' => 'Service Charge',
            'actual_amount' => 'Actual Amount',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function getSendoutRecordLoad($userid,$page){
        $query = SendCurrency::find()->where("out_userid=:out_userid",[":out_userid"=>$userid]);

        $pagesize = 10;

        $offset = ($page - 1)*$pagesize;
        $limit = Yii::$app->request->get("limit", $pagesize);
        $query->orderBy('created_at desc');
        $res = $query->offset($offset)->limit($limit)->all();

        $temp = [];
        foreach($res as $key=>$val){
            if($userid == $val->out_userid){
                $temp[$key]['username'] = $val->in_username;
                //获取头像
                $temp[$key]['userid'] = $val->in_userid;
                $icon = WB_UserProfile::find()->where("userid=:userid",[':userid'=>$val->in_userid])->select('icon')->one();
                $temp[$key]['icon'] = MTools::getYiiParams("webimagepath").'/'.$icon->icon;
                $temp[$key]['amount'] = '-'.$val->amount;
            }else{
                $temp[$key]['username'] = $val->out_username;
                $temp[$key]['userid'] = $val->out_userid;
                $icon = WB_UserProfile::find()->where("userid=:userid",[':userid'=>$val->out_userid])->select('icon')->one();
                $temp[$key]['icon'] = MTools::getYiiParams("webimagepath").'/'.$icon->icon;
                $temp[$key]['amount'] = $val->amount;
            }
            $temp[$key]['created_at'] = Yii::$app->formatter->asDatetime($val->created_at);
        }
        return $temp;
    }
}
