<?php

namespace backend\controllers;

use common\models\SnapJudgment;
use common\models\User;
use common\models\UserAmountTrade;
use common\models\UserWallet;
use common\models\UserWalletRecord;
use common\models\UserZodiac;
use common\models\Zodiac;
use common\models\ZodiacApply;
use common\models\ZodiacIssue;
use Yii;
//use yii\filters\AccessControl;
use yii\web\Controller;
use backend\models\LoginForm;
use backend\models\MY_User;
use common\models\Sellstocknum;
use backend\models\MY_UserAwardRecord;
use common\components\MTools;

//use yii\filters\VerbFilter;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
//    public function beforeAction($action) {
//        $currentaction = $action->id;
//        $accessactions = ['login'];
//        if(in_array($currentaction,$accessactions)) {
//            $action->controller->enableCsrfValidation = false;
//        }
//
//        parent::beforeAction($action);
//        return true;
//    }

    public function actionIndex() {
        if (Yii::$app->user->isGuest) {
            $this->redirect(["login"]);
        } else {
            // 拨发量
            $lubao_in = UserWalletRecord::find()->where('event_type=1 and pay_type=1 and wallet_type=1')->sum('amount');

            $lubao_out = UserWalletRecord::find()->where('event_type=2 and pay_type=2 and wallet_type=1')->sum('amount');

            $lubao = $lubao_in - $lubao_out;

            // 持币量
            $user_lubao = UserWallet::find()->sum('hcg_wa');

            // 注册会员数量显示
            $beginToday = mktime(0,0,0,date('m'),date('d'),date('Y'));// 今日开始时间戳
            $endToday = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1; // 今日结束时间戳
            $registNum = User::find()->where('created_at >= :beginTime && created_at < :endTime',[':beginTime' => $beginToday,':endTime' => $endToday])->count(); // 今日注册的会员数量

            // 交易数量统计
            $TotalNum = UserAmountTrade::find()->where('status = 3')->count();// 总交易成功数量
            $buyNum =  UserAmountTrade::find()->where('status = 3')->sum('amount');// 成交价格
            $buyNum = $buyNum === null ? 0 : $buyNum;
            $income_service =  UserWalletRecord::find()->where('(event_type=6 || event_type=9) && pay_type=2 and wallet_type=1')->sum('amount');          //预约/抢购收入
            $income_service = $income_service === null ? 0 : $income_service;
            $outcome = UserWalletRecord::find()->where('event_type = 10 and pay_type = 1 and wallet_type = 1')->sum('amount');
            $outcome = $outcome === null ? 0 : $outcome;
            $income_agency =  UserWalletRecord::find()->where('event_type=8 && pay_type=2 and wallet_type=1')->sum('amount');          //手续费收入
            $income_agency = $buyNum === null ? 0 : $income_agency;

            //初始化变量
            $list = [];
            //获取所有宠物
            $zodiac = Zodiac::find()->where('is_show = 1')->orderBy('id desc')->asArray()->all();
            if(!empty($zodiac)){
                foreach ($zodiac as $k => $v) {
                    // 获取今日预约数
                    $zodiac_apply = ZodiacApply::find()->where('zodiac_id = :zodiac_id and created_at >= :time',[':zodiac_id'=>$v['id'],':time'=>$beginToday]);
                    $yuyue_num = count($zodiac_apply->all());
                    // 获取今日到期数量(只有抢购获得的)
                    $userzodiac = UserZodiac::find()->where('zodiac_id = :id and over_time >= :begin and over_time <= :end and source = 0',
                        [':begin'=>$beginToday,':end'=>$endToday,':id'=>$v['id']])->all();
                    $daoqi_num = count($userzodiac);

                    // 今日转换数量(所有今日过期中,当前价格超越原宠物价格上限的)
                    $over_num = 0;
                    if($daoqi_num){
                        foreach ($userzodiac as $item) {
                            if($item->hcg > $v['hcg_max']){
                                $over_num ++;
                            }
                        }
                    }


//                    //获取当前宠物在发型表中的发行id
//                    $issue_id = ZodiacIssue::find()->select('id')->where('zodiac_id = :id',[':id'=>$v['id']])->asArray()->all();
//                    $success_num = 0;
//                    if(!empty($issue_id)){
//                        foreach ($issue_id as $key => $value){
//                            $flag = UserAmountTrade::find()->where('traded_at >= :begin and status = 3 and areaid = :id',[':begin'=>$beginToday,':id'=>$value['id']])->one();
//                            if($flag){
//                                $success_num ++;
//                            }
//                        }
//                    }

                    $success =SnapJudgment::find()->where('updated_at >= :updated_at and status = 1 and zodiacid = :zodiacid',[':updated_at'=>$beginToday,':zodiacid'=>$v['id']])->all();
                    $success_num = count($success);
                    // 今日抢购失败数量
//                    $failed_num = $v['kill_num'] - $success_num;

                    $failed = SnapJudgment::find()->where('updated_at >= :updated_at and status = 2 and zodiacid = :zodiacid',[':updated_at'=>$beginToday,':zodiacid'=>$v['id']])->all();
                    $failed_num = count($failed);
                    //宠物总数(未匹配的)
                    $zodiac_num = ZodiacIssue::find()->where('zodiac_id = :zodiac_id and issel = 0',[':zodiac_id'=>$v['id']])->count();

                    $list[$k]['name'] = $v['name'];
                    $list[$k]['yuyue_num'] = $yuyue_num;        // 今日预约
                    $list[$k]['daoqi_num'] = $daoqi_num;        // 今日到期
                    $list[$k]['over_num'] = $over_num;          // 今日转换
                    $list[$k]['kill_total'] = $failed_num + $success_num;   // 今日抢购总次数
                    $list[$k]['success_num'] = $success_num;    // 抢购成功
                    $list[$k]['failed_num'] = $failed_num;      // 抢购失败
                    $list[$k]['zodiac_num'] = $zodiac_num;      // 抢购成功

                }
            }

            return $this->render("index",['lubao' => $lubao, 'user_lubao' => $user_lubao,'registNum' => $registNum,'TotalNum' =>$TotalNum ,'buyNum'=> $buyNum,"income_service"=>$income_service - $outcome,"income_agency"=>$income_agency,'list'=>$list]);
        }
    }

    public function actionLogin() {
        $this->layout = false;
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model, 'csrfname' => Yii::$app->request->csrfParam, 'csrfval' => Yii::$app->request->getCsrfToken()
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    public function actionUpdatacount(){
        //$allusermodel = \frontend\models\WB_User::find()->where("iseal = 0 && isout = 0")->all();
        $allusermodel = MY_User::find()->where("iseal = 0 && isout = 0")->all();
        $cashcount = 0;
        $registcount = 0;
        $hcgcount = 0;
        $shopcount = 0;
        $stockcount = 0;
        $sellstockcount = 0;
        foreach ($allusermodel as $usermodel){
            $user = MY_User::find()->where("id = :userid",[":userid"=>$usermodel->id])->with(["stock","level","wallet"])->one();

            if($user instanceof MY_User){
                if($user->wallet){
                    $cashcount = $cashcount + $user->wallet->cash_wa;
                    $registcount =  $registcount + $user->wallet->regist_wa;
                    $hcgcount = $hcgcount + $user->wallet->hcg_wa;
                    $shopcount = $shopcount + $user->wallet->shop_wa;
                }
                if($user->stock){
                    if($user->stock->stock > $user->level->dfc_base){
                        $sellstockcount = $sellstockcount + ($user->stock->stock - $user->level->dfc_base);
                    }
                    $stockcount = $stockcount + $user->stock->stock;
                }
            }
        }
        $updatacount = new \common\models\Syscache();
        $updatacount->cash_wa = $cashcount;
        $updatacount->regist_wa = $registcount;
        $updatacount->hcg_wa = $hcgcount;
        $updatacount->shop_wa = $shopcount;
        $updatacount->stockcount = $stockcount;
        $updatacount->sellstock = $sellstockcount;
        $updatacount->created_at = time();
        $updatacount->updated_at = time();
        if($updatacount->save()){
            Yii::$app->getSession()->setFlash("success", "数据更新成功!");
        }else{
            Yii::$app->getSession()->setFlash("error", "数据更新失败!");
            $updatacount->errors();
        }
        return $this->render("index");
    }
    
    
    
    public function actionStockacount(){
        //$allusermodel = \frontend\models\WB_User::find()->where("iseal = 0 && isout = 0")->all();   
        $allusermodel = MY_User::find()->where("iseal = 0 && isout = 0")->all();
        $forcesellPoper = MTools::getYiiParams("forcesellPoper");
        $one = 0;
        $two = 0;
        $three = 0;
        $one_sell = 0;
        $two_sell = 0;
        $three_sell = 0;
        $cash = MY_UserAwardRecord::find()->where("event_type = 4 && award_type = 9 && pay_type = 1")->sum('amount');
        if($cash > 0){
            $cash = $cash;
        }else{
            $cash = 0;
        }
        $regist = MY_UserAwardRecord::find()->where("event_type = 4 && award_type = 10 && pay_type = 1")->sum('amount');
        if($regist > 0){
            $regist = $regist;
        }else{
            $regist = 0;
        }
        $deductcash = MY_UserAwardRecord::find()->where("event_type = 4 && award_type = 9 && pay_type = 2")->sum('amount');
        if($deductcash > 0){
            $deductcash = $deductcash;
        }else{
            $deductcash = 0;
        }
        $deductregist = MY_UserAwardRecord::find()->where("event_type = 4 && award_type = 10 && pay_type = 2")->sum('amount');
        if($deductregist > 0){
            $deductregist = $deductregist;
        }else{
            $deductregist = 0;
        }
        foreach ($allusermodel as $usermodel){
            $user = MY_User::find()->where("id = :userid",[":userid"=>$usermodel->id])->with(["stock","level"])->one();
            if($user instanceof MY_User){
                if($user->stock){
                    $num = $user->stock->stock + $user->stock->sell_stock - $user->level->out_num;
                    if($num > 0){
                        if($user->levelid == 1){
                            $one += $num;
                            $sell_num = floor(($user->stock->stock + $user->stock->sell_stock)*0.9*$forcesellPoper);
                            $one_sell += $sell_num > $user->stock->stock ? $user->stock->stock : $sell_num;
                        }elseif($user->levelid == 2){
                            $two += $num;
                            $sell_num = floor(($user->stock->stock + $user->stock->sell_stock)*0.9*$forcesellPoper);
                            $two_sell += $sell_num > $user->stock->stock ? $user->stock->stock : $sell_num;
                        }else{
                            $three += $num; 
                            $sell_num = floor(($user->stock->stock + $user->stock->sell_stock)*0.9*$forcesellPoper);
                            $three_sell += $sell_num > $user->stock->stock ? $user->stock->stock : $sell_num;
                        }
                    }
                }
            }
        }
        $updatacount = new \common\models\Sellstocknum();
        $updatacount->one = $one;
        $updatacount->two = $two;
        $updatacount->three = $three;
        $updatacount->one_sell = $one_sell;
        $updatacount->two_sell = $two_sell;
        $updatacount->three_sell = $three_sell;
        $updatacount->cash = $cash;
        $updatacount->regist = $regist;
        $updatacount->deductcash = $deductcash;
        $updatacount->deductregist = $deductregist;
        $updatacount->created_at = time();
        $updatacount->updated_at = time();
        if($updatacount->save()){
            Yii::$app->getSession()->setFlash("success", "数据更新成功!");
        }else{
            Yii::$app->getSession()->setFlash("error", "数据更新失败!");
            $updatacount->errors();
        }
        return $this->render("index");

    }
    

}
