<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_share_rewards".
 *
 * @property integer $id
 * @property integer $amount
 * @property integer $algebra
 * @property integer $created_at
 * @property integer $updated_at
 */
class ShareRewards extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_share_rewards';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'amount', 'algebra', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'amount' => 'Amount',
            'algebra' => 'Algebra',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
