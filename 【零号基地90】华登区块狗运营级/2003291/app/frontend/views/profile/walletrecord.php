<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="zh">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1" media="(device-height: 568px)">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="HandheldFriendly" content="True">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <title><?php echo Yii::t('app', '账户记录'); ?></title>
        <link rel="stylesheet" type="text/css" media="all" href="/css/reset.css" />
        <link rel="stylesheet" type="text/css" media="all" href="/css/style.css" />
        <style>
            .sel-opt{
                font-size: .3rem;
                border: none;
                outline: none;
                background: white;
                width: 30%;
            }

            .btn{
                border: none;
                background: none;
                color: #1E88E5;
                float: right;
                margin-top: 5%;
            }
        </style>

        <script src="/js/jquery-2.1.1.min.js"></script>
        <script src="/js/js.js" type="text/javascript"></script>
        <?php if($lang == 'en_US'){?>
            <script src="/js/dropload.min_1.js"></script>
        <?php }else{?>
            <script src="/js/dropload.min.js"></script>
        <?php }?>

    </head>
    <body onload="">
        <div id="page" class="page m">
            <div class="acnav">
                <div style="position: relative;width:35%;float:left;height:1rem;line-height: 1rem;">
                    <select class="sel-opt" id="event_type" style="width:100%;height:1rem;line-height: 1rem;padding-right:.5rem;">
                        <option value=""><?php echo Yii::t('app', '业务类型'); ?></option>
                        <?php foreach ($all_events as $key=>$val): ?>
                        <option value="<?php echo $key; ?>"><?php echo Yii::t('app', $val); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <img src="/img/bottom.png" style="width: .24rem;height:.12rem;position: absolute;right:.2rem;top:.44rem;"/>
                </div>
                <div style="position: relative;width:35%;float:left;height:1rem;line-height: 1rem;">
                    <select class="sel-opt" id="wallet_type" style="width:100%;height:1rem;line-height: 1rem;padding-right:.5rem;">
                        <option value=""><?php echo Yii::t('app', '货币类型'); ?></option>
                        <?php foreach ($all_wallet as $key=>$val): ?>
                        <option value="<?php echo $key; ?>"><?php echo Yii::t('app', $val); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <img src="/img/bottom.png" style="width: .24rem;height:.12rem;position: absolute;right:.2rem;top:.44rem;"/>
                </div>
                <button type="button" class="btn" id="search"><?php echo Yii::t('app', '搜索'); ?></button>
            </div>
            <div id="blockBuy">
                <ul class="aclist lists">
                    
                </ul>
            </div>
        </div>

        <script>
            $("#search").on("click",function(){
                var event_type = $("#event_type").val();
                var wallet_type = $("#wallet_type").val();
                //window.location.href = '/profile/walletrecord.html?event_type='+event_type+'&wallet_type='+wallet_type;
                $(".lists").empty();
                $(".dropload-down").remove();
                downLoad(event_type,wallet_type);
            });
            function downLoad(event_type,wallet_type){
                var itemIndex = 0;
                var tab1LoadEnd = false;
                var page = 0;

                // tab
                $('.page').on('scroll',function(){
                    var $this = $(this);
                    itemIndex = $this.index();
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
                    // 重置
                    dropload.resetload();
                });

                // dropload
                var dropload = $('#blockBuy').dropload({
                    scrollArea : window,
                    loadDownFn : function(me){
                        // 加载菜单一的数据
                        page++;
                        var $url = '/profile/walletrecordload.html?event_type='+event_type+'&wallet_type='+wallet_type+'&page='+ page;
                        $.ajax({
                            type: 'GET',
                            url: $url,
                            dataType: 'json',
                            success: function(data){
                                if(data != null && data.length > 0){
                                    var result = '';
                                    for(var i = 0; i < data.length; i++) {
                                        result += '<li class="acitem">\n' +
                                            '  <div class="acitd" style="width: 45%;">\n' +
                                            '     <p class="acit1">'+ data[i].event_type  +'</p>\n' +
                                            '     <p class="acit2">'+ data[i].wallet_type +'</p>\n' +
                                            '     <p class="acit3">'+ data[i].created_at +'</p>\n' +
                                            '  </div>\n' +
                                            '  <p class="acit4">'+ data[i].amount +'</p>\n' +
                                            '</li>'
                                    }
                                }else{
                                    // 数据加载完
                                    tab1LoadEnd = true;
                                    // 锁定
                                    me.lock();
                                    // 无数据
                                    me.noData();
                                }
                                // 为了测试，延迟1秒加载
                                setTimeout(function(){
                                    // $('#blockBuy').append(result);
                                    $('.lists').eq(itemIndex).append(result);
                                    // 每次数据加载完，必须重置
                                    me.resetload();
                                },1000);
                            },
                            error: function(xhr, type){
                                // alert('Ajax error!');
                                // 即使加载出错，也得重置
                                // me.resetload();
                            }
                        });
                    }
                });
            }
            downLoad(0,0);
        </script>
    </body>
</html>
