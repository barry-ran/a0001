<!doctype html>
<html lang="zh-CN">
    
    <head>
        <meta charset="utf-8">
        <title>
            <?php echo isset($title) ? $title. '-' : '' ?>
                <?php echo $this->config['sitename']?>
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
        <meta name="renderer" content="webkit">

		<link href="/static/common/bootstrap.min.css" type="text/css" rel="stylesheet">
        <link href="/static/common/css/font-awesome.min.css" rel="stylesheet">
        <link href="/static/member/jquery-ui.css" rel="stylesheet">
        <link href="/static/member/style.css" rel="stylesheet">
        <link href="/static/member/amazeui.min.css" rel="stylesheet">
		<link href="/static/common/datetimepicker.min.css" type="text/css" rel="stylesheet">
        <script src="/static/common/jquery-1.12.1.min.js" type="text/javascript">
        </script>
        <script src="/static/common/bootstrap.min.js" type="text/javascript">
        </script>
        <script src="/static/common/jquery.zclip.min.js" type="text/javascript">
        </script>
        <script src="/static/common/datetimepicker.min.js" type="text/javascript">
        </script>
        <script src="/static/member/app.js" type="text/javascript">
        </script>
		
    </head>
    
    <body>
        <style>
        	.perlogo{
				margin-left:50px;
				float:left;
			}
			.navbarxx{
				float:right;
			}
			body{
				background:#E9ECF3;
			}
			ul,li{
				text-decoration:none;
				padding:0;
				margin:0;
				border:0;
				list-style: none;
			}
			.tpl-left-nav-item a:hover{
				border-left: 3px solid #5C9ACF!important;
    			background: #f2f6f9;
    			margin-left: -3px;
    			padding-left: 15px;
				color:#337ab7;
			}
			.tpl-left-nav-item .nav-link.active {
    border-left: 3px solid #5C9ACF!important;
    background: #f2f6f9;
    margin-left: -3px;
    padding-left: 15px;
	color:#337ab7;
}
.tpl-left-nav-item .nav-link {
    display: block;
    position: relative;
    margin: 1px 0 0;
    border: 0;
    padding: 12px 15px;
    padding-top: 6px;
    text-decoration: none;
    color: #485a6a;
    font-size: 14px;
}
a {
    color: #337ab7;
}
a {
    color: #0e90d2;
}
a, ins {
    text-decoration: none;
}
a {
    background-color: transparent;
}
*, :after, :before {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}
user agent stylesheet
a:-webkit-any-link {
    color: -webkit-link;
    text-decoration: underline;
    cursor: auto;
}
.tpl-left-nav-title {
height: 50px;
padding: 25px 15px 10px;
color: #5C9ACF;
font-size: 13px;
font-weight: 600;
}
.am-dropdown a{
color: #999;
}
        </style>
        <?php $current=isset($this->action[1]) ? $this->action[1] : '';?>
        <div id="wrapper">
        	 <div class="">
                    <nav class=" navbar-static-top white-bg" role="navigation" style=" height:70px;">
                       	<div class="perlogo">
                        	<div style="width:100%; height:10px;"></div>
                       		<a href="#"><img src="/static/member/images/logo.png" height="40px"/></a>
                       	</div>
                        <div class="navbarxx">
                        <div style="width:100%; height:20px;"></div>
                        <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list tpl-header-list">
                <li class="am-dropdown" data-am-dropdown="" data-am-dropdown-toggle="">
                    <a class="am-dropdown-toggle tpl-header-list-link" href="/member">
                         控制台 
                    </a>
                </li>
                <li class="am-dropdown" data-am-dropdown="" data-am-dropdown-toggle="">
                    <a class="am-dropdown-toggle tpl-header-list-link" href="/member/takecash">
                        <span class="am-icon-bell-o"></span> 提现 
                    </a>
                    
                </li>
                <li class="am-dropdown" data-am-dropdown="" data-am-dropdown-toggle="">
                    <a class="am-dropdown-toggle tpl-header-list-link" href="/member/orders">
                        <span class="am-icon-calendar"></span> 订单 
                    </a>
                </li>
                <li class="am-dropdown" data-am-dropdown="" data-am-dropdown-toggle="">
                    <a class="am-dropdown-toggle tpl-header-list-link" href="/member">
                        <span class="tpl-header-list-user-nick"><?php echo  $_SESSION[ 'login_username'];?></span>
                    </a>
                </li>
                <li><a href="/login/logout" class="tpl-header-list-link"><span class="am-icon-sign-out tpl-header-list-ico-out-size"></span></a></li>
            </ul>
            </div>
                    </nav>
                </div>
                <div style="width:100%; height:20px; background:#E9ECF3;"></div>
            	<nav class="" role="navigation" style=" border-radius: 6px; width:180px; margin-left:20px; height:540px; float:left; background:#fff;">
                	<div class="sidebar-collapse">
                    	<ul class="tpl-left-nav-menu" style="width:180px;">
                        <li class="tpl-left-nav-title" style="width:180px; margin-bottom:10px">
                        
                            <span>聚合通 列表</span>
                       
                    	</li>
                    <li class="tpl-left-nav-item" style="width:180px;">
                        <a href="/member" <?php echo $current=='' ? ' class="nav-link active"' :'class="nav-link tpl-left-nav-link-list"';?>>
                            <i class="am-icon-home"></i>
                            <span>账户首页</span>
                        </a>
                    </li>
                    <li class="tpl-left-nav-item">
                        <a href="/member/userinfo" <?php echo $current=='userinfo' ? ' class="nav-link active"' :'class="nav-link tpl-left-nav-link-list"';?>>
                            <i class="am-icon-bar-chart"></i>
                            <span>基本资料</span>
                        </a>
                    </li>
					<!--	
                    <li class="tpl-left-nav-item">
                        <a href="/member/truename" <?php echo $current=='truename' ? ' class="nav-link active"' :'class="nav-link tpl-left-nav-link-list"'?>>
                            <i class="am-icon-table"></i>
                            <span>实名认证</span>
                        </a>
                    </li>-->

                    <li class="tpl-left-nav-item">
                        <a href="/member/userpwd" <?php echo $current=='userpwd' ? ' class="nav-link active"' :'class="nav-link tpl-left-nav-link-list"'?>>
                            <i class="am-icon-key"></i>
                            <span>修改密码</span>
                        </a>
                       
                    </li>

                    <li class="tpl-left-nav-item">
                        <a href="/member/payments" <?php echo $current=='payments' ? ' class="nav-link active"' :'class="nav-link tpl-left-nav-link-list"'?>>
                            <i class="am-icon-key"></i>
                            <span>结算记录</span>
                        </a>
                    </li>
                    <li class="tpl-left-nav-item">
                        <a href="/member/orders" <?php echo $current=='orders' ? ' class="nav-link active"' :'class="nav-link tpl-left-nav-link-list"'?>>
                            <i class="am-icon-key"></i>
                            <span>交易记录</span>
                        </a>
                    </li>
                    <li class="tpl-left-nav-item">
                        <a href="/member/count" <?php echo $current=='count' ? ' class="nav-link active"' :'class="nav-link tpl-left-nav-link-list"'?>>
                            <i class="am-icon-key"></i>
                            <span>收益统计</span>
                        </a>
                    </li>
                    <li class="tpl-left-nav-item">
                        <a href="/member/ordersca" <?php echo $current=='ordersca' ? ' class="nav-link active"' :'class="nav-link tpl-left-nav-link-list"'?>>
                            <i class="am-icon-key"></i>
                            <span>通道统计</span>
                        </a>
                    </li>
                    <li class="tpl-left-nav-item">
                        <a href="/member/takecash" <?php echo $current=='takecash' ? ' class="nav-link active"' :'class="nav-link tpl-left-nav-link-list"'?>>
                            <i class="am-icon-key"></i>
                            <span>申请提现</span>
                        </a>
                    </li>
                    <li class="tpl-left-nav-item">
                        <a href="/member/rates" <?php echo $current=='rates' ? ' class="nav-link active"' :'class="nav-link tpl-left-nav-link-list"'?>>
                            <i class="am-icon-key"></i>
                            <span>我的费率</span>
                        </a>
                    </li>
                    <li class="tpl-left-nav-item">
                        <a href="/member/api" <?php echo $current=='api' ? ' class="nav-link active"' :'class="nav-link tpl-left-nav-link-list"'?>>
                            <i class="am-icon-key"></i>
                            <span>接入信息</span>
                        </a>
                    </li>
                    <li class="tpl-left-nav-item">
                        <a href="/member/userlogs" <?php echo $current=='userlogs' ? ' class="nav-link active"' :'class="nav-link tpl-left-nav-link-list"'?>>
                            <i class="am-icon-key"></i>
                            <span>登录日志</span>
                        </a>
                    </li>
                </ul>
                	</div>
            	</nav>
				<div id="page-wrapper" class="gray-bg">
               
				
				
	