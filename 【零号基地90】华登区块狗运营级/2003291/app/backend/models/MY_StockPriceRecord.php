<?php

namespace backend\models;

/**
 * @author  shuang
 * @date    2016-12-15 10:53:57
 * @version V1.0
 * @desc    
 */
use common\models\StockPriceRecord;
use Yii;
use yii\behaviors\TimestampBehavior;
use common\components\MTools;

class MY_StockPriceRecord extends StockPriceRecord {
    /*
     * 设置表操作行为动作
     * return array
     */

    public function behaviors() {
        return[
            [
                'class' => TimestampBehavior::className()
            ]
        ];
    }

    /*
     * 配置列表查询数据
     * return object
     */

    public static function getList() {
        $query = MY_StockPriceRecord::find()->orderBy("created_at desc");
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
        $model = $id ? MY_StockPriceRecord::findOne($id) : new MY_StockPriceRecord();
        try {
            $model->load(Yii::$app->request->post());
            $model->adminid = Yii::$app->user->id;
            $model->adminname = Yii::$app->user->identity->username;
            $model->note = "平台管理员<font color='red'>" . Yii::$app->user->identity->username . "</font>修改当前BBA价格为<font color='red'>￥" . $model->price . "</font>";
            \common\models\Actionlog::setLog('更新（新增）BBA价格');
            return MTools::saveModel($model);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /*
     * 查询股票的当前价格
     */

    public static function searchStockCurrentPrice() {
        $result = MY_StockPriceRecord::find()->orderBy("created_at desc")->one();
        if ($result instanceof MY_StockPriceRecord) {
            return $result->price;
        }
    }

    /*
     * 查询股票的昨日价格
     */

    public static function searchStockYestPrice() {
        $result = MY_StockPriceRecord::find()->orderBy("created_at desc")->limit(2)->asArray()->all();
        if (count($result) == 2) {
            return Yii::$app->formatter->asDecimal(\yii\helpers\ArrayHelper::getValue($result, "1.price"));
        } else {
            return Yii::$app->formatter->asDecimal(0);
        }
    }

}
