<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title><?php echo Yii::t('app', '修改其他支付方式'); ?></title>
		<link rel="stylesheet" href="/css/ymj.css" />
        <style>
            body {
                overflow: auto;
                overflow-x: hidden;
                background: url(/img/bg2.png) no-repeat top left;
            }
            input {
                color: #fff;
            }
            .mineOre2 {
                background: none;
            }
            .layui-upload-file{display: none;}
            .coname {
                background: transparent;
                border: none;
                resize: none;
                width: 90%;
            }
            .mineOre2 {
                background: rgba(30,136,229,0);
                box-shadow: 2px 0px 12px 1px rgba(0,0,0,.8);
            }
            #submit {
                opacity: 0.7;
                padding: 6px 0;
                border-radius: 25px;
                background: -webkit-linear-gradient(left, rgba(0,0,0,.3) , rgba(30,136,229,.3), rgba(0,0,0,.3));
                background: -o-linear-gradient(right, rgba(0,0,0,.3) , rgba(30,136,229,.3), rgba(0,0,0,.3));
                background: -moz-linear-gradient(right, rgba(0,0,0,.3) , rgba(30,136,229,.3), rgba(0,0,0,.3));
                background: linear-gradient(to right, rgba(0,0,0,.3) , rgba(30,136,229,.3), rgba(0,0,0,.3));
            }
        </style>
	</head>

	<body>
		<div class="am-container">
<!--            <p style="text-indent: 20px;">--><?php //echo Yii::t('app', '请填写您的'); ?><!----><?php //echo $data['name']; ?><!--</p>-->
			<div class="am-g">
                <div class="tcenter mineOre2 mt10" >
                    <input class="coname" id="coname" name="coname" value="<?php echo $data['coname'];?>" placeholder="<?php echo Yii::t('app', '请输入您的'); ?><?php echo $data['name'];?>" />
                </div>
                <div class="mineOre2 mt10" style="display: block;">
                    <div class="draw-1">
                        <span class="five" style="color: red;">
                            <?php echo Yii::t('app', '收款二维码（必填）'); ?>
                        </span>
                    </div>
                    <div class="draw-2">
                        <label for="picture" class="picture" id="pic">
                            <?php if($data['co_pic'] != '') { ?>
                            <img class="layui-upload-img" id="image" src="<?php echo $data['co_pic']; ?>" class="layui-upload-img" style="width: 50%;max-width: 160px;height: auto;">
                            <?php } else { ?>
                            <img class="layui-upload-img" id="image" src="/img/photo@2x.png" class="layui-upload-img" style="width: 33%;max-width: 160px;height: auto;">
                            <?php } ?>
                            <p id="demoText"></p>
                        </label>
                    </div>
                </div>

                <input type="hidden" id="coid" name="coid" value="<?php echo yii\helpers\HtmlPurifier::process(Yii::$app->request->get('coid')); ?>">

                <div class="am-u-sm-12 safeLogout">
                    <button type="button" id="submit" disabled="true">
                        <?php echo Yii::t('app', '提交'); ?>
                    </button>
                </div>
			</div>
		</div>
        <script src="/js/jquery.min.js"></script>
        <script src="/layui/layui.js" charset="utf-8"></script>
        <script>
            $("#coname").on("keyup", function () {
                // 判断是否符合微信号或支付宝规则
                if($("#coname").val() != '') {
                    $("#submit").prop('disabled', false);
                    $("#submit").css({"background": "-webkit-linear-gradient(left, rgba(0,0,0,20.3) , rgba(30,136,229,20.3), rgba(0,0,0,20.3))",
                        "background": "-o-linear-gradient(right, rgba(0,0,0,20.3) , rgba(30,136,229,20.3), rgba(0,0,0,20.3))",
                        "background": "-moz-linear-gradient(right, rgba(0,0,0,20.3) , rgba(30,136,229,20.3), rgba(0,0,0,20.3))",
                        "background": "linear-gradient(to right, rgba(0,0,0,20.3) , rgba(30,136,229,20.3), rgba(0,0,0,20.3))"})
                }
            });

            layui.use('upload', function(){
                var $ = layui.jquery
                    ,upload = layui.upload;
                var uploadInst = upload.render({
                    elem: '#pic'
                    ,url: '/user/comuphoto.html'
                    ,before: function(obj){
                        obj.preview(function(index, file, result){
                            $('#image').attr('src', result);
                        });
                    }
                    ,done: function(data){
                        //上传成功
                        if(data.status == "0001"){
                            alert(data.message);
                            $('#image').attr('src', data.data.src);
                            $('#image').css({"width":"50%","max-width":"160px","height":"auto"});
                            $("#submit").prop('disabled', false);
                        }else{
                            alert(data.message);
                        }
                    }
                });
            });
            
            $("#submit").click(function() {
                var coname = $("#coname").val();
                var pic_src = $("#image").attr('src');
                var coid = $("#coid").val();
                var url = "/user/modcollect.html";
                $("#submit").prop('disabled',true);
                $.ajax({
                    type: "post",
                    dataType: "json",
                    data: {coname: coname, src: pic_src, coid: coid},
                    url: url,
                    success: function (data) {
                        if (data.status == '0001') {
                            alert(data.message);
                            $("#submit").prop('disabled',true);
                            $("#submit").css({"opacity":"0.7"});
                        } else {
                            alert(data.message);
                            $("#submit").prop('disabled',false);
                        }
                    }
                });

            });
        </script>
    </body>
</html>