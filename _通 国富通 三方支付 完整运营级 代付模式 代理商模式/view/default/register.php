<?php if(!defined( 'WY_ROOT'))exit; ?>
    <!doctype html>
    <html>
        
        <head>
            <meta http-equiv="content-type" content="text/html;charset=utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width,initial-scale=1">
            <title>
                <?php echo isset($title) ? $title. ' _ ' : '' ?>
                    <?php echo $this->config['sitename']?>
                        <?php echo $this->config['siteinfo'] ? ' _ '.$this->config['siteinfo'] : ''?>
            </title>
            <meta name="description" content="<?php echo $this->config['description']?>">
            <meta name="keywords" content="<?php echo $this->config['keyword']?>">
            <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
            <link href="/static/common/bootstrap.min.css" type="text/css" rel="stylesheet">
            <script src="/static/common/jquery-1.12.1.min.js" type="text/javascript">
            </script>
            <script src="/static/common/bootstrap.min.js" type="text/javascript">
            </script>
            <script src="/static/default/app.js" type="text/javascript">
            </script>
            <style>
                html,body,h1,h2,h3,h4,h5,h5,ul,dl,ol,div,span{margin:0;padding:0;}body{font-family:
                'Microsoft Yahei',微软雅黑}ul,ol{list-style: none;overflow: hidden}a, a:hover{text-decoration:
                none}a:focus{outline: none}img{border:none}.hide{display: none}.woody-prompt{display:none}body{background:
                #fafafa}#login{margin-top:100px}.box{border:1px solid #ddd;padding:1px;border-radius:
                3px;background: #fff}.box .title{background-color:#eee;line-height: 40px;padding-left:20px;font-size:
                1.2em;border-bottom: 1px solid #ddd}.box .content{padding:50px 40px 20px
                40px;}.logo{margin:20px}.btip{padding:20px 35px;border-top: 1px dotted
                #ddd;font-size: 0.9em;color:#6B6D6E;}.btip dl dd{line-height: 22px}.btip
                .arrow{position: absolute;margin-top:-28px;width:10px;margin-left:36.999999%}.ltip{text-align:center;margin:20px
                auto}.ltip a{color:#6B6D6E}.ltip a:hover{color:#337AB7}@media screen and
                (max-width:740px){#login{margin-top:30px}}
            </style>
        </head>
        
        <body>
            <div style="position:absolute;left:45%;top:0">
                <div class="woody-prompt">
                    <div class="prompt-error alert alert-danger">
                    </div>
                </div>
            </div>
            <div id="login">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <div class="logo text-center">
                                <a href="/">
                                    <img src="/static/default/images/logo.png">
                                </a>
                            </div>
                            <div class="box">
                                <div class="title">
                                    用户注册
                                </div>
                                <div class="content">
                                    <form class="form-ajax" action="/register/save" method="post">
                                        <input type="hidden" name="id" value="<?php echo $superid ?>">
                                        <div class="form-group">
                                            <input type="text" name="email" class="form-control" placeholder="邮箱账号"
                                            maxlength="50" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="chkcode" class="form-control" placeholder="验证码"
                                            maxlength="5" required>
                                            <div style="background:#fff;border:1px solid #e5e5e5;border-top:0;padding:5px 0;border-radius:3px;text-align:center">
                                                <img src="/chkcode" onclick="javascript:this.src=this.src+'?t=new Date().getTime()'"
                                                class="imgcode" style="cursor:pointer;">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">
                                                立即注册
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="btip">
                                    <div class="arrow">
                                        <span class="glyphicon glyphicon-info-sign">
                                        </span>
                                    </div>
                                    <dl>
									<dd>
                                            1.&nbsp;如果收不到邮件，请看一下是否被邮箱屏蔽,请打开邮箱垃圾箱看一下！。
                                        </dd>
                                        <dd>
                                            1.&nbsp;我们将向您提交的邮箱发送一份确认邮件。
                                        </dd>
                                        <dd>
                                            2.&nbsp;点击邮件中的确认链接，继续完善注册信息。
                                        </dd>
                                        <dd>
                                            3.&nbsp;提交注册信息，等待审核。
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="ltip">
                                <a href="/login">
                                    如果您已有账号，请点此登录
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    
    </html>