<?php

use frontend\assets\LoginAsset;

LoginAsset::register($this);
//$this->registerJs('app.regist();', $this::POS_END);
?>
<?php $this->beginPage() ?>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title><?php echo Yii::t('app','注册');?></title>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="alternate icon" type="/image/png" href="/i/favicon.png">
    <link rel="stylesheet" href="/css/amazeui.min.css" />
    <link rel="stylesheet" href="/css/base.css" />
    <link rel="stylesheet" href="/css/login.css" />
    <link rel="stylesheet" href="/css/select_gj.css">
    <style>
        body{
            background:#f9f9f9;
        }
        header{
            background:transparent !important;
            padding:0 !important;
            height:50px !important;
        }
        header>div{
            width:100%;left:0 !important;
            color:#000 !important;
            text-align: center;
        }
        header img{
            height:26px;
            margin-top:12px !important;
            margin-left:10px;
        }
        .hhh{display:none;}
        input,select{background:transparent;border:0;color:#666;}
        .login1{border-bottom:1px solid #eee;background:#fff;}
        .login1:first-child{
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }
        .nub-2{
            color: black;
            font-weight: normal;
        }
        .tongyi-1 a{
            color:#1e88e5;
        }
        .login1 input{
            color: black;
            font-weight: normal;
        }
        .login1 select{
            font-size: 13px;
            font-weight: 100;
            outline: none;
            border-bottom: 0px;
            border-top: 0px;
            border-left: 0px;
            border-right: 0px;
            width: calc(100% - 140px);
            background: transparent;
            color: #000000;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>
<div class="am-g content">
    <div class="am-u-sm-12" style="margin-top:30px;padding:0 18px;">
        <form id="registform">
            <div class="login1">
                <label class="nub-2"><?php echo Yii::t('app','语言选择');?></label><br class="hhh">
                <select name="" id="aah" onchange="myFunction(this)">
                    <option value="en_US">English</option>
                    <option value="zh_CN">繁体中文</option>
                    <option value="ru_RU">русский язык</option>
                    <option value="ko_KP">한국어</option>
                    <option value="ja_JP">日本語</option>
                </select>
            </div>
<!--            用户名-->
            <div class="login1">
                <label class="nub-2"><?php echo Yii::t('app','邮箱');?></label><br class="hhh">
                <input type="text" name="username" id="username" value="" placeholder="<?php echo Yii::t('app','请输入您的邮箱');?>">
            </div>

            <div class="login1" style="display: none;">
                <label class="nub-2"><?php echo Yii::t('app','手机号');?></label><br class="hhh">
                <label>
                    <select name="quhao" id='quhao'>
                        <option value ="1" selected>86</option>
                        <option value ="2">44</option>
                        <option value ="3">61</option>
                        <option value ="4">91</option>
                        <option value ="5">66</option>
                        <option value ="6">49</option>
                        <option value ="7">62</option>
                        <option value ="8">855</option>
                        <option value ="9">60</option>
                        <option value ="10">856</option>
                        <option value ="11">852</option>
                        <option value ="12">81</option>
                        <option value ="13">65</option>
                        <option value ="14">63</option>
                        <option value ="15">886</option>
                        <option value ="16">1</option>
                        <option value ="17">82</option>
                        <option value ="18">853</option>
                        <option value ="19">84</option>
                        <option value ="20">86</option>
                        <option value ="21">90</option>
                        <option value ="22">880</option>
                        <option value ="23">39</option>
                        <option value ="24">43</option>
                        <option value ="25">506</option>
                        <option value ="26">34</option>
                    </select>
                </label>
                <input type="text" name="phone" required="" id="phone"  placeholder="<?php echo Yii::t('app','您的手机号码');?>" style="width:120px;font-size:15px;">
            </div>
<!--            验证码-->
            <div class="login1" id="yanzhengma">
                <label class="nub-2"><?php echo Yii::t('app','验证码');?></label><br class="hhh">
                <input type="text" name="code" id='code' value="" placeholder="<?php echo Yii::t('app','填写验证码');?>" style="width: 27%;font-size:15px;">
                <button type='button' id='btn' class="sendcode"  style="width: 35%;"><?php echo Yii::t('app','获取验证码');?></button>
            </div>
<!--            国家选择-->
            <div class="login1 ">
                <label class="nub-2"><?php echo Yii::t('app','国籍');?></label><br class="hhh">

                <select name="country" id="country" class="fastbannerform__country">
                    <option value="America" title="AA" >America</option>
                    <option value="Andorra" title="AD" >Andorra</option>
                    <option value="UnitedStatesofAmerica" title="AE" >United Arab Emirates</option>
                    <option value="Afghanistan" title="AF" >Afghanistan</option>
                    <option value="AntiguaandBarbuda" title="AG" >Antigua and Barbuda</option>
                    <option value="Albania" title="AL" >Albania</option>
                    <option value="Armenia" title="AM" >Armenia</option>
                    <option value="Angola" title="AO" >Angola</option>
                    <option value="Argentina" title="AR" >Argentina</option>
                    <option value="Austria" title="AT" >Austria</option>
                    <option value="Australia" title="AU" >Australia</option>
                    <option value="Aruba" title="AW" >Aruba</option>
                    <option value="Azerbaijan" title="AZ" >Azerbaijan</option>
                    <option value="Barbados" title="BB" >Barbados</option>
                    <option value="Bangladesh" title="BD" >Bangladesh</option>
                    <option value="Belgium" title="BE" >Belgium</option>
                    <option value="Burkina" title="BF" >Burkina Faso</option>
                    <option value="Bulgaria" title="BG" >Bulgaria</option>
                    <option value="Bahrain" title="BH" >Bahrain</option>
                    <option value="Burundi" title="BI" >Burundi</option>
                    <option value="Benin" title="BJ" >Benin</option>
                    <option value="Bermuda" title="BM" >Bermuda</option>
                    <option value="Brunei" title="BN" >Brunei</option>
                    <option value="Bolivia" title="BO" >Bolivia</option>
                    <option value="Brazil" title="BR" >Brazil</option>
                    <option value="Bahamas" title="BS" >Bahamas</option>
                    <option value="Bhutan" title="BT" >Bhutan</option>
                    <option value="Botswana" title="BW" >Botswana</option>
                    <option value="Belarus" title="BY" >Belarus</option>
                    <option value="Belize" title="BZ" >Belize</option>
                    <option value="Canada" title="CA" >Canada</option>
                    <option value="CentralAfricanRepublic" title="CF" >Central African Republic</option>
                    <option value="Switzerland" title="CH" >Switzerland</option>
                    <option value="Chile" title="CL" >Chile</option>
                    <option value="Cameroon" title="CM" >Cameroon</option>
                    <option value="China" title="CN" >China</option>
                    <option value="Colombia" title="CO" >Colombia</option>
                    <option value="CRI" title="CR" >Costa Rica</option>
                    <option value="Cuba" title="CU" >Cuba</option>
                    <option value="Cyprus" title="CY" >Cyprus</option>
                    <option value="Czech" title="CZ" >Czech Republic</option>
                    <option value="Germany" title="DE" >Germany</option>
                    <option value="Djibouti" title="DJ" >Djibouti</option>
                    <option value="Denmark" title="DK" >Denmark</option>
                    <option value="Dominica" title="DM" >Dominica</option>
                    <option value="Algeria" title="DZ" >Algeria</option>
                    <option value="Ecuador" title="EC" >Ecuador</option>
                    <option value="Estonia" title="EE" >Estonia</option>
                    <option value="Egypt" title="EG" >Egypt</option>
                    <option value="Eritrea" title="ER" >Eritrea</option>
                    <option value="Spain" title="ES" >Spain</option>
                    <option value="Ethiopia" title="ET" >Ethiopia</option>
                    <option value="Finland" title="FI" >Finland</option>
                    <option value="Fiji" title="FJ" >Fiji</option>
                    <option value="Micronesia" title="FM" >Micronesia</option>
                    <option value="France" title="FR" >France</option>
                    <option value="Gabon" title="GA" >Gabon</option>
                    <option value="UnitedKiongdom" title="GB" selected="selected">United Kingdom</option>
                    <option value="Grenada" title="GD" >Grenada</option>
                    <option value="Georgia" title="GE" >Georgia</option>
                    <option value="Ghana" title="GH" >Ghana</option>
                    <option value="Gibraltar" title="GI" >Gibraltar</option>
                    <option value="Gambia" title="GM" >Gambia</option>
                    <option value="Guinea" title="GN" >Guinea</option>
                    <option value="Greece" title="GR" >Greece</option>
                    <option value="Guatemala" title="GT" >Guatemala</option>
                    <option value="Guyana" title="GY" >Guyana</option>
                    <option value="HongKong" title="HK" >Hong Kong</option>
                    <option value="Honduras" title="HN" >Honduras</option>
                    <option value="Croatia" title="HR" >Croatia</option>
                    <option value="Haiti" title="HT" >Haiti</option>
                    <option value="Hungary" title="HU" >Hungary</option>
                    <option value="Indonesia" title="ID" >Indonesia</option>
                    <option value="Ireland" title="IE" >Ireland</option>
                    <option value="Israel" title="IL" >Israel</option>
                    <option value="India" title="IN" >India</option>
                    <option value="Iraq" title="IQ" >Iraq</option>
                    <option value="Iran" title="IR" >Iran</option>
                    <option value="Iceland" title="IS" >Iceland</option>
                    <option value="Italy" title="IT" >Italy</option>
                    <option value="Jamaica" title="JM" >Jamaica</option>
                    <option value="Jordan" title="JO" >Jordan</option>
                    <option value="Japan" title="JP" >Japan</option>
                    <option value="Kenya" title="KE" >Kenya</option>
                    <option value="Kyrgyzstan" title="KG" >Kyrgyzstan</option>
                    <option value="Cambodia" title="KH" >Cambodia</option>
                    <option value="Kiribati" title="KI" >Kiribati</option>
                    <option value="Comoros" title="KM" >Comoros</option>
                    <option value="NorthKorea" title="KP" >North Korea</option>
                    <option value="SouthKorea" title="KR" >South Korea</option>
                    <option value="Kuwait" title="KW" >Kuwait</option>
                    <option value="CaymanIs" title="KY" >Cayman Islands</option>
                    <option value="Kazakhstan" title="KZ" >Kazakhstan</option>
                    <option value="Laos" title="LA" >Laos</option>
                    <option value="Lebanon" title="LB" >Lebanon</option>
                    <option value="St.Lucia" title="LC" >Saint Lucia</option>
                    <option value="Liechtenstein" title="LI" >Liechtenstein</option>
                    <option value="SriLanka" title="LK" >Sri Lanka</option>
                    <option value="Liberia" title="LR" >Liberia</option>
                    <option value="Lesotho" title="LS" >Lesotho</option>
                    <option value="Lithuania" title="LT" >Lithuania</option>
                    <option value="Luxembourg" title="LU" >Luxembourg</option>
                    <option value="Latvia" title="LV" >Latvia</option>
                    <option value="Libya" title="LY" >Libya</option>
                    <option value="Morocco" title="MA" >Morocco</option>
                    <option value="Monaco" title="MC" >Monaco</option>
                    <option value="Moldova" title="MD" >Moldova</option>
                    <option value="Montenegro" title="ME" >Montenegro</option>
                    <option value="Madagascar" title="MG" >Madagascar</option>
                    <option value="Macedonia" title="MK" >Macedonia</option>
                    <option value="Mali" title="ML" >Mali</option>
                    <option value="Myanmar" title="MM" >Myanmar</option>
                    <option value="Mongolia" title="MN" >Mongolia</option>
                    <option value="Macao" title="MO" >Macao</option>
                    <option value="Mauritania" title="MR" >Mauritania</option>
                    <option value="Malta" title="MT" >Malta</option>
                    <option value="Mauritius" title="MU" >Mauritius</option>
                    <option value="Maldives" title="MV" >Maldives</option>
                    <option value="Malawi" title="MW" >Malawi</option>
                    <option value="Mexico" title="MX" >Mexico</option>
                    <option value="Malaysia" title="MY" >Malaysia</option>
                    <option value="Mozambique" title="MZ" >Mozambique</option>
                    <option value="Namibia" title="NA" >Namibia</option>
                    <option value="Niger" title="NE" >Niger</option>
                    <option value="Nigeria" title="NG" >Nigeria</option>
                    <option value="Nicaragua" title="NI" >Nicaragua</option>
                    <option value="Netherlands" title="NL" >Netherlands</option>
                    <option value="Norway" title="NO" >Norway</option>
                    <option value="Nepal" title="NP" >Nepal</option>
                    <option value="Nauru" title="NR" >Nauru</option>
                    <option value="NewZealand" title="NZ" >New Zealand</option>
                    <option value="Oman" title="OM" >Oman</option>
                    <option value="Panama" title="PA" >Panama</option>
                    <option value="Peru" title="PE" >Peru</option>
                    <option value="PapuaNewCuinea" title="PG" >Papua New Guinea</option>
                    <option value="Philippines" title="PH" >Philippines</option>
                    <option value="Pakistan" title="PK" >Pakistan</option>
                    <option value="Poland" title="PL" >Poland</option>
                    <option value="PuertoRico" title="PR" >Puerto Rico</option>
                    <option value="Palestine" title="PS" >Palestine</option>
                    <option value="Portugal" title="PT" >Portugal</option>
                    <option value="Paraguay" title="PY" >Paraguay</option>
                    <option value="Qatar" title="QA" >Qatar</option>
                    <option value="Romania" title="RO" >Romania</option>
                    <option value="Russia" title="RU" >Russia</option>
                    <option value="SaudiArabia" title="SA" >Saudi Arabia</option>
                    <option value="SolomonIs" title="SB" >Solomon Islands</option>
                    <option value="Seychelles" title="SC" >Seychelles</option>
                    <option value="Sudan" title="SD" >Sudan</option>
                    <option value="Sweden" title="SE" >Sweden</option>
                    <option value="Singapore" title="SG" >Singapore</option>
                    <option value="Slovenia" title="SI" >Slovenia</option>
                    <option value="Slovak" title="SK" >Slovak</option>
                    <option value="SierraLeone" title="SL" >Sierra Leone</option>
                    <option value="SanMarino" title="SM" >San Marino</option>
                    <option value="Senegal" title="SN" >Senegal</option>
                    <option value="Somali" title="SO" >Somali</option>
                    <option value="Suriname" title="SR" >Suriname</option>
                    <option value="SaoTomeandPrincipe" title="ST" >Sao Tome and Principe</option>
                    <option value="Syria" title="SY" >Syria</option>
                    <option value="Swaziland" title="SZ" >Swaziland</option>
                    <option value="Chad" title="TD" >Chad</option>
                    <option value="Togo" title="TG" >Togo</option>
                    <option value="Thailand" title="TH" >Thailand</option>
                    <option value="Tajikistan" title="TJ" >Tajikistan</option>
                    <option value="Turkmenistan" title="TM" >Turkmenistan</option>
                    <option value="Tunisia" title="TN" >Tunisia</option>
                    <option value="Tonga" title="TO" >Tonga</option>
                    <option value="Turkey" title="TR" >Turkey</option>
                    <option value="TrinidadandTobago" title="TT" >Trinidad and Tobago</option>
                    <option value="Tuvalu" title="TV" >Tuvalu</option>
                    <option value="Taiwan" title="TW" >Taiwan</option>
                    <option value="Tanzania" title="TZ" >Tanzania</option>
                    <option value="Ukraine title="UA" >Ukraine</option>
                    <option value="Uganda" title="UG" >Uganda</option>
                    <option value="Uruguay" title="UY" >Uruguay</option>
                    <option value="Uzbekistan" title="UZ" >Uzbekistan</option>
                    <option value="SaintVincent" title="VC" >Saint Vincent</option>
                    <option value="Venezuela" title="VE" >Venezuela</option>
                    <option value="BritishVirginIslands" title="VG" >British Virgin Islands</option>
                    <option value="Vietnam" title="VN" >Vietnam</option>
                    <option value="Vanuatu" title="VU" >Vanuatu</option>
                    <option value="WallisandFutuna" title="WF" >Wallis and Futuna</option>
                    <option value="WesternSamoa" title="WS" >Western Samoa</option>
                    <option value="Yemen" title="YE" >Yemen</option>
                    <option value="SouthAfrica" title="ZA" >South Africa</option>
                    <option value="Zambia" title="ZM" >Zambia</option>
                    <option value="Zimbabwe" title="ZW" >Zimbabwe</option>
                </select>
            </div>
<!--            登录密码-->
            <div class="login1">
                <label class="nub-2"><?php echo Yii::t('app','登录密码');?></label><br class="hhh">
                <input type="password" id="password" name="password" placeholder="<?php echo Yii::t('app','输入长度为6-20位的密码');?>">
            </div>
<!--            确认密码-->
            <div class="login1">
                <label class="nub-2"><?php echo Yii::t('app','确认密码');?></label><br class="hhh">
                <input type="password" name="repassword" required="" id="repassword" placeholder="<?php echo Yii::t('app','请确认密码');?>">
            </div>
<!--            支付密码-->
            <div class="login1">
                <label class="nub-2"><?php echo Yii::t('app','支付密码');?></label><br class="hhh">
                <input type="password" placeholder="<?php echo Yii::t('app','输入6位数字支付密码');?>"  name="traspass" required="" id="traspass">
            </div>
<!--            邀请码-->
            <div class="login1" style="<?php echo $invite_code == '' ? '' : 'display:none;'; ?>">
                <label class="nub-2"><?php echo Yii::t('app','邀请码');?></label><br class="hhh">
                <input type="text" id="invite_code" name="invite_code" value="<?php echo $invite_code; ?>" placeholder="<?php echo Yii::t('app','请输入邀请码');?>" required="">
            </div>

<!--            确定按钮-->
            <div  align="center">
                <button type="button" class="am-btn am-btn-secondary am-radius btn-regist"style="background-color: #1e88e5;width:100%;border-radius:5px;line-height:28px;color:#fff;background-color:##1e88e5;outline: none;border-bottom: 0px;border-top: 0px;border-left: 0px;border-right: 0px;">
                    <?php echo Yii::t('app','确定');?>
                </button>
            </div>
            <div class="tongyi-1">
                <a id="download" href="https://fir.im/8gej"><?php echo Yii::t('app','我已有账号，直接下载APP');?></a>
            </div>
        </form>


    </div>

    <!--[if lt IE 9]>-->
    <script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
    <script src="/js/amazeui.ie8polyfill.min.js"></script>
    <!--<![endif]-->
    <!--[if (gte IE 9)|!(IE)]><!-->
    <script src="/js/jquery.min.js"></script>

    <!--<![endif]-->
    <script src="/js/amazeui.min.js"></script>
    <script src="/js/select_gj.min.js"></script>
    <script src="/js/select2_1.js"></script>
    <?php $this->endBody(); ?>
    <script>
        $(function(){
            if($("#username").attr("placeholder") == "Enter the Username"){
                $(".hhh").css("display","block");
                $(".hhh").parent().css("height","auto");
                $(".hhh").prev().css("lineHeight","30px").css("width","50%");
                $("#btn").css("marginTop","0");
                $("#code").css("width","57%");
            }
        });

        //语言选择
        function myFunction(obj) {
            var a = $(obj).val();
            var url = location.href;
            var arr = url.split("&");
            var src = arr[0];
            var aaa = src + "&lang=" + a;
            var checkValue = $("#aah").val();
            location.href = aaa;
        }

        //验证注册信息
        $(".btn-regist").click(function(){
            var  invite_code = $("#invite_code").val(),
                username = $("#username").val(),
                password = $("#password").val(),
                repassword = $("#repassword").val(),
                traspass = $("#traspass").val(),
                code = $("#code").val(),
                country = $('#country option:selected').val();
            if (!username) {
                alert("<?php echo Yii::t('app','用户名不能为空');?>");
                return false;
            }
            if (!invite_code) {
                alert("<?php echo Yii::t('app','邀请码不能为空');?>");
                return false;
            }
            var regpwd = /^[0-9A-Za-z]{6,20}$/;
            if (!regpwd.test(password)) {
                alert("<?php echo Yii::t('app','密码长度6-20位');?>");
                return false;
            }
            if (!(repassword == password)) {
                alert("<?php echo Yii::t('app','两次输入的密码不一致');?>");
                return false;
            }
            var tras = /^[0-9]{6}$/;
            if (!tras.test(traspass)) {
                alert('<?php echo Yii::t('app','输入6位数字支付密码');?>');
                return false;
            }

            if (!code){
                alert("<?php echo Yii::t('app','验证码不能为空');?>");
                return false;
            }
            $(".btn-regist").prop("disabled",true);
            $.ajax({
                type: "post",
                data: {username:username, invite_code:invite_code, password: password, repassword: repassword, traspass:traspass,code:code,country:country},
                dataType: "json",
                url: "/site/register.html",
                success: function (data) {
                    if (data.status === true) {
                        alert(data.message);
                        location.href = data.url;
                    } else {
                        alert(data.message);
                    }
                    $(".btn-regist").prop("disabled",false);
                }
            });
        });

        //发送验证码
        $(".sendcode").on("click", function () {
            $(this).button("loading").delay(1000).queue(function () {
                var $btn = $(this),
                    username = $("#username").val();
                    // phone = $("#phone").val(),
                    // quhao=$("#quhao option:selected").text(),
                    // strphone=quhao+""+phone;
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
                        // if(quhao == "86"){
                        //     if (!(/^0?1[3|4|5|6|7|8|9][0-9]\d{8}$/).test(phone)) {
                        //         alert("请输入正确的手机号码");
                        //         $btn.button('reset');
                        //         $btn.dequeue();
                        //         return false;
                        //     }
                        // }else{
                        //     if(!(/^\d{6,}$/).test(phone)){
                        //         alert("请输入正确的手机号码");
                        //         $btn.button('reset');
                        //         $btn.dequeue();
                        //         return false;
                        //     }
                        // }
                        if(!( /^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/).test(username)){
                            alert("<?php echo Yii::t('app','请输入正确的邮箱');?>");
                                    $btn.button('reset');
                                    $btn.dequeue();
                                    return false;
                        }
                        $.ajax({
                            type: "post",
                            data: {username: username},
                            dataType: "json",
                            url: "/site/emailsendmsg.html",
                            success: function (data) {
                                if (data.status === true) {
                                    alert("<?php echo Yii::t('app','验证码已发送到您的邮箱，请注意查收');?>");
                                    $btn.text(that.nums + 's');
                                    that.clock = setInterval(doLoop, 1000);
                                } else {
                                    alert(data.message);
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
<?php $this->endPage() ?>

</html>