<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\components\MTools;
/**
 * This is the model class for table "me_ztsl_award".
 *
 * @property integer $id
 * @property integer $common_num
 * @property integer $layer_num
 * @property string $award_per
 * @property integer $created_at
 * @property integer $updated_at
 */
class ZtslAward extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_ztsl_award';
    }

    /**
     * @inheritdoc
     */
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['award'], 'number'],
            [['zodiac_id', 'userid', 'created_at'], 'integer'],
            [['zodiac_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'award' => '增值数量',
            'zodiac_id' => '宠物id',
            'zodiac_name' => '宠物名称',
            'userid' => '用户id',
            'created_at' => '创建时间',
        ];
    }

}
