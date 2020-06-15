<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_level".
 *
 * @property integer $id
 * @property string $name
 * @property string $buy_min
 * @property string $profit
 * @property string $increase
 * @property integer $round
 * @property integer $updated_at
 */
class Level extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['buy_min'], 'required'],
            [['buy_min', 'profit', 'increase'], 'number'],
            [['round', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '自增ID',
            'name' => '等级名称',
            'buy_min' => 'C2C累计购买数量（最少）',
            'profit' => '基数',
            'increase' => '增长比例',
            'round' => '累计购买轮数',
            'updated_at' => '更新时间',
        ];
    }
}
