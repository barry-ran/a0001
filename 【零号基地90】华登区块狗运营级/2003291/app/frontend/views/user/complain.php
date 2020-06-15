<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title><?php echo Yii::t('app', '投诉建议'); ?></title>
		<link rel="stylesheet" href="/css/ymj.css" />
        <style>
            .layui-upload-file{display: none;}
        </style>
	</head>

	<body>
		<div class="am-container">
            <p style="text-indent: 20px;"><?php echo Yii::t('app', '请填写详细问题和意见'); ?>
            <span style="float: right;padding-right: 10px;">
                <a href="<?php echo Url::toRoute(["user/mycomplain"]); ?>">
                    <?php echo Yii::t('app', '提交记录'); ?>
                </a>
            </span>
            </p>
			<div class="am-g">
                <form action= "<?php echo Url::toRoute(["complain"]); ?>" method="post" enctype="multipart/form-data">
                    <!--主背景块-->
                    <div class="tcenter mineOre2 mt10" >
                        <textarea class="contactMessage" id="describe" maxlength="200" placeholder="<?php echo Yii::t('app', '描述（注意：至少输入5个文字，不能输入表情！）'); ?>" name="describe"></textarea>
                    </div>
                    <div class="tright mineOre2" style="display: block; padding: 0 20px 10px 0;">
                        <span id="zishu">0</span>
                        <span>/</span>
                        <span>200</span>
                    </div>

                    <div class="mineOre2 mt10" style="display: block;">
                        <div class="draw-1">
                            <span class="five">
                                <?php echo Yii::t('app', '请提供相关问题截图'); ?>
                            </span>
                        </div>
                        <div class="draw-2">
                            <label for="picture" class="picture" id="pic">
                                <img class="layui-upload-img" id="image" src="/img/jiahao.png" class="layui-upload-img">
                                <p id="demoText"></p>
                            </label>
                        </div>
                    </div>

                    <input type="hidden" id="cs_type" name="cs_type" value="<?php echo Yii::$app->request->get('type'); ?>">
                    <input type="hidden" id="cs_id" name="cs_id" value="<?php echo Yii::$app->request->get('order_id'); ?>">
                    <input type="hidden" id="description" name="description" value="<?php echo Yii::$app->request->get('description');?>">

                    <div class="am-u-sm-12 safeLogout">
                        <button type="button" id="submit" disabled="true">
                            <?php echo Yii::t('app', '提交'); ?>
                        </button>
                    </div>
                </form>
			</div>
		</div>
        <script src="/js/jquery.min.js"></script>
        <script src="/layui/layui.js" charset="utf-8"></script>
        <script>
            $(document).ready(function() {
                if($("#cs_id").val() != '' && $("#description").val() !== '') {
                    $("#describe").val("<?php echo Yii::t('app', '订单号');?>: " + $("#cs_id").val() + ", " + $("#description").val());
                    $("#submit").attr('disabled', false);
                }
            });

            $("#describe").on("keyup", function () {
                var length1 = $("#describe").val().length;
                if (length1 >= 5) {
                    $("#submit").attr('disabled', false);
                }
                if (length1 < 5) {
                    $("#submit").attr('disabled', true);
                }
                $('#zishu').html(length1);
            });

            layui.use('upload', function(){
                var $ = layui.jquery
                    ,upload = layui.upload;

                //普通图片上传
                var uploadInst = upload.render({
                    elem: '#pic'
                    ,url: '/user/comuphoto.html'
                    ,before: function(obj){
                        //预读本地文件示例，不支持ie8
                        obj.preview(function(index, file, result){
                            $('#image').attr('src', result); //图片链接（base64）
                        });
                    }
                    ,done: function(data){
                        //上传成功
                        if(data.status == '0000'){
                            $('#image').attr('src', '/' + data.src); //图片链接（base64）
                        }else{
                            alert(data.msg);
                        }
                    }
                });
            });
            
            $("#submit").click(function() {
                var describe = $("#describe").val();
                var pic_src = $("#image").attr('src');
                var cs_type = $("#cs_type").val();
                var cs_id = $("#cs_id").val();
                var url = "/user/comsubmit.html";
                $("#submit").prop('disabled',true);
                $.ajax({
                    type: "post",
                    dataType: "json",
                    data: {describe: describe, src: pic_src, cs_type: cs_type, cs_id: cs_id},
                    url: url,
                    success: function (data) {
                        if (data.status == '0000') {
                            alert(data.msg);
                            window.location.href="/user/mycomplain.html";    //  刷新当前页面
                        } else {
                            alert(data.msg);
                        }
                        $("#submit").prop('disabled',false);
                    }
                });

            });

            if($("#describe").val().length >= 5){
                $("#submit").attr('disabled', false);
            }
        </script>
    </body>
</html>