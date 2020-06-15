<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\components\MTools;
/**
 * This is the model class for table "me_car".
 *
 * @property integer $id
 * @property string $name
 * @property string $img
 * @property string $level
 * @property string $out_times
 * @property string $price
 * @property string $award_per
 * @property integer $created_at
 * @property integer $updated_at
 */
class Car extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_car';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['out_times', 'created_at', 'updated_at'], 'integer'],
            [['price', 'award_per'], 'number'],
            [['name', 'en_name', 'img'], 'string', 'max' => 200],
            [['level'], 'string', 'max' => 50],
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
            'img' => '加速器图片',
            'level' => '等级',
            'out_times' => '过期天数',
            'price' => '价格',
            'award_per' => '加速释放比例',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
    
    public static function getList() {
        
        $query = Car::find();

        $query->orderBy("created_at desc");
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
        $model = $id ? Car::findOne($id) : new Car();
        try {
            $model->load(Yii::$app->request->post());
            $filename = Yii::$app->imgload->UploadPhoto($model, 'img');
            if ($filename !== false) {
                $model->img = $filename;
            }
            $model->name = $model->name;
            $model->en_name = $model->en_name;
            $model->level = $model->level;
            $model->price = $model->price;
            $model->out_times = $model->out_times;
            $model->award_per = $model->award_per / 100;
            \common\models\Actionlog::setLog('修改id为：'.$model->id.'，名称为：'.$model->name.'，的加速器');
            return MTools::saveModel($model);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
