<?php

namespace common\models;
use frontend\models\WB_User;
use frontend\models\WB_UserWalletRecord;
use common\components\MTools;
use Yii;

/**
 * This is the model class for table "me_lt_award".
 *
 * @property integer $id
 * @property integer $layer_num
 * @property string $award_per
 * @property integer $updated_at
 */
class LtAward extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_lt_award';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['layer_num', 'updated_at'], 'integer'],
            [['award_per'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'layer_num' => '代数',
            'award_per' => '静态收益百分比',
            'updated_at' => '更新时间',
        ];
    }
    
    public static function getList() {
        $query = LtAward::find();
        //$query->orderBy("created_at desc");
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
        $model = $id ? LtAward::findOne($id) : new LtAward();
        try {
            $model->load(Yii::$app->request->post());

            $model->award_per = $model->award_per / 100;
            $model->updated_at = time();
            \common\models\Actionlog::setLog('修改id为：'.$model->id.'，的直推静态收益配置');
            return MTools::saveModel($model);
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    public static function setAward0($out_user,$out_num){//发放流通奖励
        if($out_user->userprofile->referrerid > 0){
            $refer_user = WB_User::findOne($out_user->userprofile->referrerid);
        }else{
            return true;
        }
        $i = 0;
        $minhcg = MTools::getYiiParams('minhcg')?MTools::getYiiParams('minhcg'):0;
        $vipminhcg = MTools::getYiiParams('vipminhcg');//vip用户最低卢呗数
        $vipgetuser = MTools::getYiiParams('vipgetuser');
        $vipgetuserper = $vipgetuser / 100;//vip用户获得奖励比例（普通会员）
        $vipgetvip = MTools::getYiiParams('vipgetvip');
        $vipgetvipper = $vipgetvip / 100;//vip用户获得奖励比例（vip会员）
        
        if($out_user->grade == 1){
            $vip_award = $out_num * $vipgetvipper;
            $vip_not = '伞下vip会员'.$out_user->username.'卢宝流通（'.$out_num.'）获得vip奖励';
        }else{
            $vip_award = $out_num * $vipgetuserper;
            $vip_not = '伞下会员'.$out_user->username.'卢宝流通（'.$out_num.'）获得vip奖励';
        }
        
        while (true){
            $i++;
            if($i > 15){
                break;
            }
            //获取上级会员
            $up_user = $refer_user;
            if(!$up_user){//无上级会员，结束循环
                break;
            }else{
                if($up_user->isactivate != 1){//上级会员无效，跳过，进入下一循环
                    if($up_user->userprofile->referrerid > 0){
                        $refer_user = WB_User::findOne($up_user->userprofile->referrerid);
                    }else{
                        break;
                    }
                    continue;
                }
            }
            //vip奖励
            if($up_user->grade == 1 && $vip_award > 0){
                $up_user->wallet->hcg_wa = $up_user->wallet->hcg_wa + $vip_award;
                if($up_user->wallet->save()){
                    self::Createwalletrecord($up_user->id, $vip_award, 21, 1, 1, $up_user->wallet->hcg_wa, $vip_not);
                }
            }
            //获取上级总推荐有效人数（流通奖励）
            $down_count = WB_User::find()->where("isactivate=1 && invite_code=:invite_code",[":invite_code"=>$up_user->mycode])->count();
            if($down_count > 0){//获取奖励等级
                $ztsl_tab = LtAward::find()->where("common_num<=:common_num",[":common_num"=>$down_count])->orderBy("common_num desc")->one();
                if(!$ztsl_tab || $ztsl_tab->layer_num < $i){//奖励等级不存在，跳过，进入下一循环
                    if($up_user->userprofile->referrerid > 0){
                        $refer_user = WB_User::findOne($up_user->userprofile->referrerid);
                    }else{
                        break;
                    }
                    continue;
                }
            }else{
                if($up_user->userprofile->referrerid > 0){
                    $refer_user = WB_User::findOne($up_user->userprofile->referrerid);
                }else{
                    break;
                }
                continue;
            }
            if($down_count >= $ztsl_tab->common_num){//上级会员获得奖励
                $release_award =  $out_num * $ztsl_tab->award_per;
                $note = '伞下'.$i.'代会员'.$out_user->username.'减少卢宝（'.$out_num.'），获得兑换加速奖励';
                if($release_award > $up_user->wallet->hcg_wa){
                    $release_award = $up_user->wallet->hcg_wa;
                    $note = $note.'，卢呗不足，释放所有卢呗';
                }
                $up_user->wallet->hcg_wa = $up_user->wallet->hcg_wa - $release_award;
                $up_user->wallet->cash_wa = $up_user->wallet->cash_wa + $release_award;
                if($up_user->wallet->hcg_wa >= $vipminhcg){//判断用户是否成为vip会员
                    $up_user->grade = 1;
                }else{
                    $up_user->grade = 0;
                }
                if($up_user->wallet->hcg_wa >= $minhcg && $up_user->isactivate == 0){
                    $up_user->isactivate = 1;
                }
                if($up_user->wallet->save() && $up_user->save()){
                    if($release_award > 0){
                        self::Createwalletrecord($up_user->id, $release_award, 20, 1, 2, $up_user->wallet->cash_wa, $note);
                        self::Createwalletrecord($up_user->id, $release_award, 20, 2, 1, $up_user->wallet->hcg_wa, $note);
                    }
                }
            }
            if($up_user->userprofile->referrerid > 0){//无上级，循环结束
                $refer_user = WB_User::findOne($up_user->userprofile->referrerid);
            }else{
                break;
            }
        }
        return true;
    }
    
    //产生账户记录
    public static function Createwalletrecord($userid,$amount,$event_type,$pay_type,$wallet_type,$wallet_amount,$note,$status=1){
        $UserWalletRecord1 = new WB_UserWalletRecord();
        $UserWalletRecord1->userid = $userid;//  会员id
        $UserWalletRecord1->amount = $amount;//  发生金额
        $UserWalletRecord1->event_type = $event_type;//  事件类型
        $UserWalletRecord1->pay_type = $pay_type;//  收支类型
        $UserWalletRecord1->wallet_type = $wallet_type;//  钱包类型
        $UserWalletRecord1->wallet_amount = $wallet_amount;//  钱包总额
        $UserWalletRecord1->note = $note;//  备注
        $UserWalletRecord1->created_at = time();//  创建时间
        $UserWalletRecord1->updated_at = time();//  更新时间
        $UserWalletRecord1->ip = Yii::$app->getRequest()->getUserIP();//  当前ip
        $UserWalletRecord1->status = $status;//  记录状态是否显示
        
        return $UserWalletRecord1->save();
    }

//    流通奖励  2018/8/30 14:14  YMJ
    public static function setAward($out_user,$out_num){//发放流通奖励
        if($out_user->userprofile->referrerid > 0){
            $refer_user = WB_User::findOne($out_user->userprofile->referrerid);
        }else{
            return true;
        }
		
        $i = 0;
		$vip_first = true;
//        $now = date("Y-m-d H:i:s",time());
//        $all_dt_award = array();

        $viphcg = MTools::getYiiParams('circulation_welfare') / 100;

        // if($out_user->grade_id == 5){
            // $vip_award = $out_num * $viphcg;
            // $vip_not = '伞下vip会员'.$out_user->username.'卢宝流通（'.$out_num.'）获得vip奖励';
        // }

        while (true){
            $i++;
            if($i > 16){
                break;
            }
            //获取上级会员的所有信息
            $up_user = $refer_user;
            if(!$up_user){//无上级会员，结束循环
                break;
            }else{
                if($up_user->grade_id <= 1){ // 上级会员不是有效，跳过，进入下一循环
                    if($up_user->userprofile->referrerid > 0){
                        $refer_user = WB_User::findOne($up_user->userprofile->referrerid); // 上级会员的所有信息
                    }else{
                        break;
                    }
                    continue;
                }
            }

            // LV3 奖励
            if($up_user->grade_id == 5 && $out_num * $viphcg> 0 && $vip_first == true){
				$vip_award = $out_num * $viphcg;
				$vip_not = '伞下vip会员'.$out_user->username.'卢宝流通（'.$out_num.'）获得vip奖励';
				//  奖励自动释放
                // $up_user->wallet->hcg_wa += $vip_award;
                // if($up_user->wallet->save()){
                    // self::Createwalletrecord($up_user->id, $vip_award, 21, 1, 1, $up_user->wallet->hcg_wa, $vip_not);
                // }
				//  奖励签到释放
				$vip_first = false;
				self::Createwalletrecord($up_user->id, $vip_award, 21, 1, 1, $up_user->wallet->hcg_wa, $vip_not, 0);
            }

            //
			
            $down_count = WB_User::find()->where("grade_id > 1 && invite_code = :invite_code",[":invite_code" => $up_user->mycode])->count();
            if($down_count > 0){//获取奖励等级
                //根据会员等级去获取流通加速比例
                $award_per = Grade::find()->select('id,circulate_per')->where('id =:id',[':id' => $up_user->grade_id])->one();
                // 根据推荐总人数获取伞下多少代可以进行流通加速
                $ztsl_tab = ShareRewards::find()->where("amount<=:amount",[":amount"=>$down_count])->orderBy("amount desc")->one();
                if(!$ztsl_tab || $ztsl_tab->algebra < $i){//奖励等级不存在，跳过，进入下一循环
                    if($up_user->userprofile->referrerid > 0){
                        $refer_user = WB_User::findOne($up_user->userprofile->referrerid);
                    }else{
                        break;
                    }
                    continue;
                }
            }else{
                if($up_user->userprofile->referrerid > 0){
                    $refer_user = WB_User::findOne($up_user->userprofile->referrerid);
                }else{
                    break;
                }
                continue;
            }
            if($down_count >= $ztsl_tab->amount){//上级会员获得奖励

                $release_award =  $out_num * $award_per->circulate_per;
                
//                $award_arr = array();
//                $award_arr['userid'] = $refer_user->id;
//                $award_arr['username'] = $refer_user->username;
//                $award_arr['amount'] = $release_award;
//                $award_arr['event_type'] = 20;
//                $award_arr['note'] = '伞下'.$i.'代会员'.$refer_user->username.'在'.$now.'减少卢宝（'.$out_num.'），获得流通加速奖励';
//
//                array_push($all_dt_award, $award_arr);
                
                $note = '伞下'.$i.'代会员'.$out_user->username.'减少卢宝（'.$out_num.'），获得流通加速奖励';
                if($release_award > $up_user->wallet->hcg_wa){
                    $release_award = $up_user->wallet->hcg_wa;
                    $note = $note.'，卢呗不足，释放所有卢呗';
                }
				//  奖励自动释放
                // $refer_user->wallet->hcg_wa = $up_user->wallet->hcg_wa - $release_award;
                // $refer_user->wallet->cash_wa = $up_user->wallet->cash_wa + $release_award;
                // if($refer_user->wallet->save() && $up_user->save()){
					
				//  奖励签到释放
                if($up_user->save()){
                    if($release_award > 0){
                        self::Createwalletrecord($refer_user->id, $release_award, 20, 1, 2, $refer_user->wallet->cash_wa, $note, 0);
                        self::Createwalletrecord($refer_user->id, $release_award, 20, 2, 1, $refer_user->wallet->hcg_wa,  $note, 0);
                    }
                }
            }
            if($refer_user->userprofile->referrerid > 0){//无上级，循环结束
                $refer_user = WB_User::findOne($up_user->userprofile->referrerid);
            }else{
                break;
            }
        }
        //调用将奖励插入表内
//        \common\models\DtAward::insertDatas($all_dt_award);
        return true;
    }
}
