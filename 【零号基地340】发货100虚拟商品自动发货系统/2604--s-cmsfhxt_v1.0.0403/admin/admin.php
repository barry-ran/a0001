<?php
require '../conn/conn.php';
require '../conn/function.php';
require 'admin_check.php';

$action=$_GET["action"];
$A_id=intval($_GET["A_id"]);

if($A_id!=""){
	$aa="edit&A_id=".$A_id;
	$sql="select * from sl_admin where A_id=".$A_id;

	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	if (mysqli_num_rows($result) > 0) {
		$A_head=$row["A_head"];
		$A_login=$row["A_login"];
	}
	$title="编辑";
}else{
	$A_head="nopic.png";
	$aa="add";
	$title="新增";
}

if($action=="add"){
$A_head=$_POST["A_head"];
$A_login=$_POST["A_login"];
$A_pwd=$_POST["A_pwd"];

if($A_login!="" && $A_pwd!=""){

	if(preg_match('/<|(|\*|--|#| |\'|"|\.\//i', $A_login)){
		die("{\"msg\":\"用户名含有特殊字符，请重新输入\"}");
	}

	if(getrs("select * from sl_admin where A_login='$A_login' and A_del=0","A_id")==""){
		mysqli_query($conn,"insert into sl_admin(A_head,A_login,A_pwd) values('$A_head','$A_login','".md5($A_pwd)."')");
		$A_id=getrs("select * from sl_admin where A_login='$A_login' and A_del=0","A_id");
		mysqli_query($conn, "insert into sl_log(L_aid,L_time,L_add,L_ip,L_title) values(".$_SESSION["A_id"].",'".date('Y-m-d H:i:s')."','".$_SESSION["add"]."','".getip()."','新增管理员')");
		die("{\"msg\":\"success\",\"id\":\"".$A_id."\"}");
	}else{
		die("{\"msg\":\"已存在同名记录\"}");
	}
	
}else{
	die("{\"msg\":\"请填全信息\"}");
}

}

if($action=="edit"){
$A_head=$_POST["A_head"];
$A_login=$_POST["A_login"];
$A_pwd=$_POST["A_pwd"];

if($A_login!=""){

	if(preg_match('/<|\(|\*|--|#| |\'|"|\.\//i', $A_login)){
		die("{\"msg\":\"用户名含有特殊字符，请重新输入\"}");
	}

	if($A_pwd!=""){
		mysqli_query($conn, "update sl_admin set
		A_head='$A_head',
		A_login='$A_login',
		A_pwd='".md5($A_pwd)."'
		where A_id=".$A_id);
	}else{
		mysqli_query($conn, "update sl_admin set
		A_head='$A_head',
		A_login='$A_login'
		where A_id=".$A_id);
	}
	mysqli_query($conn, "insert into sl_log(L_aid,L_time,L_add,L_ip,L_title) values(".$_SESSION["A_id"].",'".date('Y-m-d H:i:s')."','".$_SESSION["add"]."','".getip()."','编辑管理员')");
	die("{\"msg\":\"success\",\"id\":\"".$A_id."\"}");
}else{
	die("{\"msg\":\"请填全信息\"}");
}
}

if($action=="delall"){
	$id=$_POST["id"];
	if(count($id)>0) {
		$shu=0 ;
		for ($i=0 ;$i<count($id);$i++ ) {
			mysqli_query($conn,"update sl_admin set A_del=1 where A_id=".intval($id[$i]));
			$shu=$shu+1 ;
			$ids=$ids.$id[$i].",";
		}
		$ids= substr($ids,0,strlen($ids)-1);
		if($shu>0) {
			die("{\"msg\":\"success\",\"ids\":\"".$ids."\"}");
		} else {
			die("{\"msg\":\"删除失败\"}");
		}

	} else {
		die("{\"msg\":\"未选择要删除的内容\"}");
	}
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $title?>管理员 - 后台管理</title>

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
		.showpic{height: 100px;border: solid 1px #DDDDDD;padding: 5px;}
		.showpicx{width: 100%;max-width: 300px}
		.list-group a{text-decoration:none}
		.part{display:inline-block;width:30%;overflow:hidden;text-overflow:ellipsis;white-space: nowrap;}
	</style>
	</head>

	<body class="app ">

		<div id="spinner"></div>

		<div id="app">
			<div class="main-wrapper" >
				
					<?php
					require 'nav.php';
					?>

				<div class="app-content">
					<a href="recycle.php" class="btn btn-info pull-right" style="z-index: 2;position: relative;"><i class="fa fa-recycle"></i> 回收站</a>
					<section class="section">
                    	<ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">后台管理</a></li>
                            <li class="breadcrumb-item active" aria-current="page">管理员管理</li>
                        </ol>


						<div class="section-body ">
							
							<div class="row">
								
								<div class="col-lg-5">
									<form id="list">
									<div class="card card-primary">

										<div class="card-header">
											<h4>管理员列表</h4>
										</div>
												<ul class="list-group">
													<?php 
														$sql="select * from sl_admin where A_del=0 order by A_id desc limit 20";
																$result = mysqli_query($conn, $sql);
																if (mysqli_num_rows($result) > 0) {
																while($row = mysqli_fetch_assoc($result)) {
																	if($row["A_id"]==$A_id){
																		$active="active";
																	}else{
																		$active="";
																	}
																	echo "<a id=\"".$row["A_id"]."\" href=\"?A_id=".$row["A_id"]."\" class=\"list-group-item ".$active."\">
																	<div class=\"part\"><input type=\"checkbox\" name=\"id[]\" value=\"".$row["A_id"]."\"> ".$row["A_login"]."</div> 
																	
																	<img src=\"../media/".$row["A_head"]."\" alt=\"<img src='../media/".$row["A_head"]."' width='300'>\" style=\"height:25px;border-radius:10px;\" class=\"pull-right\"></a>";
																}
															}
													?>
													
												</ul>
									</div>
									<label><input type="checkbox" id="selectAll" name="selectAll"> 全选</label>
									<button class="btn btn-sm btn-danger" type="button" onClick="delall()"><i class="fa fa-times-circle" ></i> 删除所选</button>
									<a href="admin.php" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> 新增管理员</a>
								</form>
								</div>
								<?php if($action!="menu"){?>
								
								<div class="col-lg-7">
									<form id="form">
									<div class="card card-primary">
										<div class="card-header ">
											<h4><?php echo $title?>管理员</h4>
										</div>
										<div class="card-body">
												<div class="form-group row">
													<label class="col-md-3 col-form-label" >管理员帐号</label>
													<div class="col-md-9">
														<input type="text"  name="A_login" class="form-control" value="<?php echo $A_login?>">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-3 col-form-label" >管理员密码</label>
													<div class="col-md-9">
														<input type="text" name="A_pwd" class="form-control" value="" placeholder="<?php
														if($A_id!=""){
															echo "留空则不修改密码";
														}
														?>">
														
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-3 col-form-label" >管理员头像</label>
													<div class="col-md-9">
														<p><img src="../media/<?php echo $A_head?>" id="A_headx" class="showpic" onClick="showUpload('A_head','A_head','../media',1,null,'','');" alt="<img src='../media/<?php echo $A_head?>' class='showpicx'>"></p>
														<div class="input-group">
															
						                                        <input type="text" id="A_head" name="A_head" class="form-control" value="<?php echo $A_head?>">
						                                        <span class="input-group-btn">
						                                                <button class="btn btn-primary m-b-5 m-t-5" type="button" onClick="showUpload('A_head','A_head','../media',1,null,'','');">上传</button>
						                                        </span>
						                                </div>
														
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-3 col-form-label" ></label>
													<div class="col-md-9">
														<button class="btn btn-info" type="button" onClick="save()">保存</button>

														
													</div>
												</div>
										</div>
									</div>
									</form>
								</div>
							
							<?php }?>
							
							</div>
							
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
		function save(){
				$.ajax({
            	url:'?action=<?php echo $aa?>',
            	type:'post',
            	data:$("#form").serialize(),
            	success:function (data) {
            	data=JSON.parse(data);
            	if(data.msg=="success"){
            		toastr.success("保存成功，2秒后刷新", "成功");
            		setTimeout("window.location.href='admin.php?A_id="+data.id+"'", 2000 )
            	}else{
            		toastr.error(data.msg, '错误');
            	}
            	}
            });

			}
function delall() {
    if (confirm("确定删除吗？") == true) {
        $.ajax({
            url: '?action=delall',
            type: 'post',
            data: $("#list").serialize(),
            success: function(data) {
                data = JSON.parse(data);
                if (data.msg == "success") {
                    toastr.success("删除成功", "成功");
                    id = data.ids.split(",");
                    for (var i = 0; i < id.length; i++) {
                        $("#" + id[i]).hide();
                    };
                } else {
                    toastr.error(data.msg, '错误');
                }
            }
        });
        return true;
    } else {
        return false;
    }
}

$('input[name="selectAll"]').on("click",function(){
        if($(this).is(':checked')){
            $('input[name="id[]"]').each(function(){
                $(this).prop("checked",true);
            });
        }else{
            $('input[name="id[]"]').each(function(){
                $(this).prop("checked",false);
            });
        }
    });
		</script>
		
	</body>
</html>
