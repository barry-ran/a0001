<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en" style="height: auto;overflow: inherit">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo Yii::t('app', '我的'); ?></title>
    <link rel="stylesheet" href="/css/ymj.css" />
    <style>
        .accordionName{width: 50%;}
        .layui-upload-file{display: none;}
        #popLoad{
            position:fixed;top: 0;left: 0;width: 100%;height: 100%;z-index: 99;background: rgba(0,0,0,0.5);
        }
        #popLoad img{
            margin: 100px auto 0;
        }

        /*loading*/
        .ta_c{
            text-align: center;
        }

        @-webkit-keyframes rotation{
            from {-webkit-transform: rotate(0deg);}
            to {-webkit-transform: rotate(360deg);}
        }

        .Rotation{
            -webkit-transform: rotate(360deg);
            animation: rotation 3s linear infinite;
            -moz-animation: rotation 3s linear infinite;
            -webkit-animation: rotation 3s linear infinite;
            -o-animation: rotation 3s linear infinite;
        }
        .accordionName {
            margin-left: 5%;
        }
    </style>
</head>

<body style="position: relative;">
<div class="am-container">
    <div class="am-g pb60">
        <div class="am-u-sm-12 introduct qgreen"style="background:#1E88E5;height:88px;display: flex;text-align: center;">
            <div class="userIcon am-u-sm-12" style="margin:0 auto;position: relative;">
                <img src="/<?php echo $user->userprofile->icon != '' ? $user->userprofile->icon : 'img/header.png'; ?>" style="border-radius: 50%" class="layui-upload-img" id="demo1" />
                <form style="position:absolute;width:100%;height:100%;top:0px;left:0px;opacity: 0;">
                    <label for="hello" class="set head" id="test1" style="display: block;height:50px;">
                        <span id="demo1" style="margin-top: 10px"><?php echo Yii::t('app', '更换头像'); ?></span>
                    </label>
                </form>
                <p style="color: #e7e9ec;"><?php echo $user->username; ?></p>
            </div>

        </div>
        <div class="am-u-sm-12 userGo">
            <a href="<?php echo Url::toRoute(["user/alternick"]); ?>">
                <div class="accordion">
                    <div class="accordionName"><?php echo Yii::t('app', '我的昵称'); ?></div>
                    <div class="goRight"><?php echo $user->userprofile->truename; ?><img src="/img/goRight.png" /></div>
                </div>
            </a>

            <a href="<?php echo Url::toRoute(["user/update"]); ?>">
                <div class="accordion">
                    <div class="accordionName"><?php echo Yii::t('app', '修改资料'); ?></div>
                    <div class="goRight"><img src="/img/goRight.png" /></div>
                </div>
            </a>

            <a href="<?php echo Url::toRoute(["user/addcard"]); ?>">
                <div class="accordion">
                    <div class="accordionName"><?php echo Yii::t('app', '我的银行卡'); ?></div>
                    <div class="goRight"><img src="/img/goRight.png" /></div>
                </div>
            </a>

            <a href="<?php echo Url::toRoute(["profile/walletrecord"]); ?>">
                <div class="accordion">
                    <div class="accordionName"><?php echo Yii::t('app', '账户记录'); ?></div>
                    <div class="goRight"><img src="/img/goRight.png" /></div>
                </div>
            </a>
            <a href="<?php echo Url::toRoute(["user/security"]); ?>">
                <div class="accordion">
                    <div class="accordionName"><?php echo Yii::t('app', '安全验证'); ?></div>
                    <div class="goRight"><img src="/img/goRight.png" /></div>
                </div>
            </a>

            <a href="<?php echo Url::toRoute(["user/notice"]); ?>">
                <div class="accordion">
                    <div class="accordionName"><?php echo Yii::t('app', '公告'); ?></div>
                    <div class="goRight"><img src="/img/goRight.png" /></div>
                </div>
            </a>
            <a href="<?php echo Url::toRoute(["user/complain"]); ?>">
                <div class="accordion">
                    <div class="accordionName"><?php echo Yii::t('app', '投诉建议'); ?></div>
                    <div class="goRight"><img src="/img/goRight.png" /></div>
                </div>
            </a>

            <a href="<?php echo Url::toRoute(["user/about"]); ?>">
                <div class="accordion">
                    <div class="accordionName"><?php echo Yii::t('app', '关于'); ?></div>
                    <div class="goRight"><img src="/img/goRight.png" /></div>
                </div>
            </a>
            <?php if($lang == "en_US"){?>
                <a href="javascript:alert('<?php echo Yii::t('app', 'Its the latest version'); ?>！')">
                    <div class="accordion">
                        <div class="accordionName"><?php echo Yii::t('app', '版本'); ?></div>
                        <div class="goRight">1.0.0</div>
                    </div>
                </a>
            <?php } else {?>
                <a href="javascript:alert('<?php echo Yii::t('app', '已经是最新版本'); ?>！')">
                    <div class="accordion">
                        <div class="accordionName"><?php echo Yii::t('app', '版本'); ?></div>
                        <div class="goRight">1.0.0</div>
                    </div>
                </a>
            <?php }?>


            </a>
            <div class="am-u-sm-12 safeLogout">
                <a href="VM://logout" style="color: white;">
                    <button type="button">
                        <?php echo Yii::t('app', '退出登录'); ?>
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
<!--Loading 20180728-->
<div class="ta_c ng-hide" id="popLoad">
    <img class="Rotation" src="/img/loading.png" width="100" height="100"/>
</div>

<script src="/js/jquery.min.js"></script>
<script src="/layui/layui.js" charset="utf-8"></script>
<script>
    $("#hello").on("change", function () {
        var helloImg = $("#hello").val();
        $("#submitHello").click();
    });

    layui.use('upload', function(){

        var $ = layui.jquery
            ,upload = layui.upload;

        //普通图片上传
        var uploadInst = upload.render({

            elem: '#test1'
            ,url: '/user/updicon.html'
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