<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_blockchain".
 *
 * @property integer $id
 * @property string $hash
 * @property string $pre_hash
 * @property integer $created_at
 */
class Blockchain extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_blockchain';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'integer'],
            [['hash', 'pre_hash'], 'string', 'max' => 16],
            [['hash'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hash' => 'Hash',
            'pre_hash' => 'Pre Hash',
            'created_at' => 'Created At',
        ];
    }
}
