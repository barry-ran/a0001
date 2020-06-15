$(".login").on("click", function () {
    var loginInfo = {
        account: $("#username").val(),
        password: $("#password").val()
    };
    app.login(loginInfo, function (err) {
        if (err) {
            layer.msg(err);
            return;
        }
        window.location.herf = "/site/index.html";
    });
});

//忘记登录密码
$(".forget-pwd").on("click", function () {
    var loginInfo = {
        phone: $("#phone").val(),
        username: $("#username").val(),
        repassword: $("#repassword").val(),
        password: $("#password").val(),
        code: $("#code").val()
    };
    app.forgetPassword(loginInfo, function (err) {
        if (err) {
            layer.msg(err);
            return;
        }
    });
});
//忘记支付密码
$(".forgetpaypwd").on("click", function () {
    var loginInfo = {
        phone: $("#phone").val(),
        traspass: $("#traspass").val(),
        code: $("#code").val()
    };
    app.forgetPaypwd(loginInfo, function (err) {
        if (err) {
            layer.msg(err);
            return;
        }
    });
});
