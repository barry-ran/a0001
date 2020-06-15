<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\components\MTools;
/**
 * This is the model class for table "me_sell_care".
 *
 * @property integer $id
 * @property string $sell_num
 * @property string $remain_num
 * @property integer $admin_id
 * @property string $admin_name
 * @property string $price
 * @property string $note
 * @property string $ip
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $branch_id
 */
class SellCare extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_sell_care';
    }

    /**
     * @inheritdoc
     */
    public function rules() 
    { 
        return [
            [['sell_num', 'remain_num', 'lv_limit', 'lv0_limit', 'lv1_limit', 'lv2_limit', 'lv3_limit'], 'number'],
            [['admin_id', 'sell_time', 'end_time'], 'required'],
            [['admin_id', 'status', 'sell_time', 'end_time', 'created_at', 'updated_at', 'branch_id'], 'integer'],
            [['note'], 'string'],
            [['img'], 'string', 'max' => 250],
            [['admin_name'], 'string', 'max' => 50],
            [['ip'], 'string', 'max' => 100],
        ]; 
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img' => '图片',
            'sell_num' => '出售数量',
            'remain_num' => '剩余数量',
            'admin_id' => '管理员ID',
            'admin_name' => '管理员账号',
            'note' => '备注',
            'ip' => 'Ip',
            'status' => '状态',
            'sell_time' => '出售时间',
            'lv_limit' => '免费会员购买额度',
            'lv0_limit' => 'Lv0会员购买额度',
            'lv1_limit' => 'Lv1会员购买额度',
            'lv2_limit' => 'Lv2会员购买额度',
            'lv3_limit' => 'Lv3会员购买额度',
            'end_time' => '结束时间',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'branch_id' => '分公司ID',
        ];
    }
    
    /*
    * 配置列表查询数据
    * return object
    */

    public static function getList() {
        $query = SellCare::find();
        
        $begin_at = Yii::$app->request->get("begin_at");
        $end_at = Yii::$app->request->get("end_at");
        $status = Yii::$app->request->get("status");
        
        if ($begin_at) {
            $query->andFilterWhere([">=", "sell_time", strtotime($begin_at)]);
        }
        if ($end_at) {
            $query->andFilterWhere(["<=", "sell_time", strtotime($end_at)]);
        }
        if ($status) {
            $query->andFilterWhere(["=","status",$status]);
        }
        if(Yii::$app->user->identity->branch_id > 0){
            $query->andFilterWhere(["=","branch_id",Yii::$app->user->identity->branch_id]);
        }

        $query->orderBy("created_at desc");
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit",10);
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
        $model = $id ? SellCare::findOne($id) : new SellCare();
        $branch_id = Yii::$app->user->identity->branch_id;
        try {
            $model->load(Yii::$app->request->post());
            $filename = Yii::$app->imgload->UploadPhoto($model, 'img');
            if ($filename !== false) {
                $model->img = $filename;
            }
            
            $sell_time_date = $model->sell_time;
            $year=((int)substr($sell_time_date,0,4));//取得年份；
            $month=((int)substr($sell_time_date,5,2));//取得月份；
            $day=((int)substr($sell_time_date,8,2));//取得几号；
            $sell_time = mktime(0,0,0,$month,$day,$year);
            
            $end_time_date = $model->end_time;
            $year1 = ((int)substr($end_time_date,0,4));//取得年份；
            $month1 = ((int)substr($end_time_date,5,2));//取得月份；
            $day1 = ((int)substr($end_time_date,8,2));//取得几号；
            $end_time = mktime(0,0,0,$month1,$day1,$year1);
            
            $model->ip = Yii::$app->getRequest()->getUserIP();
            $model->admin_id = Yii::$app->user->id;
            $model->remain_num = $model->sell_num;
            $model->sell_time = $sell_time;
            $model->end_time = $end_time;
            $model->status = $sell_time>time()?1:2;
            $model->admin_name = Yii::$app->user->identity->username;
            $model->note = "平台管理员<font color='red'>" . Yii::$app->user->identity->username . "</font>出售<font color='red'>".$model->sell_num."</font>LKC";
            $model->created_at = time();
            $model->updated_at = time();
            $model->branch_id = $branch_id>0?$branch_id:0;
            \common\models\Actionlog::setLog('出售LKC');
            return MTools::saveModel($model);
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    public static $status = [ 1 => '预热中', 2 => '进行中', 3 => '已结束' ];
}
