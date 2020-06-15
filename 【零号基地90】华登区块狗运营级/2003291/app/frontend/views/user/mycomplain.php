<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo Yii::t('app', '投诉建议'); ?></title>
    <link href="/css/login.css" rel="stylesheet">
    <style>
        p{
            margin: 0 0 1.6rem 0;
        }
        body{
            margin: 0 auto;
        }
    </style>
</head>
    <body>
        <div class="am-container" id="blockBuy">
            <div class="am-g gtable">
                <div class="am-u-sm-12 lists" style="padding-left: 0px;padding-right: 0px;">
                    <?php foreach ($record['data'] as $item): ?>
                        <a href="<?php  echo Url::toRoute(["user/complaincontent", "id" => $item["id"]]); ?>" class="" style=" font-size: 13px;">
                            <div class="notice" style="margin: 10px 0px;width: 100%;border-radius: 0px;border: none;overflow: hidden;">
                                <p class="notice1">
	                            <?php switch ($item['type']) {
	                                case 1:
	                                    echo Yii::t('app', '我的建议');
	                                    break;
	                                case 2:
	                                    echo Yii::t('app', '超时申请');
	                                    break;
	                                case 3:
	                                    echo Yii::t('app', '卖家申诉');
	                                    break;
	                                default:
	                                    echo '';
	                                    break;
	                            } ?>
                            	    <?php //echo $item['type'] == 1 ? Yii::t('app', '我的建议') : Yii::t('app', '超时申请'); ?>
                        	</p>
                                <p class="time" style="line-height: 55px;float: left;margin:0px 0px 0px 30%;"><?php  echo  date('Y-m-d H:i:s',$item['created_at']) ; ?></p>
                                <div class="am-header-left am-header-nav right1" style="margin-top: 14px;">
                                    <img src="/img/youjiantou.png">
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <script src="/js/jquery.min.js"></script>
        <script charset="utf-8" src="/js/3.2.1.js"></script>
        <!--下拉加载-->
        <script src="/js/dropload.min.js"></script>
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
                        var $url = '/user/mycomplainload.html?page='+ page;

                        $.ajax({
                            type: 'GET',
                            url: $url,
                            dataType: 'json',
                            success: function(data){
                                if(data != null && data.length > 0){
                                    var result = '';
                                    for(var i = 0; i < data.length; i++) {
                                        result += '<a href="/user/complaincontent.html?id="'+data[i].id+' style="font-size: 13px;">\n\
                                                    <div class="notice">\n\
                                                    <p class="notice1">'+data[i].type+'</p>\n\
                                                    <p class="time">'+data[i].created_at+'</p>\n\
                                                    <div class="am-header-left am-header-nav right1">\n\
                                                    <img src="/img/youjiantou.png">\n\
                                                    </div></div></a>';

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
