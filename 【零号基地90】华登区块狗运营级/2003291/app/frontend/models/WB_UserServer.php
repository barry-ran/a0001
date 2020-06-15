<?php

namespace frontend\models;

/**
 * @author  shuang
 * @date    2016-12-15 15:57:51
 * @version V1.0
 * @desc    
 */
use common\models\UserServer;
use common\models\UserWalletRecord;
use yii\behaviors\TimestampBehavior;
use Yii;
class WB_UserServer extends UserServer{
    /*
     * 设置表操作行为动作
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

    public static function getList($userid) {
        $query = WB_UserServer::find()->where("userid=:userid",[":userid"=>$userid])->orderBy("replayd_at desc");
        $countQuery = clone $query;
        $pagesize = 10;
        $pager = new \yii\data\Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => $pagesize]);
        $offset = (Yii::$app->request->get("offset")-1) * $pagesize;
        $limit = Yii::$app->request->get("limit",$pagesize);
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        
        return ["pager" => $pager, "data" => $res];
    }
    public static function getOutRecord($userid) {
        $query = WB_UserServer::find()->where("userid=:userid",[":userid"=>$userid])->orderBy("created_at desc");
        $countQuery = clone $query;
        $pagesize = 8;
        $pager = new \yii\data\Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => $pagesize]);
        $offset = (Yii::$app->request->get("page")-1)*$pagesize;
        $limit = Yii::$app->request->get("limit", $pagesize);
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
      
        return ["pager" => $pager, "data" => $res];
    }

    /**
     * 获取建议记录
     * @param $userid   用户ID
     * @param $page     当前页
     * @param string $type  获取建议类型
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getOutRecordLoad($userid,$page,$type = ''){
        if($type){
            $query = WB_UserServer::find()->where("userid = :userid and type = :type",[":userid"=>$userid, ':type' => $type])->orderBy("created_at desc");
        }else{
            $query = WB_UserServer::find()->where("userid = :userid and type != 4",[":userid"=>$userid ])->orderBy("created_at desc");
        }


        $pagesize = 10;
        $offset = ($page - 1)*$pagesize;
        $limit = Yii::$app->request->get("limit", $pagesize);
        $res = $query->offset($offset)->limit($limit)->asArray()->all();

        for($i = 0;$i < count($res);$i++){
            //转化时间格式
            $res[$i]['created_at'] = date('Y/m/d',$res[$i]["created_at"]);
            if($res[$i]['type'] == 1){
                $res[$i]['type'] = Yii::t('app', '我的建议');
            }elseif($res[$i]['type'] == 2){
                $res[$i]['type'] = Yii::t('app', '超时申请');
            }elseif($res[$i]['type'] == 3){
                $res[$i]['type'] = Yii::t('app', '卖家申诉');
            }else{
                $res[$i]['type'] = Yii::t('app', '客服联系');
            }
        }
        
        return $res;
    }
}
