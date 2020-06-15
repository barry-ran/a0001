<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_grade_record".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $username
 * @property integer $old_grade_id
 * @property string $old_grade_name
 * @property integer $new_grade_id
 * @property string $new_grade_name
 * @property string $note
 * @property integer $created_at
 */
class GradeRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_grade_record';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'username', 'old_grade_id', 'new_grade_id'], 'required'],
            [['userid', 'old_grade_id', 'new_grade_id', 'created_at'], 'integer'],
            [['note'], 'string'],
            [['username', 'old_grade_name', 'new_grade_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => 'Userid',
            'username' => 'Username',
            'old_grade_id' => 'Old Grade ID',
            'old_grade_name' => 'Old Grade Name',
            'new_grade_id' => 'New Grade ID',
            'new_grade_name' => 'New Grade Name',
            'note' => 'Note',
            'created_at' => 'Created At',
        ];
    }
}
