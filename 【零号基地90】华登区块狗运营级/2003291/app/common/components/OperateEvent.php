<?php

namespace common\components;

/**
 * @author  shuang
 * @date    2016-12-11 19:23:23
 * @version V1.0
 * @desc    
 */
use common\models\User;
use common\models\UserZodiac;
use common\models\Zodiac;
use common\models\ZodiacGrade;
use common\models\ZodiacIssue;
use yii\base\Event;
use Yii;


class OperateEvent extends Event {

    public $amount;
    public $ids;
    public $aamount;
    public $amountt;

    /*
     * 数据模型错误提示
     * @params $array ["errors"=>[]]
     */

    private function errorMessage($errors) {
        foreach ($errors as $item) {
            $this->sender->message = $item[0];
            break;
        }
    }

    /*
     * 获取用户基本信息
     * @params $userid
     */

    protected function getUser($userid) {
        $result = \backend\models\MY_User::find()->where("id=:userid", [":userid" => $userid])->with(["userprofile", "wallet", "level"])->one();
        if (!$result instanceof \backend\models\MY_User) {
            throw new \yii\web\NotFoundHttpException;
        }
        return $result;
    }


    /*
    * 系统拨发会员积分
    */

    public function sysHcg() {
        $activeperson = MTools::getYiiParams('activeperson') ? MTools::getYiiParams('activeperson') : 10;   //激活会员龙之限制
        $trans = Yii::$app->db->beginTransaction();
         $ip = Yii::$app->getRequest()->getUserIP();
        try {
            foreach ($this->ids as $id) {
                $user = $this->getUser($id);
                if ($user->iseal > 0) {
                    $this->sender->message = "您选择的会员存在被封会员，请仔细选择";
                    return false;
                }
                if ($this->amount <= 0) {
                    $this->sender->message = "金额必须大于0";
                    return false;
                }

                $user->wallet->hcg_wa = $user->wallet->hcg_wa + $this->amount;
                $model = new \frontend\models\WB_UserWalletRecord();
                $model->userid = $user->id;
                $model->amount = $this->amount;
                $model->event_type = 1;
                $model->pay_type = 1;
                $model->wallet_type = 1;
                $model->wallet_amount = $user->wallet->hcg_wa;
                $model->note = "平台拨发积分({$this->amount})";
                $model->created_at = time();
                $model->ip = $ip;
                $model->branch_id = $user->branch_id;
                if($user->wallet->hcg_wa >= $activeperson && $user->isactivate){
                    $user->level_id = 1;
                    $user->save();
                }
                \common\models\Actionlog::setLog('拨发会员：'.$user->username.' '.$this->amount.' 积分');
                if ($model->save() && $user->wallet->update()) {
                    continue;
                } else {
                    $this->sender->message = "您选择的会员" . $user->username . "已被封，请联系系统管理员！";
                    return false;
                }
            }
            $trans->commit();
            $this->sender->flag = true;
        } catch (Exception $ex) {
            $trans->rollBack();
            throw new \yii\web\NotFoundHttpException;
        }
    }

    /*
    * 系统拨发会员推荐收益    2019-07-27（飞龙九子）
    */
    public function sysCare() {
        $trans = Yii::$app->db->beginTransaction();
        $ip = Yii::$app->getRequest()->getUserIP();
        try {
            foreach ($this->ids as $id) {
                $user = $this->getUser($id);
                if ($user->iseal > 0) {
                    $this->sender->message = "您选择的会员存在被封会员，请仔细选择";
                    return false;
                }
                if ($this->amount <= 0) {
                    $this->sender->message = "金额必须大于0";
                    return false;
                }

                $user->wallet->care_wa = $user->wallet->care_wa + $this->amount;
                $model = new \frontend\models\WB_UserWalletRecord();
                $model->userid = $user->id;
                $model->amount = $this->amount;
                $model->event_type = 1;
                $model->pay_type = 1;
                $model->wallet_type = 3;
                $model->wallet_amount = $user->wallet->care_wa;
                $model->note = "平台拨发推荐收益({$this->amount})";
                $model->created_at = time();
                $model->ip = $ip;
                $model->branch_id = $user->branch_id;
                \common\models\Actionlog::setLog('拨发会员：'.$user->username.' '.$this->amount.' 推荐收益');
                if ($model->save() && $user->wallet->update()) {
                    continue;
                } else {
                    $this->sender->message = "您选择的会员" . $user->username . "已被封，请联系系统管理员！";
                    return false;
                }
            }
            $trans->commit();
            $this->sender->flag = true;
        } catch (Exception $ex) {
            $trans->rollBack();
            throw new \yii\web\NotFoundHttpException;
        }
    }

    /*
    * 系统拨发会员永久区
    */

    public function sysPermanent() {
        $trans = Yii::$app->db->beginTransaction();
         $ip = Yii::$app->getRequest()->getUserIP();
        try {
            foreach ($this->ids as $id) {
                $user = $this->getUser($id);
                if ($user->iseal > 0) {
                    $this->sender->message = "您选择的会员存在被封会员，请仔细选择";
                    return false;
                }
                if ($this->amount <= 0) {
                    $this->sender->message = "金额必须大于0";
                    return false;
                }

                $user->wallet->permanent_wa = $user->wallet->permanent_wa + $this->amount;
                $model = new \frontend\models\WB_UserWalletRecord();
                $model->userid = $user->id;
                $model->amount = $this->amount;
                $model->event_type = 1;
                $model->pay_type = 1;
                $model->wallet_type = 7;
                $model->wallet_amount = $user->wallet->permanent_wa;
                $model->note = "平台拨发永久区({$this->amount})";
                $model->created_at = time();
                $model->ip = $ip;
                $model->branch_id = $user->branch_id;
//                $grade = \common\models\Grade::gradeChangeByHcg($user); // BBA变动引发会员等级变化

                \common\models\Actionlog::setLog('拨发会员：'.$user->username.' '.$this->amount.' 永久区');
                if ($model->save() && $user->wallet->save()) {
//                    \common\models\Grade::gradeChangeByHcg($user);
                    continue;
                } else {
                    $this->sender->message = "您选择的会员" . $user->username . "已被封，请联系系统管理员！";
                    return false;
                }
            }
            $trans->commit();
            $this->sender->flag = true;
        } catch (Exception $ex) {
            $trans->rollBack();
            throw new \yii\web\NotFoundHttpException;
        }
    }

    /*
    * 系统拨发自由区
    */

    public function sysFree() {
        $trans = Yii::$app->db->beginTransaction();
         $ip = Yii::$app->getRequest()->getUserIP();
        try {
            foreach ($this->ids as $id) {

                $user = $this->getUser($id);
                if ($user->iseal > 0) {
                    $this->sender->message = "您选择的会员存在被封会员，请仔细选择";
                    return false;
                }
                if ($this->amount <= 0) {
                    $this->sender->message = "金额必须大于0";
                    return false;
                }

                $user->wallet->free_wa = $user->wallet->free_wa + $this->amount;
                $model = new \frontend\models\WB_UserWalletRecord();
                $model->userid = $user->id;
                $model->amount = $this->amount;
                $model->event_type = 1;
                $model->pay_type = 1;
                $model->wallet_type = 6;
                $model->wallet_amount = $user->wallet->free_wa;
                $model->note = "平台拨发自由区({$this->amount})";
                $model->created_at = time();
                $model->ip = $ip;
                $model->branch_id = $user->branch_id;
                \common\models\Actionlog::setLog('拨发会员：'.$user->username.' '.$this->amount.' 自由区');
                if ($model->save() && $user->wallet->update()) {
                    continue;
                } else {
                    $this->sender->message = "您选择的会员" . $user->username . "已被封，请联系系统管理员！";
                    return false;
                }
            }
            $trans->commit();
            $this->sender->flag = true;
        } catch (Exception $ex) {
            $trans->rollBack();
            throw new \yii\web\NotFoundHttpException;
        }
    }

    /*
     * 系统扣除会员积分
    */
    public function sysReducehcg() {
        $trans = Yii::$app->db->beginTransaction();
        $ip = Yii::$app->getRequest()->getUserIP();
        try {
            foreach ($this->ids as $id) {
                $user = $this->getUser($id);
                if ($user->iseal > 0) {
                    $this->sender->message = "您选择的会员存在被封会员，请仔细选择";
                    return false;
                }
                if ($this->amount <= 0) {
                    $this->sender->message = "金额必须大于0";
                    return false;
                }
                $user->wallet->hcg_wa = $user->wallet->hcg_wa - $this->amount;
                if($user->wallet->hcg_wa < 0){
                    $this->sender->message = "您选择的会员" . $user->username . "积分不足！";
                    return false;
                }


                $model = new \frontend\models\WB_UserWalletRecord();
                $model->userid = $user->id;
                $model->amount = $this->amount;
                $model->event_type = 2;
                $model->pay_type = 2;
                $model->wallet_type = 1;
                $model->wallet_amount = $user->wallet->hcg_wa;
                $model->note = "平台扣除积分({$this->amount})";
                $model->created_at = time();
                $model->ip = $ip;
                $model->branch_id = $user->branch_id;
                \common\models\Actionlog::setLog('扣除会员：'.$user->username.' '.$this->amount.' 积分');
                if ($model->save() && $user->wallet->update()) {
                    continue;
                } else {
                    $this->sender->message = "您选择的会员" . $user->username . "已被封，请联系系统管理员！";
                    return false;
                }
            }
            $trans->commit();
            $this->sender->flag = true;
        } catch (Exception $ex) {
            $trans->rollBack();
            throw new \yii\web\NotFoundHttpException;
        }
    }

    /*
     * 系统扣除会员推荐收益   2019-07-27（飞龙九子）
    */
    public function sysReducecare() {
        $trans = Yii::$app->db->beginTransaction();
        $ip = Yii::$app->getRequest()->getUserIP();
        try {
            foreach ($this->ids as $id) {
                $user = $this->getUser($id);
                if ($user->iseal > 0) {
                    $this->sender->message = "您选择的会员存在被封会员，请仔细选择";
                    return false;
                }
                if ($this->amount <= 0) {
                    $this->sender->message = "金额必须大于0";
                    return false;
                }
                $user->wallet->care_wa = $user->wallet->care_wa - $this->amount;
                if($user->wallet->care_wa < 0){
                    $this->sender->message = "您选择的会员" . $user->username . "推荐收益不足！";
                    return false;
                }
                $model = new \frontend\models\WB_UserWalletRecord();
                $model->userid = $user->id;
                $model->amount = $this->amount;
                $model->event_type = 2;
                $model->pay_type = 2;
                $model->wallet_type = 3;
                $model->wallet_amount = $user->wallet->hcg_wa;
                $model->note = "平台扣除推荐收益({$this->amount})";
                $model->created_at = time();
                $model->ip = $ip;
                $model->branch_id = $user->branch_id;
                \common\models\Actionlog::setLog('扣除会员：'.$user->username.' '.$this->amount.' 推荐收益');
                if ($model->save() && $user->wallet->update()) {
                    continue;
                } else {
                    $this->sender->message = "您选择的会员" . $user->username . "已被封，请联系系统管理员！";
                    return false;
                }
            }
            $trans->commit();
            $this->sender->flag = true;
        } catch (Exception $ex) {
            $trans->rollBack();
            throw new \yii\web\NotFoundHttpException;
        }
    }

    //系统扣除会员永久区
    public function sysReducepermanent() {
        $trans = Yii::$app->db->beginTransaction();
        $ip = Yii::$app->getRequest()->getUserIP();
        try {
            foreach ($this->ids as $id) {
                $user = $this->getUser($id);
                if ($user->iseal > 0) {
                    $this->sender->message = "您选择的会员存在被封会员，请仔细选择";
                    return false;
                }
                if ($this->amount <= 0) {
                    $this->sender->message = "金额必须大于0";
                    return false;
                }
                $user->wallet->permanent_wa = $user->wallet->permanent_wa - $this->amount;
                if($user->wallet->permanent_wa < 0){
                    $this->sender->message = "您选择的会员" . $user->username . "永久区不足！";
                    return false;
                }

                $model = new \frontend\models\WB_UserWalletRecord();
                $model->userid = $user->id;
                $model->amount = $this->amount;
                $model->event_type = 2;
                $model->pay_type = 2;
                $model->wallet_type = 7;
                $model->wallet_amount = $user->wallet->permanent_wa;
                $model->note = "平台扣除永久区({$this->amount})";
                $model->created_at = time();
                $model->ip = $ip;
                $model->branch_id = $user->branch_id;

//                $grade = \common\models\Grade::gradeChangeByHcg($user); // 会员等级

                \common\models\Actionlog::setLog('扣除会员：'.$user->username.' '.$this->amount.' 永久区');

                if ($model->save() && $user->wallet->save() ) {
//                    \common\models\Grade::gradeChangeByHcg($user);
                    continue;
                } else {
                    $this->sender->message = "您选择的会员" . $user->username . "已被封，请联系系统管理员！";
                    return false;
                }
            }
            $trans->commit();
            $this->sender->flag = true;
        } catch (Exception $ex) {
            $trans->rollBack();
            throw new \yii\web\NotFoundHttpException;
        }
    }

    //系统扣除会员自由区
    public function sysReducefree() {
        $trans = Yii::$app->db->beginTransaction();
        $ip = Yii::$app->getRequest()->getUserIP();
        try {
            foreach ($this->ids as $id) {
                $user = $this->getUser($id);
                if ($user->iseal > 0) {
                    $this->sender->message = "您选择的会员存在被封会员，请仔细选择";
                    return false;
                }
                if ($this->amount <= 0) {
                    $this->sender->message = "金额必须大于0";
                    return false;
                }
                $user->wallet->free_wa = $user->wallet->free_wa - $this->amount;
                if($user->wallet->free_wa < 0){
                    $this->sender->message = "您选择的会员" . $user->username . "自由区不足！";
                    return false;
                }


                $model = new \frontend\models\WB_UserWalletRecord();
                $model->userid = $user->id;
                $model->amount = $this->amount;
                $model->event_type = 2;
                $model->pay_type = 2;
                $model->wallet_type = 6;
                $model->wallet_amount = $user->wallet->free_wa;
                $model->note = "平台扣除自由区({$this->amount})";
                $model->created_at = time();
                $model->ip = $ip;
                $model->branch_id = $user->branch_id;
                \common\models\Actionlog::setLog('拨发会员：'.$user->username.' '.$this->amount.' 自由区');
                if ($model->save() && $user->wallet->update()) {
                    continue;
                } else {
                    $this->sender->message = "您选择的会员" . $user->username . "已被封，请联系系统管理员！";
                    return false;
                }
            }
            $trans->commit();
            $this->sender->flag = true;
        } catch (Exception $ex) {
            $trans->rollBack();
            throw new \yii\web\NotFoundHttpException;
        }
    }
    
    public function sysReleasegoods(){
        $trans = Yii::$app->db->beginTransaction();
        $ip = Yii::$app->getRequest()->getUserIP();

        try {
            foreach ($this->ids as $id) {
                if ($this->amount <= 0) {
                    $this->sender->message = "数量必须大于0";
                    return false;
                }
                echo '<pre>';
                var_dump($id);exit;
                $user = $this->getUser($id);
                if ($user->iseal > 0) {
                    $this->sender->message = "您选择的会员存在被封会员，请仔细选择";
                    return false;
                }


                $user->wallet->cash_wa = $user->wallet->cash_wa + $this->amount;
                $model = new \frontend\models\WB_UserWalletRecord();
                $model->userid = $user->id;
                $model->amount = $this->amount;
                $model->event_type = 1;
                $model->pay_type = 1;
                $model->wallet_type = 2;
                $model->wallet_amount = $user->wallet->cash_wa;
                $model->note = "平台拨发BBA({$this->amount})";
                $model->created_at = time();
                $model->ip = $ip;
                $model->branch_id = $user->branch_id;
                \common\models\Actionlog::setLog('拨发会员：'.$user->username.' '.$this->amount.' BBA');
                if ($model->save() && $user->wallet->update()) {
                    continue;
                } else {
                    $this->sender->message = "您选择的会员" . $user->username . "已被封，请联系系统管理员！";
                    return false;
                }
            }
            $trans->commit();
            $this->sender->flag = true;
        } catch (Exception $ex) {
            $trans->rollBack();
            throw new \yii\web\NotFoundHttpException;
        }

    }

    public function sysReleasezodiac(){
        $trans = Yii::$app->db->beginTransaction();
        $ip = Yii::$app->getRequest()->getUserIP();

        try {
            foreach ($this->ids as $id) {
                //获取当前要拆分的产品
                $zodiac_issue = ZodiacIssue::findOne($id);
                if($zodiac_issue->hcg <= $this->amount){
                    continue;
                }
                //原宠物剩余价格
                $ini = $zodiac_issue->hcg - $this->amount;
                //查询原商品剩余的价格符合哪一个宠物
                $old_zodiac = Zodiac::find()->where('hcg_min <= :ini',[':ini'=>$ini])->orderBy('hcg_min desc')->one();
                //查询新商品的价格符合哪一个宠物
                $new_zodiac = Zodiac::find()->where('hcg_min <= :amount',[':amount'=>$this->amount])->orderBy('hcg_min desc')->one();
                if(!$old_zodiac || !$new_zodiac){
                    continue;
                }
                //获取我的宠物信息
                $my_zodiac = UserZodiac::find()->where('issue_id = :id and userid = :userid',[':id'=>$zodiac_issue->id,':userid'=>$zodiac_issue->belong_id])->one();

                //原拆分商品更新
                if($zodiac_issue->zodiac_id != $old_zodiac->id ){
                    Yii::$app->redis->lpop('zodiac_issue:'.$zodiac_issue->zodiac_id); // 踢除redis存储的原宠物的数量
                    $redis_num = count(Yii::$app->redis->lrange("zodiac_issue:".$zodiac_issue->zodiac_id,0,-1));

                    file_put_contents('../runtime/logs/redis_log.txt', '时间：'.time().'，踢除redis存储的原宠物的数量'.$zodiac_issue->zodiac_id.'子，发行ID:'.$zodiac_issue->id.'num:'.$redis_num.PHP_EOL,FILE_APPEND);

                    Yii::$app->redis->lpush('zodiac_issue:'.$old_zodiac->id, 1);      // 新宠物redis缓存数量+1
                    $redis_num = count(Yii::$app->redis->lrange("zodiac_issue:".$zodiac_issue->zodiac_id,0,-1));

                    file_put_contents('../runtime/logs/redis_log.txt', '时间：'.time().'，新宠物redis缓存数量+1'.$zodiac_issue->zodiac_id.'子，发行ID:'.$zodiac_issue->id.'num:'.$redis_num.PHP_EOL,FILE_APPEND);
                }
                $zodiac_issue->zodiac_id = $old_zodiac->id;
                $zodiac_issue->zodiac_name = $old_zodiac->name;
                $zodiac_issue->zodiac_grade_id = 0;
                $zodiac_issue->zodiac_grade_name = 0;
                $zodiac_issue->hcg = $ini;
                $zodiac_issue->cash = $old_zodiac->cash;
                $zodiac_issue->updated_at = time();
                //更新原商品的用户宠物信息
                $my_zodiac->zodiac_id = $old_zodiac->id;
                $my_zodiac->zodiac_grade_id = 0;
                $my_zodiac->old_hcg = $ini;
                $my_zodiac->hcg = $ini;
                $my_zodiac->due = $old_zodiac->due;
                $my_zodiac->award = $old_zodiac->award;
                $my_zodiac->updated_at = time();
                $my_zodiac->rise_num = $old_zodiac->due;
                $overtime_old = strtotime(date('Y-m-d',$zodiac_issue->created_at)) + $old_zodiac->due * 86400;
                $my_zodiac->over_time = $overtime_old;

                //创建新的商品
                $newzodiac_issue = new ZodiacIssue();
                $newzodiac_issue->zodiac_id = $new_zodiac->id;
                $newzodiac_issue->zodiac_name = $new_zodiac->name;
                $newzodiac_issue->zodiac_grade_id = 0;
                $newzodiac_issue->zodiac_grade_name = 0;
                $newzodiac_issue->hcg = $this->amount;
                $newzodiac_issue->cash = $new_zodiac->cash;
                $newzodiac_issue->issel = $zodiac_issue->issel;       //保持原宠物的卖出情况
                $newzodiac_issue->created_at = time();
                $newzodiac_issue->updated_at = time();
                $newzodiac_issue->belong_id = $zodiac_issue->belong_id;
                Yii::$app->redis->lpush('zodiac_issue:'.$new_zodiac->id, 1);      // 新宠物redis缓存数量+1

                $redis_num = count(Yii::$app->redis->lrange("zodiac_issue:".$new_zodiac->id,0,-1));

                file_put_contents('../runtime/logs/redis_log.txt', '时间：'.time().'，新宠物redis缓存数量+1'.$zodiac_issue->zodiac_id.'子，发行ID:'.$newzodiac_issue->id.'num:'.$redis_num.PHP_EOL,FILE_APPEND);
                if($newzodiac_issue->save()){
                    //创建新的用户宠物
                    $new_userzodiac = new UserZodiac();
                    $new_userzodiac->userid = $my_zodiac->userid;
                    $new_userzodiac->username = $my_zodiac->username;
                    $new_userzodiac->issue_id = $newzodiac_issue->id;
                    $new_userzodiac->zodiac_id = $new_zodiac->id;
                    $new_userzodiac->zodiac_grade_id = 0;
                    $new_userzodiac->old_hcg = $this->amount;
                    $new_userzodiac->hcg = $this->amount;
                    $new_userzodiac->due = $new_zodiac->due;
                    $new_userzodiac->award = $new_zodiac->award;
                    $new_userzodiac->updated_at = time();
                    $new_userzodiac->created_at = $zodiac_issue->created_at;
                    $new_userzodiac->rise_num = $new_zodiac->due;
                    $new_userzodiac->is_overtime = 1;
                    $new_userzodiac->is_rack = 1;
                    $new_userzodiac->source = $my_zodiac->source;
                    $new_userzodiac->allow_rack = $my_zodiac->allow_rack;
                    $overtime_new = strtotime(date('Y-m-d',$zodiac_issue->created_at)) + $new_zodiac->due * 86400;
                    $new_userzodiac->over_time = $overtime_new;

                }

                $user = Yii::$app->user->identity;
                \common\models\Actionlog::setLog('管理员：'.$user->username.'，拆分商品: '.$zodiac_issue->id.' ，拆分价格为：'.$this->amount);
                if ($zodiac_issue->save() && $new_userzodiac->save() && $my_zodiac->save()) {
                    continue;
                } else {
                    $this->sender->message = "操作失败，请联系系统管理员！";
                    return false;
                }
            }
            $trans->commit();
            $this->sender->flag = true;
        } catch (Exception $ex) {
            $trans->rollBack();
            throw new \yii\web\NotFoundHttpException;
        }
    }
}
