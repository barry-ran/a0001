<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_user_wallet_record".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $amount
 * @property integer $event_type
 * @property integer $pay_type
 * @property integer $wallet_type
 * @property string $wallet_amount
 * @property string $note
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $ip
 * @property string $father_id (already delete）
 */
class UserWalletRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_user_wallet_record';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'amount', 'event_type', 'pay_type', 'wallet_type'], 'required'],
            [['userid', 'event_type', 'pay_type', 'wallet_type', 'created_at', 'updated_at','branch_id'], 'integer'],
            [['amount', 'wallet_amount'], 'number'],
            [['note'], 'string', 'max' => 255],
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
            'userid' =>  Yii::t('app', '会员ID'),
            'amount' =>  Yii::t('app', '发生金额'),
            'event_type' =>  Yii::t('app', '事件类型'),
            'pay_type' =>  Yii::t('app', '交易类型'),
            'wallet_type' =>  Yii::t('app', '钱包类型'),
            'wallet_amount' =>  Yii::t('app', '钱包总额'),
            'note' =>  Yii::t('app', '描述'),
            'created_at' =>  Yii::t('app', '创建时间'),
            'updated_at' =>  Yii::t('app', '更新时间'),
            'ip' =>  Yii::t('app', '当前IP'),
        ];
    }
    
    public static function getList() {
        $query = UserWalletRecord::find()->with(["user"]);
        //开始时间
        $begin_at = Yii::$app->request->get("begin_at");
        //结束时间
        $end_at = Yii::$app->request->get("end_at");
        //搜索框
        $search = Yii::$app->request->get("search");
        //交易类型
        $pay_type = Yii::$app->request->get("pay_type");
        //钱包类型
        $wallet_type = Yii::$app->request->get("wallet_type");
        //事件类型
        $event_type = Yii::$app->request->get("event_type");
        $user = User::find()->where('username = :username',[':username'=>$search])->one();
        if($user){
            $search = $user->id;
        }
//        $userpro = UserProfile::find()->where('phone = :phone',[':phone'=>$search])->one();
//        if($userpro){
//            $search = $userpro->userid;
//        }

        if ($search) {
            $query->andFilterWhere(["=","userid",$search]);
//                $query->orFilterWhere(["like","username",$search]);
        }
        
        if ($begin_at) {
            $query->andFilterWhere([">=", "created_at", strtotime($begin_at)]);
        }
        if ($end_at) {
            $query->andFilterWhere(["<=", "created_at", strtotime($end_at)]);
        }

        if ($pay_type) {
            $query->andFilterWhere(["=","pay_type",$pay_type]);
        }
        if ($wallet_type) {
            $query->andFilterWhere(["=","wallet_type",$wallet_type]);
        }
        if ($event_type) {
            $query->andFilterWhere(["=","event_type",$event_type]);
        }

        if(Yii::$app->user->identity->branch_id > 0){
            if(Yii::$app->user->identity->branch_id == '1863'){
                $query->andFilterWhere(["in", "branch_id", ['1863', '1872', '1875', '1889']]);
            }else {
                $query->andFilterWhere(["=","branch_id",Yii::$app->user->identity->branch_id]);
            }
        }
        
//        $sort = Yii::$app->request->get("sort");
//        $order = Yii::$app->request->get("order");
//        $query->orderBy($sort . " " . $order);created_at
        $query->orderBy("id desc");
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $mysql = $countQuery->createCommand()->getRawSql();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["total" => $totalCount, "data" => $res];
    }
    
    /*
     * 关联会员
     */

    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'userid']);
    }


    public static $event_type = [
        0 => '全部', 1 => "系统拨发", 2 => "系统扣除", 3 => "在线充值转换积分",4 => "积分转出",5 => "推广收益提取",6 => "预约冻结积分",7 =>"获得推广收益",8 =>"预约扣除手续费",
        9=>"抢购冻结积分",10=>"抢购失败返还积分",11=>'系统发售宠物',12=>'积分转入'
    ];
    public static $pay_type = [
        1 => "入账", 2 => "出账"
    ];
    public static $wallet_type = [
        0 => '全部', 1 => "积分", 2 => 'GTC' , 3 => '推广收益'
    ];

    // 插入钱包记录
    public static function insertrecord($userid,$amount,$event_type,$pay_type,$wallet_type,$wallet_amount,$note){
        $Record = new UserWalletRecord();
        $Record->userid = $userid;                               // 用户id
        $Record->amount = $amount;                               // 发生金额
        $Record->event_type = $event_type;                       // 事件类型
        $Record->pay_type = $pay_type;                           // 交易类型
        $Record->wallet_type = $wallet_type;                     // 钱包类型
        $Record->wallet_amount = $wallet_amount;                 // 钱包总额
        $Record->note = $note;                                   // 备注
        $Record->created_at = time();                            // 创建时间
        $Record->updated_at = time();                            // 更新时间
//        $Record->ip = Yii::$app->getRequest()->getUserIP();
        $Record->ip = Yii::$app->getRequest()->getUserIP();
        return $Record->save();
    }

    /**
     * @param $userid
     * @param $page
     * @param $type 1挖矿总收益，2分享收益，3晋级收益，4永久区，5自由区
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getmyrecord($userid,$page,$type){

        $where = '( userid = :userid';
        //获取挖矿总收益
        if($type=='1'){
            $where =$where .''. ' and pay_type = 1 and (event_type = 17)';
        }
        //分享收益
        if($type=='2'){
            $where = $where .''. ' and pay_type = 1 and (event_type = 14 || event_type = 30)';
        }
        //晋级收益
        if($type=='3'){
            $where = $where .''. ' and pay_type = 1 and event_type = 28';
        }
        //永久区
        if($type=='4'){
            $where = $where .''. ' and pay_type = 1 and event_type = 29';
        }
        //自由区
        if($type=='5'){
            $where = $where .''. ' and pay_type = 1 and (event_type = 16 || event_type = 17 || event_type = 18 || event_type = 23)';
        }
        $where = $where .')';
        $query = UserWalletRecord::find()->where($where,[":userid"=>$userid ])->orderBy("created_at desc");
        $pagesize = 10;
        $offset = ($page - 1)*$pagesize;
        $limit = Yii::$app->request->get("limit", $pagesize);
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return $res;
    }

    // 获取所有事件类型
    public static function getEventType(){
        $all_wallet = \frontend\models\WB_UserWalletRecord::$event_type;
        unset($all_wallet[0]);
        $event_type = array();
        $i = 0;
        foreach ($all_wallet as $key=>$val){
            $event_type[$i]['id'] = $key;
            $event_type[$i]['name'] = $val;
            $i++;
        }
        return $event_type;
    }
}
