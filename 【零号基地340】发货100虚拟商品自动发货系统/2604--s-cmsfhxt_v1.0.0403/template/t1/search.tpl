<fh-function>
$keyword=t($_REQUEST["keyword"]);
</fh-function>
<!DOCTYPE HTML>
<html class="">
<head>
<meta name="renderer" content="webkit">
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="generator" content="fahuo100.cn"  data-variable="/,cn,10001,,10001,M1156014" />
<title>搜索<fh-function> $api=$api.$keyword;</fh-function> -[fh_title]</title>
<link href="media/[fh_ico]" rel="shortcut icon" />
<meta name="description" content="[fh_description]" />
<meta name="keywords" content="[fh_keyword]" />
<meta name="author" content="powered by fahuo100.cn" />
<link rel='stylesheet' href='template/t1/skin/css/index.css'>
<style>
.search_pic{padding:5px;border:#CCCCCC solid 1px;width:100%;max-width:150px;min-width:100px;}
table{width: 100%;}
.search_area{}
.search_area .list{padding: 10px;}
.search_area td{padding: 10px;}
</style>
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

                if($row["U_id"]==getrs("select * from sl_menu where U_del=0 and U_type='$type' and U_typeid=$id","U_id") || $row["U_id"]==getrs("select * from sl_menu where U_del=0 and U_type='$type' and U_typeid=$id","U_sub")){
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
    <h1 class="vertical-align-middle" style='color:#ffffff;'>搜索“<fh-function> $api=$api.$keyword;</fh-function>”</h1>
  </div>
</header>

<section class="met-show animsition">
  <div class="container">
    <div class="met-editor lazyload clearfix search_area">
      <fh-function>
if($keyword==""){
  $api=$api."请输入要查询的关键词！";
}else{
//搜索单页
$sql="select * from sl_text where T_del=0 and (T_title like '%".$keyword."%' or T_content like '%".$keyword."%' ) order by T_id desc";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result)) {

$search_info=$search_info."<div class='list'><table><tr><td colspan='2' ><a href='?type=text&id=".$row["T_id"]."' target='_blank'><font size='+1' color='#0066ff'><u>".str_Replace($keyword,"<font color='red'>".$keyword."</font>",$row["T_title"])."</u></font></a></td></tr><tr><td width='20%' align='center' valign='middle'><a href='?type=text&id=".$row["T_id"]."' target='_blank'><img src='media/".$row["T_pic"]."' class='search_pic'></a></td><td width='80%'>".str_replace($keyword,"<font color='red'>".$keyword."</font>",mb_substr(strip_tags($row["T_content"]),0,100,"utf-8"))."...<br><font color='#006600'>".$_SERVER["HTTP_HOST"]."/?type=text&id=".$row["T_id"]."</font><br> <font color='#777777'>位置：<a href='./'>".$C_title."</a> - <a href='?type=text&id=".$row["T_id"]."'>".$row["T_title"]."</a></font></td></tr></table></div>";

        }
$search1=1;
}else{
$search1=0;
    }


//搜索新闻分类
$sql="select * from sl_nsort where S_del=0 and (S_title like '%".$keyword."%' or S_content like '%".$keyword."%' ) order by S_id desc";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result)) {

$search_info=$search_info."<div class='list'><table><tr><td colspan='2' ><a href='?type=news&id=".$row["S_id"]."' target='_blank'><font size='+1' color='#0066ff'><u>".str_Replace($keyword,"<font color='red'>".$keyword."</font>",$row["S_title"])."</u></font></a></td></tr><tr><td width='20%' align='center' valign='middle'><a href='?type=news&id=".$row["S_id"]."' target='_blank'><img src='media/".$row["S_pic"]."' class='search_pic'></a></td><td width='80%'>".str_replace($keyword,"<font color='red'>".$keyword."</font>",mb_substr(strip_tags($row["S_content"]),0,100,"utf-8"))."...<br><font color='#006600'>".$_SERVER["HTTP_HOST"]."?type=news&id=".$row["S_id"]."</font><br> <font color='#777777'>位置：<a href='./'>".$C_title."</a> - <a href='?type=news&id=".$row["S_id"]."'>".$row["S_title"]."</a></font></td></tr></table></div>";

        }
$search2=1;
}else{
$search2=0;
    }


//搜索新闻
$sql="select * from sl_news,sl_nsort where N_sort=S_id and N_del=0 and (N_title like '%".$keyword."%' or N_content like '%".$keyword."%' ) order by N_id desc";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result)) {

$search_info=$search_info."<div class='list'><table><tr><td colspan='2' ><a href='?type=newsinfo&id=".$row["N_id"]."' target='_blank'><font size='+1' color='#0066ff'><u>".str_Replace($keyword,"<font color='red'>".$keyword."</font>",$row["N_title"])."</u></font></a></td></tr><tr><td width='20%' align='center' valign='middle'><a href='?type=newsinfo&id=".$row["N_id"]."' target='_blank'><img src='media/".$row["N_pic"]."' class='search_pic'></a></td><td width='80%'>".str_replace($keyword,"<font color='red'>".$keyword."</font>",mb_substr(strip_tags(splitx($row["N_content"],"[fh_free]",0)),0,100,"utf-8"))."...<br><font color='#006600'>".$_SERVER["HTTP_HOST"]."?type=newsinfo&id=".$row["N_id"]."</font><br> <font color='#777777'>位置：<a href='./'>".$C_title."</a> - <a href='?type=news&id=".$row["S_id"]."'>".$row["S_title"]."</a> - <a href='?type=newsinfo&id=".$row["N_id"]."'>".$row["N_title"]."</a></font></td></tr></table></div>";

        }
$search3=1;
}else{
$search3=0;
    }


//搜索产品分类
$sql="select * from sl_psort where S_del=0 and (S_title like '%".$keyword."%' or S_content like '%".$keyword."%' ) order by S_id desc";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result)) {

$search_info=$search_info."<div class='list'><table><tr><td colspan='2' ><a href='?type=product&id=".$row["S_id"]."' target='_blank'><font size='+1' color='#0066ff'><u>".str_Replace($keyword,"<font color='red'>".$keyword."</font>",$row["S_title"])."</u></font></a></td></tr><tr><td width='20%' align='center' valign='middle'><a href='?type=product&id=".$row["S_id"]."' target='_blank'><img src='media/".$row["S_pic"]."' class='search_pic'></a></td><td width='80%'>".str_replace($keyword,"<font color='red'>".$keyword."</font>",mb_substr(strip_tags($row["S_content"]),0,100,"utf-8"))."...<br><font color='#006600'>".$_SERVER["HTTP_HOST"]."?type=product&id=".$row["S_id"]."</font><br> <font color='#777777'>位置：<a href='./'>".$C_title."</a> - <a href='?type=product&id=".$row["S_id"]."'>".$row["S_title"]."</a></font></td></tr></table></div>";

        }
$search4=1;
}else{
$search4=0;
    }

//搜索产品
$sql="select * from sl_product,sl_psort where P_sort=S_id and P_del=0 and (P_title like '%".$keyword."%' or P_content like '%".$keyword."%' ) order by P_id desc";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result)) {

$search_info=$search_info."<div class='list'><table><tr><td colspan='2' ><a href='?type=productinfo&id=".$row["P_id"]."' target='_blank'><font size='+1' color='#0066ff'><u>".str_Replace($keyword,"<font color='red'>".$keyword."</font>",$row["P_title"])."</u></font></a></td></tr><tr><td width='20%' align='center' valign='middle'><a href='?type=productinfo&id=".$row["P_id"]."' target='_blank'><img src='media/".splitx($row["P_pic"],"|",0)."' class='search_pic'></a></td><td width='80%'>".str_replace($keyword,"<font color='red'>".$keyword."</font>",mb_substr(strip_tags($row["P_content"]),0,100,"utf-8"))."...<br><font color='#006600'>".$_SERVER["HTTP_HOST"]."?type=productinfo&id=".$row["P_id"]."</font><br> <font color='#777777'>位置：<a href='./'>".$C_title."</a> - <a href='?type=product&id=".$row["S_id"]."'>".$row["S_title"]."</a> - <a href='?type=productinfo&id=".$row["P_id"]."'>".$row["P_title"]."</a></font></td></tr></table></div>";

        }
$search5=1;
}else{
$search5=0;
    }

$api=$api.$search_info;

if($search1+$search2+$search3+$search4+$search5==0){
  $api=$api."未找到“".$keyword."”的相关内容，请尝试其他关键词";
}
}

      </fh-function>
    	
 </div>
  </div>
</section>
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
[fh_kefu]
</body>
</html>