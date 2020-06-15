<?php

namespace common\models;

use Yii;
use common\components\MTools;
/**
 * This is the model class for table "me_user_car".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $username
 * @property integer $car_id
 * @property string $car_name
 * @property string $car_level
 * @property string $car_img
 * @property string $car_price
 * @property integer $out_num
 * @property integer $get_num
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $ip
 */
class UserCar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_user_car';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'car_id'], 'required'],
            [['userid', 'car_id', 'out_num', 'get_num', 'status', 'created_at', 'updated_at'], 'integer'],
            [['car_price', 'award_per'], 'number'],
            [['username', 'car_name', 'en_car_name', 'car_level', 'ip'], 'string', 'max' => 50],
            [['car_img'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => '会员ID',
            'username' => '会员账号',
            'car_id' => '加速器ID',
            'car_name' => '加速器名称',
            'en_car_name' => '英文名称',
            'car_level' => '加速器等级',
            'car_img' => '加速器图片',
            'car_price' => '购买价格',
            'out_num' => '过期天数',
            'get_num' => '已加速天数',
            'award_per' => '加速比例',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'ip' => 'IP',
        ];
    }
    
    public static function getList() {
        $query = UserCar::find();
        $begin_at = Yii::$app->request->get("begin_at");
        $end_at = Yii::$app->request->get("end_at");
        $search = Yii::$app->request->get("search");
        $car_id = Yii::$app->request->get("car_id");
        
        if ($car_id > 0) {
            $query->andFilterWhere(["=", "car_id", $car_id]);
        }
        if ($begin_at) {
            $query->andFilterWhere([">=", "created_at", strtotime($begin_at)]);
        }
        if ($end_at) {
            $query->andFilterWhere(["<=", "created_at", strtotime($end_at)]);
        }
        if ($search) {
                $query->andFilterWhere(["like","userid",$search]);
                $query->orFilterWhere(["like","username",$search]); 
        }
       
        $query->orderBy('created_at desc');
//        $sort = Yii::$app->request->get("sort");
//        $order = Yii::$app->request->get("order");
//        $query->orderBy($sort . " " . $order);
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        
        return ["total" => $totalCount, "data" => $res];
    }
    
    
    public static function getMyCar($userid,$language) {//获取我的转入记录
        $query = UserCar::find()->where("userid = :userid",[":userid"=>$userid ])->orderBy("created_at desc");
        
        $countQuery = clone $query;
        $pagesize = 10;
        $pager = new \yii\data\Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => $pagesize]);
        $offset = (Yii::$app->request->get("page")-1)*$pagesize;
        $limit = Yii::$app->request->get("limit",10);
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        $backimgsrc = MTools::getYiiParams('adminimagepath');
        foreach($res as $key=>$val){
            $res[$key]['car_img'] = $backimgsrc.'/'.$val['car_img'];
            if($language == 'en_US'){
                $res[$key]['car_name'] = $val['en_car_name'];
            }
        }
        //var_dump($limit);die;
        return ["pager" => $pager, "data" => $res];
    }
    
    public static $status = [0 => '正常', 1 => '已过期'];
}
