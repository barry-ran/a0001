(function ($, owner) {
    /**
     * 用户登录
     **/
    owner.login = function (loginInfo, callback) {
        callback = callback || $.noop;
        loginInfo = loginInfo || {};
        loginInfo.account = loginInfo.account || '';
        loginInfo.password = loginInfo.password || '';
        if (loginInfo.account.length <= 0) {
            return callback('账号不能为空');
        }
        if (loginInfo.password.length < 6) {
            return callback('密码最短为 6 个字符');
        }
        $.post("/site/login.html", loginInfo, function (data) {
            if (data.status === false) {
                return callback(data.message);
            } else {
                window.location.href = data.url;
            }
        }, "json");
    };
    owner.createState = function (name, callback) {
        var state = owner.getState();
        state.account = name;
        state.token = "token123456789";
        owner.setState(state);
        return callback();
    };
    /*
     
     * 记录新手指导显示情况
     
     */
    owner.handsHit = function (content) {
        var $settings = owner.getSettings();
        if ($settings.handhits === undefined) {
            $.extend($settings, {"handhits": 1});
            layer.open({
                title: ["系统公告", 'background-color: #FF4351; color:#fff;'],
                content: content,
                btn: "朕，知道了"
            });
            $.extend($settings, {"handhits": $settings.handhits - 1});
        } else if ($settings.handhits > 0) {
            //弹出
            layer.open({
                title: ["系统公告", 'background-color: #FF4351; color:#fff;'],
                content: content,
                btn: "朕，知道了"
            });
            $.extend($settings, {"handhits": $settings.handhits - 1});
        }
        owner.setSettings($settings);
    };

    /**
     * 获取当前状态
     **/
    owner.getState = function () {
        var stateText = localStorage.getItem('$state') || "{}";
        return JSON.parse(stateText);
    };
    /**
     * 设置当前状态
     **/
    owner.setState = function (state) {
        state = state || {};
        localStorage.setItem('$state', JSON.stringify(state));
    };
    var checkEmail = function (email) {
        email = email || '';
        return (email.length > 3 && email.indexOf('@') > -1);
    };
    /**
     * 找回密码
     **/
//    owner.forgetPassword = function (regInfo, callback) {
//        callback = callback || $.noop;
//        regInfo = regInfo || {};
//        if (regInfo.username.length <= 0) {
//            return callback('请输入您的用户名');
//        }
//        if (regInfo.phone.length <= 0) {
//            return callback('请输入您的手机号码');
//        }
//        if (regInfo.password.length < 6) {
//            return callback('密码最短需要 6 个字符');
//        }
//        if (regInfo.code.length <= 0) {
//            return callback("验证码不能为空");
//        }
////        if (regInfo.password != regInfo.repassword) {
////            return callback("两次密码输入不一致");
////        }
//        $.post("/site/forgetpassword.html", regInfo, function (data) {
//            if (data.status === false) {
//                return callback(data.message);
//            } else {
//                alert(data.message);
//                window.location.href = data.url;
//
//            }
//        }, "json");
//
//    };
    /**
     * 找回支付密码
     **/
//    owner.forgetPaypwd = function (regInfo, callback) {
//        callback = callback || $.noop;
//        regInfo = regInfo || {};
//        if (regInfo.code.length < 0) {
//            return callback("验证码不能为空");
//        }
//        if (regInfo.traspass.length < 6) {
//            return callback('密码最短需要 6 个字符');
//        }
//        $.post("/site/forgetpaypwd.html", regInfo, function (data) {
//            if (data.status === false) {
//                return callback(data.message);
//            } else {
//                alert(data.message);
//                window.location.href = data.url;
//
//            }
//        }, "json");
//
//    };
    
    /**
     * 获取应用本地配置
     **/
    owner.setSettings = function (settings) {
        settings = settings || {};
        localStorage.setItem('$settings', JSON.stringify(settings));
    };
    /**
     * 设置应用本地配置
     **/
    owner.getSettings = function () {
        var settingsText = localStorage.getItem('$settings') || "{}";
        return JSON.parse(settingsText);
    };
    /*
     * 安全中心 修改密码
     */
    owner.security = function (d) {
        var conf = {
            is_login: false,
            is_apliay: false,
            url: null,
            config: {},
            init: function (d) {
                $.extend(this.config, d, true);
                this.btnLoginPass();
                this.btnApliayPass();
                this.btnSubmit();
            },
            /*
             * 修改登录密码按钮
             */
            btnLoginPass: function () {
                var _this = this;
                $(".xianshi").unbind("click").bind("click", function (e) {
                    $(".panel11").show();
                    $(".apliay-panel").hide();
                    _this.is_login = true;
                    _this.is_apliay = false;
                    _this.hideForm();
                });
            },
            /*
             * 修改支付密碼按鈕
             */
            btnApliayPass: function () {
                var _this = this;
                $(".xiugai").unbind("click").bind("click", function (e) {
                    $(".panel11").show();
                    $(".login-panel").hide();
                    _this.is_apliay = true;
                    _this.is_login = false;
                    _this.hideForm();
                });
            },
            /*
             * 隐藏表单
             * @returns {undefined}
             */
            hideForm: function () {
                var _this = this;
                $(".quxiao").unbind("click").bind("click", function (e) {
                    $(".panel11").hide();
                    $(".apliay-panel").show();
                    $(".login-panel").show();
                    _this.is_apliay = false;
                    _this.is_login = false;
                    _this.resetData();
                });
            },
            /*
             * 置空表单数据
             */
            resetData: function () {

            },
            /*
             * 获取提交的url
             * @returns {undefined}
             */
            getUrl: function () {
                if (this.is_login) {
                    this.url = this.config.loginurl;
                } else if (this.is_apliay) {
                    this.url = this.config.apliayurl;
                } else {
                    this.url = null;
                }
                return this.url;
            },
            /*
             * 提交表单数据
             */
            btnSubmit: function () {
                var _this = this;
                $(".up-btn").unbind("click").bind("click", function (e) {
                    $(this).button("loading").delay(1000).queue(function () {
                        var $btn = $(this),
                                params = $("#loginPwdForm").serializeObject();
                        if (_this.validate(params)) {
                            $.post(_this.getUrl(), params, function (data) {
                                if (data.status === true) {
                                    layer.open({
                                        content: "操作成功", skin: 'msg', time: 2 //2秒后自动关闭
                                    });
                                    $btn.button('reset');
                                    $btn.dequeue();
                                } else {
                                    layer.open({
                                        content: data.message, skin: 'msg', time: 2 //2秒后自动关闭
                                    });
                                    $btn.button('reset');
                                    $btn.dequeue();
                                }
                            }, "json");
                        } else {
                            $btn.button('reset');
                            $btn.dequeue();
                        }
                        return false;
                    });
                });
            },
            /*
             * 表单验证
             * @params data
             * return boolean
             */
            validate: function (data) {
                if (!data.oldpassword) {
                    layer.open({
                        content: "当前密码不能为空", skin: 'msg', time: 2 //2秒后自动关闭
                    });
                    return false;
                }
                if (!data.newpassword) {
                    layer.open({
                        content: "新密码不能为空", skin: 'msg', time: 2 //2秒后自动关闭
                    });
                    return false;
                }
                if (!data.renewpassword) {
                    layer.open({
                        content: "重复新密码不能为空", skin: 'msg', time: 2 //2秒后自动关闭
                    });
                    return false;
                }
                if (data.renewpassword != data.newpassword) {
                    layer.open({
                        content: "两次密码不一致", skin: 'msg', time: 2 //2秒后自动关闭
                    });
                    return false;
                }
                if (!data.phone) {
                    layer.open({
                        content: "手机号不能为空", skin: 'msg', time: 2 //2秒后自动关闭
                    });
                    return false;
                }
                if (!data.code) {
                    layer.open({
                        content: "验证码不能为空", skin: 'msg', time: 2 //2秒后自动关闭
                    });
                    return false;
                }
                return true;
            }
        };
        conf.init(d);
    };
    /*
     * 更新个人资料
     */
    owner.updateDatum = function () {
        $(".btn-updatedatum").unbind("click").bind("click", function (e) {
            $(this).button("loading").delay(1000).queue(function () {
                var $btn = $(this),
                        params = $("#updatedatum").serializeObject();
                $.post("/profile/update.html", params, function (data) {
                    if (data.status === true) {
                        layer.open({
                            content: "操作成功", skin: 'msg', time: 2 //2秒后自动关闭
                        });
                        $btn.button('reset');
                        $btn.dequeue();
                    } else {
                        layer.open({
                            content: data.message, skin: 'msg', time: 2 //2秒后自动关闭
                        });
                        $btn.button('reset');
                        $btn.dequeue();
                    }
                }, "json");
                return false;
            });
        });
    };
    /*
     * 更新手机号码
     */
    owner.updatePhone = function () {
        $(".btn-upphone").unbind("click").bind("click", function (e) {
            var myreg = /^1\d{10}$/;
            if (!$("#phone").val()) {
                layer.open({
                    content: "请填写手机号码", skin: 'msg', time: 2 //2秒后自动关闭
                });
                return;
            }
            if (!myreg.test($("#phone").val())) {
                layer.open({
                    content: "手机号码格式不正确", skin: 'msg', time: 2 //2秒后自动关闭
                });
                return;
            }
            if (!$("#code")) {
                layer.open({
                    content: "验证码不能为空", skin: 'msg', time: 2 //2秒后自动关闭
                });
                return;
            }
            if (!$("#password")) {
                layer.open({
                    content: "交易密码不能为空", skin: 'msg', time: 2 //2秒后自动关闭
                });
                return;
            }
            $(this).button("loading").delay(1000).queue(function () {
                var $btn = $(this),
                        params = $("#upphone").serializeObject();
                $.post("/profile/upphone.html", params, function (data) {
                    if (data.status === true) {
                        layer.open({
                            content: "操作成功", skin: 'msg', time: 2 //2秒后自动关闭
                        });
                        $btn.button('reset');
                        $btn.dequeue();
                    } else {
                        layer.open({
                            content: data.message, skin: 'msg', time: 2 //2秒后自动关闭
                        });
                        $btn.button('reset');
                        $btn.dequeue();
                    }
                }, "json");
                return false;
            });
        });
    };
    /*
     * 注册会员
     */
//    owner.regist = function () {
//        var conf = {
//            init: function () {
//                this.btnRegist();
//            },
//            btnRegist: function () {
//                var _this = this;
//                $(".btn-regist").unbind("click").bind("click", function (e) {
//                    if (_this.validate()) {
//                        $(this).button("loading").delay(1000).queue(function () {
//                            var $btn = $(this),
//                                    params = $("#registform").serializeObject();
//                            $.post("/site/register.html", params, function (data) {
//                                if (data.status === true) {
//                                    alert(data.msg);
//                                    $btn.button('reset');
//                                    $btn.dequeue();
//                                    window.location.href = data.url;
//                                } else {
//                                    alert(data.msg);
////                                    layer.msg(data.msg);
//                                    $btn.button('reset');
//                                    $btn.dequeue();
//                                }
//                            }, "json");
//                            return false;
//                        });
//                    }
//                });
//            },
//            validate: function () {
//                var phone = $("#phone").val(),
//                    username = $("#username").val(),
//                    password = $("#password").val(),
//                    repassword = $("#repassword").val(),
//                    traspass = $("#traspass").val(),
//                    invite_name = $("#invite_name").val(),
//                    code = $("#code").val(),
//                    options=$("#quhao").val(); 
//                if (username.length < 4 || username.length > 20) {
//                    layer.msg("用户名长度4-20位");
//                    return false;
//                }
//                if (password.length < 6 || password.length > 10) {
//                    layer.msg("密码长度6-10位");
//                    return false;
//                }
//                if (!(repassword == password)) {
//                    layer.msg("两次输入的密码不一致");
//                    return false;
//                }
//                if (traspass.length < 6 || traspass.length > 10) {
//                    layer.msg("交易密码长度6-10位");
//                    return false;
//                }
//                if (!phone) {
//                    layer.msg("手机号不能为空");
//                    return false;
//                }
//                if(options == 1){
//                    if (!(/^1\d{10}$/).test(phone)) {
//                        layer.msg("请输入正确的手机号码");
//                        return false;
//                    } 
//                    if (!code) {
//                    layer.msg("验证码不能为空");
//                    return false;
//                }
//                }
//                
//                
//                if (!invite_name) {
//                    layer.msg("邀请人的名字不能为空");
//                    return false;
//                }
//                if(status==1){
//                    layer.msg("请先阅读并接受此协议");
//                    return false;
//                }
//                return true;
//            }
//        };
//        conf.init();
//    };
    
    /*
     * 转账
     */
    owner.transfer = function () {
        var conf = {
            init: function () {
                this.btnTransfer();
            },
            btnTransfer: function () {
                var _this = this;
                $(".btn_send").unbind("click").bind("click", function (s) {
                    if (_this.validate()) {
                        $(this).button("loading").delay(1000).queue(function () {
                            var $btn = $(this),
                            params = $("#transferForm").serializeObject();
                            $.post("/trade/transfer.html", params, function (data) {
                                if (data.status === true) {
                                    layer.msg("转账成功");
                                    $btn.button('reset');
                                    $btn.dequeue();
                                    window.location.href = data.url;
                                } else {
                                    layer.msg(data.message);
                                    $btn.button('reset');
                                    $btn.dequeue();
                                }
                            }, "json");
                            return false;
                        });
                    }
                });
            },
            validate: function () {
                var wallet_token = $("#wallet_token").val(),
                    amount = $("#amount").val(),
                    traspass = $("#traspass").val();
                if (wallet_token.length <= 0) {
                    layer.msg("钱包地址不能为空");
                    return false;
                }
                if (wallet_token.length != 33) {
                    layer.msg("请输入正确的钱包地址");
                    return false;
                }
                if (!amount) {
                    layer.msg("转账金额不能为空");
                    return false;
                }
                if (!traspass) {
                    layer.msg("交易密码不能为空");
                    return false;
                }
                return true;
            }
        };
        conf.init();
    };
    
}(jQuery, window.app = {}));
$.fn.serializeObject = function () {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};


