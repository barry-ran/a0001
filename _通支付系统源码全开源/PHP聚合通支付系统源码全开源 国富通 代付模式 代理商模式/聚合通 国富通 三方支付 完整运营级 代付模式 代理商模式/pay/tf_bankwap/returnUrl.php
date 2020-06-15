<?php
require_once 'inc.php';
use WY\app\model\Pushorder;

 

$orderid=isset($_GET['orderNum']) ? $_GET['orderNum'] : '';
$push=new Pushorder($orderid);
$push->sync();
?>
