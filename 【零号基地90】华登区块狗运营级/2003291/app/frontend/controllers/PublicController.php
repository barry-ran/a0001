<?php

namespace frontend\controllers;

use common\models\UserBind;
use common\models\UserConver;
use frontend\models\WB_CoinsOrder;
use yii\helpers\HtmlPurifier;
use yii\web\Controller;
use common\models\User;
use frontend\models\WB_User;
use Yii;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use common\components\MTools;
use common\models\UserWallet;
use common\models\UserWalletRecord;

use frontend\models\WB_UserAmountTrade;

class PublicController extends Controller {
    // 行情数据 -> AJAX
    public function actionMarketdata() {
        // 获取系统coins表各种币的价格（后台设置）
        $coins = \common\models\Coins::find()->select('name, en_name, us_price, price, baseVolume, percentChange')->asArray()->all();

        $data['status'] = '0001';
        $data['messaage'] = Yii::t('app', '成功');
        $data['data'] = $coins;

        echo json_encode($data);
    }

    // BTC当前行情接口（btc_usdt）
    public static function actionGetbtcusdt() {
        $url = 'https://data.gateio.co/api2/1/ticker/btc_usdt';
        $data = self::curlGet($url);
        echo json_encode($data);
    }

    // ETH当前行情接口（eth_usdt）
    public static function actionGetethusdt() {
        $url = 'https://data.gateio.co/api2/1/ticker/eth_usdt';
        $data = self::curlGet($url);
        echo json_encode($data);
    }

    // BTC历史行情接口（btc_usdt）
    public static function actionGetbtchistory() {
        $url = 'https://data.gateio.co/api2/1/tradeHistory/btc_usdt';
        $data = self::curlGet($url);
        echo json_encode($data);
    }

    // ETH历史行情接口（eth_usdt）
    public static function actionGetethhistory() {
        $url = 'https://data.gateio.co/api2/1/tradeHistory/eth_usdt';
        $data = self::curlGet($url);
        echo json_encode($data);
    }

    // BTC K线数据（btc_usdt）
    public static function actionGetbtckline() {
        $req = Yii::$app->request;

        // group_sec参数是每条数据间隔时间（以秒为单位）
        $group_sec = HtmlPurifier::process($req->post('group_sec'));

        // range_hour参数是从现在起往前 x 个小时
        $range_hour = HtmlPurifier::process($req->post('range_hour'));

        if($group_sec == '' || $range_hour == '') {
            $data['status'] = '0002';
            $data['message'] = Yii::t('app', '无效参数');
            echo json_encode($data);
            exit;
        }

        $url = 'https://data.gateio.co/api2/1/candlestick2/btc_usdt?group_sec='.$group_sec.'&range_hour='.$range_hour;;
        $data = self::curlGet($url);
        echo json_encode($data);
    }

    // ETH K线数据（eth_usdt）
    public static function actionGetethkline() {
        $req = Yii::$app->request;

        // group_sec参数是每条数据间隔时间（以秒为单位）
        $group_sec = HtmlPurifier::process($req->post('group_sec'));

        // range_hour参数是从现在起往前 x 个小时
        $range_hour = HtmlPurifier::process($req->post('range_hour'));

        if($group_sec == '' || $range_hour == '') {
            $data['status'] = '0002';
            $data['message'] = Yii::t('app', '无效参数');
            echo json_encode($data);
            exit;
        }

        $url = 'https://data.gateio.co/api2/1/candlestick2/eth_usdt?group_sec='.$group_sec.'&range_hour='.$range_hour;
        $data = self::curlGet($url);
        echo json_encode($data);
    }

    // 获取接口数据
    public static function curlGet($url){
        $ch = curl_init();
//        $header=array(
//            "Accept: application/json",
//            "Content-Type: application/x-www-form-urlencoded",
//        );
        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT,10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//绕过ssl验证
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        //执行并获取HTML文档内容
        $output = curl_exec($ch);
        //释放curl句柄
        curl_close($ch);
//        var_dump($output);die;
        $output = json_decode($output, true);
        return $output;
    }

}
