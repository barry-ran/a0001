<?php

use yii\helpers\Url;
?>
<header data-am-widget="header" class="am-header am-header-default" style="height: 8%;background-color:#F7CA4B;">
    <div class="am-header-left am-header-nav">
        <a href="javascript:history.go(-1)" class="">

            <img src="/img/jiantouzuo.png">

        </a>
    </div>

    <h1 class="am-header-title">
        <a href="#title-link" class="">
            <?php echo Yii::t('app', '我的资产'); ?>
        </a>
    </h1>
    <div class="am-header-right am-header-nav">
        <a href="<?php echo Url::toRoute(["profile/walletrecord"]); ?>" class="">
            <?php echo Yii::t('app', '账户记录'); ?>
        </a>
    </div>
</header>

<div class="am-g">
    <div class="am-u-sm-12" style="padding-left: 0px;padding-right: 0px;">
        <div class="mybalance">
            <div class="small" style="width: 45%;">
                <p align="center"><?php echo Yii::t('app', '卢宝'); ?></p>
                <p align="center" style="margin-top: -20px;font-size: 15px;color: black;"><?php echo $res["cash_wa"]; ?></p>
            </div>
            <div class="small"  style="width: 10%; text-align: center;">
                <div align="center" class="zhuan">
                    <img src="/img/zhuanhuan.png">
                </div>
            </div>

            <div class="small"  style="width: 45%;">

                <p style="margin: 0; text-align: center;overflow: hidden;">
                    <select id="select" style="display: inline-block;">
                    <?php 
                        foreach ($temp as $item):
                        ?>
                        <option  <?php if ($item["country"] == "中国") {echo "selected";} ?>  value="<?php echo $item["rate"]; ?>" id="te"><?php echo $item["currency"]; ?>(<?php echo $item["country"]; ?>)</option>
                        <?php 
                        endforeach;
                    ?>
                    </select>
                </p>

                <p align="center" class="small3"  style="font-size: 15px;margin: 0;" id="tetlie"><?php echo number_format($res["cash_wa"] * 1.0000,4); ?></p>

            </div>
        </div>

        <div class="chan">
            <p><?php echo Yii::t('app', 'LKC'); ?></p>
        </div>
        <div class="Vpay">
            <table>
                <tr>
                    <td>
                        <a href="<?php echo Url::toRoute(["bonus/hcglist"]); ?>">
                            <span class="Vpay1"><?php echo Yii::t('app', '卢呗'); ?></span><br />
                            <span class="Vpay2"><?php echo $res["hcg_wa"]; ?></span>
                        </a>
                    </td>
                    <td>
                        <a href="<?php echo Url::toRoute(["bonus/cashlist"]); ?>">
                            <span class="Vpay1"><?php echo Yii::t('app', '卢宝'); ?></span><br />
                            <span class="Vpay2"><?php echo $res["cash_wa"]; ?></span>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="<?php echo Url::toRoute(["bonus/carelist"]); ?>">
                            <span class="Vpay1"><?php echo Yii::t('app', '通链'); ?></span><br />
                            <span class="Vpay2"><?php echo $res["care_wa"]; ?></span>
                        </a>
                    </td>
                    <td>
                        <span class="Vpay1"><?php echo Yii::t('app', '已定存通链'); ?></span><br />
                        <span class="Vpay2"><?php echo $res["get_release"]; ?></span>
                    </td>
                </tr>
            </table>
        </div>


        <div class="other">
            <p style="color: red;"><?php echo Yii::t('app', '说明：资产的统计包含可用资产加定存资产'); ?></p>
        </div>
    </div>
</div>
<script src="/js/jquery.min.js"></script>
<script type="text/javascript">
    var tetlie = document.getElementById("tetlie");

    $("#select").change(function () {

        var bb = $("#select").val();

        var rate = bb *<?php echo $res["cash_wa"]; ?>;
       

        tetlie.innerHTML =rate.toFixed(4);

    });

</script>   

