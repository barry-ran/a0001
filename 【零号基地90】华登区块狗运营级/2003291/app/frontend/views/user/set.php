<?php

use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en" style="height: auto;overflow: inherit">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php echo Yii::t('app', '设置'); ?></title>
        <link rel="stylesheet" href="/css/ymj.css" />
        <style>
            .accordionName{width: 50%;}
            .layui-upload-file{display: none;}
            #popLoad{
                position:fixed;top: 0;left: 0;width: 100%;height: 100%;z-index: 99;background: #333333;
            }
            #popLoad img{
                width: 100%;margin: auto;
            }
        </style>
    </head>

    <body style="position: relative;">
        <div class="am-container">
            <div class="am-g pb60">
                <div class="am-u-sm-12 userGo">

                    <a href="<?php echo Url::toRoute(["user/complain", "token" => $token]); ?>">
                        <div class="accordion">
                            <div class="accordionImg accImg3 opacity6">
                                <img src="/img/suggestions.png" />
                            </div>
                            <div class="accordionName"><?php echo Yii::t('app', '投诉建议'); ?></div>
                            <div class="goRight"><img src="/img/goRight.png" /></div>
                        </div>
                    </a>

                    <a href="<?php echo Url::toRoute(["user/about", "token" => $token]); ?>">
                        <div class="accordion">
                            <div class="accordionImg accImg4 opacity6">
                                <img src="/img/about.png" />
                            </div>
                            <div class="accordionName"><?php echo Yii::t('app', '关于'); ?></div>
                            <div class="goRight"><img src="/img/goRight.png" /></div>
                        </div>
                    </a>
                    <?php if($lang == "en_US"){?>
                        <a href="javascript:alert('<?php echo Yii::t('app', 'Its the latest version'); ?>！')">
                            <div class="accordion">
                                <div class="accordionImg accImg4">
                                    <img src="/img/version.png" />
                                </div>
                                <div class="accordionName"><?php echo Yii::t('app', '版本'); ?></div>
                                <div class="goRight">1.0.0</div>
                            </div>
                        </a>
                    <?php } else {?>
                        <a href="javascript:alert('<?php echo Yii::t('app', '已经是最新版本'); ?>！')">
                            <div class="accordion">
                                <div class="accordionImg accImg4">
                                    <img src="/img/version.png" />
                                </div>
                                <div class="accordionName"><?php echo Yii::t('app', '版本'); ?></div>
                                <div class="goRight">1.0.0</div>
                            </div>
                        </a>
                    <?php }?>


                    </a>
                    <div class="am-u-sm-12 safeLogout">
                        <button tyep="button"  class="exit" id="logout">
                            <a href="VM://logout" style="color: white;"><?php echo Yii::t('app', '退出登录'); ?></a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div id="popLoad" class="ng-hide">
            <img src="/img/loading.gif"/>
        </div>
<!--        <script type="text/javascript" src="/js/canvas-particle.js"></script>-->
<!--        <script charset="utf-8" src="/js/3.2.1.js"></script>-->
        <script src="/js/jquery.min.js"></script>
        <script src="/layui/layui.js" charset="utf-8"></script>
        <script src="/js/interactive.js"></script>
        <script>
            $("#hello").on("change", function () {
                var helloImg = $("#hello").val();
                $("#submitHello").click();
                //window.location.reload();
            });
            var token = "<?php echo $token ?>";
            layui.use('upload', function(){
                
                var $ = layui.jquery
                    ,upload = layui.upload;
                    
                //普通图片上传
                var uploadInst = upload.render({
                    
                    elem: '#test1'
                    ,url: '/user/updicon.html?token=' + token
                    , before: function () {
                        $("#popLoad").removeClass("ng-hide");
                    }
                    ,done: function(data){
                        
//                        console.log(data);return;
                        //上传成功
                        if(data.status == '0000'){
                            $('#demo1').attr('src', '/' + data.src); //图片链接（base64）
                            $("#popLoad").addClass("ng-hide");
                            alert(data.msg);

                        }else{
                            $("#popLoad").addClass("ng-hide");
                            alert(data.msg);
//                            return layer.msg(data.msg);
                        }
                    }
                });
            });
        </script>
    </body>

</html>