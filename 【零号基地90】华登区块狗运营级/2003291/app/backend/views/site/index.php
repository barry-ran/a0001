<?php

use yii\helpers\Url;
?>
<style>
    ul li{list-style: none;margin-left: 20px}
    table th,td{
        text-align: center;
    }
</style>
<div class="mainindex">
    <div class="welinfo">
        <span><img src="/images/sun.png" alt="天气" /></span>
        <b><?php echo Yii::$app->user->identity->username;?>您好，欢迎使用信息管理系统</b>
<!--        <a href="javascript:;">帐号设置</a>-->
    </div>
    <div class="welinfo">
        <span><img src="/images/time.png" alt="时间" /></span>
        <i>您上次登录的时间：<?php echo Yii::$app->formatter->asDatetime(Yii::$app->user->identity->last_login_at);?></i> 
<!--        （不是您登录的？<a href="javascript:;">请点这里</a>）-->
    </div>
    <div class="xline"></div>
    <ul class="iconlist">
        <li><img src="/images/ico02.png" /><p><a href="<?php echo yii\helpers\Url::toRoute(["article/create"]);?>">发布文章</a></p></li>
        <li><img src="/images/ico03.png" /><p><a href="<?php echo Url::toRoute(["regist/awardrecode"]);?>">数据统计</a></p></li>
        <li><img src="/images/ico05.png" /><p><a href="<?php echo Url::toRoute(["regist/list"]);?>">会员管理</a></p></li>
    </ul>
    <div class="xline"></div>
    <ul class="iconlist">
        <li><p>平台积分总拨发量:<?php echo $lubao?$lubao:0?></p></li>
        <li><p>平台积分总量:<?php echo $user_lubao?$user_lubao:0?></p></li>

    </ul>
    <ul class="iconlist">
        <li><p>今日注册会员人数:<?php echo $registNum?$registNum:0?></p></li>
    </ul>
    <ul class="iconlist">
        <li><p>成交订单:<?php echo $TotalNum?$TotalNum:0?></p></li>
        <li><p>成交总额:<?php echo $buyNum?$buyNum:0?></p></li>
    </ul>
    <ul class="iconlist">
        <li><p>平台预约/抢购收入总额:<?php echo $income_service?$income_service:0?></p></li>
        <li><p>平台手续费收入总额:<?php echo $income_agency?$income_agency:0?></p></li>
    </ul>
    <div class="box"></div>
    <hr/>
    <table class="table table-bordered" >
        <tr>
            <th>宠物名称</th>
            <th>今日预约</th>
            <th>今日到期</th>
            <th>今日转换</th>
            <th>今日抢购总次数</th>
            <th>抢购成功</th>
            <th>抢购失败</th>
            <th>宠物总数</th>
        </tr>
        <?php foreach($list as $value){?>
            <tr>
                <td><?php echo $value['name']?></td>
                <td><?php echo $value['yuyue_num']?></td>
                <td><?php echo $value['daoqi_num']?></td>
                <td><?php echo $value['over_num']?></td>
                <td><?php echo $value['kill_total']?></td>
                <td><?php echo $value['success_num']?></td>
                <td><?php echo $value['failed_num']?></td>
                <td><?php echo $value['zodiac_num']?></td>
            </tr>
        <?php }?>
    </table>
</div>
