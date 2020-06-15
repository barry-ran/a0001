<?php
if(!defined('IN_ROOT'))
{
	exit('Access denied');
}
echo '';
if(!$GLOBALS['userlogined'])
{
	exit(header('location:'.IN_PATH.'user/login'));
}
echo '';
$ios = $GLOBALS['db']->num_rows($GLOBALS['db']->query("select count(*) from ".tname('app')." where in_form='iOS' and in_uid=".$GLOBALS['erduo_in_userid']));
$android = $GLOBALS['db']->num_rows($GLOBALS['db']->query("select count(*) from ".tname('app')." where in_form='Android' and in_uid=".$GLOBALS['erduo_in_userid']));
$home = explode('/',$_SERVER['PATH_INFO']);
$string = isset($home[2]) ?$home[2] : NULL;
if(empty($string))
{
	$query = $GLOBALS['db']->query("select * from ".tname('app')." where in_uid=".$GLOBALS['erduo_in_userid']." order by in_addtime desc");
}
elseif(is_numeric($string))
{
	$form = $string == 1 ?'iOS': 'Android';
	$query = $GLOBALS['db']->query("select * from ".tname('app')." where in_form='".$form."' and in_uid=".$GLOBALS['erduo_in_userid']." order by in_addtime desc");
}
else
{
	$key = SafeSql(trim(is_utf8($string)));
	$query = $GLOBALS['db']->query("select * from ".tname('app')." where in_name like '%".$key."%' and in_uid=".$GLOBALS['erduo_in_userid']." order by in_addtime desc");
}
echo '<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="x-ua-compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<meta charset="';
echo IN_CHARSET;
echo '">
<title>我的应用 - ';
echo IN_NAME;
echo '</title>
<link href="';
echo IN_PATH;
echo 'static/index/icons.css" rel="stylesheet">
<link href="';
echo IN_PATH;
echo 'static/index/bootstrap.css" rel="stylesheet">
<link href="';
echo IN_PATH;
echo 'static/index/manage.css" rel="stylesheet">
<script type="text/javascript" src="';
echo IN_PATH;
echo 'static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="';
echo IN_PATH;
echo 'static/pack/layer/confirm-lib.js"></script>
<script type="text/javascript" src="';
echo IN_PATH;
echo 'static/index/uploadify.js"></script>
<script type="text/javascript" src="';
echo IN_PATH;
echo 'static/index/profile.js"></script>
<script type="text/javascript" src="';
echo IN_PATH;
echo 'static/index/drop.js"></script>
<script type="text/javascript">
var in_path = \'';
echo IN_PATH;
echo '\';
var in_time = \'';
echo $GLOBALS['erduo_in_userid'].'-'.time();
echo '\';
var in_upw = \'';
echo $GLOBALS['erduo_in_userpassword'];
echo '\';
var in_uid = ';
echo $GLOBALS['erduo_in_userid'];
echo ';
var in_id = 0;
var in_size = ';
echo intval(ini_get('upload_max_filesize'));
echo ';
var remote = {\'open\':\'';
echo IN_REMOTE;
echo '\',\'dir\':\'';
echo IN_REMOTEPK;
echo '\',\'version\':\'';
echo version_compare(PHP_VERSION,'5.5.0');
echo '\'};
layer.use(\'confirm-ext.js\');
        function timer(opj){
            $(opj).find(\'ul\').animate({
                marginTop : "-3.5rem"  
                },500,function(){  
                $(this).css({marginTop : "0.7rem"}).find("li:first").appendTo(this);  
            })  
        }
        $(function(){ 
            var num = $(\'.notice_active\').find(\'li\').length;
            if(num > 1){
               var time=setInterval(\'timer(".notice_active")\',3000);
                $(\'.gg_more a\').mousemove(function(){
                    clearInterval(time);
                }).mouseout(function(){
                    time = setInterval(\'timer(".notice_active")\',3000);
                }); 
            }
            
            $(".news_ck").click(function(){
                location.href = $(".notice_active .notice_active_ch").children(":input").val();
            })
        });
</script>
    <style type="text/css">
      .mypro{
    background:orange;
    
    width:100%;
    height:10px;
    -webkit-appearance: none;
 }
::-ms-fill{
    background:#0FE9E9;
}
::-moz-progress-bar{
    background:#0FE9E9;
 }
::-webkit-progress-bar{
    background:#c6c7c9;
 }
::-webkit-progress-value{
    background:#1abc9c;
 }
/*border-bottom: 1px solid #F0F0F0;*/
        .huadong {width: 100%;height:3.5rem;padding: 0.5rem 0 0.3rem 0; border-bottom: 1px solid #F0F0F0; position:relative;font: 12px/1.5 "Hiragino Sans GB","Microsoft YaHei",simsun;margin:0 auto;}
        .huadong .huabox {  margin:0 auto; width: 100%; line-height: 4rem;}
        .huadong .hdimg {float:left;line-height:3.2rem;}
        .huadong .hdimg img { width: 100%; vertical-align:middle;}
        .huadong h5 {font-size:2rem;float:left; line-height: 2.2rem; margin: 0.6rem 0 0 0; color:black;}
        .huadong .gg_more { float: left;}
        .huadong .gg_more a { font-size: 0.8rem; text-decoration:none;}
        
        .huadong .notice_active {
                float: left;
                width: 88%;
                height: 4rem;
                padding: 0;
                overflow: hidden;
                position: relative;
        }
        .huadong .notice_active li{font-size:6rem;list-style-type:none;line-height: 2.4rem;overflow: hidden;}
        /*.huadong .notice_active li.notice_active_ch {}*/
        .huadong .notice_active li.notice_active_ch span {color:#656972;font-size:1.3rem;display: block;overflow: hidden; width:80%;float: left;overflow: hidden;margin:0 0 2rem 0;}
        .huadong .gg_more .news_ck {
                float: left;
                margin: 0 1rem 0 1rem;
                color: #888;
                width: 5rem;
                height: 2rem;
                line-height: 2rem;
                display: block;
                border: 1px solid #656972;
                text-align: center;
                border-radius: 0.7rem;
                font-size: 0.8rem;
                margin-top: 1rem;
            }
        .huadong .gg_more .news_more {
            
        }
        .huadong .notice_active li.notice_active_ch em {text-align:right;float:right;color:#888;font-size:0.8rem;font-style:normal;  }
    </style>
</head>
<body>
<div class="navbar-wrapper ng-scope">
	<div class="ng-scope">
		<div class="navbar-header-wrap">
			<div class="middle-wrapper">
				<sidebar class="avatar-dropdown">
				<img class="img-circle" src="';
echo getavatar($GLOBALS['erduo_in_userid']);
echo '">
				<div class="name"><span class="ng-binding">';
echo substr($GLOBALS['erduo_in_username'],0,strpos($GLOBALS['erduo_in_username'],'@'));
echo '</span></div>
				<div class="email"><span class="ng-binding">';
echo $GLOBALS['erduo_in_username'];
echo '</span></div>
				<div class="dropdown-menus">
					<ul>
						<li><a href="';
echo IN_PATH.'user/profile_info';
echo '" class="ng-binding">个人资料</a></li>
						<li><a href="';
echo IN_PATH.'user/profile_pwd';
echo '">修改密码</a></li>
						<li><a href="';
echo IN_PATH.'user/profile_verify';
echo '">实名认证</a></li>
						<li><a href="';
echo IN_PATH.'user/logout';
echo '" class="ng-binding">退出</a></li>
					</ul>
				</div>
				</sidebar>
				<nav>
				<h1 class="navbar-title logo"><span onclick="location.href=\'';
echo IN_PATH;
echo '\'">';
echo '零度分发网';
echo '</span></h1>
				<div class="navbar-title primary-title"><a href="';
echo IN_PATH;
echo '" class="ng-binding">首页</a></div>';
echo '<div class="navbar-title primary-title"><a href="';
echo IN_PATH.'user/price';
echo '" class="ng-binding">分发价格</a></div>';
echo '<div class="navbar-title primary-title"><a href="';
echo IN_PATH.'user/price';
echo '" class="ng-binding">签名价格</a></div>';
echo '<div class="navbar-title primary-title"><a href="';
echo IN_PATH.'user/webview';
echo '" class="ng-binding">应用封装</a></div>';				
echo '<div class="navbar-title primary-title"><a href="';
echo IN_PATH.'user/home';
echo '" class="ng-binding">应用管理</a></div>
				</nav>
				</nav>
			</div>
		</div>
		<div class="pop-up-mask apitoken" style="display:none"></div>
		<div class="pop-up-layer ng-scope" style="display:none">
			<div class="apitoken-win ng-scope">
				<h2 class="apitoken-title">已用：';
echo formatsize($GLOBALS['erduo_in_spaceuse']);
echo '</h2>
				<h2 class="apitoken-title">总量：';
echo $GLOBALS['erduo_in_spacetotal'] >0 ?$GLOBALS['erduo_in_spacetotal'] / 1048576 : 0;
echo ' MB ≈ ';
echo formatsize($GLOBALS['erduo_in_spacetotal']);
echo '</h2>
				<div class="apitoken-desc">每 <big style="color:#f87335">MB</big> 扩充需扣除 <big style="color:#f87335">';
echo IN_SPACEPOINTS;
echo '</big> 下载点数</div>
				<div class="apitoken-action"><a class="apitoken-build rounded ng-hide" style="cursor:pointer" onclick="add_space(0, 0)">扩充容量</a></div>
				<i class="icon-cross" onclick="$(\'.pop-up-mask\').hide(),$(\'.pop-up-layer\').hide()"></i>
			</div>
		</div>
	</div>
</div>
<div class="ng-scope" id="dialog-uploadify" style="display:none">
	<div class="upload-modal-mask ng-scope"></div>
	<div class="upload-modal-container ng-scope">
		<div class="flip-container flip">
			<div class="modal-backend plane-ready upload-modal">
				<div class="btn-close" onclick="location.reload()"><i class="icon-cross"></i></div>
				<div class="plane-wrapper">
					<img class="plane" src="';
echo IN_PATH;
echo 'static/index/plane.svg">
					<div class="rotate-container">
						<img class="propeller" src="';
echo IN_PATH;
echo 'static/index/propeller.svg">
					</div>
				</div>
				<div class="progress-container">
					<p class="speed ng-binding" id="speed-uploadify"></p>
					<p class="turbo-upload"></p>
					<div class="progress">
						<div class="growing" style="width:0%"></div>
					</div>
				</div>
				<div class="redirect-tips ng-binding" style="display:none">正在解析应用，请稍等...</div>
			</div>
		</div>
	</div>
</div>
<section class="ng-scope">
<div class="page-apps ng-scope">
	<div class="middle-wrapper">
		<div class="filter-group">
			<div class="filter-set">
				<span class="filter';
if($string == 1)
{
	echo ' active';
}
echo '" onclick="location.href=\'';
echo IN_PATH.'user/home/1';
echo '\'"><i class="icon-apple"></i></span>
				<i class="split"></i>
				<span class="filter';
if($string == 2)
{
	echo ' active';
}
echo '" onclick="location.href=\'';
echo IN_PATH.'user/home/2';
echo '\'"><i class="icon-android"></i></span>
			</div>
			<div class="search-form">
				<i class="icon-search" onclick="s_earch()"></i>
				<input type="text" id="k_eyword" onkeydown="if(event.keyCode==13){s_earch()}" placeholder="输入名称搜索">
			</div>
			<div class="surplus-wrap">
				<div class="surplus">
					<div class="surplus-card">
						<div class="name"><span>剩余下载点数</span></div>
						<div class="value"><span class="ng-binding">';
echo $GLOBALS['erduo_in_points'];
echo '</span></div>
					</div>
					<div class="surplus-card" style="color:#268df7;">
						<div class="name">购买点数包</div>
						<button type="button" onclick="location.href=\'';
echo IN_PATH.'user/cishu';
echo '\'" class="btn action"><i class="icon icon-cart"></i></button>
					</div>
				</div>
			</div>
		</div>
		<div class="row row-apps-top">
			<div class="col-xs-3">
				<a href="';
echo IN_PATH.'user/home/1';
echo '" class="banner-column">
					<div class="font-en">iOS应用</div>
					<div>';
echo $ios;
echo '</div>
				</a>
			</div>
			<div class="col-xs-3">
				<a href="';
echo IN_PATH.'user/home/2';
echo '" class="banner-column">
					<div class="font-en">Android应用</div>
					<div>';
echo $android;
echo '</div>
				</a>
			</div>
			<div class="col-xs-3">
				<a class="banner-column" style="cursor:pointer" onclick="$(\'.pop-up-mask\').show(),$(\'.pop-up-layer\').show()">
					<div class="font-en">已用容量</div>
					<div style="font-weight:bold">';
echo $GLOBALS['erduo_in_spaceuse'] >0 ?round($GLOBALS['erduo_in_spaceuse'] / $GLOBALS['erduo_in_spacetotal'] * 100,2) : 0;
echo '%</div>
				</a>
			</div>
			<div class="col-xs-3">
				<a href="';
echo IN_PATH.'user/profile_verify';
echo '" class="banner-column">
					<div class="font-en">实名认证</div>
					<div style="font-weight:bold">';
echo $GLOBALS['erduo_in_verify'] >0 ?$GLOBALS['erduo_in_verify'] >1 ?'审核中': '已认证': '未认证';
echo '</div>
				</a>
			</div>
		</div>
	

    <div class="huadong">
        <div class="huabox">
        <div class="hdimg"><img src="/statics/img/lingdang.png"></div>
        <h5 style="font-size:20px">【公告】</h5>
            <div class="notice_active">
                <ul style="list-style: none;">
                  <li class=\'notice_active_ch\'><span>严禁上传色情、反动、政治等应用，违反相关法律法规的应用将被封禁，屡次上传者将封禁账号,请严格遵守！</span> </li>
                  <li class=\'notice_active_ch\'><span>免费声明： 因此造成的后果自负。请务必在下载后24小时之内删除！</span> </li>
                  <li class=\'notice_active_ch\'><span>如何去除广告？应用管理 -&gt; 管理 -&gt; 基本信息 -&gt; 去除广告 -&gt; 去除</span> </li>
                  <li class=\'notice_active_ch\'><span>免费声明： 本站只适用于受中华人民共和国法律允许范围内的个人娱乐，研究和学习使用，不得用于商业盈利经营。</span> </li>

              
                </ul>   
        
            </div>
        </div>
    </div> 	
	</div>
	<div class="middle-wrapper container-fluid">
		<div class="apps row">
			<upload-card class="components-upload-card col-xs-4 col-sm-4 col-md-4 app-animator">
			<div class="card text-center">
				<input type="file" id="upload_app" onchange="upload_app()" style="display:none">
				<div class="dashed-space" onclick="$(\'#upload_app\').click()">
					<table><tbody><tr><td>
						<i class="icon-upload-cloud2"></i>
						<div class="text drag-state"><span id="_drop1">拖拽到这里上传</span><span id="_drop2">快松手</span></div><span id="_drop2">{ipa,mobileconfig,apk}</span></div>
						<p style="color:#6e6e6e;width: 80%;margin-left: 42px;">严禁上传色情、反动等非法类app，违反相关法律法规的app将被删除，屡次上传者将被封禁账号，并上报给有关部门</p>
					</td></tr></tbody></table>
				</div>
			</div>
			<div class="upload-guied"';
if(!$ios &&!$android)
{
	echo ' style="display:block"';
}
echo '>
				<span class="ng-scope">在这里上传你的第一个应用</span>
				<img src="';
echo IN_PATH;
echo 'static/index/arrow.png">
			</div>
			</upload-card>
			';
while ($row = $GLOBALS['db']->fetch_array($query)) {
	$class = $row['in_form'] == 'iOS' ? 'icon-apple' : 'icon-android';
	echo '<div class="col-xs-4 col-sm-4 col-md-4 app-animator ng-scope"><div class="card app card-ios">';
	echo '<i class="type-icon ' . $class . '"></i><div class="type-mark"></div>';
	echo '<a class="appicon" href="' . IN_PATH . 'index.php/each_app/' . $row['in_id'] . '"><img class="icon ng-isolate-scope" width="100" height="100" src="' . geticon($row['in_icon']) . '" onerror="this.src=\'' . IN_PATH . 'static/app/' . $row['in_form'] . '.png\'"></a>';
	if ($row['in_kid']) {
		echo '<div class="combo-info ng-scope"><i class="icon-combo"></i><img class="icon ng-isolate-scope" width="45" height="45" src="' . geticon(getfield('app', 'in_icon', 'in_id', $row['in_kid'])) . '" onerror="this.src=\'' . IN_PATH . 'static/app/' . getfield('app', 'in_form', 'in_id', $row['in_kid']) . '.png\'"></div>';
	}
	echo '<br><p class="appname"><i class="icon-owner"></i><span class="ng-binding">' . $row['in_name'] . '</span></p>';
	echo '<table><tbody>';
	if (IN_SIGN && preg_match('/(\\.ipa)$/', $row['in_app'])) {
		echo '<tr><td class="ng-binding">签名期限：</td><td><span class="ng-binding"><a href="' . IN_PATH . 'index.php/sign_app/' . $row['in_id'] . '">' . ($row['in_sign'] ? date('Y-m-d H:i:s', $row['in_sign']) : '未开通') . '</a></span></td></tr>';
	} elseif (preg_match('/(\\.mobileconfig)$/', $row['in_app'])) {
		echo '<tr><td class="ng-binding">描述验证：</td><td><span class="ng-binding">' . (preg_match('/(\\-signed\\.mobileconfig)$/', $row['in_app']) ? '<b style="color:#090">√</b>' : '<b style="color:#C00">ㄨ</b>') . '</span></td></tr>';
	} else {
		echo '<tr><td class="ng-binding">更新时间：</td><td><span class="ng-binding">' . $row['in_addtime'] . '</span></td></tr>';
	}
	echo '<tr><td class="ng-binding">应用平台：</td><td><span class="ng-binding">' . $row['in_form'] . '</span></td></tr>';
	echo '<tr><td class="ng-binding">应用标识：</td><td><span class="ng-binding">' . $row['in_bid'] . '</span></td></tr>';
	echo '<tr><td class="ng-binding">应用大小：</td><td><span class="ng-binding">' . formatsize($row['in_size']) . '</span></td></tr>';
	echo '<tr><td class="ng-binding">最新版本：</td><td><span class="ng-binding">'.$row['in_bsvs'].'（Build '.$row['in_bvs'].'）</span></td></tr>';
    echo '<tr><td class="ng-binding">下载次数：</td><td class="ng-binding">累计下载 ';
    echo $row['in_hits'];
	echo '</tbody></table>';
	echo '<div class="action"><a class="ng-binding" href="' . IN_PATH . 'index.php/profile_app/' . $row['in_id'] . '"><i class="icon-pen"></i> 管理</a><a href="' . getlink($row['in_id']) . '" target="_blank" class="ng-binding"><i class="icon-eye"></i> 预览</a><button class="btn btn-remove ng-scope" onclick="del_app(' . $row['in_id'] . ', 1)" title="删除应用"><i class="icon icon-trash"></i></button></div>';
	echo '</div></div>';
}
echo '		</div>
	</div>
</div>
</section>
';
if (IN_VERIFY > 0 && $GLOBALS['erduo_in_verify'] < 1) {
	echo '<div class="alert-bar">
	<div class="action close_bar" onclick="$(\'.alert-bar\').hide()"></div>
	<div class="inner"><p class="ng-binding">应上级要求，未实名认证用户无法上传应用<a href="';
	echo IN_PATH.'user/profile_verify';
	echo '" class="btn btn-lemon" style="margin-left:20px">马上认证</a></p></div>
</div>';
}
echo '';
include 'source/index/bottom.php';
echo '</body>
</html>';
?>
  <!--底部-->
</script>

 

 <div class="side-contact fontyh hidden-xs" id="side-go-top" style="display: block;">
<div class="qq-item"> <i>&nbsp;</i> <span>QQ咨询</span>
  <p style="display: none;"><em></em> 
  <a href="http://wpa.qq.com/msgrd?v=3&uin=1787601777&site=qq&menu=yes" target="_blank">分发咨询</a> 
  <a href="http://wpa.qq.com/msgrd?v=3&uin=1787601777&site=qq&menu=yes" target="_blank">签名咨询</a> 
  <a href="http://wpa.qq.com/msgrd?v=3&uin=1787601777&site=qq&menu=yes">授权咨询</a> 
</div>
<div class="weixin-item"> <a target="_blank" href="mailto:1787601777@qq.com"><i>&nbsp;</i> <span>发送邮件</span></a>
</div>
<div class="phone-item"> <i>&nbsp;</i> <span>在线时间</span>
  <p style="height: 170px !important; display: none;"><em></em>节假日无休<br><strong>平台24小时运行</strong><br>
    客服在线时间<br>（上午9:00-下午23:30）<br>其他事宜可发送邮件<br></p>
</div>
<div class="gotop-item"> <i>&nbsp;</i> <span>返回顶部</span> </div>
</div>



<style>

/*客服*/
.side-contact{position:fixed;right:10px;bottom:126px;display:none;width:70px;height:260px;z-index:200;border-radius:8px;box-shadow:0 1px 3px rgba(0,0,0,0.3);background:#f2f2f2;text-align:center}
.side-contact span,.side-contact i{display:block}
.side-contact span{font-size:12px;color:#666}
.side-contact div:hover span{color:#17a1e6}
.side-contact i{width:35px;height:32px;margin:0 auto}
.side-contact p{position:absolute;left:0;top:0;display:none;background:#17a1e6;color:#FFF;font-size:14px}
.side-contact p strong{font-size:22px;font-weight:normal}
.side-contact p em{position:absolute;right:-11px;display:block;width:11px;height:11px;background:url(static/images/icon_tips_arrow.png) no-repeat 0 0}
.side-contact .qq-item{width:100%;height:59px;padding-top:10px;border-bottom:1px solid #f2f2f2;border-radius:8px 8px 0 0;background:#FFF;cursor:pointer}
.side-contact .qq-item i{background:url(static/images/icon_contact.png) no-repeat 0 0}
.side-contact .qq-item i{background:url(static/images/icon_contact.png) no-repeat -32px 0}
.side-contact .qq-item p{left:-140px;top:0px;width:140px;padding:5px 0;border-radius:8px}
.side-contact .qq-item p em{top:30px}
.side-contact .qq-item p a{color:#fff;float:left;border-bottom:#3AABE4 solid 1px;margin:0 20px;width:100px;font-size:14px;padding:12px 0 0 30px;height:52px;text-align:left;background:url(static/images/qq.png) no-repeat;background-position:0 10px;}
.side-contact .qq-item p a:hover{color:#F1F6F9;text-decoration:none;}
.side-contact .phone-item{width:100%;height:59px;padding-top:10px;border-bottom:1px solid #f2f2f2;background:#FFF;cursor:default}
.side-contact .phone-item i{background:url(static/images/icon_contact.png) no-repeat 2px -32px}
.side-contact .phone-item i{background:url(static/images/icon_contact.png) no-repeat -30px -32px}
.side-contact .phone-item p{left:-180px;top:70px;width:170px;height:70px;line-height:22px;padding-top:12px;border-radius:8px}
.side-contact .phone-item p em{top:30px}
.side-contact .weixin-item{width:100%;height:59px;padding-top:10px;background:#FFF;cursor:default}
.side-contact .weixin-item i{background:url(static/images/icon_contact.png) no-repeat 2px -64px}
.side-contact .weixin-item i{background:url(static/images/icon_contact.png) no-repeat -30px -64px}
.side-contact .weixin-item p{left:-130px;top:98px;width:120px;height:140px;line-height:22px;padding-top:11px;font-size:14px;border-radius:8px}
.side-contact .weixin-item p img{width:90px;height:90px;margin-top:10px}
.side-contact .weixin-item p em{top:72px}
.side-contact .gotop-item{width:100%;padding-top:10px;cursor:pointer}
.side-contact .gotop-item i{width:16px;height:16px}
.side-contact .gotop-item i{background:url(static/images/icon_top_arrow.png) no-repeat 0 0}
.side-contact .gotop-item:hover i{background:url(static/images/icon_top_arrow.png) no-repeat -18px 0}
.side-contact .gotop-item span{padding:3px 0 0 0;color:#999}

</style>

<script type="text/javascript">
//侧边栏联系我们
if ($(window).scrollTop()>=0){
    $("#side-go-top").fadeIn(500);
}
$("#side-go-top .gotop-item").click(function(){
    $('body,html').animate({scrollTop:0},300);
    return false;
});
$(window).scroll(function(){
    if ($(window).scrollTop()>=0)
    {
        $("#side-go-top").fadeIn(500);
    }
    else
    {
        $("#side-go-top").fadeOut(500);
    }
});
//侧边栏效果
$('.side-contact .qq-item,.side-contact .phone-item,.side-contact .weixin-item').hover(function(){
    $(this).find('p').show();
},function(){
    $(this).find('p').hide();
});
//输入过滤
document.getElementById("keyword").onkeypress = function(e){
    checkChar(e);
}
document.getElementById("textarea1").onkeypress = function(e){
    checkChar(e);
}
 
function checkChar(e){
    e = window.event || e;
    var code = e.keyCode || e.which;
    var reg = /[\\\/:\*\?"\<\>\|]/;// 禁止 \/:*?"<>|
    if(reg.test(String.fromCharCode(code))){
        if(window.event){
            e.returnValue = false;
        }else{
            e.preventDefault();
        }
    }
}
</script>

<!-- WPA start -->
<script id="qd2852163887046fc016031a342a43c9ea2327c62607" src="static/js/23f144c2314141e8850c185f5bd6fa9c.js" charset="utf-8" async defer></script>
<!-- WPA end -->
</body>
</html>