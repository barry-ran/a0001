<?php

use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php echo Yii::t('app', '购买记录'); ?></title>
        <link rel="stylesheet" href="/css/common.css" />
        <link rel="stylesheet" href="/css/resetTable.css" />
        <!--<link rel="stylesheet" href="/css/page2.css" />-->
    </head>
    <style>
        .gtable{
            background-color: white;
        }
        table{
            border: none;
            -webkit-box-shadow: none;
            width: 100%;
        }
        .colorYellow {
            color: #000000;
        }
    </style>

    <body>
        <div class="am-container">
            <div class="am-g">
                <!--主背景块-->
                <div id="blockBuy">
                    <table class="gtable">
                        <thead>
                            <tr>
                                <th><?php echo Yii::t('app', '日期'); ?></th>
                                <th><?php echo Yii::t('app', '状态'); ?></th>
                                <th><?php echo Yii::t('app', '数量'); ?></th>
                                <th><?php echo Yii::t('app', '价格'); ?></th>
                            </tr>
                        </thead>
                        <tbody class="lists">
                            <?php foreach ($my_care_order['data'] as $item): ?>
                            <tr>
                                <td class="boxDate"><?php echo date("Y-m-d",$item['buy_time']); ?></td>
                                <td class="boxNum">
                                    <?php echo Yii::t('app', $item['status']);?>
                                </td>
                                <td class="colorYellow"><?php echo $item['num']; ?></td>
                                <td class="colorYellow"><?php echo $item['price']; ?></td>
                            </tr>
                            
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <script src="/js/jquery.min.js"></script>
        <!--<script type="text/javascript" src="/js/canvas-particle.js"></script>-->
        <!--<script charset="utf-8" src="/js/3.2.1.js"></script>-->
        <script src="/js/interactive.js"></script>
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
                $('.gtable').on('scroll',function(){
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
                        var $url = '/profile/mycareorderload.html?page='+ page;
                        
                        $.ajax({
                            type: 'GET',
                            url: $url,
                            dataType: 'json',
                            success: function(data){
                                if(data != null && data.length > 0){
                                    var result = '';
                                    for(var i = 0; i < data.length; i++) {
                                        result += '<tr>\n' +
                                            '<td class="boxDate">-' + data[i].created_at + '</td>\n' +
                                            '<td class="boxNum">' + data[i].status + '</td>\n' +
                                            '<td class="colorYellow">' + data[i].num + '</td>\n' +
                                            '<td class="colorYellow">' + data[i].price + '</td>\n' +
                                            '</tr>'
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
    //                                    $('#blockBuy').append(result);
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
            });
        </script>
    </body>

</html>