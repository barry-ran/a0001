<?php

namespace backend\controllers;

/**
 * @author  shuang
 * @date    2016-12-1 21:05:36
 * @version V1.0
 * @desc
 */
use backend\models\UserForm;
use common\models\Grade;
use common\models\Level;
use common\models\SnapJudgment;
use common\models\User;
use common\models\UserProfile;
use common\models\UserWallet;
use common\components\BController;
use backend\models\MY_User;
use common\models\ZodiacIssue;
use common\models\UserConver;
use common\models\UserCar;
use common\models\UserWalletRecord;
use common\models\UserZodiac;
use Yii;
use yii\helpers\Json;
use common\components\MTools;
use yii\helpers\ArrayHelper;
use common\models\CareOrder;
use common\models\UserSign;
use common\models\UserAmountTrade;
use common\models\Recharge;
use common\models\BankRealname;

class RegistController extends BController {

    public $flag = false;
    public $message = "";

    /*
     * 会员查询
     */

    public function actions() {
        return [
            "list" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new MY_User()
            ],
            "update" => [
                "class" => "\common\actions\UpdateAction",
                "modelClass" => new \backend\models\UserupdateForm(),
                "renderParams" => ["action" => "update"],
                "renderTo" => "update",
            ],
            "detail" => [
                "class" => "\common\actions\ListAction",
                "getListFunc" => "getDetail",
                "iscallback" => true,
                "modelClass" => new MY_User(),
                "renderTo" => "detail"
            ],
            "awardrecode" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new UserWalletRecord(),
                "renderTo" => "awardrecode"
            ],
            "amounttrade" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new \common\models\UserAmountTrade(),
                "renderTo" => "amounttrade"
            ],
            "usercar" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new UserCar(),
                "renderTo" => "usercar"
            ],
            "initcreate" => [
                "class" => "\common\actions\CreateAction",
                "modelClass" => new UserForm(),
                "renderTo" => "initcreate",
                "redirectTo" => "regist/list",
                "renderParams" => ["action" => "initcreate"]
            ],
            "grade" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new Grade(),
                "renderTo" => "grade",
            ],
            "updategrade" => [
                "class" => "\common\actions\UpdateAction",
                "modelClass" => new Grade(),
                "renderParams" => ["action" => "updategrade"],
                "renderTo" => "updategrade",
                "redirectParams" => ["id" => ""],
                "redirectTo" => "grade",
            ],
            "batchop" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new MY_User(),
                "renderTo" => "batchop"
            ],
            "certification" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new BankRealname(),
                "renderTo" => "certification"
            ],
            "getunlogin" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new MY_User(),
                "renderTo" => "getunlogin"
            ],
            //充值记录      2019-07-19
            "recharge_record" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new Recharge(),
                "renderTo" => "recharge_record"
            ],
        ];
    }

    // 批量查询、批量实名认证审核->AJAX
    public function actionAjaxcertificationlist() {
        $res = BankRealname::getCertificationlist();
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                //获取用户profile信息
                if($item["is_success"] == 0){
                    $tip = '待审核';
                }elseif($item["is_success"] == 1){
                    $tip = '认证失败';
                }else{
                    $tip = '认证成功';
                }
                $userprofile = UserProfile::find()->where('userid = :id',[':id'=>$item['userid']])->one();
                if($item['is_success'] == 2){
                    $action = MTools::getStringActions([
                        "restepay" => [
                            "params" => ["id" => $item["id"]],
                            "title" => "重置收款方式"
                        ]
                    ]);
                }elseif($item['is_success'] == 0){
                    $action = MTools::getStringActions([
                        "agreed" => [
                            "params" => ["id" => $item["id"]],
                            "title" => "审核通过"
                        ],

                    ]);
                }else{
                    $action = '--';
                }
                $temp["rows"][] = [
                    "id"        => $item["id"],          // 存银行卡四要素 表的id
                    "userid"    => $item["userid"],          // 会员id
                    "username"  => $item["username"],    // 用户名
                    "name"      => $item["name"],        // 银行卡的账户名（真实姓名）
                    "idNo"      => $item["idNo"],        // 开通银行卡的身份证号
                    "wechat" => $userprofile->wechat ? $userprofile->wechat : '-',
                    "wechat_img" => $userprofile->wechat_img ? \yii\bootstrap\Html::a(\yii\bootstrap\Html::img($userprofile->wechat_img, ["width" => 120, "height" => 100]), $userprofile->wechat_img, ['target' => "_blank"]) : '-',
                    'alipay' => $userprofile->alipay ? $userprofile->alipay : '-',
                    'alipay_img' => $userprofile->alipay_img ? \yii\bootstrap\Html::a(\yii\bootstrap\Html::img($userprofile->alipay_img, ["width" => 120, "height" => 100]), $userprofile->alipay_img, ['target' => "_blank"]) : '-',
                    "is_success"=> $tip,
                    "created_at"=> Yii::$app->formatter->asDatetime($item["created_at"]),
                    'action' => $action,
                ];
            }
        }
        echo Json::encode($temp);
    }

    // 批量实名认证驳回
    public function actionDisagree() {
        $id = Yii::$app->request->post('id');      // 获取id
        $reason = Yii::$app->request->post('reason');      // 获取reason
        if(!$reason){
            $reason = 'null';
        }
        if(!preg_match('/[0-9-]/', $id)) {
            Yii::$app->getSession()->setFlash('error', '非法参数');
        } else {
            $realname = BankRealname::find()->where('id = :id',[':id'=>$id])->one();
            if($realname->is_success){
                Yii::$app->getSession()->setFlash('error', '此用户之前已认证通过');
                $this->redirect(["certification"]);
            }else{
                $realname->reason = $reason;
                $realname->is_success = 1;
                $res = $realname->save();
                if($res) {
                    Yii::$app->getSession()->setFlash('success', '处理成功！');
                } else {
                    Yii::$app->getSession()->setFlash('error', '处理失败');
                }
            }

        }
        $this->redirect(["certification"]);
    }

    //审核通过
    public function actionAgreed(){
        $id = Yii::$app->request->get('id');      // 获取id
        //获取后台参数
        $activeperson = MTools::getYiiParams('activeperson') ? MTools::getYiiParams('activeperson') : 10;   //激活会员龙之限制
        $realname = BankRealname::find()->where('id = :id',[':id'=>$id])->one();
        if($realname){
            //获取用户信息
            $userdata = User::find()->where('id = :id',[':id'=>$realname->userid])->one();
            $realname->is_success = 2;
            $userdata->userprofile->idcard = $realname->idNo;
            $userdata->isactivate = 1;  //1:实名,0:为实名
            if($userdata->wallet->hcg_wa >= $activeperson ){
                $userdata->level_id = 1;
            }
            if($userdata->save() && $userdata->userprofile->save() && $realname->save()){
                Yii::$app->getSession()->setFlash('success', '审核成功！');
            }else{
                Yii::$app->getSession()->setFlash('error', '审核失败');
            }
        }
        $this->redirect(["certification"]);
    }

    //重置收款二维码
    public function actionRestepay(){
        $id = Yii::$app->request->get('id');      // 获取id
        //获取用户实名认证信息
        $userbank = BankRealname::find()->where('id = :id',[':id'=>$id])->one();
        $userprofile = UserProfile::find()->where('userid = :id',[':id'=>$userbank->userid])->one();
        $userprofile->wechat = '';
        $userprofile->wechat_img = '';
        $userprofile->alipay = '';
        $userprofile->alipay_img = '';
        if($userprofile->save()){
            Yii::$app->getSession()->setFlash('success', '重置成功！');
        }else{
            Yii::$app->getSession()->setFlash('error', '重置失败！');
        }
        $this->redirect(["certification"]);
    }

    // 会员列表
    public function actionAjaxlist() {

        $res = MY_User::getList();

        $temp = ["total" => $res["total"], "rows" => []];

        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $refer = \common\models\User::find()->andWhere(["=","mycode",$item['invite_code']])->one();
                //获取用户profile表
                $userprofile = UserProfile::find()->where('userid = :id',[':id'=>$item['id']])->one();
                //获取累计收益
                $total_award1 = UserZodiac::find()->where('userid = :id',[':id'=>$item['id']])->sum('hcg');
                $total_award2 = UserZodiac::find()->where('userid = :id',[':id'=>$item['id']])->sum('old_hcg');
                $total_award = $total_award1 - $total_award2;
                $userbank = BankRealname::find()->where('userid = :id',[':id'=>$item['id']])->one();
                $temp["rows"][] = [
                    "id" => $item["id"],
                    "username" => $item["username"],
                    "mycode"=>$item["mycode"],
                    "iseal"=>$item["iseal"] ? '已封' : "正常",
                    "issell"=>$item["issell"] ? '禁止' : "正常",
                    "grade_name"=>ArrayHelper::getValue($item, "grade.name"),
                    "invitename"=>$refer ? $refer->username : "系统账号",
                    "isactivate" => $item['isactivate'] == 0 ? '未认证' : '已认证',
                    "updated_at" => Yii::$app->formatter->asDatetime($item["created_at"]),
                    "created_at" => Yii::$app->formatter->asDatetime($item["created_at"]),
                    "cash_wa" => floor($item['wallet']['cash_wa']*10000)/10000,
                    "hcg_wa" =>  floor($item['wallet']['hcg_wa']*10000)/10000,
                    "care_wa" =>  floor($item['wallet']['care_wa']*100)/100,
                    "truename" =>  $userbank ? $userbank->name : '-',
                    "total_award" =>  floor($total_award *100)/100,
                    "action" => MTools::getStringActions([
                        "update" => [
                            "params" => ["id" => $item["id"]],
                            "title" => "编辑"
                        ],
                        "detail" => [
                            "params" => ["id" => $item["id"]],
                            "title" => "查看详情"
                        ],
                    ])
                ];
            }
        }
        echo Json::encode($temp);
    }

    // 矿机等级
    public static function minerlevel($amout){
        $name = '-';
        $level = Level::find()->where('reg_score_min <= :amout and reg_score_max >= :amout',[':amout' => $amout])->one();
        if($level){
            $name = $level->name;
        }
        return $name;
    }

    public static function actionAjaxrechargelist(){
        $res = Recharge::getList();
        $temp = ["total" => $res["total"], "rows" => []];

        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $temp["rows"][] = [
                    "id" => $item["id"],
                    "userid" => $item["userid"],
                    "username"=>$item["username"],
                    "hcg"=>$item["hcg"],
                    "hcg"=>$item["hcg"],
                    "money"=>$item["money"],
                    "scale"=>$item["scale"]?'1:'.$item["scale"]:'0',
                    "created_at" => Yii::$app->formatter->asDatetime($item["created_at"]),
//                    "action" => MTools::getStringActions([
//                        "update" => [
//                            "params" => ["id" => $item["id"]],
//                            "title" => "编辑"
//                        ],
//                        "detail" => [
//                            "params" => ["id" => $item["id"]],
//                            "title" => "查看详情"
//                        ],
//                    ])
                ];
            }
        }
        echo Json::encode($temp);
    }
    // 拨发积分
    public function actionHcg() {
        $ids = Yii::$app->request->post("id");
        if (empty($ids)) {
            Yii::$app->getSession()->setFlash('success', "请选择您要拨给的会员！");
        } else {
            //获取要拨发的userid数组
            $pk = strpos($ids, ",") !== false ? explode(",", $ids) : array($ids);
            //获取拨发的BBA个数
            $score = Yii::$app->request->post("score");

            $scoree = Yii::$app->request->post("scoree");
            $event = new \common\components\OperateEvent(["amount" => $score,"amountt" =>$scoree, "ids" => $pk]);
            $this->on("hcg", [$event, "sysHcg"]);
            $this->trigger("hcg", $event);
            $this->off("hcg");
            $str = "成功拨发积分".$score."!";
            if ($this->flag === true) {
                Yii::$app->getSession()->setFlash('success', $str);
            } else {
                Yii::$app->getSession()->setFlash('success', $this->message);
            }
        }
        $this->redirect(["list"]);
    }

    // 拨发推广收益
    public function actionCare() {
        $ids = Yii::$app->request->post("id");

        if (empty($ids)) {
            Yii::$app->getSession()->setFlash('success', "请选择您要拨给的会员！");
        } else {

            //获取要拨发的userid数组
            $pk = strpos($ids, ",") !== false ? explode(",", $ids) : array($ids);
            //获取拨发的推广收益个数
            $score = Yii::$app->request->post("score");

            $scoree = Yii::$app->request->post("scoree");

            $event = new \common\components\OperateEvent(["amount" => $score,"amountt" =>$scoree, "ids" => $pk]);
            $this->on("care", [$event, "sysCare"]);
            $this->trigger("care", $event);
            $this->off("care");
            $str = "成功拨发推广收益".$score."!";
            if ($this->flag === true) {
                Yii::$app->getSession()->setFlash('success', $str);
            } else {
                Yii::$app->getSession()->setFlash('success', $this->message);
            }
        }
        $this->redirect(["list"]);
    }
    //扣除积分
    public function actionReducehcg() {
        $ids = Yii::$app->request->post("id");
        if (empty($ids)) {
            Yii::$app->getSession()->setFlash('success', "请选择您要拨给的会员！");
        } else {
            $pk = strpos($ids, ",") !== false ? explode(",", $ids) : array($ids);
            $score = Yii::$app->request->post("score");
            $scoree = Yii::$app->request->post("scoree");
            $event = new \common\components\OperateEvent(["amount" => $score,"amountt" =>$scoree, "ids" => $pk]);
            $this->on("reducehcg", [$event, "sysReducehcg"]);
            $this->trigger("reducehcg", $event);
            $this->off("reducehcg");
            $str = "成功扣除积分".$score."!";
            if ($this->flag === true) {
                Yii::$app->getSession()->setFlash('success', $str);
            } else {
                Yii::$app->getSession()->setFlash('success', $this->message);
            }
        }
        $this->redirect(["list"]);
    }
    //扣除推广收益
    public function actionReducecare() {
        $ids = Yii::$app->request->post("id");
        if (empty($ids)) {
            Yii::$app->getSession()->setFlash('success', "请选择您要拨给的会员！");
        } else {
            $pk = strpos($ids, ",") !== false ? explode(",", $ids) : array($ids);
            $score = Yii::$app->request->post("score");
            $scoree = Yii::$app->request->post("scoree");
            $event = new \common\components\OperateEvent(["amount" => $score,"amountt" =>$scoree, "ids" => $pk]);
            $this->on("reducecare", [$event, "sysReducecare"]);
            $this->trigger("reducecare", $event);
            $this->off("reducecare");
            $str = "成功扣除积分".$score."!";
            if ($this->flag === true) {
                Yii::$app->getSession()->setFlash('success', $str);
            } else {
                Yii::$app->getSession()->setFlash('success', $this->message);
            }
        }
        $this->redirect(["list"]);
    }

    // 会员账户记录
    public function actionAjaxawardrecode() {
        $res = \common\models\UserWalletRecord::getList();

        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {

                $temp["rows"][] = [
                    "id" => $item["id"],
                    "userid" => $item["userid"],
                    "username" => ArrayHelper::getValue($item, "user.username"),
                    "amount" =>$item["pay_type"] == 1 ? MTools::setFontColor(1,$item["amount"]."(收入)") : MTools::setFontColor(0,$item["amount"]."(支出)"),
                    "event_type" => \frontend\models\WB_UserWalletRecord::$event_type[$item["event_type"]],
                    "wallet_type" => \frontend\models\WB_UserWalletRecord::$wallet_type[$item["wallet_type"]],
                    "wallet_amount" => $item["wallet_amount"],
                    "created_at" => Yii::$app->formatter->asDatetime($item["created_at"]),
                    "note" => $item["note"],
                ];
            }
        }


        echo Json::encode($temp);
    }

    // 交易记录
    public function actionAjaxamounttrade() {
        $res = \common\models\UserAmountTrade::getList();
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                if($item['status'] != 50) {
                    if ($item['status'] == 8) {      // 卖家申诉中
                        $action = MTools::getStringActions(["overtimeop" => ["params" => ["id" => $item["id"], "status" => $item['status']], "title" => "卖家申诉处理"]]);
                        $action3 = MTools::getStringActions(["overtimeop" => ["params" => ["id" => $item["id"], "status" => 6, "finishorder" => 1], "title" => "完结订单"]]);
                    } elseif ($item['status'] == 0 || $item['status'] == 1 || $item['status'] == 7) {  // 挂单、买家已下单、卖家已下单
                        $action = '-';
                        $action2 = MTools::getStringActions(["overtimeop" => ["params" => ["id" => $item["id"], "status" => $item['status'], "iscancel" => 1], "title" => "撤销"]]);
                        $action3 = '-';
                    } elseif ($item['status'] == 2) {
                        $action = '-';
                        $action2 = MTools::getStringActions(["overtimeop" => ["params" => ["id" => $item["id"], "status" => $item['status'], "iscancel" => 1], "title" => "撤销"]]);
                        $action3 = MTools::getStringActions(["overtimeop" => ["params" => ["id" => $item["id"], "status" => 6, "finishorder" => 1], "title" => "完结订单"]]);
                    } elseif ($item['status'] == 3 || $item['status'] == 4 || $item['status'] == 9 || $item['status'] == 10) {
                        $action = '-';
                        $action2 = '-';
                        $action3 = '-';
                    }
                    $buyer = \common\models\UserProfile::find()->where("userid=:userid", [":userid" => $item["in_userid"]])->asArray()->one();

                    $temp["rows"][] = [
                        "id" => $item["id"],
                        "in_username" => $item["in_username"] ? $item["in_username"] : '-',
                        "out_username" => $item["out_username"] ? $item["out_username"] : '-',
                        "amount" => $item["amount"],
                        "samount" => $item["samount"],
                        "number" => $item["number"],
                        "price" => $item["price"],
    //                    "order_type"    => \common\models\UserAmountTrade::$order_type[$item["order_type"]],
                        "status" => \common\models\UserAmountTrade::$status[$item["status"]],
                        "phone" => $item["phone"],
                        "buyer_phone" => $buyer["phone"],
                        "old_order_id" => $item["old_order_id"],
                        "created_at" => Yii::$app->formatter->asDatetime($item["created_at"]),
                        "traded_at" => $item["traded_at"] != 0 ? Yii::$app->formatter->asDatetime($item["traded_at"]) : '-',
                        "picture" => $item['picture'] ? \yii\bootstrap\Html::a(\yii\bootstrap\Html::img($item['picture'], ["width" => 120, "height" => 100]), $item['picture'], ['target' => "_blank"]) : '-',
                        "action" => $action,
                        "action2" => $action2,
                        "action3" => $action3
                    ];
                }
            }
        }
        echo Json::encode($temp);
    }

    // 超时处理操作
    public function actionOvertimeop() {
        $id = Yii::$app->request->get('id');
        $status = Yii::$app->request->get('status');
        $iscancel = Yii::$app->request->get('iscancel');
        $finishorder = Yii::$app->request->get('finishorder')?Yii::$app->request->get('finishorder'):100; // 是否后台完结订单
        $buyeruntradelimit = MTools::getYiiParams('buyeruntradelimit') ? MTools::getYiiParams('buyeruntradelimit') : 1 ;         // 买家未付款次数


        // 获取订单
        $order = \common\models\UserAmountTrade::find()->where('id=:id', [':id' => $id])->one();

        // 买家
        $inuser = \common\models\User::find()->where('id=:id', [':id' => $order->in_userid])->one();

        // 获取宠物发布表信息
        $zodiac_issue = \common\models\ZodiacIssue::find()->where('id=:id', [':id' => $order->areaid])->one();

        // 后台撤销订单
        if($iscancel == 1) {
            $notarr = array(3,4,9,10);      // 防止重复提交的订单状态值
            if(in_array($order->status, $notarr)) {
                $msg = "您已对订单号: ".$order->id." 进行过撤销订单处理，请勿重复提交";
                Yii::$app->getSession()->setFlash('error', $msg);
                $status = 101;
            } else {
                $modified = 0;
                if($order->status == 7) {   //只有此状态时才能取消(匹配成功,但未付款)
                    $modified = 1;
                    $order->status = 4;
                    //更改宠物产品状态
                    $zodiac_issue->issel = 0;
                    // $ss = SnapJudgment::findOne($zodiac_issue->id);
                    $ss = SnapJudgment::find()->where("issue_id = :issue_id and userid = :userid",[":issue_id"=>$zodiac_issue->id,':userid'=>$order->in_userid])->one();
                    $ss->issue_id = $ss->userid.'_'.time();
                }
                if($modified == 1) {
                    if ($order->save() && $zodiac_issue->save() && $order->save() && $ss->save()) {


                        Yii::$app->redis->lpush('zodiac_issue:'.$zodiac_issue->zodiac_id, 1);   //返还该宠物数量

                        $redis_num = count(Yii::$app->redis->lrange("zodiac_issue:".$zodiac_issue->zodiac_id,0,-1));

                        file_put_contents('../runtime/logs/redis_log.txt', '时间：'.time().'，后台撤销返还宠物'.$zodiac_issue->zodiac_id.'子，发行ID:'.$zodiac_issue->id.'num:'.$redis_num.PHP_EOL,FILE_APPEND);

                        $msg = '订单号：' . $order->id . ', 撤销成功';
                        Yii::$app->getSession()->setFlash('success', $msg);
                        $status = 100;
                    } else {
                        Yii::$app->getSession()->setFlash('error', '撤销失败');
                        $status = 100;
                    }
                }
            }
        }

        // 状态:8，卖家申诉；买家点击“确认付款”，但实际上并没有付款
        if($status == 8) {
            if($order->status != 8) {
                $msg = "您已对订单号: ".$order->id." 进行过卖家申诉处理，请勿重复提交";
                Yii::$app->getSession()->setFlash('error', $msg);
                $status = 101;
            } else {
                $order->status = 9;
                //更改宠物产品状态
                $zodiac_issue->issel = 0;
                //获取原来的抢购表
                // $ss = SnapJudgment::findOne($zodiac_issue->id);
                $ss = SnapJudgment::find()->where("issue_id = :issue_id and userid = :userid",[":issue_id"=>$zodiac_issue->id,':userid'=>$order->in_userid])->one();
                $ss->issue_id = $ss->userid.'_'.time();
                // 如果交易被申诉异常次数达到1次，封号
                $inuser->overtime_num += 1;
                if($inuser->overtime_num >= $buyeruntradelimit) {
                    $inuser->iseal = 1;
                }
                $msg = '卖家申诉处理已完成';
                if($inuser->save() && $zodiac_issue->save() && $order->save() && $ss->save()){
                    Yii::$app->redis->lpush('zodiac_issue:'.$zodiac_issue->zodiac_id, 1);   //返还该宠物数量
                    $redis_num = count(Yii::$app->redis->lrange("zodiac_issue:".$zodiac_issue->zodiac_id,0,-1));

                    file_put_contents('../runtime/logs/redis_log.txt', '时间：'.time().'，后台申诉成功返还宠物'.$zodiac_issue->zodiac_id.'子，发行ID:'.$zodiac_issue->id.'num:'.$redis_num.PHP_EOL,FILE_APPEND);
                    Yii::$app->getSession()->setFlash('success', $msg);
                }else{
                    Yii::$app->getSession()->setFlash('error', '订单处理失败');
                }

            }
        }

        // 付款超时处理
        if($status == 5) {
            if($order->status != 5) {
                $msg = "您已对订单号: ".$order->id." 进行过付款超时处理，请勿重复提交";
                Yii::$app->getSession()->setFlash('error', $msg);
                $status = 101;
            } else {
                $inuser->overtime_num += 1;                                    // 累加超时次数
                if($inuser->overtime_num >= $buyeruntradelimit) {                               // 如果付款超时次数达到3次，则禁止交易
                    $inuser->iseal = 1;
                }
                //更改宠物产品状态
                $zodiac_issue->issel = 0;
                //获取原来的抢购表
                // $ss = SnapJudgment::findOne($zodiac_issue->id);
                $ss = SnapJudgment::find()->where("issue_id = :issue_id and userid = :userid",[":issue_id"=>$zodiac_issue->id,':userid'=>$order->in_userid])->one();
	
                $ss->issue_id = $ss->userid.'_'.time();
                $order->status = 10;                                           // 状态设置为“付款超时，订单取消”
                $order->traded_at = time();                                    // 更新交易时间为当前时间

                if($inuser->save() && $zodiac_issue->save() && $order->save() && $ss->save()){
                    Yii::$app->redis->lpush('zodiac_issue:'.$zodiac_issue->zodiac_id, 1);   //返还该宠物数量
                    $redis_num = count(Yii::$app->redis->lrange("zodiac_issue:".$zodiac_issue->zodiac_id,0,-1));

                    file_put_contents('../runtime/logs/redis_log.txt', '时间：'.time().'，后台付款超时返还宠物'.$zodiac_issue->zodiac_id.'子，发行ID:'.$zodiac_issue->id.'num:'.$redis_num.PHP_EOL,FILE_APPEND);
                    Yii::$app->getSession()->setFlash('success', '付款超时订单处理成功');
                }else{
                    Yii::$app->getSession()->setFlash('error', '订单处理失败');
                }
            }
        }

        // 收款超时处理
        if($status == 6) {
            $notinarr = array(3,4,9,10);
            if($order->status != 6 && in_array($order->status, $notinarr)) {
                $msg = "您已对订单号: ".$order->id." 进行过收款超时或完结订单处理，请勿重复提交";
                Yii::$app->getSession()->setFlash('error', $msg);
                $status = 101;
            } else {
                $order->status = 3;                                                 // 状态设置为"订单已成交"
                $order->traded_at = time();                                      // 更新交易时间为当前时间
                //执行相关操作
                $zodiac_id = $zodiac_issue->zodiac_id;      //宠物id
                $zodiac_grade_id = $zodiac_issue->zodiac_grade_id;  //宠物等级id
                $zodiac = \common\models\Zodiac::findOne($zodiac_id);   //宠物表

                // 生成一条新的发行记录
                $new_issue = new ZodiacIssue();
                $new_issue->zodiac_id = $zodiac->id;
                $new_issue->zodiac_name = $zodiac->name;
                $new_issue->zodiac_grade_id = '';
                $new_issue->zodiac_grade_name = '';
                $new_issue->hcg = $zodiac_issue->hcg;
                $new_issue->cash = $zodiac_issue->cash;
                $new_issue->issel = 2;// 0:待匹配 1:已卖出 2:成长中
                $new_issue->created_at = time();
                $new_issue->updated_at = time();
                $new_issue->belong_id = $order->in_userid;
                if($new_issue->save()){
                    //创建领养记录
                    $userzodiac = new \common\models\UserZodiac();
                    $userzodiac->zodiac_id = $zodiac_id;
                    $userzodiac->issue_id = $new_issue->id;     //宠物发布表id
                    $userzodiac->zodiac_grade_id = $zodiac_grade_id;
                    $userzodiac->userid = $order->in_userid;
                    $userzodiac->username = $order->in_username;
                    $userzodiac->hcg = $zodiac_issue->hcg;
                    $userzodiac->old_hcg = $zodiac_issue->hcg;
                    $userzodiac->due = $zodiac->due;
                    $userzodiac->award = $zodiac->award;
                    $userzodiac->source = 0;    //来源 0:购买 1:后台/app兑换
                    $userzodiac->allow_rack = 0;    //是否允许出售 0:允许  1:不允许
                    // 当天零点时间戳
                    $zerotimestamp = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
                    $over_time = $zerotimestamp + 86400 * ($zodiac->due);
                    $userzodiac->over_time = $over_time;
                    $userzodiac->is_rack = 0;           //是否上架(0:未上架, 1:已上架)
                    $userzodiac->is_overtime = 0;       //是否过期(0:未过期, 1:已过期)
                    $userzodiac->created_at = time();
                    $userzodiac->updated_at = time();
                    $userzodiac->rise_num = 0;
                    //更新原发行表宠物为已完结状态
                    $zodiac_issue->issel = 1;   // 0:待匹配 1:已卖出 2:成长中
                    $order->areaid = $new_issue->id;
                }

                // 添加消息
                $notifiac = \frontend\models\WB_Notification::create_notify($order->id, $order->out_userid, $order->out_username, $order->in_userid, $order->in_username, $order->status, $order->type, $order->method, $order->order_type,1);
                //执行保存

                if($notifiac && $order->save() && $userzodiac->save() && $zodiac_issue->save()){
                    Yii::$app->getSession()->setFlash('success', '收款超时订单处理成功');
                }else{
                    Yii::$app->getSession()->setFlash('error', '收款超时订单处理成功');
                }
            }
        }

        $this->redirect(["amounttrade"]);
    }

    // 手动匹配一个数量区间某个数量值的交易订单
    public function actionSemiautomatch() {
        $num = Yii::$app->request->post('num');                 // 撮合数量
        $areaid = Yii::$app->request->post('areaid');           // 区间ID

        $is_done = UserAmountTrade::semiAutoMatch($num, $areaid);            // 手动撮合

        switch($is_done) {
            case 'done':
                Yii::$app->getSession()->setFlash('success', '手动撮合已完成');
                break;
            case 'nosellorders':
                Yii::$app->getSession()->setFlash('error', '此区间无挂卖订单');
                break;
            case 'nobuyorders':
                Yii::$app->getSession()->setFlash('error', '此区间无挂买订单');
                break;
            case 'failed':
                Yii::$app->getSession()->setFlash('error', '手动撮合失败');
                break;
            default:
                Yii::$app->getSession()->setFlash('error', '手动撮合失败');
                break;
        }

        $this->redirect(["amounttrade"]);
    }

    //转让激活码记录
    public function actionAjaxusercar() {
        $res = \common\models\UserCar::getList();
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $temp["rows"][] = [
                    "id" => $item["id"],
                    "userid" => $item["userid"],
                    "username" => $item["username"],
                    "car_id" => $item["car_id"],
                    "car_name" => $item["car_name"],
                    "en_car_name" => $item["en_car_name"],
                    "car_level" => $item["car_level"],
                    "car_price" => $item["car_price"],
                    "award_per" => Yii::$app->formatter->asPercent($item["award_per"],2),
                    "get_num" => $item["get_num"],
                    "out_num" => $item["out_num"],
                    "status" => UserCar::$status[$item["status"]],
                    "ip" => $item["ip"],
                    "created_at" => Yii::$app->formatter->asDatetime($item["created_at"]),
                ];
            }
        }
        echo Json::encode($temp);
    }

    //会员等级列表
    public function actionAjaxgrade() {
        $res = Grade::getList();
//        echo '<pre>';
//        var_dump($res);exit;
        echo Json::encode($res);
    }

    // 批量查询、批量封号->AJAX
    public function actionAjaxbatchoplist() {
        $res = MY_User::getBatchuserlist();
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $refer = \common\models\User::find()->andWhere(["=","mycode",$item['invite_code']])->one();
                $temp["rows"][] = [
                    "id"                => $item["id"],                                             // 用户ID
                    "username"          => $item["username"],                                       // 用户名
                    "invitename"        => $refer ? $refer->username : "系统账号",                  // 推荐人
                    "grade_name"=>ArrayHelper::getValue($item, "grade.name"),                  // VIP等级(1: v1, 2: v2, 3: v3)
                    "isactivate"        => $item["isactivate"] ? '是' : "否",                       // 是否激活(0: 否, 1: 是)
                    "phone"             => ArrayHelper::getValue($item, "userprofile.phone"),      // 手机号
                    "up_referrer_id"    => \yii\bootstrap\Html::textarea("up_referrer_id", ArrayHelper::getValue($item, "userprofile.up_referrer_id")), // 多代上级推荐人id
                    "down_team_id"      => \yii\bootstrap\Html::textarea("down_team_id", ArrayHelper::getValue($item, "userprofile.down_team_id")),     // 多代下级id
                    "iseal"             => $item["iseal"] ? '已封' : "正常",                        // 是否被封(0: 正常, 1: 已封)
//                    "free_wa"           => ArrayHelper::getValue($item, "wallet.free_wa"),
//                    "permanent_wa"      => ArrayHelper::getValue($item, "wallet.permanent_wa"),
                    "cash_wa"           => ArrayHelper::getValue($item, "wallet.cash_wa"),
                    "created_at"        => Yii::$app->formatter->asDatetime($item["created_at"]),
                    "last_login_at"     => Yii::$app->formatter->asDatetime($item["last_login_at"]),
                    "login_ip"          => $item["login_ip"],

                ];
            }
        }
        echo Json::encode($temp);
    }

    // 批量封号
    public function actionBatchsuspend() {
        $ids = Yii::$app->request->post('ids');      // 获取全部上级或全部下级

        if(substr($ids, 0, 1) == '-' || substr($ids, 0, -1) == '-') {
            Yii::$app->getSession()->setFlash('error', '不能以-作为开头和结尾');
        } elseif(!preg_match('/[0-9-]/', $ids)) {
            Yii::$app->getSession()->setFlash('error', '非法参数');
        } else {
            //        $ids = explode('-', $ids);
            $ids = str_replace("-", ",", $ids);
//        var_dump($ids);die;
            $sql = 'UPDATE `me_user` SET `iseal` = 1 where `id` in (' . $ids . ');';
            $res = Yii::$app->db->createCommand($sql)->execute();
            if($res) {
                Yii::$app->getSession()->setFlash('success', '批量处理成功！');
            } else {
                Yii::$app->getSession()->setFlash('error', '已批量处理');
            }
        }
        $this->redirect(["batchop"]);
//        Yii::$app->db->createCommand()->update('me_user', ['iseal' => 1], 'id in (:id)', ['id' => $ids])->execute();  // 由于yii2使用的是PDO，所以逗号会被截断掉

//        var_dump($ids);die;
    }

    // 批量解封
    public function actionBatchrelease() {
        $ids = Yii::$app->request->post('ids');      // 获取全部上级或全部下级

        if(substr($ids, 0, 1) == '-' || substr($ids, 0, -1) == '-') {
            Yii::$app->getSession()->setFlash('error', '不能以-作为开头和结尾');
        } elseif(!preg_match('/[0-9-]/', $ids)) {
            Yii::$app->getSession()->setFlash('error', '非法参数');
        } else {
            //        $ids = explode('-', $ids);
            $ids = str_replace("-", ",", $ids);
            //        var_dump($ids);die;
            $sql = 'UPDATE `me_user` SET `iseal` = 0 where `id` in (' . $ids . ');';
            $res = Yii::$app->db->createCommand($sql)->execute();
            if ($res) {
                Yii::$app->getSession()->setFlash('success', '批量处理成功！');
            } else {
                Yii::$app->getSession()->setFlash('error', '已批量处理');
            }
        }
        $this->redirect(["batchop"]);
//        Yii::$app->db->createCommand()->update('me_user', ['iseal' => 1], 'id in (:id)', ['id' => $ids])->execute();  // 由于yii2使用的是PDO，所以逗号会被截断掉

//        var_dump($ids);die;
    }

    // 批量查询7天未登录、卢宝、卢呗为0的账号 -> AJAX
    public function actionAjaxunloginlist() {
        $myuser = new MY_User();
        $res = $myuser->getUnloginlist();
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $refer = \common\models\User::find()->andWhere(["=","mycode",$item['invite_code']])->one();
                $temp["rows"][] = [
                    "id"                => $item["id"],                                             // 用户ID
                    "username"          => $item["username"],                                       // 用户名
                    "invitename"=>$refer ? $refer->username : "超级账号",                           // 推荐人
                    "grade_name"=>ArrayHelper::getValue($item, "grade.name"),                  // VIP等级(1: v1, 2: v2, 3: v3)
                    "isactivate"        => $item["isactivate"] ? '是' : "否",                       // 是否激活(0: 否, 1: 是)
                    "up_referrer_id"    => \yii\bootstrap\Html::textarea("up_referrer_id", ArrayHelper::getValue($item, "userprofile.up_referrer_id")), // 多代上级推荐人id
                    "down_team_id"      => \yii\bootstrap\Html::textarea("down_team_id", ArrayHelper::getValue($item, "userprofile.down_team_id")),     // 多代下级id
                    "iseal"             => $item["iseal"] ? '已封' : "正常",                        // 是否被封(0: 正常, 1: 已封)
//                    "free_wa"           => ArrayHelper::getValue($item, "wallet.free_wa"),
//                    "permanent_wa"      => ArrayHelper::getValue($item, "wallet.permanent_wa"),
                    "cash_wa"           => ArrayHelper::getValue($item, "wallet.cash_wa"),
                    "created_at"        => Yii::$app->formatter->asDatetime($item["created_at"]),
                    "last_login_at"     => Yii::$app->formatter->asDatetime($item["last_login_at"]),
                    "login_ip"          => $item["login_ip"],

                ];
            }
        }
        echo Json::encode($temp);
    }

    // 批量封号（7天未登录、卢宝、卢呗为0的账号）
    public function actionBatchunloginsuspend() {
        $ids = Yii::$app->request->post('ids');      // 获取全部上级或全部下级

        if(substr($ids, 0, 1) == '-' || substr($ids, 0, -1) == '-') {
            Yii::$app->getSession()->setFlash('error', '不能以-作为开头和结尾');
        } elseif(!preg_match('/[0-9-]/', $ids)) {
            Yii::$app->getSession()->setFlash('error', '非法参数');
        } else {
//        $ids = explode('-', $ids);
            $ids = str_replace("-", ",", $ids);
//        var_dump($ids);die;
            $sql = 'UPDATE `me_user` SET `iseal` = 1 where `id` in (' . $ids . ');';
            $res = Yii::$app->db->createCommand($sql)->execute();
            if ($res) {
                Yii::$app->getSession()->setFlash('success', '批量处理成功！');
            } else {
                Yii::$app->getSession()->setFlash('error', '已批量处理');
            }
        }
        $this->redirect(["getunlogin"]);
//        Yii::$app->db->createCommand()->update('me_user', ['iseal' => 1], 'id in (:id)', ['id' => $ids])->execute();  // 由于yii2使用的是PDO，所以逗号会被截断掉

//        var_dump($ids);die;
    }

    // 批量解封（7天未登录、卢宝、卢呗为0的账号）
    public function actionBatchunloginrelease() {
        $ids = Yii::$app->request->post('ids');      // 获取全部上级或全部下级

        if(substr($ids, 0, 1) == '-' || substr($ids, 0, -1) == '-') {
            Yii::$app->getSession()->setFlash('error', '不能以-作为开头和结尾');
        } elseif(!preg_match('/[0-9-]/', $ids)) {
            Yii::$app->getSession()->setFlash('error', '非法参数');
        } else {
//        $ids = explode('-', $ids);
            $ids = str_replace("-", ",", $ids);
//        var_dump($ids);die;
            $sql = 'UPDATE `me_user` SET `iseal` = 0 where `id` in (' . $ids . ');';
            $res = Yii::$app->db->createCommand($sql)->execute();
            if ($res) {
                Yii::$app->getSession()->setFlash('success', '批量处理成功！');
            } else {
                Yii::$app->getSession()->setFlash('error', '已批量处理');
            }
        }
        $this->redirect(["getunlogin"]);
//        Yii::$app->db->createCommand()->update('me_user', ['iseal' => 1], 'id in (:id)', ['id' => $ids])->execute();  // 由于yii2使用的是PDO，所以逗号会被截断掉

//        var_dump($ids);die;
    }
}
