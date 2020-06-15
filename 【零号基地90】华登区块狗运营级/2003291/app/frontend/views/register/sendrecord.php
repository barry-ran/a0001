<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="zh">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1" media="(device-height: 568px)">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="HandheldFriendly" content="True">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <title><?php echo Yii::t('app','转出记录')?></title>
        <link rel="stylesheet" type="text/css" media="all" href="/css/reset.css" />
        <link rel="stylesheet" type="text/css" media="all" href="/css/style.css" />
        <script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
        <script src="/js/js.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="blockBuy" class="page">
            <ul class="relist lists">
                <?php foreach ($record['data'] as $val){?>
                    <li class="reitem">
                        <div class="reile">
                            <img src="/<?php echo $val['icon']; ?>" alt="" class="reilimg" />
                        </div>
                        <div class="reilr">
                            <p class="reilt">
                                <span class="reilte"><?php echo $val['username']; ?></span>
                                <span class="reiltr on"><?php echo $val['amount']; ?></span>
                            </p>
                            <p class="reilt">
                                <span class="reilte">UID:<?php echo $val['userid']; ?></span>
                                <span class="reiltr"><?php echo $val['created_at']; ?></span>
                            </p>
                        </div>
                    </li>
                <?php }?>
            </ul>
        </div>
        <!--下拉加载-->
        <?php if($lang == 'en_US'){?>
            <script src="/js/dropload.min_1.js"></script>
        <?php }else{?>
            <script src="/js/dropload.min.js"></script>
        <?php }?>
        <script>
            $(function(){
                var itemIndex = 0;
                var tab1LoadEnd = false;
                var page = 1;
                var pay_type = '<?php echo Yii::$app->request->get("pay_type") ? Yii::$app->request->get("pay_type") : 2 ?>';

                // tab
                $('.gtable').on('scroll',function(){
                    var $this = $(this);
                    itemIndex = $this.index();
                    // // 如果数据没有加载完
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
                        var $url = '/register/sendoutrecordload.html?pay_type='+ pay_type +'&page='+ page;
                        $.ajax({
                            type: 'GET',
                            url: $url,
                            dataType: 'json',
                            success: function(data){
                                if(data != null && data.length > 0){
                                    var result = '';
                                    for(var i = 0; i < data.length; i++) {
                                        result += '<li class="reitem"><div class="reile"><img src="/' + data[i].icon + '" alt="" class="reilimg" /></div><div class="reilr"><p class="reilt"><span class="reilte">' + data[i].username + '</span><span class="reiltr on">' + data[i].amount + '</span></p><p class="reilt"><span class="reilte">UID:' + data[i].userid + '</span><span class="reiltr">' + data[i].created_at + '</span></p></div></li>';
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
                                    $('.lists').eq(itemIndex).append(result);
                                    // 每次数据加载完，必须重置
                                    me.resetload();
                                },1000);
                            },
                            error: function(err){
                                 //alert('Ajax error!');
                                // 即使加载出错，也得重置
                                // me.resetload();
                            }
                        });
                    }
                });
            });
        </script>
    </body>
</html>