<?php

use yii\helpers\Url;
?>
<link href="/css/amazeui.min.css"/>
<style type="text/css">

.content{ background: #f0be0d; font-family: '微软雅黑'; color: white; font-size: 16px; }
.system-message{ padding: 80px 48px; }

.system-message .jump{ padding-top: 10px;margin-bottom:20px}
.system-message .jump a{ color: #333;}
.system-message .success,.system-message .error{ line-height: 1.8em; font-size: 36px }
.system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
#wait {
    font-size:46px;
}
#btn-stop,.href{
    display: inline-block;
    margin-right: 10px;
    font-size: 16px;
    line-height: 18px;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    border: 0 none;
    background-color: white;
    padding: 10px 20px;
    color: #f0be0d;
    font-weight: bold;
    border-color: transparent;
    text-decoration:none;
    width:100%;
    margin-top: 10px;
}
 
#btn-stop:hover,.href:hover{
    background-color: #f0be0d;
    color: #FFF;
}
</style>
<section class="content">
    <div class="system-message">
    <h1><?php echo Yii::t('app', '请求频繁！'); ?></h1>
    <p class="error"></p>
    <p class="detail"></p>
    <p class="jump">
    <b id="wait">3</b> <?php echo Yii::t('app', '秒后页面将自动跳转'); ?>
    </p>
    <div>
        <a class="href" id="btn-now" href="javascript:history.go(-1)"><?php echo Yii::t('app', '立即跳转'); ?></a> 
        <button id="btn-stop" type="button" onclick="stop()"><?php echo Yii::t('app', '停止跳转'); ?></button> 
        <a class="href"  id="btn-now2" href="/site/login.html"><?php echo Yii::t('app', '重新登录'); ?></a> 
    </div>
    </div>
    <script type="text/javascript">
    (function(){
     var wait = document.getElementById('wait'),href = document.getElementById('btn-now').href;
     var interval = setInterval(function(){
            var time = --wait.innerHTML;
            if(time <= 0) {
                    location.href = href;
                    clearInterval(interval);
            };
         }, 1000);
      window.stop = function (){
             console.log(111);
                clearInterval(interval);
     }
     })();
    </script>
    
    <!--[if (gte IE 9)|!(IE)]><!-->
    <script src="/js/jquery.min.js"></script>
    <!--<![endif]-->
    <script src="/js/amazeui.min.js"></script>

</section>

