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

    <style>

        .Nubtime1{ text-align: center;font-size: 16px; background-color: white;}

        .item {color: white;}

        body{background:url(/img/bg2.png) no-repeat top left;background-size:100% 100%;overflow: auto; overflow-x: hidden;}

        .rec {background:url(/img/baor_top.png) no-repeat top left;margin-bottom:5px; background-size:100% 100%;-moz-box-shadow: 3px 3px 4px rgba(0,0,0,.8);-webkit-box-shadow: 3px 3px 4px rgba(0,0,0,.8);box-shadow: 3px 3px 4px rgba(0,0,0,.8);}

    </style>

</head>

<section style="position:absolute;top: 0;width: 100%;">

    <div class="am-container">

        <div class="am-g">

            <div class="am-g Nubtime1" style="margin-right:0;margin-left: 0;background:url(/img/baor_top.png) no-repeat top left;background-size:100% 100%;" id="trade">
                <div class="am-u-sm-6 item on"><?php echo Yii::t('app', '卖出已完成'); ?></div>
                <div class="am-u-sm-6 item"><?php echo Yii::t('app', '买入已完成'); ?></div>
            </div>

            <div id="blockBuy" style="max-height: 500px; overflow: auto; ">
                <div class="lists">
                    <?php

                    foreach ($tradeRecordData['data'] as $val){

                        ?>

                        <div class="am-u-sm-12 mt10 rec">

                            <div class="recodeRecode" style="border-bottom: 0;">

                                <div class="fl">

                                    <div class="fz16 height22" style="color: #fff;"><?php echo $val['show']; ?></div>

                                    <div class="color-grey height22" style="color: #fff;"><?php echo $val['created_at']; ?></div>

                                </div>

                                <div class="fr tright" style="width: 50%">

                                    <div class="height22" style="color: #fff;"><?php echo $val['show2']; ?></div>

                                    <div style="color: #fff;"><?php echo $val['description']; ?></div>

                                </div>

                            </div>

                        </div>

                        <?php

                    }

                    ?>

                </div>
                <div class="lists"></div>
            </div>
        </div>

    </div>

    <script src="/js/3.2.1.js"></script>
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
        $(function(){
            var itemIndex = 0;
            var tab1LoadEnd = false;
            var tab2LoadEnd = false;
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
                }
                // 重置
                dropload.resetload();
            });

            var page = 1;
            var page2 = 1;

            // dropload
            var dropload = $('#blockBuy').dropload({
                scrollArea : window,
                loadDownFn : function(me){
                    // 加载菜单一的数据
                    if(itemIndex == '0'){
                        page++;

                        $url = '/trade/traderecordload.html?status=ywc&type=2&order_type=<?php echo $_GET['order_type']; ?>&page='+ page;
                        $.ajax({
                            type: 'GET',
                            url: $url,
                            dataType: 'json',
                            success: function(data){
                                if(data != null && data.length > 0){
                                    var result = '';
                                    for(var i = 0; i < data.length; i++) {
                                        result += '<div class="am-u-sm-12 mt10 rec">'
                                            + '<div class="recodeRecode" style="border-bottom: 0;">'
                                            + '<div class="fl">'
                                            + '<div class="fz16 height22" style="color: #1E88E5;">' + data[i].show + '</div>'
                                            + '<div class="color-grey height22" style="color: #b3b3b3;">' + data[i].created_at + '</div>'
                                            + '</div>'
                                            + '<div class="fr tright" style="width: 50%">'
                                            + '<div class="height22" style="color: #1E88E5;">' + data[i].show2 + '</div>'
                                            + '<div class="color-red">' + data[i].description + '</div>'
                                            + '</div>'
                                            + '</div>'
                                            + '</div>'
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
                                me.resetload();
                            }
                        });
                        // 加载菜单二的数据
                    }else if(itemIndex == '1'){

                        $url = '/trade/traderecordload.html?status=ywc&type=1&order_type=<?php echo $_GET['order_type']; ?>&page='+ page2;

                        $.ajax({
                            type: 'GET',
                            url: $url,
                            dataType: 'json',
                            success: function(data){
                                page2++;
                                if(data != null && data.length > 0){
                                    var result = '';
                                    for(var i = 0; i < data.length; i++) {
                                        result += '<div class="am-u-sm-12 mt10 rec">'
                                            + '<div class="recodeRecode" style="border-bottom: 0;">'
                                            + '<div class="fl">'
                                            + '<div class="fz16 height22" style="color: #1E88E5;">' + data[i].show + '</div>'
                                            + '<div class="color-grey height22" style="color: #b3b3b3;">' + data[i].created_at + '</div>'
                                            + '</div>'
                                            + '<div class="fr tright" style="width: 50%">'
                                            + '<div class="height22" style="color: #1E88E5;">' + data[i].show2 + '</div>'
                                            + '<div class="color-red">' + data[i].description + '</div>'
                                            + '</div>'
                                            + '</div>'
                                            + '</div>'
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
                                me.resetload();
                            }
                        });
                    }
                }
            });
        });

    </script>
</section>