<!DOCTYPE html>

<html lang="zh-CN" class="ACCOUNT am-touch js cssanimations"><head>

    <meta charset="UTF-8">

    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">

    <meta name="apple-mobile-web-app-capable" content="yes">

    <meta name="apple-touch-fullscreen" content="yes">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title><?php echo Yii::t('app', 'LKC订单列表'); ?></title>

    <link href="/css/admin.css" rel="stylesheet">

    <link href="/css/amazeui.min.css" rel="stylesheet">

    <link href="/css/myassets.css" rel="stylesheet">

    <link rel="stylesheet" href="/css/common2.css">

    <link rel="stylesheet" href="/css/ymj.css" />
    <link rel="stylesheet" href="/css/resetTable.css" />
    <link rel="stylesheet" href="/css/page2.css" />

    <style>

        .Nubtime1{ text-align: center;font-size: 16px; background-color: white;}

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
                <div class="am-u-sm-6 item on" id="qr"><?php echo Yii::t('app', '申购中'); ?></div>
                <div class="am-u-sm-6 item" id="wwc"><?php echo Yii::t('app', '申购已完成'); ?></div>
                <div class="am-u-sm-6 item" id="ywc"><?php echo Yii::t('app', '申购未成功'); ?></div>
            </div>

            <div id="blockBuy" style="max-height: 400px; overflow: auto; ">
                <table class="gtable" style="width: 100%; margin-top: 10px; margin-left: 0; margin-right: 0;background:url(/img/baor_top.png) no-repeat top left;background-size:100% 100%;">
                    <thead>
                    <tr>
                        <th style="width:15%;">
                            <span><?php echo Yii::t('app', '申购单号'); ?></span>
                        </th>
                        <th style="width:15%;">
                            <span><?php echo Yii::t('app', '申购数量'); ?></span>
                        </th>
                        <th style="width:15%;">
                            <span><?php echo Yii::t('app', '货币类型'); ?></span>
                        </th>
<!--                        <th style="width:15%;">-->
<!--                            <span>--><?php //echo Yii::t('app', '申购状态'); ?><!--</span>-->
<!--                        </th>-->
                        <th style="width:35%;" colspan="2" id="action">
                                <span><?php echo Yii::t('app', '操作'); ?></span>
                        </th>
                    </tr>
                    </thead>
                    <!--标题已做过长省略处理-->
                    <tbody class="lists">
                    <?php foreach ($list as $item): ?>
                        <tr>
                            <td class="id"><?php echo $item['id']; ?></td>
                            <td class="number"><?php echo Yii::t('app', $item['number']); ?></td>
                            <td class="coin_type"><?php echo $item['coin_type']; ?></td>
<!--                            <td class="status">--><?php //echo $item['status']; ?><!--</td>-->
                            <td style="width:35%;">
                                <button type="button" class="gbtn" onclick="detail($(this));"><?php echo Yii::t('app', '更多'); ?></button>
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
            <p class="closet">更多</p>
            <img src="/img/close_white_24.png" class="clopic"/>
        </div>
        <table class="tab2">
            <tbody>
            <tr>
                <td><?php echo Yii::t('app', '申购单号'); ?></td>
                <td class="pop_id"></td>
            </tr>
            <tr>
                <td><?php echo Yii::t('app', '申购数量'); ?></td>
                <td class="pop_number"></td>
            </tr>
            <tr>
                <td><?php echo Yii::t('app', '货币类型'); ?></td>
                <td class="pop_coin"></td>
            </tr>
            <tr>
                <td><?php echo Yii::t('app', '手续费率'); ?></td>
                <td class="pop_rate"></td>
            </tr>
            <tr>
                <td><?php echo Yii::t('app', '手续费'); ?></td>
                <td class="pop_fee"></td>
            </tr>
            <tr>
                <td><?php echo Yii::t('app', '总支出(LKC)'); ?></td>
                <td class="pop_amount"></td>
            </tr>
            <tr>
                <td><?php echo Yii::t('app', '申购状态'); ?></td>
                <td class="pop_status"></td>
            </tr>
            <tr>
                <td><?php echo Yii::t('app', '创建时间'); ?></td>
                <td class="pop_time"></td>
            </tr>
            </tbody>
        </table>
        
    </div>

    <!--    <script src="/js/jquery.min.js"></script>-->
    <script charset="utf-8" src="/js/3.2.1.js"></script>
    <script src="/layui/layui.js" charset="utf-8"></script>
    <script src="/js/interactive.js"></script>
    <!--下拉加载-->
    <script src="/js/dropload.min.js"></script>
<!--    <script src="/js/js.js"></script>-->
    <script>
        // 详情弹出层
        function detail(obj){
            var id = obj.parent().parent().find(".id").html();
            $.ajax({
                type: 'POST',
                data: {id: id},
                url: "/trade/singleapplyload.html",
                dataType: 'json',
                success: function (data) {
                    $(".pop_id").html(id);
                    $(".pop_number").html(data.number);
                    $(".pop_coin").html(data.coin_type);
                    $(".pop_rate").html(data.miner_rate);
                    $(".pop_fee").html(data.miner_fee);
                    $(".pop_amount").html(data.totalamount);
                    $(".pop_status").html(data.status);
                    $(".pop_time").html(data.created_at);
                }
            });

            $dataDetail = $(".gbtn").attr("data-detail");
            $("#popBox").css("display", "block");
            $("#popLayer").css("display", "block");

        }
        $(".closeLayer").on("click", function () {
            $(".pop_id").html('');
            $(".pop_number").html('');
            $(".pop_coin").html('');
            $(".pop_rate").html('');
            $(".pop_fee").html('');
            $(".pop_amount").html('');
            $(".pop_status").html('');
            $(".pop_time").html('');

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
                        var url = '/trade/myapplylistload.html?status=0&page='+ page;
                        $.ajax({
                            type: 'GET',
                            url: url,
                            dataType: 'json',
                            success: function(data){
                                // page++;
                                if(data != null && data.data.length > 0){
                                    var result = '', con_btn = '';
                                    for(var i = 0; i < data.data.length; i++) {
                                        var more = '<?php echo Yii::t('app', '更多'); ?>';
                                        result += '<tr>' +
                                            '<td class="id">'+ data.data[i].id +'</td>' +
                                            '<td class="number">'+ data.data[i].number +'</td>' +
                                            '<td class="coin_type">'+ data.data[i].coin_type  +'</td>' +
                                            // '<td class="status">'+ data.data[i].status +'</td>' +
                                            '<td style="width:35%;">' +
                                            '<button type="button" class="gbtn" onclick="detail($(this));">'+ more +'</button> ' +
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
                        var url = '/trade/myapplylistload.html?status=1&page='+ page2;
                        $.ajax({
                            type: 'GET',
                            url: url,
                            dataType: 'json',
                            success: function(data){
                                page2++;
                                if(data != null && data.data.length > 0){
                                    console.log(data);
                                    var result = '';
                                    for(var i = 0; i < data.data.length; i++) {
                                        var more = '<?php echo Yii::t('app', '更多'); ?>';
                                        result += '<tr>' +
                                            '<td class="id">'+ data.data[i].id +'</td>' +
                                            '<td class="number">'+ data.data[i].number +'</td>' +
                                            '<td class="coin_type">'+ data.data[i].coin_type  +'</td>' +
                                            // '<td class="status">'+ data.data[i].status +'</td>' +
                                            '<td style="width:35%;">' +
                                            '<button type="button" class="gbtn" onclick="detail($(this));">'+ more +'</button> ' +
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
                        $url = '/trade/myapplylistload.html?status=2&page='+ page3;

                        $.ajax({
                            type: 'GET',
                            url: $url,
                            dataType: 'json',
                            success: function(data){
                                page3++;
                                if(data != null && data.data.length > 0){
                                    var result = '';
                                    for(var i = 0; i < data.data.length; i++) {
                                        var more = '<?php echo Yii::t('app', '更多'); ?>';
                                        result += '<tr>' +
                                            '<td class="id">'+ data.data[i].id +'</td>' +
                                            '<td class="number">'+ data.data[i].number +'</td>' +
                                            '<td class="coin_type">'+ data.data[i].coin_type  +'</td>' +
                                            // '<td class="status">'+ data.data[i].status +'</td>' +
                                            '<td style="width:35%;">' +
                                            '<button type="button" class="gbtn" onclick="detail($(this));">'+ more +'</button> ' +
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
</section>