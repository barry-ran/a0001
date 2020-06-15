<!DOCTYPE html>

<html lang="zh-CN" class="ACCOUNT am-touch js cssanimations"><head>

    <meta charset="UTF-8">

    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">

    <meta name="apple-mobile-web-app-capable" content="yes">

    <meta name="apple-touch-fullscreen" content="yes">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title><?php echo $title2; ?></title>

    <link href="/css/admin.css" rel="stylesheet">

    <link href="/css/amazeui.min.css" rel="stylesheet">

    <link href="/css/myassets.css" rel="stylesheet">

    <link rel="stylesheet" href="/css/common2.css">

    <link rel="stylesheet" href="/css/ymj.css" />
    <link rel="stylesheet" href="/css/resetTable.css" />
    <link rel="stylesheet" href="/css/page2.css" />

    <style>

        .Nubtime1{ text-align: center;font-size: 16px; background-color: white;overflow: hidden}

        .choose{ color: #1AB1FF; border-bottom: 1px solid #1AB1FF;}

        .unchoose {color: #b3b3b3;}

        body{overflow: auto;overflow-x: hidden;}

        #popLayer{margin:10% 0;position: absolute;}

        table {border-radius: 0;}

        .gbtn {background: #157DAA;}

        .subBtn {background-color: #fff; color: #157DAA; border: 1px solid #157DAA;}

        .gtable td {font-size: 10px;font-weight: bold;}
        .id,.jyType,.sysprice{width:15%;}

        table tr td{width: 74px;font-weight: bold;}
        table th {font-weight: bold;}
        .am-u-sm-6 {
            width: 33%;
        }
        .layui-upload-file[type=file]{display: none;}
        body{background:url(/img/bg2.png) no-repeat top left;background-size:100% 100%;}
        .Nubtime1 .item{color:#fff;}
        .gtable tr{margin-bottom:.2rem;}
        .gtable th{color:#fff;background:none;}
        .gtable td{color:#fff;border:none;}
        .tab2 tr td:nth-child(2){width:160px;}
        #popLayer{background:#005a7f;}
        .closeLayer{padding:0px;position:relative;}
        .closet{line-height:24px;text-align: center;font-size:18px;color:#fff;}
        .clopic{position: absolute;display: block;width:24px;hieght:24px;top:-5px;right:10px;}
        #popLayer td, #popLayer table{border:none;background:rgba(23, 184, 226, 0.29);color:#fff;}
    </style>
</head>

<section style="position:absolute;top: 0;width: 100%;">

    <div class="am-container">

        <div class="am-g">

            <div class="am-g Nubtime1" style="margin-right:0;margin-left: 0;background:url(/img/baor_top.png) no-repeat top left;background-size:100% 100%;" id="trade">
                <div class="am-u-sm-6 item on" id="qr"><?php echo Yii::t('app', '待处理'); ?></div>
                <div class="am-u-sm-6 item" id="wwc"><?php echo Yii::t('app', '进行中'); ?></div>
                <div class="am-u-sm-6 item" id="ywc"><?php echo Yii::t('app', '已完成'); ?></div>
            </div>

            <div id="blockBuy" style="max-height: 500px; overflow: auto; ">
                <table class="gtable" style="width: 100%; margin-top: 10px; margin-left: 0; margin-right: 0;background:url(/img/baor_top.png) no-repeat top left;background-size:100% 100%;">
                    <thead>
                    <tr>
                        <th style="width:15%;">
                            <span><?php echo Yii::t('app', '订单号'); ?></span>
                        </th>
                        <th style="width:15%;">
                            <span><?php echo Yii::t('app', '交易类型'); ?></span>
                        </th>
                        <th style="width:15%;">
                            <span><?php echo Yii::t('app', '交易价格'); ?></span>
                        </th>
                        <!--                        <th style="width:15%;">-->
                        <!--                            <span>--><?php //echo Yii::t('app', '交易数量'); ?><!--</span>-->
                        <!--                        </th>-->
                        <th style="width:35%;" colspan="2" id="action">
                            <span><?php echo Yii::t('app', '操作'); ?></span>
                        </th>
                    </tr>
                    </thead>
                    <!--标题已做过长省略处理-->
                    <tbody class="lists">
                    <?php foreach ($tradeOrderList as $item): ?>
                        <tr>
                            <td class="id"><?php echo $item['id']; ?></td>
                            <td class="jyType"><?php echo Yii::t('app', $item['jy_type_name']); ?></td>
                            <td class="sysprice"><?php echo $item['price']; ?></td>
                            <!--                            <td class="number">--><?php //echo $item['number']; ?><!--</td>-->
                            <td style="width:35%;">
                                <button type="button" class="gbtn" onclick="detail($(this));"><?php echo Yii::t('app', '更多'); ?></button>
                                <?php if(in_array($item['status'], [1,2,5,6,7]) && $item['control'] != '') { ?>
                                    <button type="button" class="gbtn caoz" onclick="middle($(this));"><?php echo $item['control']; ?></button>
                                <?php } else { ?>
                                    <button type="button" class="gbtn caoz" style="display:none;"><?php echo $item['control']; ?></button>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                    <tbody class="lists"></tbody>
                    <tbody class="lists"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="popBox" class="ng-hide"></div>
    <div id="popLayer" class="ng-hide dataDetail1">
        <div class="closeLayer">
            <p class="closet"><?php echo Yii::t('app', '更多'); ?></p>
            <img src="/img/close_white_24.png" class="clopic"/>
        </div>
        <table class="tab2">
            <tbody>
            <tr>
                <td><?php echo Yii::t('app', '订单号'); ?></td>
                <td class="pop_id"></td>
            </tr>
            <tr>
                <td><?php echo Yii::t('app', '买入账号'); ?></td>
                <td class="pop_in_username"></td>
            </tr>
            <tr>
                <td><?php echo Yii::t('app', '交易数量'); ?></td>
                <td class="pop_number"></td>
            </tr>
            <tr>
                <td><?php echo Yii::t('app', '实际应付金额'); ?></td>
                <td class="pop_amount"></td>
            </tr>
            <tr>
                <td><?php echo Yii::t('app', '买家电话'); ?></td>
                <td class="pop_buyer_phone"></td>
            </tr>
            <tr>
                <td><?php echo Yii::t('app', '微信号'); ?></td>
                <td class="pop_wechat"></td>
            </tr>
            <tr>
                <td><?php echo Yii::t('app', '微信收款码'); ?></td>
                <td class=""><button class="pop_wechat_img" style="color:#fff;background:none;border:none;">点击放大</button></td>
            </tr>
            <tr>
                <td><?php echo Yii::t('app', '支付宝'); ?></td>
                <td class="pop_alipay"></td>
            </tr>
            <tr>
                <td><?php echo Yii::t('app', '支付宝收款码'); ?></td>
                <td class=""><button class="pop_alipay_img" style="color:#fff;background:none;border:none;">点击放大</button></td>
            </tr>
            <tr>
                <td><?php echo Yii::t('app', '收款人姓名'); ?></td>
                <td class="pop_realname"></td>
            </tr>
            <!--            <tr>-->
            <!--                <td>--><?php //echo Yii::t('app', '收款银行'); ?><!--</td>-->
            <!--                <td class="pop_bank"></td>-->
            <!--            </tr>-->
            <tr>
                <td><?php echo Yii::t('app', '收款银行卡号'); ?></td>
                <td class="pop_bank_num"></td>
            </tr>
            <tr>
                <td><?php echo Yii::t('app', '收款人电话'); ?></td>
                <td class="pop_phone"></td>
            </tr>
            <tr>
                <td><?php echo Yii::t('app', '订单状态描述'); ?></td>
                <td class="pop_description"></td>
            </tr>
            <tr>
                <td><?php echo Yii::t('app', '挂单时间'); ?></td>
                <td class="pop_created_at"></td>
            </tr>
            <tr>
                <td><?php echo Yii::t('app', '下单时间'); ?></td>
                <td class="pop_traded_at"></td>
            </tr>
            </tbody>
        </table>

    </div>

    <!--    确认付款-->
    <div class="popLayer" id="table-biao3" style="height: auto;z-index: 999;position: relative;display: none;background:#005a7f;width:90%;margin:0 auto;border-radius:6px;padding-top:.1px;margin-top:30px;">
        <div class="draw" style="background:#fff;margin:5% 10px;padding:15px;">
            <p style="margin-bottom: 0;font-size:1rem;margin-top:0px;"><?php echo Yii::t('app', '上传凭证（图片/截图）'); ?></p>
            <label for="picture" class="picture" id="pic" style="display:table;margin:0 auto;">
                <img class="layui-upload-img" id="image" src="/img/jiahao.png" style="width:100%;margin:10px auto;display: block">
                <p id="demoText"></p>
            </label>
            <!--<input class="layui-upload-file" type="file" accept="undefined" name="file">-->
            <button class="subBtn" id="subBtn" data-id="" style="background-color: #fff;color: #005a7f;border: 1px solid #005a7f;display:block;margin:0 auto;"><?php echo Yii::t('app', '提交'); ?></button>
        </div>
        <div class="closeLayer" id="guanbi3"><img src="/img/close_white_24.png"/></div>
    </div>

    <!--    确认收款-->
    <div class="table-biao" id="table-biao4" style="height: auto;z-index: 999;position: relative;display: none;background:#005a7f;width:90%;margin:0 auto;border-radius:6px;padding-top:.1px;margin-top:30px;">
        <div class="draw" style="background:#fff;margin:5% 10px;padding:15px;">
            <p style="margin-bottom: 0;"><?php echo Yii::t('app', '确认收款凭证（图片/截图）'); ?></p>
            <img class="layui-upload-img" id="image2" style="width: 100%; max-width: 100%; margin: 15px auto; " src="/img/jiahao.png">
            <div style="text-align: center;">
                <button class="subBtn" id="subBtn2" data-id=""><?php echo Yii::t('app', '确认收款'); ?></button>
                <button class="subBtn" id="ssBtn" data-id=""><?php echo Yii::t('app', '申诉'); ?></button>
            </div>
            <?php ?>
            <div>
                <p style="margin-top: 0px; margin-bottom: 0px;"><?php echo Yii::t('app', '提示'); ?>:</p>
                <p style="color: red; margin-top: 0px; margin-bottom: 0px;"><?php echo Yii::t('app', '买家请提交正确的付款凭证，轻则警告处理并扣除保证金;重则封号！'); ?></p>
            </div>
            <input hidden id="orderid" value=""/>
        </div>
        <div class="closeLayer" id="guanbi4"><img src="/img/close_white_24.png"/></div>
    </div>

    <!--遮罩-->
    <div class="mask" style="display:none;position:fixed;top:0;left:0;height: 100%;width:100%;background:rgba(0,0,0,.3);z-index: 999;" onclick="dialogClose()"></div>
    <!--确认弹窗-->
    <div class="dialog" id="d2" style="display:none; width:100%; height:100%; position:absolute; left:0; z-index:1001; font-size:.18rem;top:1.8rem;">
        <div class="dialog_content" style="width:50%;position:fixed; left:50%; top:50%; z-index:1003; background:#fff; border-radius:4px;">
            <p class="dialo" style="font-size:16px;font-weight: bold;text-align: center;line-height: 60px;margin:0px;"></p>
            <p class="dialo2" style="font-size:14px;text-align: center;line-height: 30px;padding-bottom:20px;margin:0px;"><?php echo Yii::t('app', '一经操作无法更改，请谨慎处理！'); ?></p>
            <div class="diald" style="display: flex;justify-content: center;align-items: center;height:50px;border-top:1px solid #ccc;">
                <a class="dialdlink tk_a" style="width:50%;font-size:16px;text-align: center;color:#000;line-height:50px;border-right:1px solid #ccc;"><?php echo Yii::t('app', '确定'); ?></a>
                <a href="javascript:dialogClose();" class="dialdlink" style="width:50%;font-size:16px;text-align: center;color:#000;line-height:50px;"><?php echo Yii::t('app', '取消'); ?></a>
            </div>
        </div>
    </div>

    <!--    图片放大-->
    <div class="dialog" id="d3" style="display:none; width:100%; height:100%; position:absolute; left:0; z-index:1001; font-size:.18rem;top:1.8rem;" onclick="dialogClose()">
        <div class="dialog_content" style="width:70%;position:fixed; left:50%; top:50%; z-index:1003; border-radius:4px;background:#fff;min-height:200px;">
            <img src="" id="data_url1" alt="" style="width:100%;display:none;margin:0 auto;">
            <img src="" id="data_url2" alt="" style="width:100%;display:none;margin:0 auto;">
        </div>
    </div>
    <!--    <script src="/js/jquery.min.js"></script>-->
    <script charset="utf-8" src="/js/3.2.1.js"></script>
    <script src="/layui/layui.js" charset="utf-8"></script>
    <script src="/js/interactive.js"></script>
    <!--下拉加载-->
    <?php switch ($lang){
        case 'zh_CN':
            echo '<script src="/js/dropload.min.js"></script>';
            break;
        case 'en_US':
            echo '<script src="/js/dropload.min_en.js"></script>';
            break;
        case 'ja_JP':
            echo '<script src="/js/dropload.min_ja.js"></script>';
            break;
        case 'ko_KP':
            echo '<script src="/js/dropload.min_ko.js"></script>';
            break;
        case 'ru_RU':
            echo '<script src="/js/dropload.min_ru.js"></script>';
            break;
        default:
            echo '<script src="/js/dropload.min_en.js"></script>';
            break;
    }?>
    <script>
        //弹出框
        function dialog(id,time,url) {
            dialogClose();
            $(".mask").width($(document).outerWidth(true));
            $(".mask").height($(document).outerHeight(true));

            $(".mask").show();
            $(id).show();

            var dw = $(id + " .alert").outerWidth()/2;
            var dh = $(id + " .alert").outerHeight()/2;
            $(id + " .alert").css({"margin-top":-dh+"px"});
            var dw2 = $(id + " .dialog_content").outerWidth()/2;
            var dh2 = $(id + " .dialog_content").outerHeight()/2;
            $(id + " .dialog_content").css({"margin-left":-dw2+"px","margin-top":-dh2+"px"});


            //假如有时间参数time，会定时关闭弹出框
            if(time){
                setTimeout(dialogClose,time);
            }
            if(url){
                setTimeout(function(){dialogUrl(url);},time);
            }
        }

        function dialogUrl(url) {
            window.location.href = url;
        }

        function dialogClose() {
            $(".dialog").hide();
            $(".mask").hide();
        }

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

        $("#guanbi4").click(function(){
            $("#table-biao4").hide();
            $("#table-mo").hide();
        });
        $('#pic2 img').click(function(){
            $(this).addClass('imgW');
        });

        $('#subBtn').click(function(){
            if($('#pic img').attr('src') == '/img/jiahao.png'){
                alert('<?php echo Yii::t('app', "请上传凭证"); ?>');
                return;
            }
            t_confirm1($(this).attr('data-id'));
        });

        $('#subBtn2').click(function(){
            t_confirm2($(this).attr('data-id'));
        });

        // 详情弹出层
        function detail(obj){
            var id = obj.parent().parent().find(".id").html();
            $.ajax({
                type: 'POST',
                data: {id: id},
                url: "/trade/singleorderload.html",
                dataType: 'json',
                success: function (data) {
                    $(".pop_id").html(id);
                    $(".pop_in_username").html(data.in_username);
                    $(".pop_number").html(data.number);
                    $(".pop_amount").html(data.amount);
                    $(".pop_buyer_phone").html(data.buyer_phone);
                    $(".pop_alipay").html(data.alipay);
                    $(".pop_wechat").html(data.wechat);
                    if(data.alipay_img == "#"){
                        $(".pop_alipay_img").html("-");
                        $(".pop_alipay_img").attr("disabled",true);
                    }else{
                        $(".pop_alipay_img").attr('data-url',data.alipay_img);
                    }
                    if(data.wechat_img == "#"){
                        $(".pop_wechat_img").html("-");
                        $(".pop_wechat_img").attr("disabled",true)
                    }else{
                        $(".pop_wechat_img").attr('data-url', data.wechat_img);
                    }
                    $(".pop_phone").html(data.phone);
                    // $(".pop_bank").html(data.bank);
                    $(".pop_realname").html(data.realname);
                    $(".pop_bank_num").html(data.bank_num);
                    $(".pop_description").html(data.description);
                    $(".pop_created_at").html(data.created_at);
                    $(".pop_traded_at").html(data.traded_at);
                }
            });
            $dataDetail = $(".gbtn").attr("data-detail");
            $("#popBox").css("display", "block");
            $("#popLayer").css("display", "block");


        }

        //微信二维码放大
        $(".pop_wechat_img").click(function () {
            var data_url = $(this).attr("data-url")
            // console.log(data_url);
            dialog("#d3");
            $("#data_url2").attr("src"," ").hide()
            $("#data_url1").attr("src",data_url).show()
        })

        //支付宝二维码放大
        $(".pop_alipay_img").click(function () {
            var data_url = $(this).attr("data-url")
            // console.log(data_url);
            dialog("#d3");
            $("#data_url1").attr("src"," ").hide()
            $("#data_url2").attr("src",data_url).show()
        })

        $(".closeLayer").on("click", function () {
            $(".pop_id").html('');
            $(".pop_in_username").html('');
            $(".pop_number").html('');
            $(".pop_amount").html('');
            $(".pop_buyer_phone").html('');
            $(".pop_phone").html('');
            $(".pop_realname").html('');
            $(".pop_bank_num").html('');
            $(".pop_description").html('');
            $(".pop_created_at").html('');
            $(".pop_traded_at").html('');

            $("#popBox").css("display", "none");
            $("#popLayer").css("display", "none");
        });
    </script>
    <script>
        $(function(){
            var itemIndex = 0;
            var tab1LoadEnd = false;
            var tab2LoadEnd = false;
            var tab3LoadEnd = false;
            // tab
            $('#trade .item').on('click',function(){

                var $this = $(this);
                itemIndex = $this.index();
                $this.addClass('on').siblings('.item').removeClass('on');
                $('.lists').eq(itemIndex).show().siblings('.lists').hide();

                // 如果选中菜单一
                if(itemIndex == '0'){
                    // 如果数据没有加载完
                    if(!tab1LoadEnd){
                        // 解锁
                        dropload.unlock();
                        dropload.noData(false);
                    }else{
                        // 锁定
                        dropload.lock('down');
                        dropload.noData();
                    }
                    // 如果选中菜单二
                }else if(itemIndex == '1'){
                    if(!tab2LoadEnd){
                        // 解锁
                        dropload.unlock();
                        dropload.noData(false);
                    }else{
                        // 锁定
                        dropload.lock('down');
                        dropload.noData();
                    }
                } else {
                    if(!tab3LoadEnd){
                        // 解锁
                        dropload.unlock();
                        dropload.noData(false);
                    }else{
                        // 锁定
                        dropload.lock('down');
                        dropload.noData();
                    }
                }
                // 重置
                dropload.resetload();
            });

            var page = 1;
            var page2 = 1;
            var page3 = 1;

            // dropload
            var dropload = $('#blockBuy').dropload({
                scrollArea : window,
                loadDownFn : function(me){
                    // 加载菜单一的数据
                    if(itemIndex == '0'){
                        page++;
                        var url = '/trade/tradeorderlistload.html?status=qr&order_type=<?php echo $order_type; ?>&page='+ page;
                        $.ajax({
                            type: 'GET',
                            url: url,
                            dataType: 'json',
                            success: function(data){
                                // page++;
                                if(data != null && data.length > 0){
                                    var result = '', con_btn = '';
                                    for(var i = 0; i < data.length; i++) {
                                        // data[i].btn = '更多';
                                        var more = '<?php echo Yii::t('app', '更多'); ?>';
                                        if(data[i].status == 1 || data[i].status == 2 || data[i].status == 7) {
                                            con_btn = '<button type="button" class="gbtn caoz" onclick="middle($(this));">'+ data[i].control + '</button> ';
                                        } else {
                                            con_btn = '<button type="button" class="gbtn caoz" style="display: none;">'+ data[i].control + '</button> ';
                                        }
                                        result += '<tr>' +
                                            '<td class="id">'+ data[i].id +'</td>' +
                                            '<td class="jyType">'+ /* data[i].jy_method_name + */data[i].jy_type_name +'</td>' +
                                            '<td class="sysprice">'+ data[i].price  +'</td>' +
                                            // '<td class="number">'+ data[i].number +'</td>' +
                                            '<td style="width:35%;">' +
                                            '<button type="button" class="gbtn" onclick="detail($(this));">'+ more +'</button> ' +
                                            con_btn +
                                            //'<button type="button" class="gbtn" onclick="t_cancel2($(this));"><?php //echo Yii::t('app', '取消订单'); ?>//</button>' +
                                            '</td>' +
                                            '</tr>';
                                    }
                                }else{
                                    // 数据加载完
                                    tab1LoadEnd = true;
                                    // 锁定
                                    me.lock();
                                    // 无数据
                                    me.noData();
                                }
                                $('.lists').eq(itemIndex).append(result);
                                // 每次数据加载完，必须重置
                                me.resetload();
                            },
                            error: function(xhr, type){
                                // alert('Ajax error!');
                                // 即使加载出错，也得重置
                                // me.resetload();
                            }
                        });
                        // 加载菜单二的数据
                    } else if(itemIndex == '1'){
                        var url = '/trade/tradeorderlistload.html?status=wwc&order_type=<?php echo $order_type; ?>&page='+ page2;
                        $.ajax({
                            type: 'GET',
                            url: url,
                            dataType: 'json',
                            success: function(data){
                                page2++;
                                if(data != null && data.length > 0){
                                    var result = '', con_btn = '';
                                    for(var i = 0; i < data.length; i++) {
                                        var more = '<?php echo Yii::t('app', '更多'); ?>';
                                        if(data[i].status == 0 || data[i].status == 8) {
                                            if(data[i].control == '') {
                                                con_btn = '<button type="button" class="gbtn" style="display:none;">' + data[i].control + '</button>';
                                            } else {
                                                con_btn = '<button type="button" class="gbtn" onclick="middle($(this));">' + data[i].control + '</button>';
                                            }
                                        }
                                        result += '<tr>' +
                                            '<td class="id">'+ data[i].id +'</td>' +
                                            '<td class="jyType">'+ /* data[i].jy_method_name + */data[i].jy_type_name +'</td>' +
                                            '<td class="sysprice">'+ data[i].price  +'</td>' +
                                            // '<td class="number">'+ data[i].number +'</td>' +
                                            '<td style="width:35%;">' +
                                            '<button type="button" class="gbtn" onclick="detail($(this));">'+ more +'</button> ' +
                                            con_btn +
                                            '</td>' +
                                            '</tr>';
                                    }
                                }else{
                                    // 数据加载完
                                    tab1LoadEnd = true;
                                    // 锁定
                                    me.lock();
                                    // 无数据
                                    me.noData();
                                }
                                $('.lists').eq(itemIndex).append(result);
                                // 每次数据加载完，必须重置
                                me.resetload();
                            },
                            error: function(xhr, type){
                                // alert('Ajax error!');
                                // 即使加载出错，也得重置
                                // me.resetload();
                            }
                        });
                        // 加载菜单三的数据
                    }else if(itemIndex == '2'){
                        $url = '/trade/tradeorderlistload.html?status=ywc&order_type=<?php echo $order_type; ?>&page='+ page3;

                        $.ajax({
                            type: 'GET',
                            url: $url,
                            dataType: 'json',
                            success: function(data){
                                page3++;
                                if(data != null && data.length > 0){
                                    var result = '', con_btn = '';
                                    for(var i = 0; i < data.length; i++) {
                                        // data[i].btn = '更多';
                                        var more = '<?php echo Yii::t('app', '更多'); ?>';
                                        if((data[i].status == 5 || data[i].status == 6 || data[i].status == 3 || data[i].status == 4 || data[i].status == 9 || data[i].status == 10)) {
                                            if(data[i].control == '') {
                                                con_btn = '<button type="button" class="gbtn caoz" style="display:none;">' + data[i].control + '</button> ';
                                            } else {
                                                con_btn = '<button type="button" class="gbtn caoz" onclick="middle($(this));">' + data[i].control + '</button> ';
                                            }
                                        }
                                        result += '<tr>' +
                                            '<td class="id">'+ data[i].id +'</td>' +
                                            '<td class="jyType">'+ /* data[i].jy_method_name + */data[i].jy_type_name +'</td>' +
                                            '<td class="sysprice">'+ data[i].price  +'</td>' +
                                            // '<td class="number">'+ data[i].number +'</td>' +
                                            '<td style="width:35%;">' +
                                            '<button type="button" class="gbtn" onclick="detail($(this));">'+ more +'</button> ' +
                                            con_btn +
                                            //'<button type="button" class="gbtn" onclick="t_cancel2($(this));"><?php //echo Yii::t('app', '取消订单'); ?>//</button>' +
                                            '</td>' +
                                            '</tr>';
                                    }
                                }else{
                                    // 数据加载完
                                    tab2LoadEnd = true;
                                    // 锁定
                                    me.lock();
                                    // 无数据
                                    me.noData();
                                }
                                $('.lists').eq(itemIndex).append(result);
                                // 每次数据加载完，必须重置
                                me.resetload();
                            },
                            error: function(xhr, type){
                                // alert('Ajax error!');
                                // 即使加载出错，也得重置
                                // me.resetload();
                            }
                        });
                    }
                }
            });
        });

    </script>
    <script>
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
                        shareClick(3, id, description);
                        // window.location.href = "/user/complain.html?type=3&order_id=" + id + "&description=" + description;
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
                    if(data.status == '0001'){
                        $('#image').attr('src', '/' + data.src); //图片链接（base64）
                        // alert(data.msg);
                    }else{
                        alert(data.msg);
//                            return layer.msg(data.msg);
                    }
                }
            });
        });

        // 确认付款弹窗
        function pop_confirm1(id, cond) {
            $(this).prop("disabled", false);
            $("#table-biao3").show();
            $("#popBox").show();
            $("#subBtn").attr('data-id', id+'-'+cond);
        }

        // 确认收款弹窗
        function pop_confirm2(id, cond) {
            $(this).prop("disabled", false);
            $("#table-biao4").show();
            $("#popBox").show();
            $("#subBtn2").attr('data-id', id+'-'+cond);
            $("#ssBtn").attr('data-id', id);

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
        }

        // 中间跳转函数
        function middle(obj) {
            var con = obj.html();
            var id = obj.parent().parent().find(".id").html();
            var jyType = obj.parent().parent().find(".jyType").html();
            // alert(id);return;
            if(jyType == '买入') {
                if(con == '确认付款') {
                    var cond = 1;
                    pop_confirm1(id, cond);
                } else if(con == '取消订单') {
                    var cond = 3;
                    t_cancel(id, cond);
                } else if(con == '超时申请') {
                    t_overtime1(id, $(this));
                }
            } else {
                if(con == '是否收款') {
                    var cond = 2;
                    pop_confirm2(id, cond);
                } else if(con == '取消订单') {
                    var cond = 3;
                    t_cancel(id, cond);
                } else if(con == '超时申请') {
                    t_overtime2(id, $(this));
                }
            }
        }

        // 付款超时申请
        function t_overtime2(id, obj){
            var description = "<?php echo Yii::t('app', '订单号: ');?>"+ id + "<?php echo Yii::t('app', '付款已超时');?>";
            $.ajax({
                type: "post",
                data: {id: id},
                dataType: "json",
                url: "/trade/checktj.html",
                success: function (data) {
                    if (data.status == '0001') {
                        shareClick("2", id, description);
                        // location.href="/user/complain.html?type=2&order_id=" + id + "&description=" + description;
                    } else {
                        alert(data.msg);
                    }
                    obj.prop("disabled", false);
                }
            });
        }

        // 收款超时申请
        function t_overtime1(id, obj){
            var description = "<?php echo Yii::t('app', '订单号: ');?>"+ id + "<?php echo Yii::t('app', ', 收款已超时');?>";
            $.ajax({
                type: "post",
                data: {id: id},
                dataType: "json",
                url: "/trade/checktj.html",
                success: function (data) {
                    if (data.status == '0001') {
                        shareClick("2", id, description);
                        // location.href="/user/complain.html?type=2&order_id=" + id + "&description=" + description;
                    } else {
                        alert(data.msg);
                    }
                    obj.prop("disabled", false);
                }
            });
        }

        //  取消订单
        function t_cancel(id, cond){
            var pic_src = $("#image").attr('src');

            $(".tk_a").attr("data1",pic_src).attr("data2",id + '-' + cond).attr("data3",cond);
            dialog('#d2');
        }

        //  确认付款
        function t_confirm1(id, cond){
            var pic_src = $("#image").attr('src');

            $(".tk_a").attr("data1",pic_src).attr("data2",id).attr("data3", cond);
            dialog('#d2');
        }

        //  确认收款
        function t_confirm2(id, cond){
            var pic_src = $("#image").attr('src');

            $(".tk_a").attr("data1",pic_src).attr("data2",id).attr("data3", cond);
            dialog('#d2');
        }

        $(".tk_a").on("click",function() {
            var pic_src = $(this).attr('data1');
            var arr = $(this).attr('data2').split("-");
            var id = arr[0];
            var order_type = <?php echo $order_type; ?>;
            var cond = arr[1];

            var url = '';
            switch(cond) {
                case '1':
                    url = '/trade/buyconfirm.html';
                    break;
                case '2':
                    url = '/trade/sellconfirm.html';
                    break;
                case '3':
                    url = '/trade/cancel.html';
                    break;
                default:
                    break;
            }

            $.ajax({
                type: "post",
                data: {id: id, src: pic_src},
                dataType: "json",
                url: url,
                success: function (data) {
                    alert(data.msg);
                    window.location.href = '/trade/tradeorderlist.html?status=qr&order_type=' + order_type;
                }
            });
        })

        // 跳转到原生投诉建议页面
        function shareClick(cs_type, cs_id, description) {
            var u = navigator.userAgent;
            var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
            var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
            if(isiOS) {
                try {
                    window.webkit.messageHandlers.openAppFeedback.postMessage({code:cs_type,orderid:cs_id, imageUrl:"", content:description});
                }
                catch(err) {
                    // //err.message;
                }
            } else {
                try {
                    android.openAdvice(description,cs_type,cs_id);
                }
                catch(err) {
                    // //err.message;
                }
            }


            // try {
            //     window.webkit.messageHandlers.openAppFeedback.postMessage({code:cs_type,orderid:cs_id, imageUrl:"", content:description});
            // }
            // catch(err) {
            //         // //err.message;
            // }
        }
    </script>
</section>