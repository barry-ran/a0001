
var countdown=60; 
function sendemail(){
    var obj = $("#btn");
    settime(obj);
    
    }
function settime(obj) { //发送验证码倒计时
    if (countdown == 0) { 
        obj.attr('disabled',false); 
        //obj.removeattr("disabled"); 
        obj.val("获取验证码");
        countdown = 60; 
        return;
    } else { 
        obj.attr('disabled',true);
        obj.val("重新发送(" + countdown + ")");
        countdown--; 
    } 
setTimeout(function() { 
    settime(obj) }
    ,1000) 
}


//注册页面跳转到登录页面
$("#register").click(function(){
	var UserName=$("#username").val();
	var Pwd1=$("#password1").val();
	var Pwd2=$("#password2").val();
	var Tel=$("#tel").val();
	var Code=$("#code").val();
	if(UserName != '' && Pwd1 !=''&& Pwd2 !=''&& Tel !=''&& Code !=''){
		window.location.href="../login.html";
	}
		
})

//登录页面跳转到首页面
$("#Login").click(function(){
	var UserN=$("#UserN").val();
	var Pwd=$("#Pwd").val();
	if(UserN==''||Pwd==''){
		alert("请把信息填写完整！");
	}else{
		window.location.href="index.html";
	}
})

//跳转到找回密码页面
$("#search").click(function(){
		window.location.href="passport.html";
})
