<?php 
use yii\helpers\Url;
use backend\models\MY_UserStock;
use common\models\UserWallet;
use common\models\Syscache;
use yii\helpers\Html;
//use yii\helpers\Url;
//$cash_wa = \common\models\UserWallet::find()->sum('cash_wa');
//$regist_wa = \common\models\UserWallet::find()->sum('regist_wa');
//$hcg_wa = \common\models\UserWallet::find()->sum('hcg_wa');
//$shop_wa = \common\models\UserWallet::find()->sum('shop_wa');
$data = Syscache::find()->where("created_at > 0")->orderBy("created_at desc")->one();
if(!$data instanceof Syscache){
    $cash_wa = 0;
    $regist_wa = 0;
    $hcg_wa = 0;
    $shop_wa = 0;
    $stock_count = 0;
    $sell_stock_count = 0;
    $time= time();
}else{
    $cash_wa = $data->cash_wa;
    $regist_wa = $data->regist_wa;
    $hcg_wa = $data->hcg_wa;
    $shop_wa = $data->shop_wa;
    $stock_count = $data->stockcount;
    $sell_stock_count = $data->sellstock;
    $time = $data->created_at;
}
//$walletcount = UserWallet::walletCount();
//$cash_wa = $walletcount['cash'];
//$regist_wa = $walletcount['regist'];
//$hcg_wa = $walletcount['hcg'];
//$shop_wa = $walletcount['shop'];
//$stock = MY_UserStock::SellStockCount();
//$stock_count = $stock['stockcount'];
//$sell_stock_count = $stock['sellstock'];
//$stock_count = MY_UserStock::stockCount();
//$sell_stock_count = MY_UserStock::SellStockCount();
?>
<div class="mainindex">
    <div class="welinfo">
        <span><img src="images/sun.png" alt="天气" /></span>
        <b><?php echo Yii::$app->user->identity->username;?>您好，欢迎使用信息管理系统</b>
        <a href="javascript:;">帐号设置</a>
    </div>
    <div class="welinfo">
        <span><img src="images/time.png" alt="时间" /></span>
        <i>您上次登录的时间：<?php echo Yii::$app->formatter->asDatetime(Yii::$app->user->identity->last_login_at);?></i> （不是您登录的？<a href="javascript:;">请点这里</a>）
    </div>
    <div class="xline"></div>
    <ul class="iconlist">
        <li><img src="images/ico02.png" /><p><a href="<?php echo Url::toRoute(["article/create"]);?>">发布文章</a></p></li>
        <li><img src="images/ico03.png" /><p><a href="<?php echo Url::toRoute(["stat/awardlist"]);?>">数据统计</a></p></li>
        <li><img src="images/ico05.png" /><p><a href="<?php echo Url::toRoute(["regist/list"]);?>">会员管理</a></p></li>
    </ul>
    <div class="xline"></div>
    <div class="box"></div>
        <div class="welinfo">
            <span><img src="images/time.png" alt="时间" /></span>
            <i>上次更新数据时间：<?php echo Yii::$app->formatter->asDatetime($time);?></i>  <?php echo Html::a("更新数据", Url::toRoute(["site/updatacount"]))?>
        </div>
        <ul class="iconlist">
        <li>
            <p style="font-size: 20px">会员账户现金卢呗总量</p>
            <p style="font-size: 18px"><?php echo Yii::$app->formatter->asDecimal($cash_wa,2)?></p>
        </li>
        <li>
            <p style="font-size: 20px">会员账户注册卢呗总量</p>
            <p style="font-size: 18px"><?php echo Yii::$app->formatter->asDecimal($regist_wa,2)?></p>
        </li>
        <li>
            <p style="font-size: 20px">会员账户DFC卢呗总量</p>
            <p style="font-size: 18px"><?php echo Yii::$app->formatter->asDecimal($hcg_wa,2)?></p>
        </li>
        <li>
            <p style="font-size: 20px">会员账户娱乐卢呗总量</p>
            <p style="font-size: 18px"><?php echo Yii::$app->formatter->asDecimal($shop_wa,2)?></p>
        </li>
        <li>
            <p style="font-size: 20px">会员DFC总量</p>
            <p style="font-size: 18px"><?php echo Yii::$app->formatter->asDecimal($stock_count,0)?></p>
        </li>
        <li>
            <p style="font-size: 20px">会员可售DFC总量</p>
            <p style="font-size: 18px"><?php echo Yii::$app->formatter->asDecimal($sell_stock_count,0)?></p>
        </li>
        </ul>
</div>
