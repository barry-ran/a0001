<?php

namespace backend\controllers;

/**
 * @author  余榕林
 * @date    2019-07-03 18:06:44
 * @version V1.0
 * @desc
 */

use backend\models\MY_IssueForm;
use backend\models\TaskparamsForm;
use common\components\BController;
use common\components\MTools;
use common\models\UserZodiac;
use common\models\ZodiacApply;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use Yii;
use common\models\Zodiac;
use common\models\ZodiacGrade;
use common\models\UserAmountTrade;
use common\models\ZodiacIssue;
use yii\web\User;

class ZodiacController extends BController {

    public $flag = false;
    public $message = "";

    public function actions() {
        return [
            //宠物列表
            "list" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new Zodiac()
            ],
            //编辑宠物
            "update" => [
                "class" => "\common\actions\UpdateAction",
                "modelClass" => new Zodiac(),
                "renderParams" => ["action" => "update"],
                "renderTo" => "create",
                "redirectParams" => ["id" => ""]
            ],
            //添加宠物
            "create" => [
                "class" => "\common\actions\CreateAction",
                "modelClass" => new Zodiac(),
                "renderParams" => ["action" => "create"],
            ],
            //删除宠物
            "delete" => [
                "class" => "\common\actions\DeleteAction",
                "modelClass" => new Zodiac(),
                "redirectTo" => "list",
            ],
            //宠物等级列表
            "grade_list" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new ZodiacGrade(),
                "renderTo" => "zodiacgrade",
            ],
            //编辑宠物等级
            "updategrade" => [
                "class" => "\common\actions\UpdateAction",
                "modelClass" => new ZodiacGrade(),
                "renderParams" => ["action" => "updategrade"],
                "renderTo" => "creategrade",
                "redirectParams" => ["id" => ""],
                "redirectTo" => "grade_list",
            ],
            //发售宠物产品
            "release_zodiac" => [
                "class" => "\common\actions\CreateAction",
                "modelClass" => new MY_IssueForm(),
                "renderParams" => ["action" => "release_zodiac"],
                "renderTo" => "release",
                "redirectTo" => "release_list",
                "redirectParams" => ["id" => ""]
            ],
            //宠物发行列表
            "release_list" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new ZodiacIssue(),
                "renderTo" => "releaselist",
            ],
            //宠物预约列表
            "apply_list" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new ZodiacApply(),
                "renderTo" => "apply_list",
            ],
            //宠物列表
            "user_zodiac" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new UserZodiac(),
                "renderTo" => "user_zodiac",
            ],
        ];
    }

    //获取宠物列表Ajax
    public function actionAjaxlist() {
        $res = Zodiac::getList();
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $temp["rows"][] = [
                    "id" => $item["id"],
                    "name" => $item["name"],
                    "begin_at_hour" => $item["begin_at_hour"],
                    "begin_at_minu" => $item["begin_at_minu"],
                    "end_at_hour" => $item["end_at_hour"],
                    "end_at_minu" => $item["end_at_minu"],
                    "is_show" => $item["is_show"]?"是":"否",
                    "subscribe" => $item["subscribe"],
                    "seckill" => $item["seckill"],
                    "fee" => $item["fee"],
                    "picture" => $item["picture"] ? \yii\bootstrap\Html::a(\yii\bootstrap\Html::img($item['picture'], ["width" => 120, "height" => 100]), $item['picture'], ['target' => "_blank"]) : '-',
                    "due" => $item["due"],
                    "click_num" => $item["click_num"],
                    "award" => $item["award"],
                    "hcg_min" => $item['hcg_min'],
                    "hcg_max" => $item['hcg_max'],
                    "kmd" => $item['kmd'],
                    'cash' => $item['cash'],
                    'issue_num' => $item['issue_num'],
                    "updated_at" => Yii::$app->formatter->asDatetime($item["updated_at"]),
                    "action" => MTools::getStringActions([
                        "update" => [
                            "params" => ["id" => $item["id"]],
                            "title" => "编辑"
                        ],
                        "delete" => [
                            "params" => ["id" => $item["id"]],
                            "title" => "删除"
                        ],
                    ])
                ];
            }
        }
        echo Json::encode($temp);
    }

    //获取用户宠物列表Ajax
    public function actionAjaxuserzodiac() {
        $res = UserZodiac::getList();
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $zodiac = Zodiac::findOne($item["zodiac_id"]);
                //获取发行表对应信息
                $issue = ZodiacIssue::findOne($item['issue_id']);
                if($issue->issel == 1){
                    $action = ' - - ';
                    $is_sell = '0';     //已售出
                }else{
                    $is_sell = '1';     //未售出
                    if($item['allow_rack'] == 1){
                        $action = MTools::getStringActions(
                            [
                                "endeleteuserzodiac" => [
                                    "params" => ["id" => $item["id"]],
                                    "title" => "还原"]
                            ]
                        );
                    }else{
                        $action = MTools::getStringActions(
                            ["deleteuserzodiac" => [
                                "params" => ["id" => $item["id"]],
                                "title" => "删除"]
                            ]
                        );
                    }
                }


                $temp["rows"][] = [
                    "id" => $item["id"],
                    "userid" => $item["userid"],
                    "username" => $item["username"],
                    "zodiac_id" => $item["zodiac_id"],
                    "zodiac_name" => $zodiac->name,
                    "old_hcg" => $item["old_hcg"],
                    "hcg" => $item["hcg"],
                    "created_at" => Yii::$app->formatter->asDatetime($item["created_at"]),
                    "due" => $item["due"],
                    "award" => $item["award"],
                    "rise_num" => $item["rise_num"],
                    'is_sell' => $is_sell == 1 ? MTools::setFontColor(1,"未售出") : MTools::setFontColor(0,"已售出"),
                    "is_rack" => $item["is_rack"]?'已上架':'未上架',
                    "is_overtime" => $item["is_overtime"]?'已过期':'未过期',
                    "source" => $item["source"]?'推广收益提取/后台发布':'抢购',
                    "allow_rack" => $item["source"]?'不允许':'允许',
                    "over_time" => Yii::$app->formatter->asDatetime($item["over_time"]),
                    "updated_at" => Yii::$app->formatter->asDatetime($item["updated_at"]),
                    "action" => $action
                ];
            }
        }
        echo Json::encode($temp);
    }

    //获取宠物等级列表Ajax
    public function actionAjaxgradelist() {
        $res = ZodiacGrade::getList();
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $temp["rows"][] = [
                    "id" => $item["id"],
                    "name" => $item["name"],
                    "hcg_min" => $item["hcg_min"],
                    "hcg_max" => $item["hcg_max"],
                    "cash_min" => $item["cash_min"],
                    "cash_max" => $item["cash_max"],
                    "zodiac_id" => $item["zodiac_id"],
                    "created_at" => Yii::$app->formatter->asDatetime($item["created_at"]),
                    "updated_at" => Yii::$app->formatter->asDatetime($item["updated_at"]),
                    "action" => MTools::getStringActions([
                        "updategrade" => [
                            "params" => ["id" => $item["id"]],
                            "title" => "编辑"
                        ],
                    ])
                ];
            }
        }
        echo Json::encode($temp);
    }

    //获取宠物发行列表Ajax
    public function actionAjaxreleaselist() {
        $res = ZodiacIssue::getList();

        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                $zodiac = Zodiac::findOne($item['zodiac_id']);
                if($zodiac){
                    if($item["issel"]==0){
                        $issel = '等待卖出';
                    }elseif ($item["issel"]==1){
                        $issel = '交易中';
                    }else{
                        $issel = '成长中';
                    }
                    $temp["rows"][] = [
                        "id" => $item["id"],
                        "zodiac_name" => $zodiac->name,
                        "hcg" => $item["hcg"],
                        "cash" => $item["cash"],
                        "due" => $zodiac->due.'天',
                        "belong_name" => $item->user->username? $item->user->username:1,
                        "issel" => $issel,
                        "created_at" => Yii::$app->formatter->asDatetime($item["created_at"])
                    ];
                }
            }
        }
        echo Json::encode($temp);
    }

    //拆分宠物
    public function actionReleasezodiac(){
        $ids = Yii::$app->request->post("id");

        if (empty($ids)) {
            Yii::$app->getSession()->setFlash('success', "请选择要拆分的产品！");
        } else {
            //获取要拆分的zodiac_issue_id数组
            $pk = strpos($ids, ",") !== false ? explode(",", $ids) : array($ids);
            //获取拆分的产品价格
            $score = Yii::$app->request->post("score");
            //获取拆分原因
            $scoree = Yii::$app->request->post("scoree");

            $event = new \common\components\OperateEvent(["amount" => $score,"amountt" =>$scoree, "ids" => $pk]);
            $this->on("releasezodiac", [$event, "sysReleasezodiac"]);
            $this->trigger("releasezodiac", $event);
            $this->off("releasezodiac");
            $str = "成功拆分产品！";
//            echo '<pre>';
//            var_dump($str);exit;
            if ($this->flag === true) {
                Yii::$app->getSession()->setFlash('success', $str);
            } else {
                Yii::$app->getSession()->setFlash('success', $this->message);
            }
        }
        $this->redirect(["release_list"]);
    }

    //获取预约列表Ajax
    public function actionAjaxapplylist() {
        $res = ZodiacApply::getList();
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {

            foreach ($res["data"] as $item) {
                $zodiac_name = Zodiac::find()->where('id = :id',[':id' => $item["zodiac_id"]])->one();
                $grade_name = ZodiacGrade::find()->where('id = :id',[':id' => $item["zodiac_grade_id"] ])->one();
                $user = \common\models\User::find()->where('id = :id',[':id' => $item["userid"]])->one();
                if($item['status'] == 0){
                    $status = '预约中';
                }elseif($item['status'] == 1){
                    $status = '预约失败';
                }else{
                    $status = '预约成功';
                }
                if($item['islock']){
                    $action = MTools::getStringActions([
                        "unlock_get" => [
                            "params" => ["id" => $item["id"]],
                            "title" => "解除"
                        ],
                    ]);
                }else{
                    $action = MTools::getStringActions([
                        "lock_get" => [
                            "params" => ["id" => $item["id"]],
                            "title" => "限制"
                        ],
                    ]);
                }

                $temp["rows"][] = [
                    "id" => $item["id"],
                    "userid" => $item["userid"],
                    "username" => $user->username,
                    "zodiac_name" => $zodiac_name->name,
//                    "grade_name" => $grade_name->name,
                    "created_at" => Yii::$app->formatter->asDatetime($item["created_at"]),
                    'status' => $status,
                    'islock' => $item['islock']== 0 ? '未限制抢购' : "已限制抢购",    //是否限制抢购
                    "action" => $action
                ];
            }
        }
        echo Json::encode($temp);
    }

    //限制抢购
    public function actionLock_get(){
        $id = Yii::$app->request->get('id');
        $zodiac_apply= ZodiacApply::find()->where('id = :id',[':id' => $id])->one();
        $zodiac_apply->islock = 1;
        if($zodiac_apply->save()){
            Yii::$app->getSession()->setFlash('success', '操作成功');
        }
        $this->redirect(["apply_list"]);
    }

    //解除限制
    public function actionUnlock_get(){
        $id = Yii::$app->request->get('id');
        $zodiac_apply= ZodiacApply::find()->where('id = :id',[':id' => $id])->one();
        $zodiac_apply->islock = 0;
        if($zodiac_apply->save()){
            Yii::$app->getSession()->setFlash('success', '操作成功');
        }
        $this->redirect(["apply_list"]);
    }

    //删除用户宠物
    public function actionDeleteuserzodiac(){
        $id = Yii::$app->request->get('id');
        $user_zodiac = UserZodiac::findOne($id);    //获取当前用户宠物信息
        $zodiac_issue = ZodiacIssue::find()->where('id = :id',[':id'=>$user_zodiac->issue_id])->one();  //获取该宠物发行信息
        //更改允许上架的状态
        $user_zodiac->allow_rack = 1;
        //插入管理员日志
        $ac_log = \common\models\Actionlog::setLog('删除宠物：'.$id);
        //只有已过期(已上架)的宠物才能进行redis操作
        if($user_zodiac->is_overtime && $user_zodiac->is_rack){
            $zodiac_issue->issel = 3;   //限制出售
            if($user_zodiac->save() && $ac_log && $zodiac_issue->save()){
                Yii::$app->redis->lpop('zodiac_issue:'.$zodiac_issue->zodiac_id);   //缓存数量减少一个

                $redis_num = count(Yii::$app->redis->lrange("zodiac_issue:".$zodiac_issue->zodiac_id,0,-1));

                file_put_contents('../runtime/logs/redis_log.txt', '时间：'.time().'，后台删除用户宠物'.$zodiac_issue->zodiac_id.'子，发行ID:'.$zodiac_issue->id.'num:'.$redis_num.PHP_EOL,FILE_APPEND);
                Yii::$app->getSession()->setFlash('success', '删除成功');
            }else{
                Yii::$app->getSession()->setFlash('error', '删除失败');
            }
        }else{
            if($user_zodiac->save() && $ac_log){
                Yii::$app->getSession()->setFlash('success', '删除成功');
            }else{
                Yii::$app->getSession()->setFlash('error', '删除失败');
            }
        }

        $this->redirect(["user_zodiac"]);
    }

    //还原用户被删除的宠物
    public function actionEndeleteuserzodiac(){
        $id = Yii::$app->request->get('id');
        $user_zodiac = UserZodiac::findOne($id);
        $user_zodiac->allow_rack = 0;
        $zodiac_issue = ZodiacIssue::find()->where('id = :id',[':id'=>$user_zodiac->issue_id])->one();
        //插入管理员日志
        $ac_log = \common\models\Actionlog::setLog('还原宠物：'.$id);
        //如果是未上架,未过期的宠物,则只改变允许出售的状态
        if($user_zodiac->is_overtime == 0 && $user_zodiac->is_rack == 0){
            if($user_zodiac->save() && $ac_log){
                Yii::$app->getSession()->setFlash('success', '还原成功');
            }else{
                Yii::$app->getSession()->setFlash('error', '删除失败');
            }
        }else{
            $zodiac_issue->issel = 0;           //待匹配
            $user_zodiac->is_rack = 1;          //改为已上架
            $user_zodiac->is_overtime = 1;      //改为已过期
            if($user_zodiac->save() && $ac_log && $zodiac_issue->save()){
                Yii::$app->redis->lpush('zodiac_issue:'.$zodiac_issue->zodiac_id,'1');      //缓存数量增加一个
                $redis_num = count(Yii::$app->redis->lrange("zodiac_issue:".$zodiac_issue->zodiac_id,0,-1));

                file_put_contents('../runtime/logs/redis_log.txt', '时间：'.time().'，后台还原删除用户宠物'.$zodiac_issue->zodiac_id.'子，发行ID:'.$zodiac_issue->id.'num:'.$redis_num.PHP_EOL,FILE_APPEND);
                Yii::$app->getSession()->setFlash('success', '还原成功');
            }else{
                Yii::$app->getSession()->setFlash('error', '还原失败');
            }
        }

        $this->redirect(["user_zodiac"]);
    }

}
