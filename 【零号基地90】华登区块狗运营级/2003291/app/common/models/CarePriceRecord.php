<?php

namespace common\models;

use Yii;
use common\components\MTools;
/**
 * This is the model class for table "me_care_price_record".
 *
 * @property integer $id
 * @property double $price
 * @property integer $adminid
 * @property string $adminname
 * @property string $note
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 */
class CarePriceRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_care_price_record';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price'], 'required'],
            [['price'], 'number'],
            [['adminid', 'created_at', 'updated_at'], 'integer'],
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
            'id' => 'ID',
            'price' => '价格',
            'adminid' => '管理员ID',
            'adminname' => '管理员账号',
            'note' => '备注',
            'description' => '描述',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
    
    /*
     * 配置列表查询数据
     * return object
     */

    public static function getList() {
        $query = CarePriceRecord::find()->orderBy("created_at desc");
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
        $model = $id ? CarePriceRecord::findOne($id) : new CarePriceRecord();
        try {
            $model->load(Yii::$app->request->post());
            $model->adminid = Yii::$app->user->id;
            $model->adminname = Yii::$app->user->identity->username;
            $model->note = "平台管理员<font color='red'>" . Yii::$app->user->identity->username . "</font>修改当前LKC价格为<font color='red'>￥" . $model->price . "</font>";
            $model->created_at = time();
            $model->updated_at = time();
            \common\models\Actionlog::setLog('更新（新增）LKC价格');
            return MTools::saveModel($model);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
