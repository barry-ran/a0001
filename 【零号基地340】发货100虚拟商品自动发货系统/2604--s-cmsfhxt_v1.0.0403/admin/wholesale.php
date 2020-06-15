<?php
require '../conn/conn.php';
require '../conn/function.php';
require 'admin_check.php';

$action=$_GET["action"];

if($action=="save"){
	
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>货源批发 - 后台管理</title>

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
		<link rel="stylesheet" href="assets/plugins/toaster/garessi-notif.css">

		<script type="text/javascript" src="../upload/upload.js"></script>
		<style type="text/css">
		.showpic{height: 50px;border: solid 1px #DDDDDD;padding: 5px;}
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
					<section class="section">
                    	<ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">后台管理</a></li>
                            <li class="breadcrumb-item active" aria-current="page">货源批发</li>
                        </ol>

						<div class="section-body ">
							
							<div class="row">
								
								<div class="col-lg-5">
									<form id="form">
									<div class="card card-primary">
										<div class="card-header ">
											<h4>导入数据</h4>
										</div>
										<div class="card-body">
												<div class="form-group row">
													<label class="col-md-3 col-form-label" >采购码</label>
													<div class="col-md-9">
						                                <input type="text" id="xml" name="xml" class="form-control" value="">
													</div>
												</div>

											<div class="form-group row">
													<label class="col-md-3 col-form-label" >使用步骤</label>
													<div class="col-md-9">
														<p>1.从右侧采购文章或商品，得到一个32位采购码</p>
														<p>2.填入采购码，点击导入数据</p>
													</div>
												</div>

												<div class="form-group row">
													<label class="col-md-3 col-form-label" ></label>
													<div class="col-md-9">
														<button class="btn btn-primary" type="button" onClick="save()">导入数据</button>
													</div>
												</div>

										</div>
									</div>
	
									<p style="font-weight: bold;">功能介绍：</p>
									<p>新网站往往缺少素材，本页面提供海量的文章及商品，可供导入到您自己的网站；</p>
									<p>全部为真实的文章/商品，可以自己定价及出售给用户。</p>
									</form>
								</div>
							


								<div class="col-lg-7">
									<div class="card card-primary">
										<div class="card-header ">
											<h4>货源批发市场</h4>
										</div>
										<div class="card-body">

<ul class="nav nav-tabs" id="myTab" role="tablist">
	<li class="nav-item">
		<a class="nav-link active" id="home-tab2" data-toggle="tab" href="#home2" role="tab" aria-controls="home" aria-selected="true">文章货源</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" id="profile-tab2" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile" aria-selected="false">商品货源</a>
	</li>
	
</ul>

<div class="tab-content tab-bordered" id="myTab2Content">
	<div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab2">
		<form action="http://fhdemo.s-cms.cn/w/api/wholesale.php?type=buy&t=news" method="post" target="_blank">
		<div class="row">
			<input type="hidden" name="domain" value="<?php echo $_SERVER["HTTP_HOST"]?>">
		<?php
			$news=json_decode(file_get_contents("http://fhdemo.s-cms.cn/w/api/wholesale.php?type=news"),true)["news_list"];
			foreach($news as $v) {
				echo "<div class=\"col-md-6 col-sm-12\" style=\"overflow:hidden;height:25px;\"><input type=\"checkbox\" name=\"id[]\" value=\"".$v["N_id"]."\"> <a href=\"http://fhdemo.s-cms.cn/w/?type=newsinfo&id=".$v["N_id"]."\" target=\"_blank\">[￥".$v["N_price"]."] ".$v["N_title"]."</a></div>";
			}
		?>
	<div class="col-md-12">
		<button class="btn btn-info" type="submit">采购</button>
	</div>
	</div>
	</form>
	</div>

	<div class="tab-pane fade" id="profile2" role="tabpanel" aria-labelledby="profile-tab2">
			<form action="http://fhdemo.s-cms.cn/w/api/wholesale.php?type=buy&t=product" method="post" target="_blank">
				<div class="row">
					<input type="hidden" name="domain" value="<?php echo $_SERVER["HTTP_HOST"]?>">
		<?php
			$product=json_decode(file_get_contents("http://fhdemo.s-cms.cn/w/api/wholesale.php?type=product"),true)["product_list"];
			foreach($product as $v) {
				echo "<div class=\"col-md-3 col-sm-12\" >
				<a href=\"http://fhdemo.s-cms.cn/w/?type=productinfo&id=".$v["P_id"]."\" target=\"_blank\"><img src=\"http://fhdemo.s-cms.cn/w/media/".$v["P_pic"]."\" style=\"width:100%\"></a>
				<input type=\"checkbox\" name=\"id[]\" value=\"".$v["P_id"]."\"> <a href=\"http://fhdemo.s-cms.cn/w/?type=productinfo&id=".$v["P_id"]."\" target=\"_blank\">[￥".$v["P_price"]."] ".$v["P_title"]."</a>
				</div>";
			}
		?>
	<div class="col-md-12">
		<button class="btn btn-info" type="submit">采购</button>
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
					</section>
				</div>

			</div>
		</div>

		<!--Jquery.min js-->
		<script src="assets/js/jquery.min.js"></script>

		<!--Bootstrap.min js-->
		<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

		<!--Sidemenu js-->
		<script src="assets/plugins/toggle-menu/sidemenu.js"></script>

		<!--mCustomScrollbar js-->
		<script src="assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>

		<!--Scripts js-->
		<script src="assets/js/scripts.js"></script>

		<script src="assets/plugins/toastr/build/toastr.min.js"></script>


		<script type="text/javascript">
		function save(){
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

		</script>
		
	</body>
</html>
