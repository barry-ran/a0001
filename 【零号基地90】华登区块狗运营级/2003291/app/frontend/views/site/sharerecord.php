<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
        <title><?php echo Yii::t('app', '分享记录'); ?></title>
        <style type="text/css">
            body{
                max-width: 640px;
                margin:auto;
                background: #F5F5F5;
                font-size:12px;
                position: relative;
            }
            .am-container{
                z-index: 9;
                position: absolute;
                left: 0;
                top: 0;
                right: 0;
                bottom: 0;
                width: 100%;
            }
            .conta_div>div.conta{
                border-bottom: 1px solid #ddd;
            }
            .conta_div>div.conta:last-child{
                border:none;
            }
            .conta{
                display: flex;justify-content: space-between;background: #fff;font-size: 15px; padding: 5px 0;
            }
            .conta_1{
                width:30%;text-align: center;
            }
            .conta_1>img{
                width: 50px;height:50px;margin-top: 8px;
            }
            .conta_2{
                width: 70%;
                line-height: 22px;
            }
            .conta_2>div{
                width:100%;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            .conta_small{
                color:#8F8F8F;font-size: 14px;
            }
        </style>
    </head>
    <body>
        <div class="am-container">
            <div id="blockBuy" class="conta_div" style="margin-top: 10px;">
                <div class="lists">
                    <?php foreach($res['data'] as $item):?>
                        <div class="conta">
                            <div class="conta_1">
                                <img src="/<?php echo $item['icon']?>" alt="" />
                            </div>
                            <div class="conta_2">
                                <div>
                                    <?php echo $item['username']?>:[<?php echo $item['id']?>]
                                </div>
                                <div class="conta_small">
                                    <?php echo $item['phone']?>
                                </div>
                                <div class="conta_small">
                                    <?php echo $item['created_at']?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <script charset="utf-8" src="/js/3.2.1.js"></script>
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
                // tab
                $('.conta_div').on('scroll',function(){
                    var $this = $(this);
                    itemIndex = $this.index();
                    //如果数据没有加载完
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
                        var $url = '/site/sharerecordload.html?page='+ page;
                        $.ajax({
                            type: 'GET',
                            url: $url,
                            dataType: 'json',
                            success: function(data){
                                if(data != null && data.length > 0){

                                    var result = '';
                                    for(var i = 0; i < data.length; i++) {
                                        result += '<div class="conta">\n' +
                                            '<div class="conta_1">\n' +
                                            '<img src="/'+data[i].icon +' " alt="">\n' +
                                            '</div>\n' +
                                            '<div class="conta_2">\n' +
                                            '<div>\n' +
                                            ''+ data[i].username +':['+ data[i].id +']\n' +
                                            '</div>\n' +
                                            '<div class="conta_small">\n' +
                                            ''+ data[i].phone +'</div>\n' +
                                            '<div class="conta_small">\n' +
                                            ''+ data[i].created_at +'</div>\n' +
                                            '</div>\n' +
                                            '</div>';
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
                    }
                });
            });
        </script>
    </body>
</html>
