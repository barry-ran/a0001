<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_dt_award".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $username
 * @property string $amount
 * @property integer $status
 * @property string $note
 * @property integer $created_at
 * @property integer $click_time
 */
class DtAward extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_dt_award';
    }

    /**
     * @inheritdoc
     */
    public function rules() 
    { 
        return [
            [['userid', 'username', 'event_type'], 'required'],
            [['userid', 'event_type', 'status', 'created_at', 'click_time'], 'integer'],
            [['amount'], 'number'],
            [['note'], 'string'],
            [['username'], 'string', 'max' => 50],
        ]; 
    } 

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => '会员id',
            'username' => '会员账号',
            'amount' => '数量',
            'status' => '状态',
            'note' => '备注',
            'created_at' => '创建时间',
            'click_time' => '点击获取时间',
        ];
    }
    public static $event_type = [
        1 => "成为正式会员送的签到奖励",
        2 => "成为正式会员推荐人获得奖励",
    ];
    public static function insertDatas($awardsArr){
        foreach($awardsArr as $key=>$val){
            $model = new DtAward();
            $model->userid = $val['userid'];
            $model->username = $val['username'];
            $model->amount = $val['amount'];
            $model->event_type = $val['event_type'];
            $model->note = $val['note'];
            $model->created_at = time();
            $model->save();
        }
        return true;
    }
    // 插入奖励记录
    public static function insertrecord($userid,$username,$amount,$event_type,$status,$note){
        $Record = new DtAward();
        $Record->userid = $userid;                               // 会员id
        $Record->username = $username;                               // 会员账号
        $Record->amount = $amount;                 // 奖励数量
        $Record->event_type = $event_type;                 // 事件类型
        $Record->status = $status;                 // 状态（1：已领取，2：未领取）
        $Record->note = $note;                                   // 备注
        $Record->created_at = time();                            // 创建时间
        $Record->click_time = time();                            // 获取时间

        return $Record->save();
    }
}
