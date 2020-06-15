<?php

namespace common\components;

use Yii;
use yii\base\Component;

class ApiData extends Component {
    
    //地理api  URL
    private $api_geogUrl = "http://ip.taobao.com/service/getIpInfo.php?ip=";
    /*
     *  获取用户真实IP
     */

    public function realIp() {
        $ip = false;
        $server = $_SERVER;
        $seq = [ 'HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'];
        foreach ($seq as $key) {
            if (\array_key_exists($key, $server) === true) {
                foreach (explode(',', $server[$key]) as $ip) {
                    if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
                        return $ip;
                    }
                }
            }
        }
    }

    /**
     * 获取 IP  地理位置
     * 淘宝IP接口
     * @Return: array
     */
    function getCity($ip) {
        $url = $this->api_geogUrl . $ip;
        $res = json_decode(Yii::$app->curl->post($url));
        if ( $res->code === 1) {
            return false;
        }
        $data = $res->data->city;
        return $data;
    }

}
