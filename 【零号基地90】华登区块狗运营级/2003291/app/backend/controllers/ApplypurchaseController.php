<?php

namespace backend\controllers;

/**
 * @author  w
 * @date    2018-09-08 10:05:36
 * @version V1.0
 * @desc
 */
use backend\models\UserForm;
use common\models\Applypurchase;
use common\models\Grade;
use common\models\Level;
use common\models\User;
use common\models\UserWallet;
use common\components\BController;
use backend\models\MY_User;
use common\models\UserConver;
use common\models\UserCar;
use common\models\UserWalletRecord;
use Yii;
use yii\helpers\Json;
use common\components\MTools;
use yii\helpers\ArrayHelper;
use backend\models\TaskparamsForm;
use common\models\CareOrder;
use common\models\UserSign;

class ApplypurchaseController extends BController {

    public $flag = false;
    public $message = "";

    /*
     * 会员查询
     */

    public function actions() {
        return [
            "applypurchaselist" => [
                "class" => "\common\actions\ListAction",
                "modelClass" => new \common\models\Applypurchase(),
                "renderTo" => "applypur"
            ],
        ];
    }

    // 申购参数配置
    public function actionTaskparams() {
        $model = new TaskparamsForm();
        foreach ($model->attributes() as $attribute) {
            $model->$attribute = ArrayHelper::getValue(Yii::$app->params, $attribute);
        };
        $res = array("errors" => array(), "model" => $model);
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $flag = $model->updateParams();
            if ($flag !== false) {
                \common\models\Actionlog::setLog('修改配置参数');
                Yii::$app->getSession()->setFlash('success', '更新成功!');
            } else {
                $res = $flag;
                Yii::$app->getSession()->setFlash('error', $res["errors"]);
            }
        }
        return $this->render("taskparams", array_merge($res, array("action" => "taskparams", "labels" => $model->attributeLabels())));
    }

    // 申购列表 -> AJAX
    public function actionAjaxapplypurchase() {
        $res = \common\models\Applypurchase::getList();
        $coins = \common\models\Coins::find()->asArray()->all();

//        var_dump($coins);die;
        $temp = ["total" => $res["total"], "rows" => []];
        if ($res["total"] > 0) {
            foreach ($res["data"] as $item) {
                switch($item['coin_type']) {
                    case 1:
                        $item['coin_type'] = $coins[0]['name'];
                        break;
                    case 2:
                        $item['coin_type'] = $coins[1]['name'];
                        break;
                    case 3:
                        $item['coin_type'] = $coins[2]['name'];
                        break;
                    case 4:
                        $item['coin_type'] = $coins[3]['name'];
                        break;
                    case 5:
                        $item['coin_type'] = $coins[4]['name'];
                        break;
                    case 6:
                        $item['coin_type'] = $coins[5]['name'];
                        break;
                    case 7:
                        $item['coin_type'] = $coins[6]['name'];
                        break;
                    case 8:
                        $item['coin_type'] = $coins[7]['name'];
                        break;
                    default:
                        break;
                }
                $temp["rows"][] = [
                    "id"            => $item["id"],
                    "userid"        => $item["userid"],
                    "username"      => $item["username"],
                    "wallet_token"  => $item["wallet_token"],
                    "number"        => $item["number"],
                    "totalamount"   => $item["totalamount"],
                    "miner_fee"     => $item["miner_fee"] ,
                    "miner_rate"    => (int)$item["miner_rate"] .'%',
                    "coin_type"     => $item["coin_type"],
                    "status"        => Applypurchase::$status_cn[$item["status"]],
                    "add_label"     => $item["add_label"],
                    "branch_id"     => $item["branch_id"],
                    "created_at"    => Yii::$app->formatter->asDatetime($item["created_at"]),
                    "updated_at"    => Yii::$app->formatter->asDatetime($item["updated_at"]),
                ];
            }
        }
        echo Json::encode($temp);
    }

    // 申购完成
    public function actionFinishorder() {
        $id = Yii::$app->request->post('id');            // 获取申购订单id

        if(empty($id)) {
            Yii::$app->getSession()->setFlash('success', "请选择您要完成的申购订单！");
        } else {
            // 修改申购订单状态
            $order = \common\models\Applypurchase::find()->where('id=:id', [':id' => $id])->one();
            if($order->status == 1) {
                Yii::$app->getSession()->setFlash('error', "此订单状态已是 申购已完成 ");
            } elseif($order->status == 2) {
                Yii::$app->getSession()->setFlash('error', "此订单状态已是 申购不成功 ");
            } else {
                $order->status = 1;
                $order->updated_at = time();
                if($order->save()) {
//                    $userwallet = \common\models\UserWallet::find()->where('userid=:userid', ['userid' => $order->userid])->one();
//                    switch($order->coin_type) {
//                        case '比特币':
//                        case 'BTC':
//                            $userwallet['btc_wa'] += $order->number;
//                            $userwallet->save();
//                            break;
//                        case '莱特币':
//                        case 'LTC':
//                            $userwallet['ltc_wa'] += $order->number;
//                            $userwallet->save();
//                            break;
//                        case '以太坊':
//                        case 'ETH':
//                            $userwallet['eth_wa'] += $order->number;
//                            $userwallet->save();
//                            break;
//                        case '柚子币':
//                        case 'EOS':
//                            $userwallet['eos_wa'] += $order->number;
//                            $userwallet->save();
//                            break;
//                        case '以太经典':
//                        case 'ETC':
//                            $userwallet['etc_wa'] += $order->number;
//                            $userwallet->save();
//                            break;
//                        default:
//                            break;
//                    }
                    // 给用户发送申购完成的短信
                    $user_profile = \common\models\UserProfile::find()->where('userid=:userid', [':userid' => $order->userid])->one();
                    if($user_profile->quhao == '86') {
                        $text = '【LKC】尊敬的用户，您申购的 '.$order->coin_type.' 数字货币'.$order->number.'个已到账，请您及时查收。';
                    } else {
                        $text = '【LKC】Dear User，Your Apply buying '.$order->number.' '.$order->coin_type.' have been received, please check wallet in time.';
                    }
                    MTools::SendTradeMsg($user_profile->quhao.$user_profile->phone, $text);

                    Yii::$app->getSession()->setFlash('success', '用户: '. $order->username . ' 申购已完成!');
                } else {
                    Yii::$app->getSession()->setFlash('error', '未知问题，请联系管理员');
                }
            }
        }

        $this->redirect(["applypurchaselist"]);
    }

    // 申购失败，返还用户LKC
    public function actionDealfail() {
        $id = Yii::$app->request->post('id');            // 获取申购订单id
        if(empty($id)) {
            Yii::$app->getSession()->setFlash('success', "请选择您要完成的申购订单！");
        } else {
            // 获得订单
            $order = \common\models\Applypurchase::find()->where('id=:id', [':id' => $id])->one();

            if ($order->status == 1) {
                Yii::$app->getSession()->setFlash('error', "此订单状态已是 申购已完成 ");
            } elseif ($order->status == 2) {
                Yii::$app->getSession()->setFlash('error', "此订单状态已是 申购不成功 ");
            } else {
                $order->status = 2;
                $order->updated_at = time();
                // 获取用户钱包
                $userwallet = UserWallet::find()->where('userid=:userid', [':userid' => $order->userid])->one();

                // 获取当前用户的分区id
                $branch = User::find()->select('branch_id')->where('id = :id',[':id' => $order->userid])->one();

                if($order->created_at < 1552406400) {
                    $userwallet->cash_wa += $order->totalamount;         // 返还用户卢宝
                    // 返还卢宝钱包记录
                    $userwalletrecord = UserWalletRecord::insertrecord($order->userid, $order->totalamount, 27, 1, 2, $userwallet->cash_wa, Yii::t('app', '申购失败，返还卢宝'),$branch->branch_id);
                    $message = '申购未成功，返还用户: ' . $order->username . ' 卢宝: ' . $order->totalamount . '个';
                } else {
                    $userwallet->care_wa += $order->totalamount;         // 返还用户LKC
                    // 返还LKC钱包记录
                    $userwalletrecord = UserWalletRecord::insertrecord($order->userid, $order->totalamount, 27, 1, 3, $userwallet->care_wa, Yii::t('app', '申购失败，返还LKC'),$branch->branch_id);
                    $message = '申购未成功，返还用户: ' . $order->username . ' LKC: ' . $order->totalamount . '个';
                }

                if ($order->save() && $userwallet->save() && $userwalletrecord) {
//                    Yii::$app->getSession()->setFlash('success', '申购未成功，返还用户: ' . $order->username . ' 申购手续费(卢宝): ' . $order->miner_fee);
                    Yii::$app->getSession()->setFlash('success', $message);
                } else {
                    Yii::$app->getSession()->setFlash('error', '未知问题，请联系管理员');
                }
            }
        }

        $this->redirect(["applypurchaselist"]);
    }
}
