<?php

namespace backend\models;

use common\models\UserWallet;
use common\models\UserWalletRecord;
use common\models\Zodiac;
use common\models\ZodiacIssue;
use common\models\UserZodiac;
use common\models\UserBank;
use Yii;
use common\components\MTools;
use yii\base\Model;
use yii\helpers\HtmlPurifier;
use yii\web\User;

class MY_IssueForm extends Model {

    public $zodiac_id; //飞龙ID
    public $num; //发行数量
    public $hcg; //价格
    public $belong;  //所属

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['zodiac_id','hcg','num','belong'],'required'],
            [['zodiac_id','hcg','num','belong'],'filter', 'filter' => 'trim'],
//            [['zodiac_id'], "match", "pattern" => "/^[1-9]{1,10}$/", "message" => "请选择要发行的宠物"],
            [['num'],'integer'],
            [['hcg'],'checkHcg'],
            [['zodiac_id'],'checkZodiac'],
            [['belong'],'checkUser'],
            [['zodiac_id','num','belong','hcg'],'number'],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'zodiac_id' => '飞龙',
            'hcg' => '价格',
            'num' => '发行数量',
            'belong' => "所属用户ID",
        ];
    }

    //  宠物验证
    public function checkZodiac($attr, $params) {
        $zodiac = Zodiac::find()->where('id=:id', [':id' => $this->zodiac_id])->one();
        if(empty($zodiac)){
            $this->addError($attr, "请选择要发行的宠物");
        }
    }

    //  宠物价格区间验证,推广收益判断
    public function checkHcg($attr, $params) {
        $zodiac = Zodiac::find()->where('id=:id', [':id' => $this->zodiac_id])->one();
        if($this->hcg < $zodiac->hcg_min || $this->hcg > $zodiac->hcg_max){
            $this->addError($attr, "宠物价格不在要发行的宠物区间范围内");
        }
        //获取用户钱包
        $userwallet = UserWallet::find()->where('userid = :id',[':id'=>$this->belong])->one();
        if(!$userwallet){
            $this->addError($attr, "用户ID不存在");
        }
        if($userwallet->care_wa < ($this->hcg * $this->num)){
            $this->addError($attr, "您的推广收益不足,无法发布");
        }

    }

    //  用户ID验证
    public function checkUser($attr, $params) {
        $userdata = \common\models\User::find()->where('id=:id', [':id' => $this->belong])->one();
        if(empty($userdata)){
            $this->addError($attr, "没找到该用户");
        }
        $userbank = UserBank::find()->where('userid = :userid and state = 1',[':userid' => $userdata->id])->one();
        if(!$userdata->userprofile->alipay && !$userdata->userprofile->wechat && empty($userbank)){
            $this->addError($attr, "该用户未绑定支付方式");
        }
    }

    public static function createData() {
        $model = new MY_IssueForm();
        $model->load(Yii::$app->request->post());
        //验证表单数据
        if (!$model->validate()) {
            return ["errors" => $model->errors, "model" => $model];
        }
        //获取要发行的宠物
        $zodiac = Zodiac::findOne($model->zodiac_id);
        $userdata = \common\models\User::findOne($model->belong);
        $trans = Yii::$app->db->beginTransaction();
        try {
            for ($i=1;$i<=$model->num;$i++){
                //批量插入发行表
                $zodiacissue = new ZodiacIssue();
                $zodiacissue->zodiac_id = $model->zodiac_id;
                $zodiacissue->zodiac_name = $zodiac->name;
                $zodiacissue->hcg = $model->hcg;
                $zodiacissue->issel = 0;
                $zodiacissue->cash = $zodiac->cash;
                $zodiacissue->created_at = time();
                $zodiacissue->updated_at = time();
                $zodiacissue->belong_id = $model->belong;
                if(!$zodiacissue->save()){
                    return ["errors" => $zodiacissue->errors, "model" => $zodiacissue];
                }
                //批量插入用户宠物表
                $zodiacUser = new UserZodiac();
                $zodiacUser->userid = $model->belong;
                $zodiacUser->username = $userdata->username;
                $zodiacUser->issue_id = $zodiacissue->id;
                $zodiacUser->zodiac_id = $model->zodiac_id;
                $zodiacUser->old_hcg = $model->hcg;
                $zodiacUser->hcg = $model->hcg;
                $zodiacUser->created_at = time();
                $zodiacUser->over_time = time();
                $zodiacUser->updated_at = time();
                $zodiacUser->due = $zodiac->due;
                $zodiacUser->award = $zodiac->award;
                $zodiacUser->is_rack= 1;
                $zodiacUser->is_overtime= 1;
                $zodiacUser->rise_num= $zodiac->due;
                $zodiacUser->source = 1;      // 0:抢购  1:推广收益提取/后台发布
                $zodiacUser->allow_rack = 0;
                //宠物列表发行数增加
                $zodiac->issue_num += 1;
                $zodiac->save();
                // 用户推广收益减少
                $userdata->wallet->care_wa -= $model->hcg;
                $note = '后台发布宠物,扣除推广收益';
                UserWalletRecord::insertrecord($model->belong,$model->hcg,11,2,3,$userdata->wallet->care_wa,$note);
                if(!$zodiacUser->save() || !$userdata->wallet->save()){
                    return ["errors" => $zodiacissue->errors, "model" => $zodiacissue];
                }
            }
            $ac_log = \common\models\Actionlog::setLog('发行宠物：'.$zodiac->name.'数量：'.$model->num.'归属用户ID：'.$model->belong);
            if($ac_log){
                MTools::AddRedis($model->num,$model->zodiac_id); //添加到redis
                $redis_num = count(Yii::$app->redis->lrange("zodiac_issue:".$model->zodiac_id,0,-1));
                file_put_contents('../runtime/logs/redis_log.txt', '时间：'.time().'，后台发行宠物'.$model->zodiac_id.'子'.$model->num.'个成功'.'num:'.'归属用户ID：'.$model->belong.$redis_num.PHP_EOL,FILE_APPEND);
                $trans->commit();
                return true;
            }
        } catch (Exception $ex) {
            $trans->rollBack();
            throw new \yii\web\NotFoundHttpException($ex);
        }
    }

}
