<?php

namespace common\models;

use Yii;
use common\components\MTools;
/**
 * This is the model class for table "me_coins".
 *
 * @property integer $id
 * @property string $name
 * @property string $en_name;
 * @property string $price
 * @property integer $created_at
 * @property integer $updated_at
 */
class Coins extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_coins';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['us_price', 'price', 'baseVolume', 'percentChange'], 'number'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'en_name', 'img'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'en_name' => '英文名称',
            'us_price' => '美元价格',
            'price' => '价格',
            'baseVolume' => '成交量',
            'percentChange' => '涨跌百分比',
            'img' => '图片',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
    
    public static function getList() {
        $query = Coins::find()->orderBy("created_at desc");
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["total" => $totalCount, "data" => $res];
    }
    
    public static function createData($id = null) {
        $model = $id ? Coins::findOne($id) : new Coins();
        try {
            $model->load(Yii::$app->request->post());
            if($_FILES['Coins']['tmp_name']['img'] != ''){
                $filename = Yii::$app->imgload->UploadPhotoQn($model, 'img');
                if ($filename !== false) {
                    $model->img = $filename;
                }
            }

            $model->name = $model->name;
            $model->en_name = $model->en_name;
            $model->price = $model->price;
            $model->us_price = $model->price * 7.0000;
            $model->baseVolume = $model->baseVolume;
            $model->percentChange = $model->percentChange;
            $model->created_at = time();
            $model->updated_at = time();
            if($id){
                \common\models\Actionlog::setLog('编辑id为：'.$id.'，名称为：'.$model->name.'的货币信息');
            }else{
                \common\models\Actionlog::setLog('新增货币：'.$model->name);
            }
            return MTools::saveModel($model);
        } catch (Exception $e) {
            throw $e;
        }
    }

    // 获取数字货币信息
    public static function getCoins() {
        $coins = Coins::find()->select('id,name,en_name,price,img,us_price')->asArray()->all();

        return $coins;
    }
}
