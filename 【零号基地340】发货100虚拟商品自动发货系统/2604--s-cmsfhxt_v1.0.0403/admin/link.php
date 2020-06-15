<?php
require '../conn/conn.php';
require '../conn/function.php';
require 'admin_check.php';

$page=$_GET["page"];
$action=$_GET["action"];
$L_id=intval($_GET["L_id"]);

if($page==""){
	$page=1;
}

if($L_id!=""){
	$aa="edit&L_id=".$L_id;
	$sql="select * from sl_link where L_id=".$L_id;

	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	if (mysqli_num_rows($result) > 0) {
		$L_pic=$row["L_pic"];
		$L_order=$row["L_order"];
		$L_title=$row["L_title"];
		$L_content=$row["L_content"];
		$L_link=$row["L_link"];
	}
	$title="编辑";
}else{
	$L_pic="nopic.png";
	$aa="add";
	$title="新增";
}

if($action=="add"){
$L_pic=$_POST["L_pic"];
$L_order=intval($_POST["L_order"]);
$L_title=$_POST["L_title"];
$L_content=$_POST["L_content"];
$L_link=$_POST["L_link"];

if($L_title!=""){
	if(getrs("select * from sl_link where L_title='$L_title' and L_del=0","L_id")==""){
		mysqli_query($conn,"insert into sl_link(L_pic,L_order,L_title,L_content,L_link) values('$L_pic',$L_order,'$L_title','$L_content','$L_link')");
		$L_id=getrs("select * from sl_link where L_title='$L_title' and L_del=0","L_id");
		mysqli_query($conn, "insert into sl_log(L_aid,L_time,L_add,L_ip,L_title) values(".$_SESSION["A_id"].",'".date('Y-m-d H:i:s')."','".$_SESSION["add"]."','".getip()."','新增友链')");
		die("{\"msg\":\"success\",\"id\":\"".$L_id."\"}");
	}else{
		die("{\"msg\":\"已存在同名记录\"}");
	}
	
}else{
	die("{\"msg\":\"请填全信息\"}");
}

}

if($action=="edit"){
$L_pic=$_POST["L_pic"];
$L_order=intval($_POST["L_order"]);
$L_title=$_POST["L_title"];
$L_content=$_POST["L_content"];
$L_link=$_POST["L_link"];

if($L_title!=""){

	mysqli_query($conn, "update sl_link set
	L_pic='$L_pic',
	L_title='$L_title',
	L_order=$L_order,
	L_content='$L_content',
	L_link='$L_link'
	where L_id=".$L_id);
	mysqli_query($conn, "insert into sl_log(L_aid,L_time,L_add,L_ip,L_title) values(".$_SESSION["A_id"].",'".date('Y-m-d H:i:s')."','".$_SESSION["add"]."','".getip()."','编辑友链')");
	die("{\"msg\":\"success\",\"id\":\"".$L_id."\"}");
}else{
	die("{\"msg\":\"请填全信息\"}");
}
}

if($action=="delall"){
	$id=$_POST["id"];
	if(count($id)>0) {
		$shu=0 ;
		for ($i=0 ;$i<count($id);$i++ ) {
			mysqli_query($conn,"update sl_link set L_del=1 where L_id=".intval($id[$i]));
			$shu=$shu+1 ;
			$ids=$ids.$id[$i].",";
		}
		$ids= substr($ids,0,strlen($ids)-1);
		if($shu>0) {
			mysqli_query($conn, "insert into sl_log(L_aid,L_time,L_add,L_ip,L_title) values(".$_SESSION["A_id"].",'".date('Y-m-d H:i:s')."','".$_SESSION["add"]."','".getip()."','批量删除友链')");
			die("{\"msg\":\"success\",\"ids\":\"".$ids."\"}");
		} else {
			die("{\"msg\":\"删除失败\"}");
		}

	} else {
		die("{\"msg\":\"未选择要删除的内容\"}");
	}
}


$sql="select count(L_id) as L_count from sl_link where L_del=0";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$L_counts=$row["L_count"];

?>
<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $title?>友链 - 后台管理</title>

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
		.showpic{height: 50px;border: solid 1px #DDDDDD;padding: 5px;}
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
                            <li class="breadcrumb-item active" aria-current="page">友链管理</li>
                        </ol>


						<div class="section-body ">
							
							<div class="row">
								
								<div class="col-lg-5">
									<form id="list">
									<div class="card card-primary">

										<div class="card-header">
											<h4>友链列表</h4>
										</div>
												<ul class="list-group">
													<li class="list-group-item " style="background: #f7f7f7"><div class="part">友链网站</div><div class="part">网址</div></li>
													<?php 
														$sql="select * from sl_link where L_del=0 order by L_order asc,L_id desc limit ".(($page-1)*20).",20";
																$result = mysqli_query($conn, $sql);
																if (mysqli_num_rows($result) > 0) {
																while($row = mysqli_fetch_assoc($result)) {
																	if($row["L_id"]==$L_id){
																		$active="active";
																	}else{
																		$active="";
																	}
																	echo "<a id=\"".$row["L_id"]."\" href=\"?L_id=".$row["L_id"]."\" class=\"list-group-item ".$active."\">
																	<div class=\"part\"><input type=\"checkbox\" name=\"id[]\" value=\"".$row["L_id"]."\"> ".$row["L_order"].".".$row["L_title"]."</div> 
																	<div class=\"part\">".$row["L_link"]."</div>
																	<img src=\"../media/".$row["L_pic"]."\" alt=\"<img src='../media/".$row["L_pic"]."' class='showpicx'>\" style=\"height:25px;border-radius:10px;\" class=\"pull-right\"></a>";
																}
															}
													?>
													
												</ul>
									</div>
									<label><input type="checkbox" id="selectAll" name="selectAll"> 全选</label>
									<button class="btn btn-sm btn-danger" type="button" onClick="delall()"><i class="fa fa-times-circle" ></i> 删除所选</button>
									<a href="link.php" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> 新增友链</a>
									<ul class="pagination" id="pagination" style="float: right;"></ul>
									<input type="hidden" id="PageCount" runat="server" />
        <input type="hidden" id="PageSize" runat="server" value="20" />
        <input type="hidden" id="countindex" runat="server" value="20"/>
        <!--设置最多显示的页码数 可以手动设置 默认为7-->
        <input type="hidden" id="visiblePages" runat="server" value="7" />
								</form>
								</div>
								<?php if($action!="menu"){?>
								
								<div class="col-lg-7">
									<form id="form">
									<div class="card card-primary">
										<div class="card-header ">
											<h4><?php echo $title?>友链</h4>
										</div>
										<div class="card-body">
												<div class="form-group row">
													<label class="col-md-3 col-form-label" >友链网站</label>
													<div class="col-md-9">
														<input type="text"  name="L_title" class="form-control" value="<?php echo $L_title?>">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-3 col-form-label" >友链排序</label>
													<div class="col-md-9">
														<input type="text"  name="L_order" class="form-control" value="<?php echo $L_order?>" placeholder="数字越小，排序越靠前">
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-md-3 col-form-label" >友链网址</label>
													<div class="col-md-9">
														<input type="text"  name="L_link" class="form-control" value="<?php echo $L_link?>">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-3 col-form-label" >友链LOGO</label>
													<div class="col-md-9">
														<p><img src="../media/<?php echo $L_pic?>" id="L_picx" class="showpic" onClick="showUpload('L_pic','L_pic','../media',1,null,'','');" alt="<img src='../media/<?php echo $L_pic?>' class='showpicx'>"></p>
														<div class="input-group">
															
						                                        <input type="text" id="L_pic" name="L_pic" class="form-control" value="<?php echo $L_pic?>">
						                                        <span class="input-group-btn">
						                                                <button class="btn btn-primary m-b-5 m-t-5" type="button" onClick="showUpload('L_pic','L_pic','../media',1,null,'','');">上传</button>
						                                        </span>
						                                </div>
														
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-3 col-form-label" >友链备注</label>
													<div class="col-md-9">
														<textarea class="form-control" rows="3" name="L_content"><?php echo $L_content?></textarea>
														
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

		<!--Jquery.min js-->
		<script src="assets/js/jquery.min.js"></script>

		<!--popper js-->
		<script src="assets/js/popper.js"></script>

		<!--Tooltip js-->
		<script src="assets/js/tooltip.js"></script>

		<script src="assets/js/help.js"></script>

		<!--Bootstrap.min js-->
		<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

		<!--Jquery.nicescroll.min js-->
		<script src="assets/plugins/nicescroll/jquery.nicescroll.min.js"></script>

		<!--mCustomScrollbar js-->
		<script src="assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>

		<!--Scroll-up-bar.min js-->
		<script src="assets/plugins/scroll-up-bar/dist/scroll-up-bar.min.js"></script>

		<!--Sidemenu js-->
		<script src="assets/plugins/toggle-menu/sidemenu.js"></script>

		<!--Scripts js-->
		<script src="assets/js/scripts.js"></script>

		<script src="assets/plugins/toastr/build/toastr.min.js"></script>
		<script src="assets/plugins/toaster/garessi-notif.js"></script>

		<script src="assets/plugins/toaster/garessi-notif.js"></script>
		<script src="assets/js/jqPaginator.min.js" type="text/javascript"></script>

		<script type="text/javascript">

		function loadData(num) {
            $("#PageCount").val("<?php echo $L_counts?>");
        }
function loadpage(id) {
    var myPageCount = parseInt($("#PageCount").val());
    var myPageSize = parseInt($("#PageSize").val());
    var countindex = myPageCount % myPageSize > 0 ? (myPageCount / myPageSize) + 1 : (myPageCount / myPageSize);
    $("#countindex").val(countindex);

    $.jqPaginator('#pagination', {
        totalPages: parseInt($("#countindex").val()),
        visiblePages: parseInt($("#visiblePages").val()),
        currentPage: id,
        first: '<li class="first page-item"><a href="javascript:;" class="page-link">|<</a></li>',
        prev: '<li class="prev page-item"><a href="javascript:;" class="page-link"><i class="arrow arrow2"></i><</a></li>',
        next: '<li class="next page-item"><a href="javascript:;" class="page-link">><i class="arrow arrow3"></i></a></li>',
        last: '<li class="last page-item"><a href="javascript:;" class="page-link">>|</a></li>',
        page: '<li class="page page-item"><a href="javascript:;" class="page-link">{{page}}</a></li>',
        onPageChange: function (num, type) {
            if (type == "change") {
                window.location="link.php?page="+num;
            }
        }
    });
}
$(function () {
    loadData(<?php echo $page?>);
    loadpage(<?php echo $page?>);

});

		function save(){
				$.ajax({
            	url:'?action=<?php echo $aa?>',
            	type:'post',
            	data:$("#form").serialize(),
            	success:function (data) {
            	data=JSON.parse(data);
            	if(data.msg=="success"){
            		toastr.success("保存成功，2秒后刷新", "成功");
            		setTimeout("window.location.href='link.php?L_id="+data.id+"'", 2000 )
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
