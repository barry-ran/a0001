<?php 
require '../conn/conn.php';
require '../conn/function.php';
require 'member_check.php';

if($M_type==0 || time()-strtotime($M_sellertime)>$M_sellerlong*365*86400){//商家到期
	Header("Location:seller.php");
	die();
}

$action=$_GET["action"];
$P_id=intval($_GET["P_id"]);

if($P_id!=""){
	$aa="edit&P_id=".$P_id;
	$title="编辑";
	$sql="select * from sl_product,sl_psort where P_sort=S_id and P_id=$P_id and P_mid=$M_id";
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
		$P_fx=$row["P_fx"];
		$P_time=$row["P_time"];
	}
}else{
	$aa="add";
	$title="新增";
	$P_pic="nopic.png";
	$P_selltype=0;
	$P_rest=100;
	$P_fx=1;
	$P_time=date('Y-m-d H:i:s');
}

if(checkauth()){
	plug("x1","../conn/plug/");
	require "../conn/plug/x1.php";
}else{
	die("{\"msg\":\"免费版暂不支持商家入驻功能\"}");
}

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="会员中心">
  <title>会员中心 - <?php echo $C_title?></title>
  <link href="../media/<?php echo $C_ico?>" rel="shortcut icon" />

  <!-- Stylesheets -->
  <link rel="stylesheet" href="../css/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/site.min.css">
  <!-- css plugins -->
  <link rel="stylesheet" href="css/icheck.min.css">
  <link rel="stylesheet" href="css/cropper.min.css">
  <link rel="stylesheet" href="../css/sweetalert.css">
 <script type="text/javascript" src="../upload/upload.js"></script>
		<style type="text/css">
		.showpic{height: 100px;border: solid 1px #DDDDDD;padding: 5px;max-width: 100%}
		.showpicx{width: 100%;max-width: 500px}
		.list-group a{text-decoration:none}

		.btn-danger{margin-top: 10px;}

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

<body class="body-index">
<?php require 'top.php';?>
		<div class="container m_top_30">
			<div class="yto-box">
				<div class="row">
					<div class="col-sm-2 hidden-xs">
			<h5 class="p_bottom_10">商品管理</h5>
		<ul class="nav nav-pills nav-stacked">
	        <li ><a href="product_sell.php">商品列表</a></li>
	        <li class="active"><a href="product_add.php">新增商品</a></li>
	     </ul>
					</div>
					<div class="col-sm-10 b-left">
						
						
						<div class="panel panel-default">
							<div class="panel-heading"><?php echo $title?>商品</div>
							<div class="panel-body">
								<form id="form">
												<div class="form-group row">
													<label class="col-md-2 col-form-label" >商品标题</label>
													<div class="col-md-10">
														<input type="text"  name="P_title" class="form-control" value="<?php echo $P_title?>">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-2 col-form-label" >发布时间</label>
													<div class="col-md-10">
														<input type="text"  name="P_time" class="form-control" value="<?php echo $P_time?>">
													</div>
												</div>


												<div class="form-group row">
													<label class="col-md-2 col-form-label" >商品价格</label>
													<div class="col-md-10">

														<div class="input-group">
														<input type="text"  name="P_price" class="form-control" value="<?php echo $P_price?>">
														<span class="input-group-addon">元</span>
													</div>

													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-2 col-form-label" >商品分类</label>
													<div class="col-md-10">
														<select name="P_sort" class="form-control">
															<?php
																$sql2="select * from sl_psort where S_del=0 and S_sub=0  order by S_order,S_id desc";
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
													<div class="col-md-10">
														<input type="text"  name="P_order" class="form-control" value="<?php echo $P_order?>" placeholder="数字越小越靠前">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-2 col-form-label" >开启分销</label>
													<div class="col-md-10 buy">
														<label aa="P_fx" <?php if($P_fx==0){echo "class='checked'";}?>><input type="radio" name="P_fx" value="0" <?php if($P_fx==0){echo "checked='checked'";}?>> 关闭</label>

														<label aa="P_fx" <?php if($P_fx==1){echo "class='checked'";}?>><input type="radio" name="P_fx" value="1" <?php if($P_fx==1){echo "checked='checked'";}?>> 开启</label>
														<span style="font-size: 12px">*开启分销功能后，您的商品会被其他用户推广，您需要支付相应的佣金（一级佣金<?php echo $C_fx1?>%/二级佣金<?php echo $C_fx2?>%/三级佣金<?php echo $C_fx3?>%）</span>
													</div>
												</div>


												<div class="form-group row">
													<label class="col-md-2 col-form-label" >发货内容</label>
													<div class="col-md-10 buy">
														<label aa="P_selltype" <?php if($P_selltype==0){echo "class='checked'";}?>><input type="radio" name="P_selltype" value="0" onclick="change(0)" <?php if($P_selltype==0){echo "checked='checked'";}?>> [自动发货]固定内容</label>

														<label aa="P_selltype" <?php if($P_selltype==1){echo "class='checked'";}?>><input type="radio" name="P_selltype" value="1" onclick="change(1)" <?php if($P_selltype==1){echo "checked='checked'";}?>> [自动发货]卡密</label>

														<label aa="P_selltype" <?php if($P_selltype==2){echo "class='checked'";}?>><input type="radio" name="P_selltype" value="2" onclick="change(2)" <?php if($P_selltype==2){echo "checked='checked'";}?>> [手动发货]实物</label>
														

														<textarea name="P_sell[]" class="form-control" rows="3" placeholder="输入固定发货内容" id="P_sell1"><?php echo $P_sell?></textarea>

														<div id="P_sell2">
														<select class="form-control" name="P_sell[]">
															<option value="0">请选择一个卡密分类</option>
															<?php
																$sql="select * from sl_csort where S_del=0 and S_mid=$M_id order by S_id desc";
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
														<a href="card_sell.php" target="_blank" class="btn btn-info btn-sm" style="margin-top: 10px;">管理卡密</a>
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

												<div class="form-group row">
													<label class="col-md-2 col-form-label" >商品介绍</label>
													<div class="col-md-10">
														<script charset='utf-8' src='../kindeditor/kindeditor-all-min.js'></script>
		                                                <script charset='utf-8' src='../kindeditor/lang/zh-CN.js'></script>
		                                                <script>KindEditor.ready(function(K) {window.editor = K.create('#content', {uploadJson : '../kindeditor/php/upload_json.php', fileManagerJson : '../kindeditor/php/file_manager_json.php',allowFileManager : true,items:['source', '|', 'fullscreen', 'undo', 'redo', 'print', 'cut', 'copy', 'paste','plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright','justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript','superscript', '|', 'selectall', '-','title', 'fontname', 'fontsize', '|', 'textcolor', 'bgcolor', 'bold','italic', 'underline', 'strikethrough', 'removeformat', '|', 'image','multiimage','flash', 'media', 'advtable', 'hr', 'emoticons', 'link', 'unlink', '|', 'about'] });});</script>
		                                                <textarea name='P_content' style='width:100%;height:350px;' id='content'><?php echo $P_content?></textarea>
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-2 col-form-label" ></label>
													<div class="col-md-10">
														<button class="btn btn-info" type="button" onClick="save(1)">保存</button>
														<button class="btn btn-primary" type="button" onClick="save(2)">保存并返回</button>
														
													</div>
												</div>
											</form>
										</div>
				</div>
			</div>
			</div>
			</div>
			
		</div>

	</div>
	
<?php 
require 'foot.php';
?>

	<!-- js plugins  -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<script src="js/page.js"></script>
	<script src="../js/sweetalert.min.js"></script>
	<script>
$(function() { $('.buy label').click(function(){var aa = $(this).attr('aa');$('[aa="'+aa+'"]').removeAttr('class') ;$(this).attr('class','checked');});});
	</script>
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
	            			alert("保存成功");
	            		}else{
	            			window.location.href="product_add.php?P_id="+data.P_id;
	            		}
            		}else{
            			window.location.href="product_sell.php";
            		}
            	}else{
            		alert(data.msg);
            	}
            	}
            });

			}
		</script>
</body>
</html>