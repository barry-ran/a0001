<div  class="Body">
    <div  class="Bdy ng-scope">
        <div class="bdy ng-scope">
            <?php echo $this->render("_linktop"); ?>
            <div class="panel">
                <div  class="panelC">
                    <ul class="list1">
                        <li>
                            <label class="key">VM<?php echo Yii::t('app', '用户名'); ?>：</label><span class="val ng-binding">wudada005a</span>
                            <ul class="opers">
                                <li class="oper">
                                    <a href="javascript:void(0)" class="fuc ng-hide"><span><?php echo Yii::t('app', '修改'); ?></span></a>
                                </li>
                            </ul>
                            <form id="nicknameForm" name="nicknameForm" class="form4 ng-pristine ng-invalid ng-invalid-required ng-hide">
                                <div class="frmCol frmColFull">
                                    <p class="frm txt"><input type="text" name="newName" autocomplete="off"  placeholder="<?php echo Yii::t('app', '新的用户名'); ?>" class="txt large ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required">
                                        <label title="<?php echo Yii::t('app', '新的VM用户名'); ?>"></label><span class="txt-msgs"></span><span class="alert-info ng-hide"><?php echo Yii::t('app', '检查中'); ?>...</span></p>
                                </div>
                                <div class="frmCol frmColFull">
                                    <p class="frm txt"><input type="password" name="login_password" autocomplete="off"  placeholder="<?php echo Yii::t('app', '登录密码'); ?>">" class="txt large ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required"></p>
                                    <label title="<?php echo Yii::t('app', '登录密码'); ?>"></label></div>
                                <div class="frmCol frmColFull frmCol64">
                                    <p class="frm"><button type="submit" class="btn btn_primary" disabled="disabled"><span  class="loading_text"><?php echo Yii::t('app', '提交'); ?></span></button></p>
                                    <p class="frm">
                                        <a href="javascript:void(0)"  class="btn btn_ignored"><?php echo Yii::t('app', '取消'); ?></a>
                                    </p>
                                </div>
                            </form>
                        </li>
                        <li><label class="key"<?php echo Yii::t('app', '钱包地址'); ?>>：</label><span  class="val ng-binding">csRNk75qMxwgk7yxboqcL9UCi7UUFvg2Ya</span></li>
                        <li>
                            <label class="key"><?php echo Yii::t('app', '邮箱'); ?>：</label><i   class="iF iF-ok ng-binding">wu*****a@163.com</i><i   class="iF iF-err ng-binding ng-hide">wu*****a@163.com</i><q  class="q em2 ng-hide">&nbsp;<?php echo Yii::t('app', '未激活'); ?></q>
                            <ul class="opers">
                                <li class="oper"><button  class="btn ng-hide"><?php echo Yii::t('app', '重新发送邮件'); ?><q   class="q ng-binding ng-hide"></q></button></li>
                            </ul>
                            <!--<div  class="hint dark ng-hide"><em>说明</em>
                                    <p class="ng-binding">我们已经给 wu*****a@163.com 发送了邮件。请点击邮件中的链接以完成注册。如果长时间（5-10分钟）没有收到邮件，请点击下方的重发按钮重新发送邮件。并且请检查垃圾邮件列表，某些情况邮件可能被当做垃圾邮件处理了。</p>
                            </div>-->
                        </li>
                        <li><label class="key"><?php echo Yii::t('app', '手机'); ?></label><span class="status"><span  class="statustxt no"><i class="iF iF-close"></i><?php echo Yii::t('app', '没有绑定手机'); ?></span><span   class="statustxt ok ng-binding ng-hide"></span></span>
                            <ul class="opers">
                                <li class="oper">
                                    <a href="javascript:void(0)" class="fuc">
                                        <span class="ng-scope"><?php echo Yii::t('app', '绑定'); ?></span>
                                    </a>
                                </li>
                            </ul>
                            <div class="ng-isolate-scope">
                                <!-- ngIf: apiErr -->
                                <form id="mobileForm" name="mobileForm" class="form form4 white ng-pristine ng-invalid ng-invalid-required ng-valid-maxlength ng-valid-pattern ng-hide"><input type="password" autocomplete="off" class="noDis">
                                    <div class="frmCol frmColFull">
                                        <p class="frm txt frm_icon icon_pwd"><input type="password" required="required" name="paypwd" autocomplete="off"  placeholder="<?php echo Yii::t('app', '交易密码'); ?>" class="txt ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required"><label title="<?php echo Yii::t('app', '交易密码'); ?>"></label></p>
                                    </div>
                                    <!-- ngIf: user.mobile -->
                                    <div  class="frmCol frmColFull frmCol55">
                                        <p class="frm txt frm_icon icon_captcha"><input type="text" required="required" name="captchaCode" autocomplete="off" maxlength="4"  placeholder="<?php echo Yii::t('app', '图形验证码'); ?>" class="txt ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-maxlength"><label title="<?php echo Yii::t('app', '图形验证码'); ?>"></label></p>
                                        <p  class="frm"><img ng-src="/api/code/random?1517383411155" class="captcha" src="/api/code/random?1517383411155"></p>
                                    </div>
                                    <div  class="frmCol frmColFull frmCol55">
                                        <p class="frm sel sel1">
                                            <select  name="selcountry"  placeholder="<?php echo Yii::t('app', '国家区号'); ?>" class="ng-pristine ng-untouched ng-valid ng-not-empty">
                                                <option label="(+1) <?php echo Yii::t('app', '美国'); ?>" value="string:1">(+1)<?php echo Yii::t('app', '美国'); ?> </option>
                                                <option label="(+86) <?php echo Yii::t('app', '中国'); ?>" value="string:86" selected="selected">(+86) <?php echo Yii::t('app', '中国'); ?></option>
                                                <option label="(+55) <?php echo Yii::t('app', '巴西'); ?>" value="string:55">(+55) <?php echo Yii::t('app', '巴西'); ?></option>
                                                <option label="(+1) <?php echo Yii::t('app', '加拿大'); ?>" value="string:1">(+1) <?php echo Yii::t('app', '加拿大'); ?></option>
                                                <option label="(+33)  <?php echo Yii::t('app', '法国'); ?>" value="string:33">(+33) <?php echo Yii::t('app', '法国'); ?></option>
                                                <option label="(+49)  <?php echo Yii::t('app', '德国'); ?>" value="string:49">(+49) <?php echo Yii::t('app', '德国'); ?></option>
                                                <option label="(+852) <?php echo Yii::t('app', '香港'); ?>" value="string:852">(+852) <?php echo Yii::t('app', '香港'); ?></option>
                                                <option label="(+91) <?php echo Yii::t('app', '印度'); ?>" value="string:91">(+91) <?php echo Yii::t('app', '印度'); ?></option>
                                                <option label="(+972)  <?php echo Yii::t('app', '以色列'); ?>" value="string:972">(+972) <?php echo Yii::t('app', '以色列'); ?></option>
                                                <option label="(+39) <?php echo Yii::t('app', '意大利'); ?>" value="string:39">(+39) <?php echo Yii::t('app', '意大利'); ?></option>
                                                <option label="(+81) <?php echo Yii::t('app', '日本'); ?>" value="string:81">(+81) <?php echo Yii::t('app', '日本'); ?></option>
                                                <option label="(+82) <?php echo Yii::t('app', '韩国'); ?>" value="string:82">(+82) <?php echo Yii::t('app', '韩国'); ?></option>
                                                <option label="(+853) <?php echo Yii::t('app', '澳门'); ?>" value="string:853">(+853) <?php echo Yii::t('app', '澳门'); ?></option>
                                                <option label="(+63) <?php echo Yii::t('app', '菲律宾'); ?>" value="string:63">(+63) <?php echo Yii::t('app', '菲律宾'); ?></option>
                                                <option label="(+92) <?php echo Yii::t('app', '巴基斯坦'); ?>" value="string:92">(+92) <?php echo Yii::t('app', '巴基斯坦'); ?></option>
                                                <option label="(+7) <?php echo Yii::t('app', '俄罗斯'); ?>" value="string:7">(+7) <?php echo Yii::t('app', '俄罗斯'); ?></option>
                                                <option label="(+65) <?php echo Yii::t('app', '新加坡'); ?>" value="string:65">(+65) <?php echo Yii::t('app', '新加坡'); ?></option>
                                                <option label="(+27) <?php echo Yii::t('app', '南非'); ?>" value="string:27">(+27) <?php echo Yii::t('app', '南非'); ?></option>
                                                <option label="(+34) <?php echo Yii::t('app', '西班牙'); ?>" value="string:34">(+34) <?php echo Yii::t('app', '西班牙'); ?></option>
                                                <option label="(+886) <?php echo Yii::t('app', '台湾'); ?>" value="string:886">(+886) <?php echo Yii::t('app', '台湾'); ?></option>
                                                <option label="(+44) <?php echo Yii::t('app', '英国'); ?>" value="string:44">(+44) <?php echo Yii::t('app', '英国'); ?></option>
                                                <option label="(+60) <?php echo Yii::t('app', '马来西亚'); ?>" value="string:60">(+60) <?php echo Yii::t('app', '马来西亚'); ?></option>
                                            </select><label title="<?php echo Yii::t('app', '国家区号'); ?>"></label><span class="txt-msgs active"><span class="txt-msg info"><?php echo Yii::t('app', '国家区号'); ?></span></span>
                                        </p>
                                        <p  class="frm txt"><input type="text" required="required" name="phonenum" autocomplete="off"  placeholder="<?php echo Yii::t('app', '新手机号'); ?>" class="txt large ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-pattern"><label title="<?php echo Yii::t('app', '新手机号'); ?>"></label></p>
                                    </div>
                                    <div  class="frmCol frmColFull ng-hide">
                                        <p class="frm txt frm_icon icon_mobi"><input type="text" required="required" name="phonenum" autocomplete="off"  placeholder="<?php echo Yii::t('app', '新手机号'); ?>" class="txt large ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-pattern"><label title="<?php echo Yii::t('app', '新手机号'); ?>"></label></p>
                                    </div>
                                    <div  class="frmCol frmColFull frmCol55">
                                        <p class="frm txt frm_icon icon_dynm"><input id="verifyCode" type="text" required="required" name="vcode" autocomplete="off" maxlength="6"  placeholder="<?php echo Yii::t('app', '新手机验证码'); ?>" class="txt ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-maxlength"><label title="<?php echo Yii::t('app', '新手机验证码'); ?>"></label></p>
                                        <p class="frm btns2r"><button type="button" class="btn btn-vcode btn_minor" disabled="disabled"><span ><?php echo Yii::t('app', '获取动态密码'); ?></span><span  class="ng-hide"><?php echo Yii::t('app', '获取中'); ?>...</span><span  class="ng-binding ng-hide"> <?php echo Yii::t('app', '秒后重试'); ?></span><q   class="q ng-binding ng-hide"></q></button></p>
                                    </div>
                                    <div  class="frmCol frmColFull frmCol55">
                                        <p class="frm"><button type="submit" class="btn btn_primary" disabled="disabled"><?php echo Yii::t('app', '提交'); ?></button></p>
                                        <p class="frm frm-cancel"><button  class="btn btn_ignored"><?php echo Yii::t('app', '取消'); ?></button></p>
                                    </div>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!--<div class="flex-foo"></div>-->
        </div>
    </div>
</div>