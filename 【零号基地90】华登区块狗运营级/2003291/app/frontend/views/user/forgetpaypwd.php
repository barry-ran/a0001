<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title><?php echo Yii::t("app", "忘记支付密码") ?></title>
		<link rel="stylesheet" href="/css/ymj.css" />
	</head>

	<body>
		<div class="am-container">
			<div class="am-g">
				<div class="am-u-sm-12 userGo">
					<div class="accordion2">
						<div class="accordionInput frm">
							<input type="text" name="strphone" id="strphone" value="<?php echo $profiledata['quhao'].$profiledata['phone'];?>" readonly="readonly" class="txt large fl" step="1">
							<label title="<?php echo Yii::t('app', '手机号码'); ?>"></label>
							<span role="tooltip"></span>
						</div>
					</div>
                    <div class="accordion2">
                        <div class="accordionInput frm">
                            <input type="text"  name="code" id='code'  placeholder="<?php echo Yii::t('app', '填写验证码'); ?>" class="txt large fl" step="1">
                            <label title="<?php echo Yii::t('app', '请输入验证码'); ?>"></label>
                            <span role="tooltip"></span>
                        </div>
                        <div class="goRight">
                            <button type='button' id='btn' class="sendcode" style="background:transparent;color:#1AB1FF;"><?php echo Yii::t('app', '获取验证码'); ?></button>
                        </div>
                    </div>
					<div class="accordion2">
						<div class="accordionInput frm">
							<input type="password" name="traspass" id='traspass' placeholder="<?php echo Yii::t('app', '设置新的密码'); ?>" class="txt large fl" step="1">
							<label title="<?php echo Yii::t('app', '请输入交易密码'); ?>"></label>
							<span role="tooltip"></span>
						</div>
						<div class="goRight opacity6 closeInput">
                            <img src="/img/close_gray_18.png" />
                        </div>
					</div>
				</div>
				<div class="am-u-sm-12 safeLogout">
					<button type="button" class="forgetpaypwd"><?php echo Yii::t('app', '提交'); ?></button>
				</div>
			</div>
		</div>

		<script charset="utf-8" src="/js/3.2.1.js"></script>
        <script src="/js/jquery.min.js"></script>
        <script src="/js/amazeui.min.js"></script>
		<script>
			$(".large").focus(function() {
				$(this).parent().parent().css("margin-top", "24px");
			});
			$(".large").blur(function() {
				$(this).parent().parent().css("margin-top", "10px");
			});
			$(".closeInput").on("click", function() {
				$(this).prev().find("input").val("");
			});

            $(".forgetpaypwd").click(function(){
                var phone = '<?php echo $profiledata['phone']?>',
                    code = $("#code").val(),
                    traspass = $("#traspass").val(),
                    strphone = $("#strphone").val();
                if (code.length <  0) {
                    alert('<?php echo Yii::t('app', "填写验证码")?>');
                    return false;
                }
                var tras = /^\d{6}$/;
                if(!tras.test(traspass) || traspass.length != 6){
                    alert("<?php echo Yii::t('app', "交易密码必须为6位纯数字"); ?>");
                    return false;
                }
                $('.forgetpaypwd').prop("disabled",true);

                var url = "/user/forgetpaypwd.html";
                $.ajax({
                    type: "post",
                    data: {strphone: strphone,traspass: traspass,code:code,phone:phone},
                    dataType: "json",
                    url: url,
                    success: function (s) {
                        if (s.status == true) {
                            alert(s.message);
                        } else {
                            alert(s.message);
                            $('.forgetpaypwd').prop("disabled",false);
                        }
                    }
                });
            });
            //发送验证码
            $(".sendcode").on("click", function () {
                $(this).button("loading").delay(1000).queue(function () {
                    var $btn = $(this),
                        quhao = '<?php echo $profiledata['quhao'];?>',
                        phone = '<?php echo $profiledata['phone'];?>',
                        strphone = $("#strphone").val();
                    var conf = {
                        clock: "",
                        nums: 60,
                        init: function () {
                            var that = this;
                            var doLoop = function () {
                                that.nums--;
                                if (that.nums > 0) {
                                    $btn.text(that.nums + 's');
                                } else {
                                    clearInterval(that.clock); //清除js定时器
                                    $btn.button('reset');
                                    $btn.dequeue();
                                    that.nums = 60; //重置时间
                                }
                            };
                            if(quhao == "86"){
                                if (!(/^0?1[3|4|5|6|7|8|9][0-9]\d{8}$/).test(phone)) {
                                    alert("<?php echo Yii::t('app', "请输入正确的手机号码"); ?>");
                                    $btn.button('reset');
                                    $btn.dequeue();
                                    return false;
                                }
                            }else{
                                if(!(/^\d{6,}$/).test(phone)){
                                    alert("<?php echo Yii::t('app', "请输入正确的手机号码"); ?>");
                                    $btn.button('reset');
                                    $btn.dequeue();
                                    return false;
                                }
                            }
                            $.ajax({
                                type: "post",
                                data: {strphone: strphone ,phone:phone,quhao:quhao},
                                dataType: "json",
                                url: "/site/intsendmsg.html",
                                success: function (e) {
                                    if (e.status === true) {
                                        alert("<?php echo Yii::t('app', "验证码已发送到您手机，请注意查收"); ?>");
                                        $btn.text(that.nums + 's');
                                        that.clock = setInterval(doLoop, 1000);
                                    } else {
                                        alert(e.message);
                                        $btn.button('reset');
                                        $btn.dequeue();
                                    }
                                }
                            });
                        }
                    };
                    conf.init();
                });
            });
		</script>
	</body>
</html>