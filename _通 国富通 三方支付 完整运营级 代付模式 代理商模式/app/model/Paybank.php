<?php
namespace WY\app\model;

use WY\app\libs\Http;
use WY\app\model\Tfpay;
if (!defined('WY_ROOT')) {
    exit;
}
class Paybank
{
    function __construct()
    {
        $this->pay = new Tfpay();
    }
    public function put($data)
    {
        return $this->pay->put($data);
    }
    public function getRet($code)
    {
        return $this->pay->getRet($code);
    }
}
?>