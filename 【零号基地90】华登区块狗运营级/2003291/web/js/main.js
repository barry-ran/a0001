//屏幕适应
(function (win) {
    if (!win.addEventListener) return;
    var html = document.documentElement;
    function setFont() {
        var cliWidth = html.clientWidth;
        html.style.fontSize = 100 * (cliWidth /750) + 'px';
    }
    win.addEventListener('resize', setFont, false);
    setFont();
})(window);


$(function(){
    var regTel=/^1[3456789]\d{9}$/;//电话验证
    var regUsername=/^[a-zA-Z][a-zA-Z0-9]{3,15}$/;
    
    var c_phone    = $.cookie('phone');
    var c_password = $.cookie('password');
    if (c_phone && c_password) {
    	$("#phone").val(c_phone);
    	$("#password").val(c_password);
    	$(".remember_check").attr("checked","checked");
    }


    //点击登录按钮 表单验证
    $(".login_btn").click(function(){
        var phone=$("#phone").val();
        var password=$("#password").val();
        if(!phone || phone.trim() == "") {
            mui.toast('请输入手机号码',{ duration:'short', type:'div' })
            return false;
        }
        if(!(regTel.test(phone))){
            mui.toast('请输入正确的手机号码',{ duration:'short', type:'div' })
            return false;
        }
        if(!password || password.trim() == "") {
            mui.toast('请输入密码',{ duration:'short', type:'div' })
            return false;
        }
        var checkeds = $(".remember_check").is(':checked');
        
		
        $.ajax({
            type: "post",
            url: "http://lf2.221bk.cn/api/loginapi.html",
            data: {username:phone,password:password},
            dataType: 'json',
            success: function(result) {
            	
				if(checkeds){
					$.cookie('phone',phone,{ expires: 10 });
					$.cookie('password',password,{ expires: 10 });
				}else{
					$.cookie('phone','');
					$.cookie('password','');
				}
                if(result.status == '0001') {
                    mui.toast(result.message,{ duration:'short', type:'div' });
                    window.location.href = result.data.url;
                } else {
                    mui.toast(result.message,{ duration:'short', type:'div' })
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                mui.toast('请求失败',{ duration:'short', type:'div' })
            }
        });
    });


    //点击发送验证码
    $(".getcode_btn").click(function(){
        var phone=$("#phone").val();
        if(!phone || phone.trim() == "") {
            mui.toast('请输入手机号码',{ duration:'short', type:'div' });
            return false;
        }
        if(!(regTel.test(phone))){
            mui.toast('请输入正确的手机号码',{ duration:'short', type:'div' });
            return false;
        }
        $.ajax({
            type: "post",
            url: "http://lf2.221bk.cn/api/intsendmsg.html",
            data: {phone: phone},
            dataType: 'json',
            success: function(result) {
                if(result.status == '0001') {
                    mui.toast('发送成功',{ duration:'short', type:'div' });
                    setTimer();  //倒计时
                } else {
                    mui.toast(result.message,{ duration:'short', type:'div' })
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                mui.toast('请求失败',{ duration:'short', type:'div' })
            }
        });
    });



    //获取路径？后字段
    function GetQueryString(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return decodeURI(r[2]);
        return '';
    }

    var invite_code = GetQueryString('invite_code');

    $("#comm_code").val(invite_code); //邀请码


    //点击确认注册按钮
    $(".register_btn").click(function(){
        var username=$("#username").val();
        var phone=$("#phone").val();
        var code=$("#code").val();
        var login_password=$("#login_password").val();
        var login_password_confirm=$("#login_password_confirm").val();
        var pay_password=$("#pay_password").val();
        var pay_password_confirm=$("#pay_password_confirm").val();
        var comm_code=$("#comm_code").val();


        if(!username || username.trim() == "") {
            mui.toast('请输入用户名',{ duration:'short', type:'div' })
            return false;
        }
        if(!(regUsername.test(username))){
            mui.toast('用户名由字母开头,长度8-16位的字母数字组合',{ duration:'long', type:'div' })
            return false;
        }
        if(!phone || phone.trim() == "") {
            mui.toast('请输入手机号码',{ duration:'short', type:'div' })
            return false;
        }
        if(!(regTel.test(phone))){
            mui.toast('请输入正确的手机号码',{ duration:'short', type:'div' })
            return false;
        }
        if(!code || code.trim() == "") {
            mui.toast('请输入验证码',{ duration:'short', type:'div' })
            return false;
        }
        if(!login_password || login_password.trim() == "") {
            mui.toast('请输入登录密码',{ duration:'short', type:'div' })
            return false;
        }
        if(!login_password_confirm || login_password_confirm.trim() == "") {
            mui.toast('请再次输入登录密码',{ duration:'short', type:'div' })
            return false;
        }else if(login_password_confirm != login_password){
            mui.toast('登录密码不一致',{ duration:'short', type:'div' })
            return false;
        }
        if(!pay_password || pay_password.trim() == "") {
            mui.toast('请输入支付密码',{ duration:'short', type:'div' })
            return false;
        }
        if(!pay_password_confirm || pay_password_confirm.trim() == "") {
            mui.toast('请再次输入支付密码',{ duration:'short', type:'div' })
            return false;
        }else if(pay_password_confirm != pay_password){
            mui.toast('支付密码不一致',{ duration:'short', type:'div' })
            return false;
        }
        if(!comm_code || comm_code.trim() == "") {
            mui.toast('请输入邀请码',{ duration:'short', type:'div' })
            return false;
        }
    })



    //点击确认 修改密码按钮
    $(".change_btn").click(function(){
        var username=$("#username").val();
        var phone=$("#phone").val();
        var code=$("#code").val();
        var login_password=$("#login_password").val();
        var login_password_confirm=$("#login_password_confirm").val();

        if(!username || username.trim() == "") {
            mui.toast('请输入用户名',{ duration:'short', type:'div' })
            return false;
        }
        if(!(regUsername.test(username))){
            mui.toast('用户名由字母开头,长度8-16位的字母数字组合',{ duration:'long', type:'div' })
            return false;
        }
        if(!phone || phone.trim() == "") {
            mui.toast('请输入手机号码',{ duration:'short', type:'div' })
            return false;
        }
        if(!(regTel.test(phone))){
            mui.toast('请输入正确的手机号码',{ duration:'short', type:'div' })
            return false;
        }
        if(!code || code.trim() == "") {
            mui.toast('请输入验证码',{ duration:'short', type:'div' })
            return false;
        }
        if(!login_password || login_password.trim() == "") {
            mui.toast('请输入新密码',{ duration:'short', type:'div' })
            return false;
        }
        if(!login_password_confirm || login_password_confirm.trim() == "") {
            mui.toast('请再次输入新密码',{ duration:'short', type:'div' })
            return false;
        }else if(login_password_confirm != login_password){
            mui.toast('密码不一致',{ duration:'short', type:'div' })
            return false;
        }
        $.ajax({
            type: "post",
            url: "http://lf2.221bk.cn/api/forgetpasswordapi.html",
            data: {username: username,phone: phone,code: code,password: login_password},
            dataType: 'json',
            success: function(result) {
                if(result.status == '0001') {
                    mui.toast(result.message,{ duration:'short', type:'div' });
                    window.location.href = "http://lf1.221bk.cn/login.html";
                } else {
                    mui.toast(result.message,{ duration:'short', type:'div' })
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                mui.toast('请求失败',{ duration:'short', type:'div' })
            }
        });
    })
});


function setTimer(){
    var t =30;
    $(".getcode_btn").hide();
    $(".getcode_count").html(t+"s").show();

    function fun() {
        t--;
        $(".getcode_count").html(t+"s后重发")
        if(t <= 0) {
            clearInterval(inter);
            $(".getcode_count").hide();
            $(".getcode_btn").show();
        }
    }
    var inter = setInterval(fun, 1000);
}