<?php

namespace frontend\models;

/**
 * @author  shuang
 * @date    2016-12-10 21:14:06
 * @version V1.0
 * @desc    
 */
use common\components\MTools;
use common\models\UserTransform;
use common\models\UserWalletRecord;
use yii\behaviors\TimestampBehavior;
use Yii;

class WB_UserTransform extends UserTransform {
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
        1 => "转让", 2 => "挂售返回卢呗", 3 => "卢宝兑换卢呗"
    ];

    public static $wallet_type = [
        1 => "RMB（中国）",
    ];
    //    获取转让记录
    public static function getMyRecord($userid,$pay_type) {
        if(!$pay_type){
            $query = WB_UserTransform::find()->where("out_userid=:out_userid || in_userid=:in_userid",[":in_userid"=>$userid,":out_userid"=>$userid]);
        }else{
            if($pay_type == 1){
                $query = WB_UserTransform::find()->where("in_userid=:in_userid",[":in_userid"=>$userid]);
            }else{
                $query = WB_UserTransform::find()->where("out_userid=:out_userid",[":out_userid"=>$userid]);
            }
        }
        
        $countQuery = clone $query;
        $pagesize = 10;
        $pager = new \yii\data\Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => $pagesize]);
        $offset = (Yii::$app->request->get("page")-1)*$pagesize;
        $limit = Yii::$app->request->get("limit", $pagesize);
        $query->orderBy('created_at desc');
        $res = $query->offset($offset)->limit($limit)->all();

        $temp = [];
        foreach($res as $key=>$val){
            if($userid == $val->out_userid){
                $temp[$key]['username'] = $val->in_username;
                //获取头像
                $temp[$key]['userid'] = $val->in_userid;
                $icon = WB_UserProfile::find()->where("userid=:userid",[':userid'=>$val->in_userid])->select('icon')->one();
                $temp[$key]['icon'] = $icon->icon;
                $temp[$key]['amount'] = '-'.$val->amount;
            }else{
                $temp[$key]['username'] = $val->out_username;
                $temp[$key]['userid'] = $val->out_userid;
                $icon = WB_UserProfile::find()->where("userid=:userid",[':userid'=>$val->out_userid])->select('icon')->one();
                $temp[$key]['icon'] = $icon->icon;
                $temp[$key]['amount'] = $val->amount;
            }
           $temp[$key]['created_at'] = Yii::$app->formatter->asDatetime($val->created_at);
        }
        
        return ["pager" => $pager, "data" => $temp];
    }
    //    获取转入记录
    public static function getInRecord($userid) {
        $query = (new \yii\db\Query())
            ->select('b.icon, b.userid, b.username, a.amount, a.created_at')
            ->from('me_user_transform AS a')
            ->leftJoin('me_user_profile AS b', 'a.out_userid = b.userid')
            ->where('a.in_userid=:in_userid && a.event_type=1', [":in_userid" => $userid])
            ->orderBy('a.created_at desc')
        ;

        $countQuery = clone $query;
        $pagesize = 10;
        $pager = new \yii\data\Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => $pagesize]);
        $offset = (Yii::$app->request->get("page")-1)*$pagesize;
        $limit = Yii::$app->request->get("limit", 10);
        $res = $query->offset($offset)->limit($limit)->all();
        //  将class转换成数组
        $res = json_decode(json_encode($res), true);
        for($i = 0;$i < count($res);$i++){
            $res[$i]['amount'] = '+'.$res[$i]['amount'];
            $res[$i]['created_at'] = Yii::$app->formatter->asDatetime($res[$i]['created_at']);
        }
        return ["pager" => $pager, "data" => $res];
    }

    public static function getSendoutRecordLoad($userid,$pay_type,$page){

        if($pay_type == 1){
            $query = WB_UserTransform::find()->where("in_userid=:in_userid",[":in_userid"=>$userid]);
        }else{
            $query = WB_UserTransform::find()->where("out_userid=:out_userid",[":out_userid"=>$userid]);
        }

        $pagesize = 10;

        $offset = ($page - 1)*$pagesize;
        $limit = Yii::$app->request->get("limit", $pagesize);
        $query->orderBy('created_at desc');
        $res = $query->offset($offset)->limit($limit)->all();

        $temp = [];
        foreach($res as $key=>$val){
            if($userid == $val->out_userid){
                $temp[$key]['username'] = $val->in_username;
                $temp[$key]['userid'] = "UID:".$val->in_userid;
                $icon = WB_UserProfile::find()->where("userid=:userid",[':userid'=>$val->in_userid])->select('icon')->one();
                $temp[$key]['icon'] = $icon->icon;
                $temp[$key]['amount'] = '-'.$val->amount;
            }else{
                $temp[$key]['username'] = $val->out_username;
                $temp[$key]['userid'] = "UID:".$val->out_userid;
                $icon = WB_UserProfile::find()->where("userid=:userid",[':userid'=>$val->out_userid])->select('icon')->one();
                $temp[$key]['icon'] = $icon->icon;
                $temp[$key]['amount'] = $val->amount;
            }
           $temp[$key]['created_at'] = Yii::$app->formatter->asDatetime($val->created_at);
        }
        return $temp;
    }
}
