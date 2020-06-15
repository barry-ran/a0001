<script type="text/javascript">
function auth(){
	$.post("api.php?action=get_auth", {
	    authcode: $("#authcode").val(),
	},
	function(data) {
	    if(data == "success") {
	        toastr.success("授权成功！请重启浏览器", '成功');
	    }else{
	    	toastr.error(data, '错误');
	    	$('#largeModal').modal('show');
	    	$("#auth_pay").html("<iframe src='https://fahuo100.cn/pay' scrolling='no' name='mapif' type='1' frameborder='0' height='820' width='100%'></iframe>");
	    }
	});
}
</script>

<nav class="navbar navbar-expand-lg main-navbar">
					<a class="header-brand" href="./">
						<img src="../media/<?php echo $C_logo?>" class="header-brand-img">
					</a>
					
					<form class="form-inline mr-auto">
						<ul class="navbar-nav mr-3">
							<li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="ion ion-navicon-round"></i></a></li>
							<li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-md-none navsearch"><i class="ion ion-search"></i></a></li>
						</ul>
						<?php if($_COOKIE["auth"]!="success"){?>
						<div class="search-element">
							<input class="form-control" type="search" placeholder="授权码" aria-label="Search" id="authcode">
							<button class="btn btn-primary" type="button" onclick="auth()"><i class="fa fa-check"></i></button>
						</div>
						<?php }?>
					</form>
					

					<ul class="navbar-nav navbar-right">

						<li class="dropdown dropdown-list-toggle">
							<a href="#" class="nav-link nav-link-lg full-screen-link">
								<i class="ion-arrow-expand" id="fullscreen-button"></i>
							</a>
						</li>
						<li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg">
							<img src="../media/<?php echo $_SESSION["A_head"]?>" class="rounded-circle w-32">
							<div class="d-sm-none d-lg-inline-block"><?php echo $_SESSION["A_login"]?></div></a>
							<div class="dropdown-menu dropdown-menu-right">
								<a href="login.php?action=unlogin" class="dropdown-item has-icon">
									<i class="ion-ios-redo"></i> 退出登录
								</a>
								<a href="../" class="dropdown-item has-icon" target="_blank">
									<i class="ion-arrow-right-a"></i> 前往首页
								</a>
							</div>
						</li>

					</ul>
				</nav>

				<aside class="app-sidebar">
					<div class="app-sidebar__user">
					    <div class="dropdown">
							<div class="nav-link pl-2 pr-2 leading-none d-flex" data-toggle="dropdown" >
								<img  src="../media/<?php echo $_SESSION["A_head"]?>" class=" avatar-md rounded-circle">
								<span class="ml-2 d-lg-block">
									<span class="text-white app-sidebar__user-name mt-5"><?php echo $_SESSION["A_login"]?></span><br>
									<a href="member_vip.php"><span class="text-muted app-sidebar__user-name text-sm"> 管理员</span></a>
								</span>
							</div>
						</div>
					</div>
					<style>
.side-menu li{display: inline}
				</style>
<ul class="side-menu">		
	<li>
		<a class="side-menu__item" href="index.php"><i class="side-menu__icon fa fa-home"></i><span class="side-menu__label">后台首页</span></a>
	</li>
	<li class="slide">
		<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-cog"></i><span class="side-menu__label">系统设置</span><i class="angle fa fa-angle-right"></i></a>
		<ul class="slide-menu">
			<li><a href="config.php" class="slide-item"> 基本设置</a></li>
			<li><a href="vip.php" class="slide-item"> VIP会员设置</a></li>
			<li><a href="template.php" class="slide-item"> 模板管理</a></li>
			<li><a href="slide.php?action=menu" class="slide-item"> 焦点图管理</a></li>
			<li><a href="link.php?action=menu" class="slide-item"> 友链管理</a></li>
			<li><a href="menu.php?action=menu" class="slide-item"> 菜单设置</a></li>
		</ul>
	</li>
	<li class="slide">
		<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-star"></i><span class="side-menu__label">内容管理</span><i class="angle fa fa-angle-right"></i></a>
		<ul class="slide-menu">
			<li><a href="text.php?action=menu" class="slide-item"> 单页管理</a></li>
			<li><a href="product_list.php" class="slide-item"> 商品管理</a></li>
			<li><a href="news_list.php" class="slide-item"> 文章管理</a></li>
			<li><a href="card_list.php" class="slide-item"> 卡密管理</a></li>
		</ul>
	</li>

	<li class="slide">
		<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-list"></i><span class="side-menu__label">交易管理</span><i class="angle fa fa-angle-right"></i></a>
		<ul class="slide-menu">
			<li><a href="orders_list.php" class="slide-item"> 订单管理</a></li>
			<li><a href="evaluate.php?action=menu" class="slide-item"> 评价管理</a></li>
			<li><a href="list.php" class="slide-item"> 资金明细</a></li>
			<li><a href="rcard_list.php" class="slide-item"> 会员充值卡</a></li>
		</ul>
	</li>

	<li class="slide">
		<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-users"></i><span class="side-menu__label">账户管理</span><i class="angle fa fa-angle-right"></i></a>
		<ul class="slide-menu">
			<li><a href="admin.php?action=menu" class="slide-item"> 管理员管理</a></li>
			<li><a href="member.php?action=menu&type=0" class="slide-item"> 会员管理</a></li>
			<li><a href="member.php?action=menu&type=1" class="slide-item"> 商家管理</a></li>
		</ul>
	</li>

	<li class="slide">
		<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-list"></i><span class="side-menu__label">其他设置</span><i class="angle fa fa-angle-right"></i></a>
		<ul class="slide-menu">
			<li><a href="log.php" class="slide-item"> 操作日志</a></li>
			<li><a href="recycle.php" class="slide-item"> 回收站</a></li>
			<li><a href="guestbook.php?action=menu" class="slide-item"> 留言管理</a></li>
			
			
		</ul>
	</li>

	<li>
		<a class="side-menu__item" href="update.php"><i class="side-menu__icon fa fa-refresh"></i><span class="side-menu__label">检测更新</span></a>
	</li

	
	<?php if($_COOKIE["auth"]!="success"){?>
	<li>
		<a class="side-menu__item" href="javascript:;" onclick="$('#largeModal').modal('show');$('#auth_pay').html('<iframe src=\'https://fahuo100.cn/pay.html\' name=\'mapif\' type=\'1\' frameborder=\'0\' height=\'820\' width=\'100%\'></iframe>')"><i class="side-menu__icon fa fa-home"></i><span class="side-menu__label">购买授权</span></a>
	</li>
	<?php }?>
</ul>
</aside>

<!-- Large Modal -->
<div id="largeModal" class="modal fade">
	<div class="modal-dialog modal-lg" role="document" >
		<div class="modal-content " style="width: 1000px">
			<div class="modal-header pd-x-20">
				<h6 class="modal-title">购买授权</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div id="auth_pay"></div>
		</div>
	</div><!-- modal-dialog -->
</div><!-- modal -->