<fh-function>
$page=$_GET["page"];
$tag=t($_GET["tag"]);

if($tag==""){
  $taginfo="";
}else{
  $taginfo=" and CONCAT(\" \",P_tag,\" \") like '% ".$tag." %'";
}

$M_id=$_GET["M_id"];
if($page==""){
  $page=1;
}
if($M_id!=""){
  $M_info=" and P_mid=$M_id ".$taginfo;
}else{
  $M_info=" and P_sh=1".$taginfo;
}

$sql="select * from sl_psort where S_id=".$id;
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  if (mysqli_num_rows($result) > 0) {
    $S_sub=$row["S_sub"];
  }

if($id==0){
  $sql="select count(P_id) as P_count from sl_product where P_del=0 $M_info order by P_order,P_id desc";
}else{
  if($S_sub==0){
    $sql="select count(P_id) as P_count from sl_product,sl_psort where S_del=0 $M_info and P_del=0 and P_sort=S_id and S_sub=".$id." order by P_order,P_id desc";
  }else{
    $sql="select count(P_id) as P_count from sl_product,sl_psort where S_del=0 $M_info and P_del=0 and P_sort=S_id and S_id=".$id." order by P_order,P_id desc";
  }
}

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$P_count=$row["P_count"];

$page_num=intval($P_count/10)+1;
if($P_count%10 ==0){
  $page_num=$page_num-1;
}

</fh-function>

<!DOCTYPE HTML>
<html class="  ">
<head>
<meta name="renderer" content="webkit">
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="generator" content="fahuo100.cn"  data-variable="/,cn,10001,,10001,M1156014" />
<title>[S_title] - [fh_title]</title>
<link href="media/[fh_ico]" rel="shortcut icon" />
<meta name="description" content="[fh_description]" />
<meta name="keywords" content="[fh_keyword]" />
<meta name="author" content="powered by fahuo100.cn" />
<link rel='stylesheet' href='template/t1/skin/css/index.css'>
<link href="css/Pager.css" rel="stylesheet" type="text/css" />

</head>
<body>
<!--[if lte IE 8]>
<div class="text-center padding-top-50 padding-bottom-50 bg-blue-grey-100">
  <p class="browserupgrade font-size-18">
	你正在使用一个<strong>过时</strong>的浏览器。请<a href="http://browsehappy.com/" target="_blank">升级您的浏览器</a>，以提高您的体验。
  </p>
</div>
<![endif]-->
<div class="load-box"></div>
<header>

  <div class="head-box">
    <div class="container">
      <div class="head-left">
        <div class="head-left-wrapper">
          <div class="head-left-slide">
            <p>欢迎来到[fh_title]！</p>
            <font>
            <hr>
            <a id="met-weixins"><i class="fa fa-weixin" data-plugin="webuiPopover" data-trigger="hover" data-animation="pop" data-placement='bottom' data-width='130' data-padding='0' data-content="<img src='media/[fh_qrcode]' alt='[fh_title]' style='width: 120px;display:block;margin:auto;'>"></i></a>
            
             </font> </div>
        </div>
      </div>
      <div class="head-right"> 
        <fh-function>
      if($_SESSION["M_login"]==""){
        $api=$api."<a class=\"login\" href=\"member/login.php\">登录</a>
              <hr>
              <a class=\"login\" href=\"member/reg.php\">注册</a>";
      }else{
        $api=$api."<a class=\"login\" href=\"member\">".$_SESSION["M_login"]."</a>
              <hr>
              <a class=\"login\" href=\"member/login.php?action=unlogin\">退出</a>";
      }
        </fh-function>
        <li class="dropdown shopcut"> <a href="member/cart.php"> <i class="icon wb-shopping-cart" aria-hidden="true"></i> <font>购物车</font> <span class="badge badge-danger up hide topcart-goodnum"></span> </a> </li>
      </div>
    </div>
  </div>
  <nav>
    <div class="neck-box">
      <div class="container">
        <div class="logo-box"> <a href="./" title="[fh_title]"> <img src="media/[fh_logo]" alt="[fh_title]"> <img src="media/[fh_logo]" alt="[fh_title]"> </a> </div>
        <div class="search-box">
          <div class="search-cut">
            
            <form  name="formsearch" action="./?type=search" method="post">
              <input type="text" name="keyword" value="" placeholder="输入关键词">
              <button class="fa fa-search" type="submit"></button>
            </form>
          </div>
        </div>
        <div class="nav-box index">
          
          <div class="nav-cut">
            <ul class="nav-ul">

              <fh-function>
                $sql="select * from sl_menu where U_del=0 and U_sub=0 order by U_order,U_id desc";
                s[[

                if($row["U_id"]==getrs("select * from sl_menu where U_del=0 and U_type='product' and U_typeid=$id","U_id") || $row["U_id"]==getrs("select * from sl_menu where U_del=0 and U_type='product' and U_typeid=$id","U_sub")){
                    $class="nav-li active";
                  }else{
                    $class="nav-li margin-left-0";
                  }

                  if($row["U_type"]=="link"){
                    $link=$row["U_link"];
                    $target="_blank";
                  }else{
                    $link="?type=".$row["U_type"]."&id=".$row["U_typeid"];
                    $target="_self";
                  }
                        $api=$api."<li class=\"".$class."\"><a href=\"".$link."\" target=\"".$target."\" title=\"".$row["U_title"]."\" >".$row["U_title"]."</a></li>";
                    ]]

              </fh-function>
            </ul>
          </div>
          <div class="nav-hover">

            <fh-function>
            $sql="select * from sl_menu where U_del=0 and U_sub=0 order by U_order,U_id desc";
                s[[
                $api=$api."<ul>";

                    $sql2="select * from sl_menu where U_del=0 and U_sub=".$row["U_id"]." order by U_order,U_id desc";
                    s2[[
                      
                      if($row2["U_type"]=="link"){
                        $link2=$row2["U_link"];
                        $target="_blank";
                      }else{
                        $link2="?type=".$row2["U_type"]."&id=".$row2["U_typeid"];
                        $target="_self";
                      }
                            $api=$api."<li><a href=\"".$link2."\" target=\"".$target."\" title=\"".$row2["U_title"]."\" >".$row2["U_title"]."</a></li>";
                        ]]

                  $api=$api."</ul>";
                    ]]

            </fh-function>
            
          </div>
        </div>
      </div>
    </div>
  </nav>
  <div class="met-banner-ny vertical-align text-center" style=''>
    <h1 class="vertical-align-middle" style='color:#ffffff;'>[S_title]</h1>
  </div>
</header>
<div class="column-side ">
  <div class="container mobile-not-padding">
    <div class="column-nav">
      <ol class="column-ul">




        <li class="column-li"> <a href="?type=product&id=0">全部商品</a> </li>
        
<fh-function>

$sql="select * from sl_psort where S_del=0 and S_sub=0 order by S_order,S_id desc";
                s[[
                  $api=$api."<li class=\"column-li navs\"> <a href=\"?type=product&id=".$row["S_id"]."\" title=\"".$row["S_title"]."\" >".$row["S_title"]."</a> </li>";
                ]]
</fh-function>

        
      </ol>
    </div>
    <div class="column-hover">
      <ul>
      </ul>

<fh-function>
$sql="select * from sl_psort where S_del=0 and S_sub=0 order by S_order,S_id desc";
                s[[
$api=$api."<ul class=\"has\">";
$sql2="select * from sl_psort where S_del=0 and S_sub=".$row["S_id"]." order by S_order,S_id desc";
                s2[[
                  $api=$api."<li><a href=\"?type=product&id=".$row2["S_id"]."\" title=\"".$row2["S_title"]."\" >".$row2["S_title"]."</a></li>";
                ]]
$api=$api."</ul>";

                ]]
</fh-function>
    </div>
  </div>
</div>
<div class="grey-box">
  <div class="container">
    <div class="host-cut">
      <div class="host-list active">
        <ul class="blocks-2 blocks-sm-3 blocks-md-4 blocks-xlg-5  met-page-ajax met-grid" id="met-grid" data-scale='1'>

<fh-function>
if($id==0){
  $sql="select * from sl_product where P_del=0 $M_info order by P_order,P_id desc limit ".(($page-1)*10).",10";
}else{
  if($S_sub==0){
    $sql="select * from sl_product,sl_psort where S_del=0 and P_del=0 $M_info and P_sort=S_id and S_sub=".$id." order by P_order,P_id desc limit ".(($page-1)*10).",10";
  }else{
    $sql="select * from sl_product,sl_psort where S_del=0 and P_del=0 $M_info and P_sort=S_id and S_id=".$id." order by P_order,P_id desc limit ".(($page-1)*10).",10";
  }
}

    s[[
      $api=$api."<li class=\"shown scms-pic\"> <a href=\"?type=productinfo&id=".$row["P_id"]."\" title=\"".$row["P_title"]."\"> <img data-original=\"media/".splitx($row["P_pic"],"|",0)."\" alt=\"".$row["P_title"]."\"> <span> <b>".$row["P_title"]."</b> <i>&nbsp;</i>
<p>￥".$row["P_price"]."</p>
</span> </a> </li>";
                ]]
</fh-function>

        </ul>
        <div>
<div class='met_pager'>
<div id="pager"></div>
</div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="foot-service">
    <ul class="foot-service-wraper">
      <li class="foot-service-slide"><a  title="正品保证"><i class="fa fa-diamond"></i>正品保证</a></li>
      <li class="foot-service-slide"><a  title="如实描述"><i class="fa fa-camera-retro"></i>如实描述</a></li>
      <li class="foot-service-slide"><a  title="专业配送"><i class="fa fa-truck"></i>专业配送</a></li>
      <li class="foot-service-slide"><a  title="金牌服务"><i class="fa fa-heart-o"></i>金牌服务</a></li>
      <li class="foot-service-slide"><a  title="万千信赖"><i class="fa wb-gallery"></i>万千信赖</a></li>
    </ul>
  </div>
  <div class="foot-content">
    <div class="foot-nav">
      <ul class="foot-nav-wraper">

        <fh-function>
                $sql="select * from sl_menu where not U_type='index' and not U_type='link' and U_del=0 and U_sub=0 order by U_order,U_id desc";
                s[[
                  
                  $api=$api."<li class=\"foot-nav-slide\"> <b><a href=\"?type=".$row["U_type"]."&id=".$row["U_typeid"]."\"  title=\"".$row["U_title"]."\">".$row["U_title"]."</a></b>
          <ol>";

            $sql2="select * from sl_menu where U_del=0 and U_sub=".$row["U_id"]." order by U_order,U_id desc";
                s2[[
                  $api=$api."<li><a href=\"?type=".$row2["U_type"]."&id=".$row2["U_typeid"]."\"  title=\"".$row2["U_title"]."\">".$row2["U_title"]."</a></li>";
                ]]

          $api=$api."</ol>
        </li>";
                    ]]

              </fh-function>
        
      </ul>
    </div>
    <div class="foot-text"> <b><a href="tel:[fh_phone]" title="[fh_phone]">[fh_phone]</a></b> <i>服务时间 9:00-22:00</i>
      <p> <a id="met-weixin"><i class="fa fa-weixin light-green-700" data-plugin="webuiPopover" data-trigger="hover" data-animation="pop" data-placement='top' data-width='160' data-padding='0' data-content="<img src='media/[fh_qrcode]' style='width: 150px;height:150px;display:block;margin:auto;'>"></i></a> 
        
      </p>
    </div>
  </div>
</div>
<footer>
  <div class="container">
    <div class="met-links">
      <ol class="breadcrumb">
        <li>友情链接 :</li>
        <fh-function>
        $sql="select * from sl_link where L_del=0 order by L_id desc";
                s[[
                        $api=$api."<li><a href=\"".$row["L_link"]."\" target=\"_blank\">".$row["L_title"]."</a>  </li>";
                    ]]
        </fh-function>
      </ol>
    </div>
    <p>
    <p>
[fh_copyright][fh_beian][fh_code]
      </p>
    </p>
  </div>
</footer>

<button type="button" class="btn btn-icon btn-primary btn-squared met-scroll-top hide"><i class="icon wb-chevron-up" aria-hidden="true"></i></button>
<button type="button" onclick="window.location.href='member/cart.php'" class="btn btn-icon btn-primary btn-squared met-scroll-top hide" style="bottom: 50px;"><i class="icon wb-shopping-cart" aria-hidden="true"></i></button>
<script src="template/t1/skin/js/shop_lang_cn.js"></script> 
<script src="template/t1/skin/js/index.js"></script> 
<script src="template/t1/skin/js/shop_v3.js"></script>

<script src="js/jquery.pager.js" type="text/javascript"></script>
<script>
$(".scms-pic").attr("style","float: none;display:inline-block;vertical-align:top;");
$(document).ready(function() {
    $("#pager").pager({ pagenumber: <fh-function> $api=$api.$page;</fh-function>, pagecount: <fh-function> $api=$api.$page_num;</fh-function>, buttonClickCallback: PageClick });
});

PageClick = function(pageclickednumber) {
  window.location="./?type=product&id=[S_id]&tag=<fh-function> $api=$api.$tag;</fh-function>&page="+pageclickednumber+"&M_id=<fh-function> $api=$api.$M_id;</fh-function>";
}
</script>
[fh_kefu]
</body>
</html>