<?php 
require '../conn/conn.php';
require '../conn/function.php';

if($C_memberon==0){
    box("会员中心未开放","../","error");
}

$from = $_GET["from"];
$action = $_GET["action"];
$genkey=gen_key(20);

$D_domain=splitx($_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"],"/member",0);

if($from==""){
	$from="index.php";
}

if($action == "quick"){
    $sql = "select * from sl_member where M_id=".intval($_GET["M_id"])." and M_pwd='" . xcode($_GET["M_pwd"],"DECODE",intval($_GET["M_id"])) . "' and M_del=0";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION["M_login"] = $row["M_login"];
        $_SESSION["M_id"] = $row["M_id"];
        $_SESSION["M_pwd"] = $row["M_pwd"];
        Header("Location:".$from);
    }
}

if ($action == "unlogin") {
    $_SESSION["M_login"] = "";
    $_SESSION["M_id"] = "";
    $_SESSION["M_pwd"] = "";
    box("退出成功!", "login.php", "success");
}

if ($action == "login") {
    $M_email = t($_POST["M_email"]);
    $M_pwd = $_POST["M_pwd"];
    $M_code = $_POST["M_code"];
    
    if((xcode($_POST["M_code"],'DECODE',$_SESSION["CmsCode"],0)!=$_SESSION["CmsCode"] || $_POST["M_code"]=="" || $_SESSION["CmsCode"]=="") && $C_slide==1){
        box("验证码错误!".$_SESSION["CmsCode"]."|".xcode($_POST["M_code"],'DECODE',$_SESSION["CmsCode"],0), "back", "error");
    } else {
        $sql = "Select * from sl_member where (M_email='" . $M_email . "' or M_login='" . $M_email . "') and M_pwd='" . md5($M_pwd) . "' and M_del=0";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION["M_login"] = $row["M_login"];
            $_SESSION["M_id"] = $row["M_id"];
            $_SESSION["M_pwd"] = md5($M_pwd);
            Header("Location:".$from);
        } else {
            box("帐号或密码错误!", "back", "error");
        }
    }
}

if($_SESSION["M_login"]!=="" && $_SESSION["M_pwd"]!="" && $_SESSION["M_id"]!=""){
    die("<script>window.location.href=\"$from\"</script>");
}

?>

<!DOCTYPE HTML>
<html>
<head>
<title>会员登录 - <?php echo $C_title?></title>
<meta name="renderer" content="webkit">
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="generator" data-variable="" />
<link href="../media/<?php echo $C_ico?>" rel="shortcut icon" type="image/x-icon" />
<link rel='stylesheet' type='text/css' href="css/account.css">
</head>
<!--[if lte IE 8]>
<div class="text-center margin-bottom-0 bg-blue-grey-100 alert">
    <button type="button" class="close" aria-label="Close" data-dismiss="alert">
        <span aria-hidden="true">×</span>
    </button>
    你正在使用一个 <strong>过时</strong> 的浏览器。请 <a href="http://browsehappy.com/" target="_blank">升级您的浏览器</a>，以提高您的体验。
</div>
<![endif]-->

<body class="page-register-v3 layout-full">
<div class="page animsition vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">>
    <div class="page-content vertical-align-middle">
        <div class="panel">
            <div class="panel-body">

<div class="brand">
	<a href="../"><img class="brand-img" src="../media/<?php echo $C_logo?>"></a>
	<h2 class="brand-text font-size-20 margin-top-20">会员登录</h2>
</div>

                <form method="post" class="met-form-validation" action="?action=login&from=<?php echo urlencode($from)?>">
                    <input type="hidden" name="add">
                    <div class="form-group form-material floating">
                        <input type="text" class="form-control"  name="M_email" />
                        <label class="floating-label">邮箱/帐号</label>
                    </div>
                    
                    <div class="form-group form-material floating">
                        <input
                        type="password" class="form-control" name="M_pwd"
                        data-fv-notempty="true"
                        maxlength="100"
                        minlength="1"
                        />
                        <label class="floating-label">密码</label>
                    </div>
                    <?php if($C_slide==1){
                        echo "<div class=\"form-group form-material floating\" style=\"position: relative;\">
                        <iframe src=\"../conn/code_1.php?name=M_code\" scrolling=\"no\" frameborder=\"0\" width=\"100%\" height=\"40\"></iframe>
                    </div>";
                    }?>
                    
                    
                    <button type="submit" class="btn btn-primary btn-block btn-lg margin-top-10">登录</button>
                </form>
                <p>
                    <?php 
                    if($C_qqon==1){
                        echo "<a href=\"../qq/qqlogin.php?from=".urlencode($from)."\"><img src=\"../images/qqlogin.png\"></a>";
                    }
                    if($C_wxon==1){
                    	if(isMobile()){
                    		echo " <a href=\"".gethttp().$D_domain."/pay/wxpay/login.php?from=".urlencode($from)."&genkey=".$genkey."_".intval($_SESSION["uid"])."\"><img src=\"../images/wxlogin.png\"></a>";
                    	}else{
                    		echo " <img src=\"../images/wxlogin.png\" alt=\"<img src='https://static.websiteonline.cn/website/qr/index.php?url=".gethttp().$D_domain."/pay/wxpay/login.php?genkey=".$genkey."_".intval($_SESSION["uid"])."' width='150'>\">";
                    	}
                    }
                    ?>
                </p>
                <p>还没有账号? 去 <a href="reg.php?from=<?php echo urlencode($from)?>">注册</a> <a href="forget.php">忘记密码？</a></p>
            </div>
        </div>

<footer class="page-copyright page-copyright-inverse">
	<p class="txt">
		<span class="beian"> <?php echo $C_beian?></a>
        </span>
	</p>
	<div class=""><?php echo $C_copyright?>
	</div>
</footer>

    </div>
</div>
<script src="js/account.js"></script>
<script src="js/help.js"></script>
<script type="text/javascript">
function test(){
$.post("post.php",
    {
      genkey:"<?php echo $genkey."_".intval($_SESSION["uid"])?>",
    },
    function(data){
  if(data==1){
  document.location.href='login.php?from=<?php echo urlencode($from)?>'
  }
    });
}
setInterval("test()",3000); //每3秒钟执行一次test()
</script>
</body>
</html>
