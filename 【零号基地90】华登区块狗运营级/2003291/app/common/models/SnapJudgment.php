<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_snap_judgment".
 *
 * @property integer $id
 * @property integer $zodiacid
 * @property integer $created_at
 * @property integer $userid
 */
class SnapJudgment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_snap_judgment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zodiacid', 'created_at', 'userid'], 'required'],
            [['zodiacid', 'created_at', 'userid','status','updated_at'], 'integer'],
            [['issue_id'],'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'zodiacid' => 'Zodiacid',
            'created_at' => 'Created At',
            'userid' => 'Userid',
            'issue_id' => 'issue_id',
            'status' => 'status',
            'updated_at' => 'updated_at',
        ];
    }
}
