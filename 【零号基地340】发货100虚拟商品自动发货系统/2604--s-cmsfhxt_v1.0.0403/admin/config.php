<?php
require '../conn/conn.php';
require '../conn/function.php';
require 'admin_check.php';

$action=$_GET["action"];
if($action=="creat"){
	$sub=splitx($_SERVER["PHP_SELF"],"/admin",0);
	$callback=getbody("http://fahuo100.cn/api/index.php?action=creatapp&sub=$sub&domain=".$_SERVER["HTTP_HOST"],"data=".base64_encode(json_encode($H_data)));
	die($callback);
}

if($action=="save"){

	$C_title=$_POST["C_title"];
	$C_keyword=$_POST["C_keyword"];
	$C_description=$_POST["C_description"];
	$C_logo=$_POST["C_logo"];
	$C_ico=$_POST["C_ico"];
	$C_code=$_POST["C_code"];
	$C_copyright=$_POST["C_copyright"];

	$C_alipay_pid=$_POST["C_alipay_pid"];
	$C_alipay_pkey=$_POST["C_alipay_pkey"];
	$C_7pay_pid=$_POST["C_7pay_pid"];
	$C_7pay_pkey=$_POST["C_7pay_pkey"];
	$C_codepay_id=$_POST["C_codepay_id"];
	$C_codepay_key=$_POST["C_codepay_key"];
	$C_wx_appid=$_POST["C_wx_appid"];
	$C_wx_appsecret=$_POST["C_wx_appsecret"];
	$C_wx_mchid=$_POST["C_wx_mchid"];
	$C_wx_key=$_POST["C_wx_key"];
	$C_qqid=$_POST["C_qqid"];
	$C_qqkey=$_POST["C_qqkey"];

	$C_alicode=$_POST["C_alicode"];
	$C_wxcode=$_POST["C_wxcode"];

	$C_wxapp_id=$_POST["C_wxapp_id"];
	$C_wxapp_key=$_POST["C_wxapp_key"];
	$C_aliapp_id=$_POST["C_aliapp_id"];
	$C_aliapp_key=$_POST["C_aliapp_key"];
	$C_aliapp_key2=$_POST["C_aliapp_key2"];
	$C_bdapp_id=$_POST["C_bdapp_id"];
	$C_bdapp_key=$_POST["C_bdapp_key"];
	$C_bdapp_key2=$_POST["C_bdapp_key2"];
	$C_qqapp_id=$_POST["C_qqapp_id"];
	$C_qqapp_key=$_POST["C_qqapp_key"];
	$C_zjapp_id=$_POST["C_zjapp_id"];
	$C_zjapp_key=$_POST["C_zjapp_key"];

	$C_appt=$_POST["C_appt"];

	$C_alipayon=intval($_POST["C_alipayon"]);
	$C_wxpayon=intval($_POST["C_wxpayon"]);
	$C_7payon=intval($_POST["C_7payon"]);
	$C_codepayon=intval($_POST["C_codepayon"]);
	$C_alicodeon=intval($_POST["C_alicodeon"]);
	$C_wxcodeon=intval($_POST["C_wxcodeon"]);
	$C_qqon=intval($_POST["C_qqon"]);
	$C_wxon=intval($_POST["C_wxon"]);

	$C_rzon=intval($_POST["C_rzon"]);
	$C_fee=intval($_POST["C_fee"]);
	$C_rzfee=round($_POST["C_rzfee"],2);
	$C_rzfeetype=intval($_POST["C_rzfeetype"]);
	$C_zd=round($_POST["C_zd"],2);

	$C_beian=$_POST["C_beian"];
    $C_qrcode=$_POST["C_qrcode"];
    $C_email=$_POST["C_email"];
    $C_phone=$_POST["C_phone"];

    $C_mailtype=$_POST["C_mailtype"];
    $C_mailcode=$_POST["C_mailcode"];
    $C_smtp=$_POST["C_smtp"];

    $C_fx1=$_POST["C_fx1"];
    $C_fx2=$_POST["C_fx2"];
    $C_fx3=$_POST["C_fx3"];

    $C_memberon=$_POST["C_memberon"];

    $C_backup=intval($_POST["C_backup"]);
    $C_slide=intval($_POST["C_slide"]);
    $C_uncopy=intval($_POST["C_uncopy"]);
    $C_twice=intval($_POST["C_twice"]);

    if(!checkauth()){
    	$C_fx1=0;
    	$C_fx2=0;
    	$C_fx3=0;
    	if($C_rzon==1){
    		die("免费版暂时不支持开启商家入驻功能");
    	}
    	if($C_qqon==1 || $C_wxon==1){
    		die("免费版暂时不支持开启快捷登录");
    	}
    	if($C_7payon==1 || $C_codepayon==1){
    		die("免费版暂时不支持开启7支付/码支付");
    	}
    }

    $C_html=intval($_POST["C_html"]);

	foreach ($_POST as $x=>$value) {
	    if(splitx($x,"_",0)=="picpic1"){
	        $C_kf=$C_kf.$_POST[$x]."_".$_POST["picpic2_".splitx($x,"_",1)]."_".$_POST["picpic3_".splitx($x,"_",1)]."|";
	    }
	}

	$C_kf=substr($C_kf,0,strlen($C_kf)-1);
	if($C_title==""){
		die("请填全信息");
	}else{
		mysqli_query($conn,"update sl_config set
		C_title='$C_title',
		C_keyword='$C_keyword',
		C_description='$C_description',
		C_logo='$C_logo',
		C_ico='$C_ico',
		C_code='$C_code',
		C_copyright='$C_copyright',
		C_kefu='$C_kf',
		C_alipay_pid='$C_alipay_pid',
		C_7pay_pid='$C_7pay_pid',
		C_codepay_id='$C_codepay_id',
		C_wx_appid='$C_wx_appid',
		C_wx_mchid='$C_wx_mchid',
		C_qqid='$C_qqid',
		C_wxapp_id='$C_wxapp_id',
		C_aliapp_id='$C_aliapp_id',
		C_bdapp_id='$C_bdapp_id',
		C_qqapp_id='$C_qqapp_id',
		C_zjapp_id='$C_zjapp_id',
		C_appt='$C_appt',
		C_alicode='$C_alicode',
		C_wxcode='$C_wxcode',
		C_alipayon=$C_alipayon,
		C_wxpayon=$C_wxpayon,
		C_7payon=$C_7payon,
		C_codepayon=$C_codepayon,
		C_qqon=$C_qqon,
		C_wxon=$C_wxon,
		C_rzon=$C_rzon,
		C_fee=$C_fee,
		C_rzfee=$C_rzfee,
		C_rzfeetype=$C_rzfeetype,
		C_zd=$C_zd,
		C_alicodeon=$C_alicodeon,
		C_wxcodeon=$C_wxcodeon,
		C_beian='$C_beian',
		C_qrcode='$C_qrcode',
		C_email='$C_email',
		C_mailtype=$C_mailtype,
		C_smtp='$C_smtp',
		C_html=$C_html,
		C_phone='$C_phone',
		C_fx1=$C_fx1,
		C_fx2=$C_fx2,
		C_fx3=$C_fx3,
		C_twice=$C_twice,
		C_uncopy=$C_uncopy,
		C_slide=$C_slide,
		C_backup=$C_backup,
		C_memberon=$C_memberon
		");
		if($C_qqkey!=""){
			mysqli_query($conn,"update sl_config set C_qqkey='$C_qqkey'");
		}
		if($C_alipay_pkey!=""){
			mysqli_query($conn,"update sl_config set C_alipay_pkey='$C_alipay_pkey'");
		}
		if($C_7pay_pkey!=""){
			mysqli_query($conn,"update sl_config set C_7pay_pkey='$C_7pay_pkey'");
		}
		if($C_codepay_key!=""){
			mysqli_query($conn,"update sl_config set C_codepay_key='$C_codepay_key'");
		}
		if($C_wx_appsecret!=""){
			mysqli_query($conn,"update sl_config set C_wx_appsecret='$C_wx_appsecret'");
		}
		if($C_wx_key!=""){
			mysqli_query($conn,"update sl_config set C_wx_key='$C_wx_key'");
		}
		if($C_mailcode!=""){
			mysqli_query($conn,"update sl_config set C_mailcode='$C_mailcode'");
		}

		if($C_wxapp_key!=""){
			mysqli_query($conn,"update sl_config set C_wxapp_key='$C_wxapp_key'");
		}
		if($C_aliapp_key!=""){
			mysqli_query($conn,"update sl_config set C_aliapp_key='$C_aliapp_key'");
		}
		if($C_aliapp_key2!=""){
			mysqli_query($conn,"update sl_config set C_aliapp_key2='$C_aliapp_key2'");
		}
		if($C_bdapp_key!=""){
			mysqli_query($conn,"update sl_config set C_bdapp_key='$C_bdapp_key'");
		}
		if($C_bdapp_key2!=""){
			mysqli_query($conn,"update sl_config set C_bdapp_key2='$C_bdapp_key2'");
		}
		if($C_qqapp_key!=""){
			mysqli_query($conn,"update sl_config set C_qqapp_key='$C_qqapp_key'");
		}
		if($C_zjapp_key!=""){
			mysqli_query($conn,"update sl_config set C_zjapp_key='$C_zjapp_key'");
		}

		mysqli_query($conn, "insert into sl_log(L_aid,L_time,L_add,L_ip,L_title) values(".$_SESSION["A_id"].",'".date('Y-m-d H:i:s')."','".$_SESSION["add"]."','".getip()."','编辑基本设置')");
		die("success");
	}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>基本设置 - 后台管理</title>

		<!--favicon -->
		<link rel="icon" href="../media/<?php echo $C_ico?>" type="image/x-icon"/>

		<!--Bootstrap.min css-->
		<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">

		<!--Icons css-->
		<link rel="stylesheet" href="assets/css/icons.css">

		<!--Style css-->
		<link rel="stylesheet" href="assets/css/style.css">

		<!--mCustomScrollbar css-->
		<link rel="stylesheet" href="assets/plugins/scroll-bar/jquery.mCustomScrollbar.css">

		<!--Sidemenu css-->
		<link rel="stylesheet" href="assets/plugins/toggle-menu/sidemenu.css">

		<!--Toastr css-->
		<link rel="stylesheet" href="assets/plugins/toastr/build/toastr.css">


		<script type="text/javascript" src="../upload/upload.js"></script>
		<style type="text/css">
		.showpic{height: 50px;border: solid 1px #DDDDDD;padding: 5px;}
		.showpicx{width: 100%;max-width: 300px}
		.table td{padding: 0px}

		.buy label {
			padding: 1px 5px;
			cursor: pointer;
			border: #CCCCCC solid 2px;
			-moz-border-radius: 3px;
			-webkit-border-radius: 3px;
			border-radius: 3px;
			color: #CCCCCC;
		}

		.buy .checked {
			border: #ff0000 solid 2px;
			-moz-border-radius: 3px;
			-webkit-border-radius: 3px;
			border-radius: 3px;
			color: #ff0000;
		}

		.buy input[type="radio"] {
			display: none;
		}
	</style>
	<script type="text/javascript">

function AddPic(){
 var i =pic1.rows.length;
 var newTr = pic1.insertRow();
 var _id='pp'+i;
 var newTd0 = newTr.insertCell();
 newTr.id=_id;
 newTd0.innerHTML ='<div class="input-group"><input type="text" name="picpic3_'+i+'" class="form-control" value="" placeholder="职务"><input type="text" name="picpic1_'+i+'" class="form-control" value="" placeholder="号码"><select class="form-control" name="picpic2_'+i+'"><option value="qq">QQ客服</option><option value="ww">旺旺客服</option><option value="wx">微信客服</option><option value="phone">电话号码</option><option value="email">电子邮箱</option></select><span class="input-group-btn"><button class="btn btn-primary m-b-5  m-t-5" type="button" onclick="DelPic('+i+')">－ 删除</button></span></div>'
 
}
function DelPic(i){
  var Container = document.getElementById("pic1");    
    var _tr=document.getElementById("pp"+i);  
    row=_tr.rowIndex;
    Container.deleteRow(row); 
}

	</script>
	</head>

	<body class="app ">

		<div id="spinner"></div>

		<div id="app">
			<div class="main-wrapper" >
				
					<?php
					require 'nav.php';
					?>

				<div class="app-content">
					<section class="section">
                    	<ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">后台管理</a></li>
                            <li class="breadcrumb-item active" aria-current="page">基本设置</li>
                        </ol>

						<div class="section-body ">
							<form id="form">
							<div class="row">
								
								<div class="col-lg-8">
									<div class="card card-primary">
		
										<div class="card-body">
											<ul class="nav nav-tabs" id="myTab2" role="tablist">
												<li class="nav-item">
													<a class="nav-link active" id="home-tab2" data-toggle="tab" href="#t1" role="tab" aria-controls="home" aria-selected="true">基本设置</a>
												</li>
												
												<li class="nav-item">
													<a class="nav-link" id="profile-tab2" data-toggle="tab" href="#t2" role="tab" aria-controls="profile" aria-selected="false">登录设置</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="contact-tab2" data-toggle="tab" href="#t3" role="tab" aria-controls="contact" aria-selected="false">收款接口</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="contact-tab2" data-toggle="tab" href="#t4" role="tab" aria-controls="contact" aria-selected="false">联系方式</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="contact-tab2" data-toggle="tab" href="#t5" role="tab" aria-controls="contact" aria-selected="false">商家入驻</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="contact-tab2" data-toggle="tab" href="#t6" role="tab" aria-controls="contact" aria-selected="false">邮箱接口设置</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="contact-tab2" data-toggle="tab" href="#t7" role="tab" aria-controls="contact" aria-selected="false">辅助功能</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="contact-tab2" data-toggle="tab" href="#t8" role="tab" aria-controls="contact" aria-selected="false">APP及小程序</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="contact-tab2" data-toggle="tab" href="#t9" role="tab" aria-controls="contact" aria-selected="false">安全设置</a>
												</li>
											</ul>
											<div class="tab-content tab-bordered" id="myTab2Content">
												<div class="tab-pane fade show active" id="t1" role="tabpanel" aria-labelledby="home-tab2">
													
												<div class="form-group row">
													<label class="col-md-3 col-form-label" >网站标题</label>
													<div class="col-md-9">
														<input type="text"  name="C_title" class="form-control" value="<?php echo $C_title?>">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-3 col-form-label" >网站关键词</label>
													<div class="col-md-9">
														<input type="text"  name="C_keyword" class="form-control" value="<?php echo $C_keyword?>">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-3 col-form-label" >网站描述</label>
													<div class="col-md-9">
														<textarea class="form-control" rows="3" name="C_description"><?php echo $C_description?></textarea>
														
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-3 col-form-label" >网站LOGO</label>
													<div class="col-md-9">
														<p><img src="../media/<?php echo $C_logo?>" id="C_logox" class="showpic" onClick="showUpload('C_logo','C_logo','../media',1,null,'','');" alt="<img src='../media/<?php echo $C_logo?>' class='showpicx'>"></p>
														<div class="input-group">
															
						                                        <input type="text" id="C_logo" name="C_logo" class="form-control" value="<?php echo $C_logo?>">
						                                        <span class="input-group-btn">
						                                                <button class="btn btn-primary m-b-5 m-t-5" type="button" onClick="showUpload('C_logo','C_logo','../media',1,null,'','');">上传</button>
						                                        </span>
						                                </div>
														
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-3 col-form-label" >网站ICO图标</label>
													<div class="col-md-9">
														<p><img src="../media/<?php echo $C_ico?>" id="C_icox" class="showpic" onClick="showUpload('C_ico','C_ico','../media',1,null,'','');"></p>
														<div class="input-group">
						                                        <input type="text" id="C_ico" name="C_ico" class="form-control" value="<?php echo $C_ico?>">
						                                        <span class="input-group-btn">
						                                                <button class="btn btn-primary m-b-5  m-t-5" type="button" onClick="showUpload('C_ico','C_ico','../media',1,null,'','');">上传</button>
						                                        </span>
						                                </div>
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-3 col-form-label" >网站备案号</label>
													<div class="col-md-9">
														<input type="text"  name="C_beian" class="form-control" value="<?php echo $C_beian?>" placeholder="没有可留空">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-3 col-form-label" >版权文字</label>
													<div class="col-md-9">
														<textarea class="form-control" rows="3" name="C_copyright"><?php echo $C_copyright?></textarea>
														
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-3 col-form-label" >统计代码</label>
													<div class="col-md-9">
														<textarea class="form-control" rows="3" name="C_code"><?php echo $C_code?></textarea>
														
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-3 col-form-label" >客服设置</label>
													<div class="col-md-9">

														<table class="table" id="pic1">

														<?php
															$kf=explode("|",$C_kefu);
															for($i=0;$i<count($kf);$i++){
																if(splitx($kf[$i],"_",1)=="qq"){
																	$qq="selected='selected'";
																}else{
																	$qq="";
																}

																if(splitx($kf[$i],"_",1)=="ww"){
																	$ww="selected='selected'";
																}else{
																	$ww="";
																}

																if(splitx($kf[$i],"_",1)=="wx"){
																	$wx="selected='selected'";
																}else{
																	$wx="";
																}

																if(splitx($kf[$i],"_",1)=="phone"){
																	$phone="selected='selected'";
																}else{
																	$phone="";
																}

																if(splitx($kf[$i],"_",1)=="email"){
																	$email="selected='selected'";
																}else{
																	$email="";
																}
																echo '<tr id="pp'.$i.'"><td><div class="input-group">
															            <input type="text" placeholder="职务" name="picpic3_'.$i.'" class="form-control" value="'.splitx($kf[$i],"_",2).'">
															            <input type="text" placeholder="号码" name="picpic1_'.$i.'" class="form-control" value="'.splitx($kf[$i],"_",0).'">
															            <select class="form-control" name="picpic2_'.$i.'">
															            	<option value="qq" '.$qq.'>QQ客服</option>
															            	<option value="ww" '.$ww.'>旺旺客服</option>
															            	<option value="wx" '.$wx.'>微信客服</option>
															            	<option value="phone" '.$phone.'>电话号码</option>
															            	<option value="email" '.$email.'>电子邮箱</option>
															            </select>
															            <span class="input-group-btn">
															                    <button class="btn btn-primary m-b-5  m-t-5" type="button" onclick="DelPic('.$i.')">－ 删除</button>
															            </span>
															    </div></td></tr>';
															}
														?>

</table>
														<button type="button" class="btn btn-primary btn-sm" onclick="AddPic()">＋ 新增一个客服</button>
														<span class="pull-right">说明：显示在网站右侧</span>
													</div>
												</div>

										
												</div>



												<div class="tab-pane fade" id="t2" role="tabpanel" aria-labelledby="profile-tab2">

												<div class="form-group row">
													<label class="col-md-3 col-form-label" >开启会员中心</label>
													<div class="col-md-9 buy">
														<label aa="C_memberon" <?php if($C_memberon==1){echo "class='checked'";}?>><input value="1" type="radio" name="C_memberon" <?php if($C_memberon==1){echo "checked='checked'";}?>> 开启</label>
														<label aa="C_memberon" <?php if($C_memberon==0){echo "class='checked'";}?>><input value="0" type="radio" name="C_memberon" <?php if($C_memberon==0){echo "checked='checked'";}?>> 关闭</label>
														
													</div>
												</div>
												<hr>

											
												<div class="form-group row">
													<label class="col-md-3 col-form-label" >QQ ID</label>
													<div class="col-md-9">
														<input type="text"  name="C_qqid" class="form-control" value="<?php echo $C_qqid?>">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-3 col-form-label" >QQ KEY</label>
													<div class="col-md-9">
														<input type="text"  name="C_qqkey" class="form-control" value="" <?php if($C_qqkey!=""){echo "placeholder=\"留空则不修改\"";}?>>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-md-3 col-form-label" >快捷登录开关 <img src="img/vip.png" height="15"></label>
													<div class="col-md-9">
														<label><input value="1" type="checkbox" name="C_qqon" <?php if($C_qqon==1){echo "checked='checked'";}?>> QQ快捷登录</label>
														<label><input value="1" type="checkbox" name="C_wxon" <?php if($C_wxon==1){echo "checked='checked'";}?>> 微信快捷登录</label>
														<div style="margin-top: 10px;font-size: 12px;color: #AAAAAA">*配置收款接口的微信APP ID及微信APP secret即可实现微信快捷登录</div>
														<div style="margin-top: 10px;font-size: 12px;color: #AAAAAA">*如果您不知道如何填写，请点击<a href="http://fahuo100.cn/h2.html" target="_blank">查看帮助</a></div>
													</div>
												</div>

												</div>
												<div class="tab-pane fade" id="t3" role="tabpanel" aria-labelledby="contact-tab2">
													
											<p style="text-align: center;font-weight: bold;font-size: 17px">支付宝收款（商户收款接口）</p>
												<div class="form-group row">
													<label class="col-md-3 col-form-label" >支付宝PID</label>
													<div class="col-md-9">
														<input type="text"  name="C_alipay_pid" class="form-control" value="<?php echo $C_alipay_pid?>">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-3 col-form-label" >支付宝PKEY</label>
													<div class="col-md-9">
														<input type="text"  name="C_alipay_pkey" class="form-control" value="" <?php if($C_alipay_pkey!=""){echo "placeholder=\"留空则不修改\"";}?>>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-md-3 col-form-label" ></label>
													<div class="col-md-9">
														<div style="margin-top: 10px;font-size: 12px;color: #AAAAAA">*如果您不知道如何填写，请点击<a href="http://fahuo100.cn/h1.html" target="_blank">查看帮助</a> <a href="https://b.alipay.com/index2.htm" target="_balnk">支付宝官网</a></div>

													</div>
												</div>
												<hr>
												<p style="text-align: center;font-weight: bold;font-size: 17px">微信支付收款（商户收款接口）</p>
												<div class="form-group row">
													<label class="col-md-3 col-form-label" >微信APP ID</label>
													<div class="col-md-9">
														<input type="text"  name="C_wx_appid" class="form-control" value="<?php echo $C_wx_appid?>">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-3 col-form-label" >微信APP secret</label>
													<div class="col-md-9">
														<input type="text"  name="C_wx_appsecret" class="form-control" value="" <?php if($C_wx_appsecret!=""){echo "placeholder=\"留空则不修改\"";}?>>
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-3 col-form-label" >微信MCHID</label>
													<div class="col-md-9">
														<input type="text"  name="C_wx_mchid" class="form-control" value="<?php echo $C_wx_mchid?>">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-3 col-form-label" >微信KEY</label>
													<div class="col-md-9">
														<input type="text"  name="C_wx_key" class="form-control" value="" <?php if($C_wx_key!=""){echo "placeholder=\"留空则不修改\"";}?>>
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-3 col-form-label" ></label>
													<div class="col-md-9">
														<div style="margin-top: 10px;font-size: 12px;color: #AAAAAA">*如果您不知道如何填写，请点击<a href="http://fahuo100.cn/h1.html" target="_blank">查看帮助</a> <a href="https://pay.weixin.qq.com" target="_balnk">微信支付官网</a></div>

													</div>
												</div>
												<hr>
												<p style="text-align: center;font-weight: bold;font-size: 17px">7支付收款（个人免签接口）</p>

												<div class="form-group row">
													<label class="col-md-3 col-form-label" >7支付PID</label>
													<div class="col-md-9">
														<input type="text"  name="C_7pay_pid" class="form-control" value="<?php echo $C_7pay_pid?>">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-3 col-form-label" >7支付PKEY</label>
													<div class="col-md-9">
														<input type="text"  name="C_7pay_pkey" class="form-control" value="" <?php if($C_7pay_pkey!=""){echo "placeholder=\"留空则不修改\"";}?>>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-md-3 col-form-label" ></label>
													<div class="col-md-9">
														<div style="margin-top: 10px;font-size: 12px;color: #AAAAAA">*如果您不知道如何填写，请点击<a href="http://fahuo100.cn/h4.html" target="_blank">查看帮助</a> <a href="https://7-pay.cn" target="_balnk">7支付官网</a></div>

													</div>
												</div>
												<hr>
												<p style="text-align: center;font-weight: bold;font-size: 17px">码支付收款（个人免签接口）</p>

												<div class="form-group row">
													<label class="col-md-3 col-form-label" >码支付ID</label>
													<div class="col-md-9">
														<input type="text"  name="C_codepay_id" class="form-control" value="<?php echo $C_codepay_id?>">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-3 col-form-label" >通信密钥</label>
													<div class="col-md-9">
														<input type="text"  name="C_codepay_key" class="form-control" value="" <?php if($C_codepay_key!=""){echo "placeholder=\"留空则不修改\"";}?>>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-md-3 col-form-label" ></label>
													<div class="col-md-9">
														<div style="margin-top: 10px;font-size: 12px;color: #AAAAAA">*如果您不知道如何填写，请点击<a href="http://fahuo100.cn/h17.html" target="_blank">查看帮助</a> <a href="https://codepay.fateqq.com/home.htm" target="_balnk">码支付官网</a></div>

													</div>
												</div>
												
												<hr>
												<div class="form-group row">
													<label class="col-md-3 col-form-label" >支付开关</label>
													<div class="col-md-9">
														<label><input value="1" type="checkbox" name="C_alipayon" <?php if($C_alipayon==1){echo "checked='checked'";}?>> 支付宝商户</label><br>
														<label><input value="1" type="checkbox" name="C_wxpayon" <?php if($C_wxpayon==1){echo "checked='checked'";}?>> 微信支付商户 </label><br>
														<label><input value="1" type="checkbox" name="C_7payon" <?php if($C_7payon==1){echo "checked='checked'";}?>> 7支付收款 </label>
														<img src="img/vip.png" height="15"><br>
														<label><input value="1" type="checkbox" name="C_codepayon" <?php if($C_codepayon==1){echo "checked='checked'";}?>> 码支付收款 </label>
														<img src="img/vip.png" height="15">
														

													</div>
												</div>


										
												</div>
												<div class="tab-pane fade" id="t4" role="tabpanel" aria-labelledby="contact-tab2">
													
											
												<div class="form-group row">
													<label class="col-md-3 col-form-label" >微信二维码</label>
													<div class="col-md-9">
														<p><img src="../media/<?php echo $C_qrcode?>" id="C_qrcodex" class="showpic" onClick="showUpload('C_qrcode','C_qrcode','../media',1,null,'','');" alt="<img src='../media/<?php echo $C_qrcode?>'  class='showpicx'>"></p>
														<div class="input-group">
															
						                                        <input type="text" id="C_qrcode" name="C_qrcode" class="form-control" value="<?php echo $C_qrcode?>">
						                                        <span class="input-group-btn">
						                                                <button class="btn btn-primary m-b-5 m-t-5" type="button" onClick="showUpload('C_qrcode','C_qrcode','../media',1,null,'','');">上传</button>
						                                        </span>
						                                </div>
														
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-3 col-form-label" >拨打电话</label>
													<div class="col-md-9">
														<input type="text"  name="C_phone" class="form-control" value="<?php echo $C_phone?>">
													</div>
												</div>
										
												</div>
												<div class="tab-pane fade" id="t5" role="tabpanel" aria-labelledby="contact-tab2">
													
												<div class="form-group row">
													<label class="col-md-3 col-form-label">商家入驻 <img src="img/vip.png" height="15"></label>
													<div class="col-md-9 buy">
														<label aa="C_rzon" <?php if($C_rzon==1){echo "class='checked'";}?>><input value="1" type="radio" name="C_rzon" <?php if($C_rzon==1){echo "checked='checked'";}?>> 开启</label>
														<label aa="C_rzon" <?php if($C_rzon==0){echo "class='checked'";}?>><input value="0" type="radio" name="C_rzon" <?php if($C_rzon==0){echo "checked='checked'";}?>> 关闭</label>
														
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-3 col-form-label">入驻费用</label>
													<div class="col-md-9">
														<div class="input-group">
														<select class="form-control" name="C_rzfeetype">
															<option value="0" <?php if($C_rzfeetype==0){echo "selected='selected'";}?>>一次性</option>
															<option value="1" <?php if($C_rzfeetype==1){echo "selected='selected'";}?>>每年</option>
														</select>
														<input type="text"  name="C_rzfee" class="form-control" value="<?php echo $C_rzfee?>">
														<span class="input-group-addon">元</span>
													</div>
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-3 col-form-label">最低提现金额</label>
													<div class="col-md-9">
														<div class="input-group">
														<input type="text"  name="C_zd" class="form-control" value="<?php echo $C_zd?>">
														<span class="input-group-addon">元</span>
													</div>
													</div>
												</div>


												<div class="form-group row">
													<label class="col-md-3 col-form-label">提现手续费</label>
													<div class="col-md-9">
														<div class="input-group">
														<input type="text"  name="C_fee" class="form-control" value="<?php echo $C_fee?>">
														<span class="input-group-addon">%</span>
													</div>
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-3 col-form-label" ></label>
													<div class="col-md-9">
														<div style="margin-top: 10px;font-size: 12px;color: #AAAAAA">*成为商家后可以享受普通会员的所有权限，并且可以发布自己的商品/文章</div>

													</div>
												</div>
										
												</div>

												<div class="tab-pane fade" id="t6" role="tabpanel" aria-labelledby="contact-tab2">
													
												<div class="form-group row">
													<label class="col-md-3 col-form-label">邮箱接口</label>
													<div class="col-md-9 buy">
														<label aa="C_mailtype" <?php if($C_mailtype==1){echo "class='checked'";}?>><input value="1" type="radio" name="C_mailtype" <?php if($C_mailtype==1){echo "checked='checked'";}?>> 自行提供</label>
														<label aa="C_mailtype" <?php if($C_mailtype==0){echo "class='checked'";}?>><input value="0" type="radio" name="C_mailtype" <?php if($C_mailtype==0){echo "checked='checked'";}?>> 官网提供</label>

													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-3 col-form-label">电子邮箱</label>
													<div class="col-md-9">
														<input type="text"  name="C_email" class="form-control" value="<?php echo $C_email?>">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-md-3 col-form-label">SMTP</label>
													<div class="col-md-9">
														<input type="text"  name="C_smtp" class="form-control" value="<?php echo $C_smtp?>">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-md-3 col-form-label">邮箱授权码<br>或邮箱密码</label>
													<div class="col-md-9">
														<input type="text"  name="C_mailcode" class="form-control" value="" <?php if($C_mailcode!=""){echo "placeholder=\"留空则不修改\"";}?>>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-md-3 col-form-label" ></label>
													<div class="col-md-9">
														<div style="margin-top: 10px;font-size: 12px;color: #AAAAAA">*如果您不知道如何填写，请点击<a href="http://fahuo100.cn/h8.html" target="_blank">查看帮助</a></div>

													</div>
												</div>
										
												</div>



												<div class="tab-pane fade" id="t7" role="tabpanel" aria-labelledby="contact-tab2">
													
												<div class="form-group row">
													<label class="col-md-3 col-form-label">伪静态 <img src="img/vip.png" height="15"></label>
													<div class="col-md-9 buy">
														<label aa="C_html" <?php if($C_html==1){echo "class='checked'";}?>><input value="1" type="radio" name="C_html" <?php if($C_html==1){echo "checked='checked'";}?>> 开启</label>
														<label aa="C_html" <?php if($C_html==0){echo "class='checked'";}?>><input value="0" type="radio" name="C_html" <?php if($C_html==0){echo "checked='checked'";}?>> 关闭</label>

													</div>
												</div>
												<div class="form-group row">
													<label class="col-md-3 col-form-label" ></label>
													<div class="col-md-9">
														<div style="margin-top: 10px;font-size: 12px;color: #AAAAAA">*如果开启伪静态，需额外配置文件，请点击<a href="http://fahuo100.cn/h10.html" target="_blank">查看帮助</a></div>

													</div>
												</div>


												<div class="form-group row">
													<label class="col-md-3 col-form-label">三级分销 <img src="img/vip.png" height="15"></label>
													<div class="col-md-9">
														<p><div class="input-group">
												            <span class="input-group-addon">一级佣金</span>
												            <input type="text" class="form-control" name="C_fx1" value="<?php echo $C_fx1?>">
												            <span class="input-group-addon">%</span>
												        </div></p>
												        <p><div class="input-group">
												            <span class="input-group-addon">二级佣金</span>
												            <input type="text" class="form-control" name="C_fx2" value="<?php echo $C_fx2?>">
												            <span class="input-group-addon">%</span>
												        </div></p>
												        <p><div class="input-group">
												            <span class="input-group-addon">三级佣金</span>
												            <input type="text" class="form-control" name="C_fx3" value="<?php echo $C_fx3?>">
												            <span class="input-group-addon">%</span>
												        </div></p>

													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-3 col-form-label" ></label>
													<div class="col-md-9">
														<div style="margin-top: 10px;font-size: 12px;color: #AAAAAA">
															*佣金比例设置为0则不开启该级分销功能<br>
															如果不懂如何设置分销规则，请点击<a href="http://fahuo100.cn/h16.html" target="_blank">查看帮助</a></div>

													</div>
												</div>
												</div>

												<div class="tab-pane fade" id="t8" role="tabpanel" aria-labelledby="contact-tab2">


													<div class="form-group row">
													<label class="col-md-3 col-form-label" >微信小程序-AppID</label>
													<div class="col-md-9">
														<input type="text"  name="C_wxapp_id" class="form-control" value="<?php echo $C_wxapp_id?>">
													</div>
													</div>
													<div class="form-group row">
													<label class="col-md-3 col-form-label" >微信小程序-AppSecret</label>
													<div class="col-md-9">
														<input type="text"  name="C_wxapp_key" class="form-control" value="" <?php if($C_wxapp_key!=""){echo "placeholder=\"留空则不修改\"";}?>>
													</div>
													</div>
													<hr>
													<div class="form-group row">
													<label class="col-md-3 col-form-label" >支付宝小程序-AppID</label>
													<div class="col-md-9">
														<input type="text"  name="C_aliapp_id" class="form-control" value="<?php echo $C_aliapp_id?>">
													</div>
													</div>
													<div class="form-group row">
													<label class="col-md-3 col-form-label" >支付宝小程序-应用私钥</label>
													<div class="col-md-9">
														<textarea name="C_aliapp_key" class="form-control" rows="3" <?php if($C_aliapp_key!=""){echo "placeholder=\"留空则不修改\"";}?>></textarea>
													</div>
													</div>

													<div class="form-group row">
													<label class="col-md-3 col-form-label" >支付宝小程序-支付宝公钥</label>
													<div class="col-md-9">
														<textarea name="C_aliapp_key2" class="form-control" rows="3" <?php if($C_aliapp_key2!=""){echo "placeholder=\"留空则不修改\"";}?>></textarea>
													</div>
													</div>
													<hr>

													<div class="form-group row">
													<label class="col-md-3 col-form-label" >百度小程序-App ID</label>
													<div class="col-md-9">
														<input type="text"  name="C_bdapp_id" class="form-control" value="<?php echo $C_bdapp_id?>">
													</div>
													</div>
													<div class="form-group row">
													<label class="col-md-3 col-form-label" >百度小程序-App Key</label>
													<div class="col-md-9">
														<input type="text"  name="C_bdapp_key" class="form-control" value="" <?php if($C_bdapp_key!=""){echo "placeholder=\"留空则不修改\"";}?>>
													</div>
													</div>
													<div class="form-group row">
													<label class="col-md-3 col-form-label" >百度小程序-App Secret</label>
													<div class="col-md-9">
														<input type="text"  name="C_bdapp_key2" class="form-control" value="" <?php if($C_bdapp_key2!=""){echo "placeholder=\"留空则不修改\"";}?>>
													</div>
													</div>
													<hr>

													<div class="form-group row">
													<label class="col-md-3 col-form-label" >QQ小程序-AppID</label>
													<div class="col-md-9">
														<input type="text"  name="C_qqapp_id" class="form-control" value="<?php echo $C_qqapp_id?>">
													</div>
													</div>
													<div class="form-group row">
													<label class="col-md-3 col-form-label" >QQ小程序-AppSecret</label>
													<div class="col-md-9">
														<input type="text"  name="C_qqapp_key" class="form-control" value="" <?php if($C_qqapp_key!=""){echo "placeholder=\"留空则不修改\"";}?>>
													</div>
													</div>
													<hr>

													<div class="form-group row">
													<label class="col-md-3 col-form-label" >字节跳动小程序-AppID</label>
													<div class="col-md-9">
														<input type="text"  name="C_zjapp_id" class="form-control" value="<?php echo $C_zjapp_id?>">
													</div>
													</div>
													<div class="form-group row">
													<label class="col-md-3 col-form-label" >字节跳动小程序-AppSecret</label>
													<div class="col-md-9">
														<input type="text"  name="C_zjapp_key" class="form-control" value="" <?php if($C_zjapp_key!=""){echo "placeholder=\"留空则不修改\"";}?>>
													</div>
													</div>

													<div class="form-group row">
													<label class="col-md-3 col-form-label" >选择模板</label>
													<div class="col-md-9">
														<label><input type="radio" name="C_appt" value="shop" <?php if($C_appt=="shop"){echo "checked='checked'";}?>> 商城型</label> <button type="button" class="btn btn-info btn-sm" onclick="show('t1')">演示</button>
														<label><input type="radio" name="C_appt" value="news" <?php if($C_appt=="news"){echo "checked='checked'";}?>> 文章型</label> <button type="button" class="btn btn-info btn-sm" onclick="show('t2')">演示</button>
													</div>
													</div>

													<div class="form-group row">
													<label class="col-md-3 col-form-label" >生成代码包</label>
													<div class="col-md-9">
														<button type="button" onClick="save()" class="btn btn-info">保存信息</button>
														<button type="button" onClick="creat()" class="btn btn-primary">生成代码包</button>
													</div>
													</div>

													<div class="form-group row">
													<label class="col-md-3 col-form-label" >说明</label>
													<div class="col-md-9">
														<div style="margin-top: 10px;font-size: 12px;color: #AAAAAA">*如何不知道如何生成，请点击<a href="http://fahuo100.cn/h12.html" target="_blank">生成教程</a>和<a href="http://fahuo100.cn/h13.html" target="_blank">配置教程</a></div>
													</div>
													</div>

												</div>


												<div class="tab-pane fade" id="t9" role="tabpanel" aria-labelledby="contact-tab2">
													<div class="form-group row">
														<label class="col-md-3 col-form-label">后台二次验证</label>
														<div class="col-md-9 buy">
															<label aa="C_twice" <?php if($C_twice==1){echo "class='checked'";}?>><input value="1" type="radio" name="C_twice" <?php if($C_twice==1){echo "checked='checked'";}?>> 开启</label>
															<label aa="C_twice" <?php if($C_twice==0){echo "class='checked'";}?>><input value="0" type="radio" name="C_twice" <?php if($C_twice==0){echo "checked='checked'";}?>> 关闭</label>
															<div style="margin-top: 10px;font-size: 12px;color: #AAAAAA">*当登录IP有变动时会触发二次验证</div>
														</div>
													</div>

													<div class="form-group row">
														<label class="col-md-3 col-form-label">滑块验证</label>
														<div class="col-md-9 buy">
															<label aa="C_slide" <?php if($C_slide==1){echo "class='checked'";}?>><input value="1" type="radio" name="C_slide" <?php if($C_slide==1){echo "checked='checked'";}?>> 开启</label>
															<label aa="C_slide" <?php if($C_slide==0){echo "class='checked'";}?>><input value="0" type="radio" name="C_slide" <?php if($C_slide==0){echo "checked='checked'";}?>> 关闭</label>
															<div style="margin-top: 10px;font-size: 12px;color: #AAAAAA">*会员中心及后台登录时拖动滑块验证</div>
														</div>
													</div>

													<div class="form-group row">
														<label class="col-md-3 col-form-label">页面防复制</label>
														<div class="col-md-9 buy">
															<label aa="C_uncopy" <?php if($C_uncopy==1){echo "class='checked'";}?>><input value="1" type="radio" name="C_uncopy" <?php if($C_uncopy==1){echo "checked='checked'";}?>> 开启</label>
															<label aa="C_uncopy" <?php if($C_uncopy==0){echo "class='checked'";}?>><input value="0" type="radio" name="C_uncopy" <?php if($C_uncopy==0){echo "checked='checked'";}?>> 关闭</label>

															<div style="margin-top: 10px;font-size: 12px;color: #AAAAAA">*禁用鼠标右键，防止页面内容被复制</div>

														</div>
													</div>
													<div class="form-group row">
														<label class="col-md-3 col-form-label">数据自动备份</label>
														<div class="col-md-9 buy">
															<label aa="C_backup" <?php if($C_backup==1){echo "class='checked'";}?>><input value="1" type="radio" name="C_backup" <?php if($C_backup==1){echo "checked='checked'";}?>> 开启</label>
															<label aa="C_backup" <?php if($C_backup==0){echo "class='checked'";}?>><input value="0" type="radio" name="C_backup" <?php if($C_backup==0){echo "checked='checked'";}?>> 关闭</label>
															<div style="margin-top: 10px;font-size: 12px;color: #AAAAAA">*每次登录后台时，自动备份一次数据库</div>

														</div>
													</div>

												</div>

											</div>
										</div>
									</div>
								</div>

								<div class="col-lg-12">
									<button class="btn btn-primary" type="button" onClick="save()" style="margin-bottom: 20px;margin-right: 20px;">保存</button>
									说明：带 <img src="img/vip.png" height="15"> 标识的功能仅限授权版用户使用。
								</div>
							
							</div>
							</form>
						</div>
					</section>
				</div>

			</div>
		</div>

		<!-- Large Modal -->
		<div id="appt" class="modal fade">
			<div class="modal-dialog" role="document" >
				<div class="modal-content " style="width: 430px">
					<div class="modal-header pd-x-20">
						<h6 class="modal-title">模板演示</h6>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div id="app_show"></div>
				</div>
			</div><!-- modal-dialog -->
		</div><!-- modal -->

		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="assets/plugins/toggle-menu/sidemenu.js"></script>
		<script src="assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>
		<script src="assets/js/scripts.js"></script>
		<script src="assets/js/help.js"></script>
		<script src="assets/plugins/toastr/build/toastr.min.js"></script>

		<script type="text/javascript">
		function show(T_id){
			$('#appt').modal('show');
			$('#app_show').html('<iframe src="http://fhdemo.s-cms.cn/'+T_id+'/wap/" style="border:none;height:700px;width:100%"></iframe>')
		}
		function save(){
			console.log($("#form").serialize());
				$.ajax({
            	url:'?action=save',
            	type:'post',
            	data:$("#form").serialize(),
            	success:function (data) {
            	if(data=="success"){
            		toastr.success("保存成功", "成功");
            	}else{
            		toastr.error(data, '错误');
            	}
            	}
            });

			}

			function creat(){
				var C_appt=$("input[name='C_appt']:checked").val();
				$.ajax({
            	url:'?action=creat',
            	type:'post',
            	data:$("#form").serialize(),
            	success:function (data) {
            	data=JSON.parse(data);
            	if(data.msg=="success"){
            		toastr.success("生成成功", "成功");
            		window.location.href="http://fahuo100.cn/app/download/"+data.url+".zip";
            	}else{
            		toastr.error(data.msg, '错误');
            	}
            	}
            });

			}
$(function() { $('.buy label').click(function(){var aa = $(this).attr('aa');$('[aa="'+aa+'"]').removeAttr('class') ;$(this).attr('class','checked');});});
		</script>
		
	</body>
</html>
