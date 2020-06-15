<?php
require '../conn/conn.php';
require '../conn/function.php';
require 'admin_check.php';

$action=$_GET["action"];
$P_id=intval($_GET["P_id"]);

if($P_id!=""){
	$aa="edit&P_id=".$P_id;
	$sql="select * from sl_product,sl_psort where P_sort=S_id and P_id=".$P_id;

	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	if (mysqli_num_rows($result) > 0) {
		$P_pic=$row["P_pic"];
		$P_title=$row["P_title"];
		$S_title=$row["S_title"];
		$P_content=$row["P_content"];
		$P_price=$row["P_price"];
		$P_sort=$row["P_sort"];
		$P_order=$row["P_order"];
		$P_sell=$row["P_sell"];
		$P_selltype=$row["P_selltype"];
		$P_rest=$row["P_rest"];
		$P_sh=$row["P_sh"];
		$P_unlogin=$row["P_unlogin"];
		$P_tag=$row["P_tag"];
		$P_fx=$row["P_fx"];
		$P_shuxing=$row["P_shuxing"];
		$P_video=$row["P_video"];
		$P_time=$row["P_time"];
		$P_sold=$row["P_sold"];
	}
}else{
	$aa="add";
	$P_pic="nopic.png";
	$P_selltype=0;
	$P_rest=100;
	$P_sh=1;
	$P_unlogin=1;
	$P_fx=1;
	$P_time=date('Y-m-d H:i:s');
	$P_sold=0;
}

if($action=="add"){
	foreach ($_POST as $x=>$value) {
	    if(splitx($x,"_",0)=="picpic1"){
	        $pic=$pic.$_POST[$x]."|";
	    }
	}
	$P_pic=substr($pic,0,strlen($pic)-1);
	$P_title=$_POST["P_title"];
	$P_content=$_POST["P_content"];
	$P_price=round($_POST["P_price"],2);
	$P_sort=intval($_POST["P_sort"]);
	$P_order=intval($_POST["P_order"]);
	$P_selltype=intval($_POST["P_selltype"]);
	$P_rest=intval($_POST["P_rest"]);
	$P_sh=intval($_POST["P_sh"]);
	$P_unlogin=intval($_POST["P_unlogin"]);
	$P_fx=intval($_POST["P_fx"]);
	$P_sold=intval($_POST["P_sold"]);
	$P_tag=$_POST["P_tag"];
	$P_video=$_POST["P_video"];
	$P_shuxing=$_POST["P_shuxing"];
	$P_time=$_POST["P_time"];
	$P_sell=$_POST["P_sell"][$P_selltype];

	if($P_sort==0){
		die("{\"msg\":\"请选择一个商品分类\"}");
	}
	if($P_price<0){
		die("{\"msg\":\"商品价格不可为负\"}");
	}
	if($P_selltype==1 && $P_sell==0){
		die("{\"msg\":\"请选择一个卡密分类\"}");
	}

	if($P_title!=""){
		mysqli_query($conn,"insert into sl_product(P_pic,P_title,P_content,P_price,P_sort,P_order,P_selltype,P_sell,P_rest,P_sh,P_unlogin,P_fx,P_tag,P_shuxing,P_video,P_time,P_sold) values('$P_pic','$P_title','$P_content',$P_price,$P_sort,$P_order,$P_selltype,'$P_sell',$P_rest,$P_sh,$P_unlogin,$P_fx,'$P_tag','$P_shuxing','$P_video','$P_time',$P_sold)");

		$P_id=getrs("select * from sl_product where P_title='$P_title' and P_pic='$P_pic' and P_sort=$P_sort","P_id");
		mysqli_query($conn,"insert into sl_log(L_aid,L_time,L_add,L_ip,L_title) values(".$_SESSION["A_id"].",'".date('Y-m-d H:i:s')."','".$_SESSION["add"]."','".getip()."','新增商品')");
		die("{\"msg\":\"success\",\"P_id\":$P_id}");
	}else{
		die("{\"msg\":\"请填全内容\"}");
	}
}

if($action=="edit"){
	foreach ($_POST as $x=>$value) {
	    if(splitx($x,"_",0)=="picpic1"){
	        $pic=$pic.$_POST[$x]."|";
	    }
	}
	$P_pic=substr($pic,0,strlen($pic)-1);
	$P_title=$_POST["P_title"];
	$P_content=$_POST["P_content"];
	$P_price=round($_POST["P_price"],2);
	$P_sort=intval($_POST["P_sort"]);
	$P_order=intval($_POST["P_order"]);
	$P_selltype=intval($_POST["P_selltype"]);
	$P_rest=intval($_POST["P_rest"]);
	$P_sh=intval($_POST["P_sh"]);
	$P_unlogin=intval($_POST["P_unlogin"]);
	$P_fx=intval($_POST["P_fx"]);
	$P_sold=intval($_POST["P_sold"]);
	$P_tag=$_POST["P_tag"];
	$P_video=$_POST["P_video"];
	$P_shuxing=$_POST["P_shuxing"];
	$P_time=$_POST["P_time"];
	$P_sell=$_POST["P_sell"][$P_selltype];

	if($P_sort==0){
		die("{\"msg\":\"请选择一个商品分类\"}");
	}

	if($P_price<0){
		die("{\"msg\":\"商品价格不可为负\"}");
	}

	if($P_selltype==1 && $P_sell==0){
		die("{\"msg\":\"请选择一个卡密分类\"}");
	}

	if($P_title!=""){
		mysqli_query($conn, "update sl_product set
		P_pic='$P_pic',
		P_title='$P_title',
		P_content='$P_content',
		P_price=$P_price,
		P_sort=$P_sort,
		P_order=$P_order,
		P_selltype=$P_selltype,
		P_rest=$P_rest,
		P_sh=$P_sh,
		P_unlogin=$P_unlogin,
		P_fx=$P_fx,
		P_sold=$P_sold,
		P_sell='$P_sell',
		P_tag='$P_tag',
		P_shuxing='$P_shuxing',
		P_time='$P_time',
		P_video='$P_video'
		where P_id=".$P_id);
		mysqli_query($conn,"insert into sl_log(L_aid,L_time,L_add,L_ip,L_title) values(".$_SESSION["A_id"].",'".date('Y-m-d H:i:s')."','".$_SESSION["add"]."','".getip()."','编辑商品')");
		die("{\"msg\":\"success\",\"P_id\":0}");
	}else{
		die("{\"msg\":\"请填全内容\"}");
	}
}


?>
<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>商品设置 - 后台管理</title>

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

		<!--Morris css-->
		<link rel="stylesheet" href="assets/plugins/morris/morris.css">

		<!--Toastr css-->
		<link rel="stylesheet" href="assets/plugins/toastr/build/toastr.css">


		<script type="text/javascript" src="../upload/upload.js"></script>
		<style type="text/css">
		.showpic{height: 100px;border: solid 1px #DDDDDD;padding: 5px;max-width: 100%;}
		.showpicx{width: 100%;max-width: 500px}
		.list-group a{text-decoration:none}

		.buy label {
			padding: 1px 5px;
			cursor: pointer;
			border: #CCCCCC solid 2px;
			-moz-border-radius: 3px;
			-webkit-border-radius: 3px;
			border-radius: 3px;
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

function AddPic()
{
 var i =pic1.rows.length;
 var newTr = pic1.insertRow();
 var _id='pp'+i;
 var newTd0 = newTr.insertCell();
 newTr.id=_id;
 newTd0.innerHTML ='<div class="row"><div class="col-md-3"><img src="../media/nopic.png" id="picpic1_'+i+'x" class="showpic" onClick="showUpload(\'picpic1_'+i+'\',\'picpic1_'+i+'\',\'../media\',1,null,\'\',\'\');" alt="<img src=\'../media/nopic.png\' class=\'showpicx\'>"></div><div class="col-md-9"><div class="input-group"><input type="text" id="picpic1_'+i+'" name="picpic1_'+i+'" class="form-control" value="nopic.png"><span class="input-group-btn"><button class="btn btn-primary m-b-5 m-t-5" type="button" onClick="showUpload(\'picpic1_'+i+'\',\'picpic1_'+i+'\',\'../media\',1,null,\'\',\'\');">上传</button></span></div><button class="btn btn-danger btn-sm" type="button" onclick="DelPic('+i+')">- 删除该图</button></div></div>';
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
                            <li class="breadcrumb-item active" aria-current="page"><a href="product_list.php">商品管理</a></li>
                        </ol>

						<div class="section-body ">
							<form id="form">
							<div class="row">
								
								<div class="col-lg-3">

									<div class="card card-primary">

										<div class="card-header">
											<h4><?php echo $S_title?> -商品列表</h4>

										</div>
										
											
												<ul class="list-group">
													<?php 
													if($P_id==0){
														$sql="select * from sl_product,sl_psort where P_sort=S_id and P_del=0 order by S_order,P_order,P_id desc limit 20";
													}else{
														$sql="select * from sl_product,sl_psort where P_sort=S_id and P_del=0 and P_sort=$P_sort order by S_order,P_order,P_id desc limit 20";
													}
														
																$result = mysqli_query($conn, $sql);
																if (mysqli_num_rows($result) > 0) {
																while($row = mysqli_fetch_assoc($result)) {
																	if($row["P_id"]==$P_id){
																		$active="active";
																	}else{
																		$active="";
																	}
																	echo "<a href=\"?P_id=".$row["P_id"]."\" class=\"list-group-item ".$active."\"><b>[".$row["S_title"]."]</b> ".htmlspecialchars($row["P_title"])."</a>";
																}
															}
													?>
													
												</ul>
											
										
									</div>
									<a href="product_add.php" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> 新增商品</a>
								</div>

								<div class="col-lg-9">
									<div class="card card-primary">
										<div class="card-header ">
											<h4>商品管理</h4>
										</div>
										<div class="card-body">
												<div class="form-group row">
													<label class="col-md-2 col-form-label" >商品标题</label>
													<div class="col-md-10">
														<input type="text"  name="P_title" class="form-control" value="<?php echo htmlspecialchars($P_title)?>">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-2 col-form-label" >商品价格</label>
													<div class="col-md-4">

														<div class="input-group">
														<input type="text"  name="P_price" class="form-control" value="<?php echo $P_price?>">
														<span class="input-group-addon">元</span>
													</div>

													</div>

													<label class="col-md-2 col-form-label" >商品分类</label>
													<div class="col-md-4">
														<select name="P_sort" class="form-control">
															<?php
																$sql2="select * from sl_psort where S_del=0 and S_sub=0 order by S_order,S_id desc";
																	$result2 = mysqli_query($conn, $sql2);
																	if (mysqli_num_rows($result2) > 0) {
																	while($row2 = mysqli_fetch_assoc($result2)) {
																		echo "<optgroup label=\"".$row2["S_title"]."\">";
																		$sql="select * from sl_psort where S_del=0 and S_sub=".$row2["S_id"]." order by S_order,S_id desc";
																			$result = mysqli_query($conn, $sql);
																			if (mysqli_num_rows($result) > 0) {
																			while($row = mysqli_fetch_assoc($result)) {
																				if($P_sort==$row["S_id"]){
																					$selected="selected";
																				}else{
																					$selected="";
																				}
																				echo "<option value=\"".$row["S_id"]."\" ".$selected.">".$row["S_title"]."</option>";
																			}
																		}
																		echo "</optgroup>";
																	}
																}
															?>
														</select>
														<div style="margin-top: 10px;font-size: 12px;color: #AAAAAA">*商品无法直接归到主分类，如果无法选择请先新建子分类</div>
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-2 col-form-label" >发布时间</label>
													<div class="col-md-4">
														<input type="text"  name="P_time" class="form-control" value="<?php echo $P_time?>">
													</div>
													<label class="col-md-2 col-form-label" >商品销量</label>
													<div class="col-md-4">
														<div class="input-group">
														<input type="text"  name="P_sold" class="form-control" value="<?php echo $P_sold?>">
														<span class="input-group-addon">件</span>
													</div>
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-2 col-form-label" >商品图片</label>
													<div class="col-md-10">
<table class="table" id="pic1">
															<?php
															$pic=explode("|",$P_pic);
															for($i=0;$i<count($pic);$i++){
																echo "<tr id=\"pp".$i."\"><td><div class=\"row\">
																<div class=\"col-md-3\">
																<img src=\"../media/".$pic[$i]."\" id=\"picpic1_".$i."x\" class=\"showpic\" onClick=\"showUpload('picpic1_".$i."','picpic1_".$i."','../media',1,null,'','');\" alt=\"<img src='../media/".$pic[$i]."' class='showpicx'>
																\"></div>

																<div class=\"col-md-9\">
																<div class=\"input-group\">
						                                        <input type=\"text\" id=\"picpic1_".$i."\" name=\"picpic1_".$i."\" class=\"form-control\" value=\"".$pic[$i]."\">
						                                        <span class=\"input-group-btn\">
						                                                <button class=\"btn btn-primary m-b-5 m-t-5\" type=\"button\" onClick=\"showUpload('picpic1_".$i."','picpic1_".$i."','../media',1,null,'','');\">上传</button>
						                                        </span>
						                                </div>
						                                <button class=\"btn btn-danger btn-sm\" type=\"button\" onclick=\"DelPic(".$i.")\">- 删除该图</button>
						                                </div>
						                                </div></td></tr>";
															}

															?>
</table>
<button class="btn btn-info btn-sm" type="button" onclick="AddPic()">+ 新增一个商品图</button>
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-2 col-form-label" >商品排序</label>
													<div class="col-md-4">
														<input type="text"  name="P_order" class="form-control" value="<?php echo $P_order?>" placeholder="数字越小越靠前">
													</div>
													<label class="col-md-2 col-form-label" >商品审核</label>
													<div class="col-md-4">
														
														<select class="form-control" name="P_sh">
															<option value="0" <?php if($P_sh==0){echo "selected=\"selected\"";}?>>未审核</option>
															<option value="1" <?php if($P_sh==1){echo "selected=\"selected\"";}?>>已通过</option>
															<option value="2" <?php if($P_sh==2){echo "selected=\"selected\"";}?>>未通过</option>
														</select>
													
													</div>
												</div>


												<div class="form-group row">
													<label class="col-md-2 col-form-label" >发货内容</label>
													<div class="col-md-10 buy">
														<label aa="P_selltype" <?php if($P_selltype==0){echo "class='checked'";}?>><input type="radio" name="P_selltype" value="0" onclick="change(0)" <?php if($P_selltype==0){echo "checked='checked'";}?>> [自动发货]固定内容</label>
														<label aa="P_selltype" <?php if($P_selltype==1){echo "class='checked'";}?>><input type="radio" name="P_selltype" value="1" onclick="change(1)" <?php if($P_selltype==1){echo "checked='checked'";}?>> [自动发货]卡密</label>
														<label aa="P_selltype" <?php if($P_selltype==2){echo "class='checked'";}?>><input type="radio" name="P_selltype" value="2" onclick="change(2)" <?php if($P_selltype==2){echo "checked='checked'";}?>> [手动发货]实物</label>
														<div style="font-size: 12px;color: #AAAAAA;display: inline-block;margin-left: 20px;">*不会设置？点击<a href="http://fahuo100.cn/h6.html" target="_blank">查看帮助</a></div>

														<textarea name="P_sell[]" class="form-control" rows="3" placeholder="输入固定发货内容" id="P_sell1"><?php echo $P_sell?></textarea>
														<div id="P_sell2">
														<select class="form-control" name="P_sell[]">
															<option value="0">请选择一个卡密分类</option>
															<?php
																$sql="select * from sl_csort where S_del=0 order by S_id desc";
																	$result = mysqli_query($conn, $sql);
																	if (mysqli_num_rows($result) > 0) {
																	while($row = mysqli_fetch_assoc($result)) {
																		if($P_sell==$row["S_id"]){
																			$selected="selected";
																		}else{
																			$selected="";
																		}
																		echo "<option value=\"".$row["S_id"]."\" ".$selected.">".$row["S_title"]."</option>";
																	}
																}

															?>
														</select>
														<a href="card_list.php" target="_blank" class="btn btn-info btn-sm" style="margin-top: 10px;">管理卡密</a>
														</div>

														<div id="P_sell3">
															<div class="input-group">
													            <span class="input-group-addon">商品余量</span>
													            <input type="text" class="form-control" name="P_rest" value="<?php echo $P_rest?>">
													        </div>
														<p style="font-size: 12px;margin-top: 10px;">*实物商品，请手动给用户发货</p>
													</div>

													</div>
												</div>


<div class="panel-group" id="accordion">
<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" style="display: block;text-align: center;background: #f7f7f7;margin-bottom: 10px;font-weight: bold;padding: 5px;">＋展开高级功能</a>
            
        <div id="collapseThree" class="panel-collapse collapse" style="background: #f7f7f7;padding: 10px;margin-bottom: 10px;border-radius: 10px;">
												<div class="form-group row">
													<label class="col-md-2 col-form-label" >免登录购买</label>
													<div class="col-md-4 buy">
														<label aa="P_unlogin" <?php if($P_unlogin==1){echo "class='checked'";}?>><input type="radio" name="P_unlogin" value="1"  <?php if($P_unlogin==1){echo "checked='checked'";}?>> 开启</label>
														<label aa="P_unlogin" <?php if($P_unlogin==0){echo "class='checked'";}?>><input type="radio" name="P_unlogin" value="0"  <?php if($P_unlogin==0){echo "checked='checked'";}?>> 关闭</label>
													</div>

													<label class="col-md-2 col-form-label" >分销推广</label>
													<div class="col-md-4 buy">
														<label aa="P_fx" <?php if($P_fx==1){echo "class='checked'";}?>><input type="radio" name="P_fx" value="1"  <?php if($P_fx==1){echo "checked='checked'";}?>> 开启</label>
														<label aa="P_fx" <?php if($P_fx==0){echo "class='checked'";}?>><input type="radio" name="P_fx" value="0"  <?php if($P_fx==0){echo "checked='checked'";}?>> 关闭</label>
													</div>

												</div>

												<div class="form-group row">
													<label class="col-md-2 col-form-label">插入视频</label>
													<div class="col-md-10 buy">
														<textarea name="P_video" id="P_video" class="form-control" rows="3" placeholder="上传mp4视频或者粘贴视频代码"><?php echo $P_video?></textarea>
														<p style="font-size: 12px;margin-top: 10px;"><button class="btn btn-sm btn-primary" type="button" onClick="showUpload('P_video','P_video','../media',1,null,'','');">上传视频</button> *如果您不知道如何使用视频功能，请点击<a href="http://fahuo100.cn/h18.html" target="_blank">查看帮助</a></p>
													</div>

												</div>


												<div class="form-group row">
													<label class="col-md-2 col-form-label">商品Tag</label>
													<div class="col-md-10">
														<textarea name="P_tag" class="form-control" rows="3" placeholder="多个标签用空格隔开"><?php echo $P_tag?></textarea>
														
														<p style="font-size: 12px;margin-top: 10px;">*使用Tag功能，方便用户快速定位具有相同标签的商品，多个标签用空格隔开</p>
													</div>

												</div>

												<div class="form-group row">
													<label class="col-md-2 col-form-label">商品参数</label>
													<div class="col-md-10">
														<textarea name="P_shuxing" class="form-control" rows="3" placeholder="格式：每行一个"><?php echo $P_shuxing?></textarea>
														
														<p style="font-size: 12px;margin-top: 10px;">*格式：每行一个</p>
													</div>

												</div>
</div>
												<div class="form-group row">
													<label class="col-md-2 col-form-label" >商品介绍</label>
													<div class="col-md-10">
														<script charset='utf-8' src='../kindeditor/kindeditor-all-min.js'></script>
		                                                <script charset='utf-8' src='../kindeditor/lang/zh-CN.js'></script>
		                                                <script>KindEditor.ready(function(K) {window.editor = K.create('#content', {uploadJson : '../kindeditor/php/upload_json.php', fileManagerJson : '../kindeditor/php/file_manager_json.php',allowFileManager : true,items:[
        'source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste',
        'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
        'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
        'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
        'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
        'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
        'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
        'anchor', 'link', 'unlink', '|', 'about'
] });});</script>
		                                                <textarea name='P_content' style='width:100%;height:350px;' id='content'><?php echo $P_content?></textarea>
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-2 col-form-label" ></label>
													<div class="col-md-10">
														<button class="btn btn-info" type="button" onClick="save(1)">保存</button>
														<button class="btn btn-primary" type="button" onClick="save(2)">保存并返回</button>
														<div class="pull-right">无商品可卖？<a href="" target="_balnk" class="btn btn-sm btn-success"><i class="fa fa-shopping-cart"></i> 批发采购</a></div>
													</div>
												</div>
										</div>
									</div>
								</div>
							</div>
							</form>
						</div>
					</section>
				</div>

			</div>
		</div>

		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="assets/plugins/toggle-menu/sidemenu.js"></script>
		<script src="assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>
		<script src="assets/js/scripts.js"></script>
		<script src="assets/js/help.js"></script>
		<script src="assets/plugins/toastr/build/toastr.min.js"></script>

		<script type="text/javascript">
		var $P_selltype=<?php echo $P_selltype?>;
		$("#P_sell1").hide();
		$("#P_sell2").hide();
		$("#P_sell3").hide();
		switch($P_selltype){
			case 0:
			$("#P_sell1").show();
			break;

			case 1:
			$("#P_sell2").show();
			break;

			case 2:
			$("#P_sell3").show();
			break;
		}
		
		function change(id){
			$("#P_sell1").hide();
			$("#P_sell2").hide();
			$("#P_sell3").hide();

			switch(id){
				case 0:
				$("#P_sell1").show();
				break;

				case 1:
				$("#P_sell2").show();
				break;

				case 2:
				$("#P_sell3").show();
				break;
			}
		}

		function save(id){
			editor.sync();
				$.ajax({
            	url:'?action=<?php echo $aa?>',
            	type:'post',
            	data:$("#form").serialize(),
            	success:function (data) {
            	data=JSON.parse(data);
            	if(data.msg=="success"){
            		if(id==1){
	            		if(data.P_id==0){
	            			toastr.success("保存成功", "成功");
	            		}else{
	            			window.location.href="product_add.php?P_id="+data.P_id;
	            		}
            		}else{
            			window.location.href="product_list.php";
            		}
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
