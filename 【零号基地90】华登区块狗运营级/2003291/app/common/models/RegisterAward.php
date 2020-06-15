<?php

namespace common\models;

use Yii;
use common\components\MTools;

/**
 * This is the model class for table "me_register_award".
 *
 * @property integer $id
 * @property integer $number
 * @property string $present_integral
 * @property integer $created_at
 * @property integer $updated_at
 */
class RegisterAward extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_register_award';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'number', 'created_at', 'updated_at'], 'integer'],
            [['present_integral'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => '推荐人数 ',
            'present_integral' => '赠送卢呗数量',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    /*
    * 配置列表查询数据
    * return object
    */

    public static function getList() {
        $query = RegisterAward::find();
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
        $model = $id ? RegisterAward::findOne($id) : new RegisterAward();
        try {
            $model->load(Yii::$app->request->post());

            $model->number = $model->number;
            $model->present_integral = $model->present_integral;
            $model->updated_at = time();
            \common\models\Actionlog::setLog('编辑id为：'.$model->id.'的推荐人数或赠送卢呗数量');
            return MTools::saveModel($model);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
