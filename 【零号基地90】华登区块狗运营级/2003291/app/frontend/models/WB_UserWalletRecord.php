<?php

namespace frontend\models;

/**
 * @author  shuang
 * @date    2016-12-10 21:14:06
 * @version V1.0
 * @desc    
 */
use common\models\UserWalletRecord;
use yii\behaviors\TimestampBehavior;
use Yii;
use yii\helpers\ArrayHelper;
use common\components\MTools;

class WB_UserWalletRecord extends UserWalletRecord {
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
    
    public static function getMyRecord($userid,$event_type,$wallet_type) {
        $query = WB_UserWalletRecord::find()->where("userid = :userid",[":userid"=>$userid])->orderBy("created_at desc");
        if ($event_type > 0) {
                $query->andFilterWhere(["=","event_type",$event_type]);
        }
        if ($wallet_type > 0) {
            $query->andFilterWhere(["=","wallet_type",$wallet_type]);
        }
        $countQuery = clone $query;
        $pagesize = 6;
        $pager = new \yii\data\Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => $pagesize]);
        $offset = (Yii::$app->request->get("page")-1)*$pagesize;
        $limit = Yii::$app->request->get("limit",$pagesize);
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        $temp=[];
        foreach($res as $item){
            $temp[]=[
                "created_at"=>date("Y/m/d",$item['created_at']),
                "event_type"=> self::$event_type[$item["event_type"]],
                "amount"=>$item["pay_type"]==1?$item["amount"]:"-".$item["amount"],
                "wallet_type"=>self::$wallet_type[$item["wallet_type"]],
            ];
        }
        return ["pager" => $pager, "data" => $temp];
    }
    
    public static function getRecord($userid, $page, $paytype) {
        $query = WB_UserWalletRecord::find()->where("userid = :userid && pay_type = :pay_type",[":userid"=>$userid ,":pay_type"=>$paytype])->orderBy("created_at desc");
       // $query->andWhere("userprofile.userid=:userid", [":userid" => Yii::$app->user->id]);
       // $sort = Yii::$app->request->get("sort", "me_user_award_record.updated_at");
       // $order = Yii::$app->request->get("order");
      //  $query->orderBy($sort . " " . $order);
        $countQuery = clone $query;
        $pagesize = 10;
        $pager = new \yii\data\Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => $pagesize]);
        $offset = (Yii::$app->request->get("page")-1)*$pagesize;
        $limit = Yii::$app->request->get("limit");
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["pager" => $pager, "data" => $res];
    }
    
    /*
     * 获取奖项  会员获得总量、 日期总量 
     * @params $userid
     * @params $award_type
     * @params $date
     */

    public static function getAwardCountOrDateCount($userid) {        
        $date=time();
        $start = strtotime(date("Y-m-d", $date) . " 00:00:00");
        $end = strtotime(date("Y-m-d", $date) . " 23:59:59");
        $query = new \yii\db\Query();
        $query->from(WB_UserAwardRecord::tableName());
        $query->where("userid =:userid",[":userid"=>$userid]);
        $query->andwhere(['in' , 'award_type' ,[1,2,3,4]]);
        $query->andwhere(["in","event_type",[1,2]]);
        $query->andWhere("cash_amount !=:cash_amount", [":cash_amount" => 0]);   
        $query->andWhere(['between', 'created_at',$start, $end]);
        $sun =$query->sum("amount");
        $sun =$sun?$sun:0;
        return $sun;
    }
    
    /*
     * 获取奖项  会员获得总量、 一周总量
     * @params $userid
     * @params $award_type
     * @params $date
     */
    public static function getAwardCountOrDateCountWeek($userid, $award_type) { 
        $date= time();
        $cid = \frontend\models\WB_User::find()->select("created_at")->where(["id"=>$userid])->asArray()->one();  
        $scid = strtotime(date("Y-m-d",$cid["created_at"]) . " 00:00:00");
        $mdate=strtotime(date('Y-m-d',$date) . " 00:00:10");
        $chabei = ceil(($mdate-$scid)/(24*60*60*7));           
        $dam= date("Y-m-d",$cid["created_at"]);           
        $query = new \yii\db\Query();
        $query->from(WB_UserAwardRecord::tableName());
        $query->where("award_type=:award_type", [":award_type" => $award_type]);
        $query->andWhere("userid=:userid", [":userid" => $userid]);
        $query->andWhere("cash_amount !=:cash_amount", [":cash_amount" => 0]);
        if($chabei>=2){
            $mcb =$chabei-1;
            $start = strtotime(date("Y-m-d",strtotime("$dam+$mcb week")) . " 00:00:00"); 
            $end = strtotime(date("Y-m-d",strtotime("$dam+$chabei week")) . " 00:00:00");
        }else{
            $start = strtotime(date("Y-m-d",$cid["created_at"]) . " 00:00:00");   
            $end = strtotime(date("Y-m-d",strtotime("$dam+$chabei week")) . " 00:00:00");
        }
        $query->andWhere(['between', 'created_at',$start, $end]);     
        return $query->sum("amount");                  
    }

    public static function getList() {
        $query = WB_UserAwardRecord::find()->select("me_user_award_record.*,userprofile.username")
                ->leftJoin(['userprofile' => 'me_user_profile'], 'userprofile.userid = me_user_award_record.userid');
        $search = Yii::$app->request->get("search");
        if ($search) {
            $query->andFilterWhere(['like', 'userprofile.username', $search]);
            $query->orFilterWhere(['like', 'note', $search]);
        }
        $query->andWhere("userprofile.userid=:userid", [":userid" => Yii::$app->user->id]);
        $sort = Yii::$app->request->get("sort", "me_user_award_record.updated_at");
        $order = Yii::$app->request->get("order");
        $query->orderBy($sort . " " . $order);
        $countQuery = clone $query;
        $pager = new \yii\data\Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => 10]);
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["pager" => $pager, "data" => $res];
    }
   
    public static function getSearchAccountChanges($userid){
        $cache=Yii::$app->cache;       
        $query= WB_UserAwardRecord::find()->Where("userid=$userid");
        $post=Yii::$app->request->post();
        if($post){   //缓存类型
            $award_type=$post['award_type'];
            $cache->set("award_type", $award_type,0);
            //缓存初始时间
            $starttime = strtotime(date($post['starttime']))?strtotime(date($post['starttime'])):0;

            $cache->set("data_starttime",$starttime,0);
            //缓存结束时间
            $endtime = strtotime(date($post['endtime']))?strtotime(date($post['endtime'])):time();

            $cache->set("data_endtime",$endtime,0);
                if($award_type!=-1){
                    $query->andWhere("award_type=:award_type",[":award_type"=>$award_type]);
                    if(!empty($starttime))
                    {
                        $query->andWhere("created_at > $starttime");
                    }
                    $query->andWhere("created_at <= $endtime");
                    $query->andWhere("amount >0");
                }else
                {
                    if(!empty($starttime))
                    {
                        $query->andWhere("created_at > $starttime");
                        
                    }
                    $query->andWhere("created_at <= $endtime");
                    $query->andWhere("amount >0");
            }
        }else {            
            $award_type=$cache->get("award_type");
            $starttime=$cache->get("data_starttime");
            $endtime=$cache->get("data_endtime");
                if($award_type!=-1){
                $query->andWhere("award_type=:award_type",[":award_type"=>$award_type]);
                    if(!empty($starttime))
                    {
                        $query->andWhere("created_at > $starttime");
                    }
                $query->andWhere("created_at <= $endtime");
                $query->andWhere("amount >0");
            }else{
                $query->andWhere("amount >0");
                if(!empty($starttime)){
                    $query->andWhere("created_at > $starttime");
                }
                $query->andWhere("created_at <= $endtime");
            }
        }
        $countquery= clone $query;
        $pagesize = 20;
        $pager = new \yii\data\Pagination(['totalCount' =>$countquery->count() , 'defaultPageSize' => $pagesize]);
        $offset = $pagesize * (Yii::$app->request->get("page")-1);
        $limit = Yii::$app->request->get("limit",$pagesize);
        $res = $query->offset($offset)->limit($limit)->orderBy("created_at desc")->asArray()->all();
        $temp=[];
        foreach($res as $item){
            $temp[]=[
                "created_at"=>date("Y-m-d H:i:s",$item['created_at']),
                "award_type"=> self::$award_type[$item["award_type"]],
                "pay_type"=>self::$pay_type[$item["pay_type"]],
                "note"=>$item["note"],
                "amount"=>$item["amount"],
                "cash_amount"=>$item["cash_amount"],
                "regist_amount"=>$item["regist_amount"],
                "care_amount"=>$item["care_amount"],
                "hcg_amount"=>$item["hcg_amount"],
            ];
        }
        return ["pager" => $pager, "data" =>$temp,"award_type"=>$award_type];     
    }
    public static function getAllAccountChanges($userid){
        $query= WB_UserAwardRecord::find()->where("userid=:userid",[":userid"=>$userid])->orderBy("created_at desc, id desc");
        $query->andWhere("amount>0");
        $countquery = clone $query;
        $pagesize = 20;
        $pager = new \yii\data\Pagination(['totalCount' =>$countquery->count() , 'defaultPageSize' => $pagesize]);
        $offset = $pagesize * (Yii::$app->request->get("page")-1);
        $limit = Yii::$app->request->get("limit",$pagesize);
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        $temp=[];
        foreach($res as $item){
            $temp[]=[
                "created_at"=>date("Y-m-d H:i:s",$item['created_at']),
                "award_type"=> self::$award_type[$item["award_type"]],
                "pay_type"=>self::$pay_type[$item["pay_type"]],
                "note"=>$item["note"],
                "amount"=>$item["amount"],
                "cash_amount"=>$item["cash_amount"],
                "regist_amount"=>$item["regist_amount"],
                "care_amount"=>$item["care_amount"],
                "hcg_amount"=>$item["hcg_amount"],
            ];
        }
        return ['pager'=>$pager,'data'=>$temp];
    }

    // 2018-05-18 去掉father_id查询条件
    public static function getTransferrecord($userid,$event_type){
        $query = WB_UserWalletRecord::find()->where('userid = :userid && (event_type=:event_type)',
                [':userid'=>$userid,':event_type'=>$event_type])->orderBy("created_at desc");
        $countQuery = clone $query;
        $pagesize = 6;
        $pager = new \yii\data\Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => $pagesize]);
        $offset = (Yii::$app->request->get("page")-1)*$pagesize;
        $limit = Yii::$app->request->get("limit",10);
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        $temp = [];
        foreach ($res as $item) {
            $name = \common\models\User::find()->where('id=:id',[':id'=>$item['userid']])->one();
            $temp[] = [
                "id" => $item['id'],
                "username" => $name['username'],
                "amount" => ArrayHelper::getValue($item, "amount"),
                "note" => ArrayHelper::getValue($item, "note"),
                "event_type" => MTools::setFontColor($item['event_type'], \frontend\models\WB_UserWalletRecord::$event_type[$item['event_type']]),
                "pay_type" => MTools::setFontColor($item['pay_type'],\frontend\models\WB_UserWalletRecord::$pay_type[$item['pay_type']]),
                "wallet_type" => MTools::setFontColor($item['wallet_type'],\frontend\models\WB_UserWalletRecord::$wallet_type[$item['wallet_type']]),
                "created_at" => Yii::$app->formatter->asDatetime($item['created_at'])
            ];
        }
        return ["pager" => $pager, "data" => $temp];
    }
    
    public static function getsubaccount(){
        $user = Yii::$app->user->identity;
        $sonuser = \backend\models\MY_User::find()->with(["wallet"])->where('username like :username',[":username"=>'%'.$user->username.'-'.'%']);
        $countQuery = clone $sonuser;
        $pagesize = 10;
        $pager = new \yii\data\Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => $pagesize]);
        $offset = (Yii::$app->request->get("page")-1)*$pagesize;
        $limit = Yii::$app->request->get("limit",10);
        $res = $sonuser->offset($offset)->limit($limit)->asArray()->all();
        //找出子账号的regist_wa字段
        $temp=[];
        for($i = 0;$i < count($res);$i++){
            $temp[$i]['id'] = $res[$i]['id'];
            $temp[$i]['username'] = $res[$i]['username'];
            $temp[$i]['regist_wa'] = $res[$i]['wallet']['regist_wa'];
        }
        return ["pager" => $pager, "data" => $temp];
    }

    /**
     * 获取钱包记录列表
     * @param $userid   用户id
     * @param $event_type   事件类型
     * @param $wallet_type  钱包类型
     * @param $page     当前页
     * @return array|\yii\db\ActiveRecord[]     AR类型
     * @throws \yii\base\InvalidConfigException
     */
    public static function getWalletRecordLoad($userid,$event_type,$wallet_type,$page){
        $query = WB_UserWalletRecord::find()->where("userid = :userid && status=1",[":userid"=>$userid])->orderBy("created_at desc");

        //条件筛选
        if ($event_type > 0) {
            $query->andFilterWhere(["=","event_type",$event_type]);
        }
        if ($wallet_type > 0) {
            $query->andFilterWhere(["=","wallet_type",$wallet_type]);
        }
        //排序
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'created_at';
        $order = isset($_GET['order']) ? $_GET['order'] : 'desc';
        $query->orderBy($sort . " " . $order);
        //一页显示几条
        $pagesize = 10;

        //从第几条开始显示 0
        $offset = ($page - 1)*$pagesize;

        //限制条数
        $limit = Yii::$app->request->get("limit", $pagesize);
        $res = $query->offset($offset)->limit($limit)->asArray()->all();

//        for($i = 0;$i < count($res);$i++){
//            //转换时间格式
//            $res[$i]['created_at'] = Yii::$app->formatter->asDatetime($res[$i]["created_at"]);
//            //显示事件类型名称
//            $event_type = self::$event_type[$res[$i]["event_type"]];
//
//            //显示钱包类型名称
//            $wallet_type = self::$wallet_type[$res[$i]["wallet_type"]];
//
//            //显示是支出还是收入
//            if($res[$i]['pay_type'] == 2){
//                $res[$i]['amount'] = '-'.$res[$i]['amount'];
//            }else{
//                $res[$i]['amount'] = '+'.$res[$i]['amount'];
//            }
//
////            //如果是系统交易订单
////            if($res[$i]["event_type"] == 3){                                                       // 事件类型, 3: 交易
////                if($res[$i]["wallet_type"] == 1){                                                  // 钱包类型, 1: 积分
////                    $res[$i]['event_type'] = Yii::t('app', '卢宝买入获得卢呗');
////                }elseif($res[$i]["wallet_type"] == 2){                                             // 钱包类型, 2: 余额
////                    if($res[$i]['pay_type'] == 2){                                                 // 收支类型, 2: 出账
////                        if(strpos($res[$i]['note'], '买入LKC')) {
////                            $res[$i]['event_type'] = Yii::t('app', '买入LKC支出');
////                        } elseif(strpos($res[$i]['note'], '线下交易卖出卢宝')) {
////                            $res[$i]['event_type'] = Yii::t('app', '卢宝卖出');
////                        } else {
////                            $res[$i]['event_type'] = Yii::t('app', 'LKC挂买冻结');
////                        }
////                    }else{                                                                         // 收支类型, 1: 入账
////                        if(strpos($res[$i]['note'], '卢宝挂卖取消订单') || strpos($res[$i]['note'], '返还卢宝')) {
////                            $res[$i]['event_type'] = Yii::t('app', '取消订单,卢宝退回');
////                        } elseif(strpos($res[$i]['note'], '卖出LKC')) {
////                            $res[$i]['event_type'] = Yii::t('app', '卖出LKC收入');
////                        } elseif(strpos($res[$i]['note'], '线下交易买入卢宝')) {
////                            $res[$i]['event_type'] = Yii::t('app', '卢宝买入');
////                        } else {
////                            $res[$i]['event_type'] = Yii::t('app', 'LKC挂买撤单');
////                        }
////                    }
////                }else{                                                                             // 钱包类型, 3: LKC
////                    $res[$i]['event_type'] = Yii::t('app', 'LKC交易');
////                }
////            }elseif($res[$i]["event_type"] == 6){
////                if($res[$i]["wallet_type"] == 1){
////                    if($res[$i]['pay_type'] == 2){
////                        $res[$i]['event_type'] = Yii::t('app', '卢呗转出');
////                    }else{
////                        $res[$i]['event_type'] = Yii::t('app', '卢呗转入');
////                    }
////                }elseif($res[$i]["wallet_type"] == 2){
////                    if($res[$i]['pay_type'] == 2){
////                        $res[$i]['event_type'] = Yii::t('app', '卢宝转出');
////                    }else{
////                        $res[$i]['event_type'] = Yii::t('app', '卢宝转入');
////                    }
////                }
////
////            }else{
////                $res[$i]['event_type'] = Yii::t('app', $event_type);
////            }
//
//
//
//            $res[$i]['wallet_type'] = Yii::t('app', $wallet_type);
//            $res[$i]['btn'] = Yii::t('app', '查看详情');
//        }
        for($i = 0;$i < count($res);$i++){
            $res[$i]['created_at'] = date('Y/m/d H:i:s',$res[$i]["created_at"]);
            $res[$i]['event_type'] = $res[$i]["event_type"];
            $res[$i]['event_type_name'] = self::$event_type[$res[$i]["event_type"]];
            $res[$i]['wallet_type'] = $res[$i]["wallet_type"];
            $res[$i]['wallet_type_name'] = self::$wallet_type[$res[$i]["wallet_type"]];
            $res[$i]['amount'] = $res[$i]["pay_type"]==1?$res[$i]["amount"]:"-".$res[$i]["amount"];
            $res[$i]['event_type'] = Yii::t('app', $res[$i]['event_type']);
            $res[$i]['wallet_type'] = Yii::t('app', $res[$i]['wallet_type']);
        }
        return $res;
    }

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
        $Record->ip = Yii::$app->getRequest()->getUserIP();

        return $Record->save();
    }

    // 插入钱包记录
    public static function nsinsertrecord($userid,$amount,$event_type,$pay_type,$wallet_type,$wallet_amount,$note){
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
        $Record->ip = Yii::$app->getRequest()->getUserIP();

        return $Record;
    }
}
