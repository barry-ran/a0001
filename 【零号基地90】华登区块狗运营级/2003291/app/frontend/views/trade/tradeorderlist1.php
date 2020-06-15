<html lang="zh-CN" class="ACCOUNT am-touch js cssanimations" style="height: auto !important;min-height: 0;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $title2; ?></title>
    <link href="/css/page.css" rel="stylesheet">
<!--    <link href="/css/admin.css" rel="stylesheet">-->
    <link href="/css/amazeui.min.css" rel="stylesheet">
<!--    <link href="/css/app.css" rel="stylesheet">-->
<!--    <link href="/css/base.css" rel="stylesheet">-->
    <link href="/css/home.css" rel="stylesheet">
<!--    <link href="/css/login.css" rel="stylesheet">-->
    <link href="/css/myassets.css" rel="stylesheet">
    <style>

        .dispose {
            border: 1px solid #1E88E5;
            border-radius: 6px;
        }
        .dispose-a a{
            color: #1E88E5;
        }
        .dispose-choose{
            border: 1px solid #1E88E5;
            border-radius: 6px;
            background: #1E88E5;
        }
        .dispose-choose a{ color: white;}
        .biao-t th {
            font-size: 1.2rem;
            text-shadow: none;
            font-weight: bolder;
            color: black;
        }
        .biao-t td {
            font-size: 1.2rem;
            color: black;
        }
        table {
            font-size: 1.2rem;
        }
        .hao {
            font-size: 1.2rem;
            text-shadow: none;
            font-weight: bolder;
            color: #4c4c4c;
        }
        .pagination > li > a,
        .pagination > li > span {
            background: #1E88E5;
            border: 1px solid #1E88E5;
        }
        .pagination > .disabled > span,
        .pagination > .disabled > span:hover,
        .pagination > .disabled > span:focus,
        .pagination > .disabled > a,
        .pagination > .disabled > a:hover,
        .pagination > .disabled > a:focus {
            color: #b3b3b3;
            cursor: not-allowed;
            border-color: #1E88E5;
        }
        body{
/*            overflow: visible;*/
            background-color: #f1f1f1;
            overflow-x: auto;
        }
        .draw{
            min-height: 150px;
            width: auto;
            height: auto;
            margin: 25px 10%;
        }
        .draw img {
             width: 40%;
             max-width: 160px;
             height: auto;
             float: none;
            margin-left: 0;
         }
        .layui-upload-file{display: none!important;}
        .subBtn{
            width: 30%;
            background: none;
            color: #ff9000;
            border: 1px solid #ff9000;
            border-radius: 3px;
        }
        .imgW{width: 100%;}
    </style>
    <link rel="stylesheet" href="/css/resetTable2.css" />
</head>
<section style="position:absolute;top: 0;overflow: auto">

    <div class="am-g dispose" style="z-index: 10;">
        <div style="border-right: 0;" class="am-u-sm-4 dispose-a <?php echo !isset($_GET['status']) || (isset($_GET['status']) && $_GET['status'] == 'qr')? 'dispose-choose' : ''; ?>" >
            <a href="/trade/tradeorderlist.html?status=qr&order_type=<?php echo $_GET['order_type']; ?>"><?php echo Yii::t("app", "待处理"); ?></a>
        </div>
        <div style="border-right: 0;" class="am-u-sm-4 dispose-a <?php echo isset($_GET['status']) && $_GET['status'] == 'wwc'? 'dispose-choose' : ''; ?>">
            <a href="/trade/tradeorderlist.html?status=wwc&order_type=<?php echo $_GET['order_type']; ?>"><?php echo Yii::t("app", "进行中"); ?></a>
        </div>
        <div style="border-right: 0;" class="am-u-sm-4 dispose-a <?php echo isset($_GET['status']) && $_GET['status'] == 'ywc'? 'dispose-choose' : ''; ?>" style="border-right: none;">
            <a href="/trade/tradeorderlist.html?status=ywc&order_type=<?php echo $_GET['order_type']; ?>"><?php echo Yii::t("app", "已完成"); ?></a>
        </div>
    </div>

    <table class="tab" id="chuli" style="font-size: 1.2rem">
        <tr class="biao-t">
            <th><?php echo Yii::t("app", "订单号"); ?></th>
            <th><?php echo Yii::t("app", "交易类型"); ?></th>
            <th><?php echo Yii::t("app", "交易价格"); ?></th>
            <th style="min-width: 86px;"><?php Yii::t("app", "操作"); ?></th>
        </tr>
        <?php foreach ($tradeOrderList['data'] as $val){
            ?>
            <tr  class="biao-t">
                <td class=".nub-one"><?php echo $val['id'];?></td>
                <td><?php echo $val['jy_method_name'].$val['jy_type_name'];?></td>
                <td style="color: #1E88E5;"><?php echo $val['price'];?></td>
                <?php if($val['jyType'] == 1){ ?>
                    <td>
                        <div class="duo" style="<?php echo in_array($val['status'], [0,1,6,7])? 'color: #1E88E5;':'float:none; margin: 0 auto;color: #1E88E5;' ?>"><?php echo Yii::t("app", "更多"); ?></div>
                        <?php if(in_array($val['status'], [0,1,6,7])) { ?>
                            <button class="caoz" style="color: #1E88E5; width: auto;padding: 0 1px;float: right;margin-right: 1px;margin-left: 0;background: none;"><?php echo $val['control'];?></button>
                        <?php } ?>
                    </td>
                <?php } else { ?>
                    <td>
                        <div class="duo" style="<?php echo in_array($val['status'], [0,2,5])? 'color: #1E88E5;':'float:none; margin: 0 auto;color: #1E88E5;' ?>"><?php echo Yii::t("app", "更多"); ?></div>
                        <?php if(in_array($val['status'], [0,2,5])){?>
                            <button class="caoz" style="color: #1E88E5; width: auto;padding: 0 1px;float: right;margin-right: 1px;margin-left: 0;background: none;"><?php echo $val['control'];?></button>
                        <?php }?>
                    </td>
                    <?php
                }
                ?>

                                                                                     <!-- total use: 12 -->
                <td style="display: none;"><?php echo $val['jyType'];?></td>                    <!-- 4 -->
                <td style="display: none;"><?php echo $val['jy_username'];?></td>               <!-- 5 -->
                <td style="display: none;"><?php echo $val['show'];?></td>                      <!-- 6 -->
                <td style="display: none;"><?php echo $val['amount'];?></td>                    <!-- 7 -->
                <td style="display: none;"><?php echo $val['bank'];?></td>                      <!-- 8 -->
                <td style="display: none;"><?php echo $val['bank_num'];?></td>                  <!-- 9 -->
                <td style="display: none;"><?php echo $val['terrace_fee'];?></td>               <!-- 10没用到 -->
                <td style="display: none;"><?php echo $val['integral_fee'];?></td>              <!-- 11没用到 -->
                <td style="display: none;"><?php echo $val['description'];?></td>               <!-- 12 -->
                <td style="display: none;"><?php echo $val['created_at'];?></td>                <!-- 13 -->
                <td style="display: none;"><?php echo $val['traded_at'];?></td>                 <!-- 14 -->
                <td style="display: none;"><?php echo $val['realname'];?></td>                  <!-- 15 -->
                <td style="display: none;"><?php echo $val['alipay'];?></td>                    <!-- 16 -->
                <td style="display: none;"><?php echo $val['wechat'];?></td>                    <!-- 17 -->
                <td style="display: none;"><?php echo $val['phone'];?></td>                     <!-- 18 -->
                <td style="display: none;"><?php echo $val['buyer_phone'];?></td>    <!-- 19 -->

            </tr>
            <?php
        } ?>


    </table>
    <!--分页-->
    <div class="pagination" style="margin-top: 10px; margin-bottom: 10px;">
        <?php echo common\components\SLinkPager::widget([
            'pagination' => $tradeOrderList['pager'],
            'firstPageLabel' => Yii::t("app", "首页"),
            'nextPageLabel' => Yii::t("app", "下一页"),
            'prevPageLabel' => Yii::t("app", "上一页"),
            'lastPageLabel' => Yii::t("app", "末页"),
            "hideOnSinglePage" => false
        ]);
        ?>
    </div>

    <!--模态框-->
    <div class="table-mo" id="table-mo" style="font-size: 1.2rem;"></div>
    <div class="table-biao" id="table-biao1">
        <div id="guanbi1"><img src="/img/guanbi.png"></div>
        <table>
            <tr>
                <th class="hao"><span><?php echo Yii::t('app', '订单号'); ?></span></th>
                <td id="td1-1" class="hao"><span></span></td>
            </tr>

            <tr>
                <th class="hao"><span><?php echo Yii::t('app', '卖出账号'); ?></span></th>
                <td id="td1-2" class="hao"><span></span></td>
            </tr>

            <tr>
                <th class="hao"><span><?php echo Yii::t('app', '交易数量'); ?></span></th>
                <td id="td1-3" class="hao"><span></span></td>
            </tr>

            <tr>
                <th class="hao"><span><?php echo Yii::t('app', '实际交易额'); ?></span></th>
                <td id="td1-4" class="hao" style="color: #1E88E5;"><span></span></td>
            </tr>

            <tr>
                <th class="hao"><span><?php echo Yii::t('app', '买家电话'); ?></span></th>
                <td id="td1-19" class="hao"><span></span></td>
            </tr>

            <tr>
                <th class="hao"><span><?php echo Yii::t('app', '卖家支付宝'); ?></span></th>
                <td id="td1-16" class="hao"><span></span></td>
            </tr>

            <tr>
                <th class="hao"><span><?php echo Yii::t('app', '卖家微信'); ?></span></th>
                <td id="td1-17" class="hao"><span></span></td>
            </tr>

            <tr>
                <th class="hao"><span><?php echo Yii::t('app', '卖家电话'); ?></span></th>
                <td id="td1-18" class="hao"><span></span></td>
            </tr>

            <tr>
                <th class="hao"><span><?php echo Yii::t('app', '银行名称'); ?></span></th>
                <td id="td1-5" class="hao"><span></span></td>
            </tr>

            <tr>
                <th class="hao"><span><?php echo Yii::t('app', '卖家户名'); ?></span></th>
                <td id="td1-15" class="hao"><span></span></td>
            </tr>

            <tr>
                <th class="hao"><span><?php echo Yii::t('app', '卖家银行卡号'); ?></span></th>
                <td id="td1-6" class="hao"><span></span></td>
            </tr>

            <tr>
                <th class="hao"><span><?php echo Yii::t('app', '订单状态描述'); ?></span></th>
                <td id="td1-7" class="hao"><span></span></td>
            </tr>

            <tr>
                <th class="hao"><span><?php echo Yii::t('app', '挂单时间'); ?></span></th>
                <td id="td1-8" class="hao"><span></span></td>
            </tr>

            <tr>
                <th class="hao"><span><?php echo Yii::t('app', '下单时间'); ?></span></th>
                <td id="td1-9" class="hao"><span></span></td>
            </tr>
        </table>
    </div>
    <div class="table-biao" id="table-biao2">
        <div id="guanbi2"><img src="/img/guanbi.png"></div>
        <table>
            <tr>
                <th class="hao"><span><?php echo Yii::t('app', '订单号'); ?></span></th>
                <td id="td2-1" class="hao"><span></span></td>
            </tr>

            <tr>
                <th class="hao"><span><?php echo Yii::t('app', '买入账号'); ?></span></th>
                <td id="td2-2" class="hao"><span></span></td>
            </tr>

            <tr>
                <th class="hao"><span><?php echo Yii::t('app', '交易数量'); ?></span></th>
                <td id="td2-3" class="hao"><span></span></td>
            </tr>
            <tr>
                <th class="hao"><span><?php echo Yii::t('app', '实际交易额'); ?></span></th>
                <td id="td2-4" class="hao" style="color: #1E88E5;"><span></span></td>
            </tr>

            <tr>
                <th class="hao"><span><?php echo Yii::t('app', '买家电话'); ?></span></th>
                <td id="td2-19" class="hao"><span></span></td>
            </tr>

            <tr>
                <th class="hao"><span><?php echo Yii::t('app', '卖家支付宝'); ?></span></th>
                <td id="td2-16" class="hao"><span></span></td>
            </tr>

            <tr>
                <th class="hao"><span><?php echo Yii::t('app', '卖家微信'); ?></span></th>
                <td id="td2-17" class="hao"><span></span></td>
            </tr>

            <tr>
                <th class="hao"><span><?php echo Yii::t('app', '卖家电话'); ?></span></th>
                <td id="td2-18" class="hao"><span></span></td>
            </tr>

            <tr>
                <th class="hao"><span><?php echo Yii::t('app', '银行名称'); ?></span></th>
                <td id="td2-5" class="hao"><span></span></td>
            </tr>

            <tr>
                <th class="hao"><span><?php echo Yii::t('app', '卖家户名'); ?></span></th>
                <td id="td2-15" class="hao"><span></span></td>
            </tr>

            <tr>
                <th class="hao"><span><?php echo Yii::t('app', '卖家银行卡号'); ?></span></th>
                <td id="td2-6" class="hao"><span></span></td>
            </tr>
            <!--            <tr>-->
            <!--                <th class="hao"><span>--><?php //echo Yii::t('app', '平台手续费率'); ?><!--</span></th>-->
            <!--                <td id="td2-7" class="hao"><span></span></td>-->
            <!--            </tr>-->
            <!--            <tr>-->
            <!--                <th class="hao"><span>--><?php //echo Yii::t('app', '报单返还费率'); ?><!--</span></th>-->
            <!--                <td id="td2-8" class="hao"><span></span></td>-->
            <!--            </tr>-->
            <tr>
                <th class="hao"><span><?php echo Yii::t('app', '订单状态描述'); ?></span></th>
                <td id="td2-9" class="hao"><span></span></td>
            </tr>
            <tr>
                <th class="hao"><span><?php echo Yii::t('app', '挂单时间'); ?></span></th>
                <td id="td2-10" class="hao"><span></span></td>
            </tr>
            <tr>
                <th class="hao"><span><?php echo Yii::t('app', '下单时间'); ?></span></th>
                <td id="td2-11" class="hao"><span></span></td>
            </tr>
        </table>
    </div>
<!--    top: 50%; left: 50%; transform: translate(-50%, -50%)-->
<!--    确认付款-->
    <div class="table-biao" id="table-biao3" style="height: auto;">
        <div id="guanbi3"><img src="/img/guanbi.png"></div>
        <div class="draw">
            <p style="margin-bottom: 0;">上传凭证（图片/截图）</p>
            <label for="picture" class="picture" id="pic">
                <img class="layui-upload-img" id="image" src="/img/jiahao.png">
                <p id="demoText"></p>
            </label>
            <input class="layui-upload-file" type="file" accept="undefined" name="file">
            <button class="subBtn" id="subBtn" data-id="">提交</button>
        </div>
    </div>
    <!--    确认收款-->
    <div class="table-biao" id="table-biao4" style="height: auto;">
        <div id="guanbi4"><img src="/img/guanbi.png"></div>
        <div class="draw">
            <p style="margin-bottom: 0;">确认收款凭证（图片/截图）</p>
            <img class="layui-upload-img" id="image2" style="width: 100%; max-width: 100%; margin: 15px auto; " src="/img/jiahao.png">
            <div style="text-align: center;">
                <button class="subBtn" id="subBtn2" data-id="">提交</button>
                <button class="subBtn" id="ssBtn" data-id="">申诉</button>
            </div>
            <?php ?>
            <div>
                <p style="margin-top: 0px; margin-bottom: 0px;"><?php echo Yii::t('app', '提示'); ?>:</p>
                <p style="color: red; margin-top: 0px; margin-bottom: 0px;"><?php echo Yii::t('app', '买家请提交正确的付款凭证，轻则警告处理并扣除信用值;重则封号！'); ?></p>
            </div>
            <input hidden id="orderid" value=""/>
        </div>
    </div>

    <script src="/js/3.2.1.js"></script>
    <script src="/js/amazeui.min.js"></script>
    <script src="/layui/layui.js"></script>
<!--    <script src="/js/home.js"></script>-->
    <script>
        $(".duo").click(function(){
            $("#table-mo").show();
            var jyType = $(this).parent().parent().find('td').eq(4).html();
            if(jyType == 1){    // 买入订单
                $("#table-biao1").show();
                var one = $(this).parent().parent().find('td').eq(0).html();
                $("#td1-1").html(one);
                var two = $(this).parent().parent().find('td').eq(5).html();
                $("#td1-2").html(two);
                var three = $(this).parent().parent().find('td').eq(6).html();
                $("#td1-3").html(three);
                var four = $(this).parent().parent().find('td').eq(7).html();
                $("#td1-4").html(four);

                var sixteen = $(this).parent().parent().find('td').eq(16).html();
                $("#td1-16").html(sixteen);

                var seventeen = $(this).parent().parent().find('td').eq(17).html();
                $("#td1-17").html(seventeen);

                var eighteen = $(this).parent().parent().find('td').eq(18).html();
                $("#td1-18").html(eighteen);

                var nineteen = $(this).parent().parent().find('td').eq(19).html();
                $("#td1-19").html(nineteen);

                var five = $(this).parent().parent().find('td').eq(8).html();
                $("#td1-5").html(five);

                var fifteen = $(this).parent().parent().find('td').eq(15).html();
                $("#td1-15").html(fifteen);

                var six = $(this).parent().parent().find('td').eq(9).html();
                $("#td1-6").html(six);
                var seven = $(this).parent().parent().find('td').eq(12).html();
                $("#td1-7").html(seven);
                var eight = $(this).parent().parent().find('td').eq(13).html();
                $("#td1-8").html(eight);
                var nine = $(this).parent().parent().find('td').eq(14).html();
                $("#td1-9").html(nine);
            }else{              // 卖出订单
                $("#table-biao2").show();
                var one = $(this).parent().parent().find('td').eq(0).html();
                $("#td2-1").html(one);
                var two = $(this).parent().parent().find('td').eq(5).html();
                $("#td2-2").html(two);
                var three = $(this).parent().parent().find('td').eq(6).html();
                $("#td2-3").html(three);
                var four = $(this).parent().parent().find('td').eq(7).html();
                $("#td2-4").html(four);

                var sixteen = $(this).parent().parent().find('td').eq(16).html();
                $("#td2-16").html(sixteen);

                var seventeen = $(this).parent().parent().find('td').eq(17).html();
                $("#td2-17").html(seventeen);

                var eighteen = $(this).parent().parent().find('td').eq(18).html();
                $("#td2-18").html(eighteen);

                var nineteen = $(this).parent().parent().find('td').eq(19).html();
                $("#td2-19").html(nineteen);

                var five = $(this).parent().parent().find('td').eq(8).html();
                $("#td2-5").html(five);

                var fifteen = $(this).parent().parent().find('td').eq(15).html();
                $("#td2-15").html(fifteen);

                var six = $(this).parent().parent().find('td').eq(9).html();
                $("#td2-6").html(six);
                var seven = $(this).parent().parent().find('td').eq(12).html();
                // $("#td2-7").html(seven * 100 + "%");
                // var eight = $(this).parent().parent().find('td').eq(11).html();
                // $("#td2-8").html(eight * 100 + "%");
                // var nine = $(this).parent().parent().find('td').eq(12).html();
                $("#td2-9").html(seven);
                var ten = $(this).parent().parent().find('td').eq(13).html();
                $("#td2-10").html(ten);
                var eleven = $(this).parent().parent().find('td').eq(14).html();
                $("#td2-11").html(eleven);
            }
        });

        $("#guanbi1").click(function(){
            $("#table-biao1").hide();
            $("#table-mo").hide();
        });

        $("#guanbi2").click(function(){
            $("#table-biao2").hide();
            $("#table-mo").hide();
        });

        $("#guanbi3").click(function(){
            $("#table-biao3").hide();
            $("#table-mo").hide();
        });
        $('#subBtn').click(function(){
            if($('#pic img').attr('src') == '/img/jiahao.png'){
                alert('请上传凭证');
                return;
            }
            t_confirm1($(this).attr('data-id'));
        });

        $("#guanbi4").click(function(){
            $("#table-biao4").hide();
            $("#table-mo").hide();
        });
        $('#pic2 img').click(function(){
            $(this).addClass('imgW');
        });
        $('#subBtn2').click(function(){
            t_confirm2($(this).attr('data-id'));
        });

        $('.caoz').click(function(){
            var id = $(this).parent().parent().find('td').eq(0).html();
            var jyType = $(this).parent().parent().find('td').eq(4).html();
            var con = $(this).html();
            $(this).prop("disabled", true);
            if(jyType == 1){
                if(con == '<?php echo Yii::t("app", "确认付款"); ?>'){
                        $(this).prop("disabled", false);
                        $("#table-biao3").show();
                        $("#table-mo").show();
                        $("#subBtn").attr('data-id', id);
//                    t_confirm1(id);
                }else if(con == '<?php echo Yii::t("app", "取消订单"); ?>'){
                    t_cancel1(id);
                }else if(con == '<?php echo Yii::t("app", "超时申请"); ?>'){
                    t_overtime1(id, $(this));
                }
            }else{
                if(con == '<?php echo Yii::t("app", "确认收款"); ?>'){
                    $(this).prop("disabled", false);
                    $("#table-biao4").show();
                    $("#table-mo").show();
                    $("#subBtn2").attr('data-id', id);
                    $("#ssBtn").attr('data-id', id);
//                    t_confirm2(id);
                }else if(con == '<?php echo Yii::t("app", "取消订单"); ?>'){
                    t_cancel2(id);
                }else if(con == '<?php echo Yii::t("app", "超时申请"); ?>'){
                    t_overtime2(id, $(this));
                }
            }
        });
        //  买入取消订单
        function t_cancel1(id){
            var order_type = <?php echo $_GET['order_type']; ?>;
            if(!confirm('<?php echo Yii::t("app", "确认取消该订单"); ?>  ？')){ return;}
            $.ajax({
                type: "post",
                data: {id: id, order_type: order_type},
                dataType: "json",
                url: "/trade/buycancel.html",
                success: function (data) {
                    if (data.status == '0001') {
                        alert(data.msg);
                        window.location.href = '/trade/tradeorderlist.html?status=ywc&order_type=<?php echo $_GET['order_type']; ?>';
                    } else {
                        alert(data.msg);
                        window.location.href='/trade/tradeorderlist.html?status=qr&order_type=<?php echo $_GET['order_type']; ?>';
                    }
                }
            });
        }

        //  卖出取消订单
        function t_cancel2(id){
            var order_type = <?php echo $_GET['order_type']; ?>;
            if(!confirm('<?php echo Yii::t("app", "确认取消该订单"); ?>？')){ return;}
            $.ajax({
                type: "post",
                data: {id: id, order_type: order_type },
                dataType: "json",
                url: "/trade/sellcancel.html",
                success: function (data) {
                    if (data.status == '0001') {
                        alert(data.msg);
                        window.location.href = '/trade/tradeorderlist.html?status=ywc&order_type=<?php echo $_GET['order_type']; ?>';
                    } else {
                        alert(data.msg);
                        window.location.href='/trade/tradeorderlist.html?status=qr&order_type=<?php echo $_GET['order_type']; ?>';
                    }
                }
            });
        }

        //  确认付款
        function t_confirm1(id){
            var pic_src = $("#image").attr('src');
            if(!confirm('<?php echo Yii::t("app", "确认已付款"); ?>？')){ return;}
            $.ajax({
                type: "post",
                data: {id: id, order_type: <?php echo $_GET['order_type']; ?>, src: pic_src},
                dataType: "json",
                url: "/trade/buyconfirm.html",
                success: function (data) {
                    if (data.status == '0001') {
                        alert(data.msg);
                        window.location.href = '/trade/tradeorderlist.html?status=wwc&order_type=<?php echo $_GET['order_type']; ?>';
                        // window.location.reload();//  刷新当前页面
                    } else if(data.status == '0003') {
                        alert(data.msg);
                        window.location.href = '/trade/tradeorderlist.html?status=wwc&order_type=<?php echo $_GET['order_type']; ?>';
                        // window.location.reload();//  刷新当前页面
                    } else {
                        alert(data.msg);
                    }
                }
            });
        }

        //  确认收款
        function t_confirm2(id){
            var method = 0;
            if(!confirm('<?php echo Yii::t("app", "确认已收款"); ?>？')){ return;}
            $.ajax({
                type: "post",
                data: {id: id, method: method, order_type: <?php echo $_GET['order_type']; ?>},
                dataType: "json",
                url: "/trade/sellconfirm.html",
                success: function (data) {
                    if (data.status == '0001') {
                        alert(data.msg);
                        window.location.href = '/trade/tradeorderlist.html?status=ywc&order_type=<?php echo $_GET['order_type']; ?>';
                        // window.location.reload();//  刷新当前页面
                    } else if(data.status == '0003') {
                        alert(data.msg);
                        window.location.href = '/trade/tradeorderlist.html?status=ywc&order_type=<?php echo $_GET['order_type']; ?>';
                        // window.location.reload();//  刷新当前页面
                    } else {
                        alert(data.msg);
                    }
                }
            });
        }

        // 收款超时申请
        function t_overtime1(id,obj){
            var description = "<?php echo Yii::t('app', '收款已超时');?>";
            $.ajax({
                type: "post",
                data: {id: id},
                dataType: "json",
                url: "/trade/checktj.html",
                success: function (data) {
                    if (data.status == '0001') {
                        location.href="/user/complain.html?type=2&order_id=" + id + "&description=" + description;
                    } else {
                        alert(data.msg);
                    }
                    obj.prop("disabled", false);
                }
            });
        }

        // 付款超时申请
        function t_overtime2(id, obj){
            var description = "<?php echo Yii::t('app', '付款已超时');?>";
            $.ajax({
                type: "post",
                data: {id: id},
                dataType: "json",
                url: "/trade/checktj.html",
                success: function (data) {
                    if (data.status == '0001') {
                        location.href="/user/complain.html?type=2&order_id=" + id + "&description=" + description;
                    } else {
                        alert(data.msg);
                    }
                    obj.prop("disabled", false);
                }
            });
        }

        $('#ssBtn').click(function() {
            var id = $("#orderid").val();
            var description = "<?php echo Yii::t('app', '卖家申诉'); ?>";

            $.ajax({
                type: "post",
                data: {id: id},
                dataType: "json",
                url: "/trade/checktj.html",
                success: function (data) {
                    if (data.status == '0001') {
                        window.location.href = "/user/complain.html?type=3&order_id=" + id + "&description=" + description;
                    } else {
                        alert(data.msg);
                    }
                }
            });
        });


        $('.caoz').click(function() {
            var id = $(this).parent().parent().find('td').eq(0).html();

            $("#orderid").val(id);

            $.ajax({
                type: "post",
                data: {id: id},
                dataType: "json",
                url: "/trade/getcred.html",
                success: function (data) {
                    if (data.status == '0001') {
                        $("#image2").attr("src", data.src);
                    } else {
                        alert(data.msg);
                    }
                }
            });
        });

        layui.use('upload', function(){
            var $ = layui.jquery
                ,upload = layui.upload;

            //普通图片上传
            var uploadInst = upload.render({
                elem: '#pic'
                ,url: '/trade/payphoto.html'
                ,before: function(obj){
                    //预读本地文件示例，不支持ie8
                    obj.preview(function(index, file, result){
                        $('#image').attr('src', result); //图片链接（base64）
                    });
                }
                ,done: function(data){
//                        console.log(data);return;
                    //上传成功
                    if(data.status == '0000'){
                        $('#image').attr('src', '/' + data.src); //图片链接（base64）
                        // alert(data.msg);
                    }else{
                        alert(data.msg);
//                            return layer.msg(data.msg);
                    }
                }
            });
        });
    </script>
</section>