<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_stock_price_record".
 *
 * @property integer $id
 * @property double $price
 * @property double $total
 * @property integer $times
 * @property integer $adminid
 * @property string $adminname
 * @property string $note
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 */
class StockPriceRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_stock_price_record';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price'], 'required'],
            [['price', 'total'], 'number'],
            [['adminid', 'created_at', 'updated_at', 'times'], 'integer'],
            [['adminname'], 'string', 'max' => 100],
            [['note', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '自增ID'),
            'price' => Yii::t('app', 'BBA价格'),
            'total' => Yii::t('app', '总交易额'),
            'times' => Yii::t('app', '已上涨次数'),
            'adminid' => Yii::t('app', '管理员ID'),
            'adminname' => Yii::t('app', '管理员账号'),
            'note' => Yii::t('app', '说明'),
            'description' => Yii::t('app', '描述'),
            'created_at' => Yii::t('app', '修改时间'),
            'updated_at' => Yii::t('app', '更新时间'),
        ];
    }

    // 判断是否需要
    public static function getTimesVolume() {
        // 获取
        $spr = StockPriceRecord::find()->select('total, times')->limit(1)->orderBy("created_at desc")->asArray()->one();
        // 判断是否达到100W
        $total = (int)($spr['total'] / 1000000);       // 结果取整

        $result = $total - $spr['times'];              // 结果大于0

        if($result >= 1) {
            return 1;
        } else {
            return 0;
        }
    }

    // 获取BBA当前系统时价
    public static function getCurrentPrice() {
        $sysPriceData = \common\models\StockPriceRecord::find()->limit(1)->orderBy("created_at desc")->asArray()->one();

        return $sysPriceData['price'];
    }

    // 价格上涨
    public static function addPrice() {
        $last_price = StockPriceRecord::getCurrentPrice();

        $spr = new StockPriceRecord();
        $spr->price = $last_price + 0.01;           // 累加价格
        $spr->times += 1;                           // 累加上涨次数
        $spr->updated_at = time();

        $spr->save();
    }

}
