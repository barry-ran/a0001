<?php

namespace common\models;

use Yii;
use common\components\MTools;

/**
 * This is the model class for table "me_trade_num".
 *
 * @property integer $id
 * @property integer $areaid
 * @property string $areaname
 * @property string $min
 * @property string $max
 * @property integer $created_at
 * @property integer $updated_at
 */
class TradeNum extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_trade_num';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['areaid', 'min', 'max', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'areaid' => '价格区间',
            'areaname' => '区间名称',
            'min' => '此区间最低数量',
            'max' => '此区间最高数量',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    public static $area_name = [1 => 'B1', 2 => 'B2', 3 => 'B3'];

    public static function getList() {
        
        $query = TradeNum::find();

        //$query->orderBy("created_at desc");
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        
        return ["total" => $totalCount, "data" => $res];
    }
    
    /*
     * 插入、更新数据
     * @params $data array
     * @params $id int 主键
     * return boolean 
     */

    public static function createData($id = null) {
        $model = $id ? TradeNum::findOne($id) : new TradeNum();
        try {
            $model->load(Yii::$app->request->post());

            $model->min = $model->min;
            $model->max = $model->max;
            $model->updated_at = time();
            \common\models\Actionlog::setLog('编辑id为：'.$model->id.'的交易数量');
            return MTools::saveModel($model);
        } catch (Exception $e) {
            throw $e;
        }
    }

    // 获取交易区间及最低数量、最高数量
    public static function getAreaNum() {
        $ret = TradeNum::find()->select('areaid, areaname, min, max')->asArray()->all();
        return $ret;
    }

    // 获取指定交易区间的信息
    public static function getSpecAreaInfo($areaid) {
        $ret = TradeNum::find()->select('areaid, areaname, min, max')->where('areaid=:areaid', [':areaid' => $areaid])->asArray()->one();
        return $ret;
    }

    // 根据价格及价格区间ID
    public static function isMatchNum($areaid, $num) {
        $area = TradeNum::find()->select('min   , max')->where(['areaid' => $areaid])->asArray()->one();

        // 挂单数量如果不在区间内，则返回 0，否则返回 1
        if($num < $area['min'] || $num > $area['max']) {
            return 0;
        } else {
            return 1;
        }
    }
}
