<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_user_sign".
 *
 * @property string $id
 * @property integer $userid
 * @property string $username
 * @property string $amount
 * @property integer $type
 * @property integer $freeze_id
 * @property integer $sign_time
 * @property string $ip
 * @property integer $award_id
 */
class UserSign extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_user_sign';
    }

    /**
     * @inheritdoc
     */
    public function rules() 
    {
        return [
            [['userid', 'type', 'freeze_id', 'sign_time', 'award_id'], 'integer'],
            [['amount'], 'number'],
            [['username'], 'string', 'max' => 50],
            [['ip'], 'string', 'max' => 200],
        ];
    } 

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => '用户ID',
            'username' => '用户账号',
            'amount' => '签到释放BBA数量',
            'type' => '类型',
            'freeze_id' => '挖矿记录ID',
            'sign_time' => '签到时间',
            'ip' => 'IP',
            'award_id' => '奖励表ID',
        ];
    }
    
    public static function getList() {
        $query = UserSign::find();
        $begin_at = Yii::$app->request->get("begin_at");
        $end_at = Yii::$app->request->get("end_at");
        $search = Yii::$app->request->get("search");
        
        if ($begin_at) {
            $query->andFilterWhere([">=", "sign_time", strtotime($begin_at)]);
        }
        if ($end_at) {
            $query->andFilterWhere(["<=", "sign_time", strtotime($end_at)]);
        }
        if ($search) {
                $query->andFilterWhere(["=","userid",$search]);
                $query->orFilterWhere(["like","username",$search]); 
        }

        
//        $sort = Yii::$app->request->get("sort");
//        $order = Yii::$app->request->get("order");
//        $query->orderBy($sort . " " . $order);
        $query->orderBy("sign_time desc");
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["total" => $totalCount, "data" => $res];
    }

    //  每日签到释放
    public function actionPenaward(){
        //  设置请求超时时间（0为不限制）
        set_time_limit(0);

        // 银卢呗每日释放判断，如果当日已释放将跳出流程（查询钱包流水表的even_type）
        $today = mktime(0,0,0,date('m'),date('d'),date('Y'));
        $last_record = UserWalletRecord::find()->where("event_type = 3")->orderBy("created_at desc")->one();
        if($last_record){
            if($last_record->created_at >= $today){
                echo '今日已释放';
                file_put_contents('../runtime/logs/daytimepenaward.text', '今日已释放---时间：'.date("Y-m-d H:i:s")."\r\n",FILE_APPEND);die;
            }
        }

        $ip = Yii::$app->getRequest()->getUserIP();
        if($ip != '47.52.154.54'){
//        if($ip != '127.0.0.1'){
            file_put_contents('../runtime/logs/daytimepenaward.text', '非本站ip:'.$ip.'---时间：'.date("Y-m-d H:i:s")."\r\n",FILE_APPEND);die;
        }

        $award_keys = ["userid","amount","event_type","pay_type","wallet_type","wallet_amount","note","created_at","updated_at","ip"];
        $award_data = array();

        $trans = Yii::$app->db->beginTransaction();//  事务启用
        try{
            $users = WB_User::find()->where("iseal = 0")->with(['userprofile','wallet','level'])->all();//  获取所有用户(关联用户信息及用户等级)

            $level = \common\models\Level::find()->asArray()->orderBy("id asc")->all();   // 获得所有等级

            $dayreleaseper = '';                                                     // 每日释放比例初始化

            $releasetocashper = Mtools::getYiiParams('releasetocashper');   // 每日释放到金卢呗比例
            $releasetoshopper = Mtools::getYiiParams('releasetoshopper');   // 每日释放到钻石卢呗比例

            $ip = Yii::$app->getRequest()->getUserIP();                     //  当前用户ip
            foreach ($users as $key => $val) {
                // 判断用户等级，使用对应的银卢呗释放比例
                switch($val->level_id) {
                    case 1:
                        $dayreleaseper = $level['0']['release_per'];        // 会员银卢呗释放比例
                        break;
                    case 2:
                        $dayreleaseper = $level['1']['release_per'];        // 商家银卢呗释放比例
                        break;
                    case 3:
                        $dayreleaseper = $level['2']['release_per'];        // 经纪人银卢呗释放比例
                        break;
                    case 4:
                        $dayreleaseper = $level['3']['release_per'];        // 商家、经纪人银卢呗释放比例
                    default:
                        break;
                }

                //  银卢呗释放
                if($val->wallet->hcg_wa > 1){
                    $award  = $val->wallet->hcg_wa * $dayreleaseper;
                    //  数字格式重置
                    $award = round($award,4);
                    $note = '每日银卢呗释放:'.$award;

                    $val->wallet->cash_wa += ($award * $releasetocashper / 100);    // 释放到金卢呗
                    $val->wallet->shop_wa += ($award * $releasetoshopper / 100);    // 释放到钻石卢呗
                    $val->wallet->hcg_wa -= $award;                                 // 银卢呗释放减少

                    if($val->wallet->save()){
                        //  数字格式重置
                        $val->wallet->hcg_wa = round($val->wallet->hcg_wa,4);

                        $award_data[] = [$val->id, $award, 3, 1, 1, $val->wallet->hcg_wa, $note, time(), time(), $ip];
                    }
                }
            }

            //  记录每日银卢呗释放数据
            if(count($award_data)){
                $res = \Yii::$app->db->createCommand()->batchInsert(UserWalletRecord::tableName(), $award_keys, $award_data)->execute();

            }else{
                $res = 1;
                file_put_contents('../runtime/logs/daytimepenaward.text', '每日释放没有相关数据---时间：'.date("Y-m-d H:i:s")."\r\n",FILE_APPEND);
            }
            if($res){
                $trans->commit();
                file_put_contents('../runtime/logs/daytimepenaward.text', '每日释放成功---时间：'.date("Y-m-d H:i:s")."\r\n",FILE_APPEND);
            }
        }
        catch (Exception $e) {
            $trans->rollBack();
            file_put_contents('../runtime/logs/daytimepenaward.text', '事件执行失败---时间：'.date("Y-m-d H:i:s")."\r\n",FILE_APPEND);
            throw $e;
        }
        echo "每日释放成功";
        return true;
    }

    // 插入记录
    public static function createrecord($userid,$username,$amount,$type,$freeze_id=null){
        $model = new UserSign();
        $model->userid = $userid;
        $model->username = $username;
        $model->amount = $amount;
        $model->type = $type;
        $model->freeze_id = $freeze_id;
        $model->sign_time = time();
        $model->ip = Yii::$app->request->getUserIP();

        return $model->save();
    }

}
