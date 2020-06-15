<!DOCTYPE HTML>
<html class="  ">
<head>
<meta name="renderer" content="webkit">
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="generator" content="fahuo100.cn"  data-variable="/,cn,10001,,10001,M1156014" />
<title>[fh_title]</title>
<link href="media/[fh_ico]" rel="shortcut icon" />
<meta name="description" content="[fh_description]" />
<meta name="keywords" content="[fh_keyword]" />
<meta name="author" content="powered by fahuo100.cn" />
<link rel='stylesheet' href='template/t1/skin/css/index.css'>
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
				$api="<a class=\"login\" href=\"member/login.php\">登录</a>
			        <hr>
			        <a class=\"login\" href=\"member/reg.php\">注册</a>";
			}else{
				$api="<a class=\"login\" href=\"member\">".$_SESSION["M_login"]."</a>
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
            
            <form  name="formsearch" action="?type=search" method="post">
              <input type="text" name="keyword" value="" placeholder="输入关键词">
              <button class="fa fa-search" type="submit"></button>
            </form>
          </div>
        </div>
        <div class="nav-box index">
          <div class="nav-class has-banner"> <span> <i class="wb-list"></i> <a href="?type=product&id=0" title="产品中心" target='_self'>全部商品分类</a> </span> </div>
          <div class="nav-cut">
            <ul class="nav-ul">

              <fh-function>
                $sql="select * from sl_menu where U_del=0 and U_sub=0 order by U_order,U_id desc";
                s[[
                  if($type==$row["U_type"] && $id==$row["U_typeid"]){
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
  <div class="container mobile-not-padding">
    <div class="product-cut auto">
      <div class="product-class has-banner index">
        <ul class="product-class-wrapper">
          <fh-function>
          $sql="select * from sl_psort where S_del=0 and S_sub=0 order by S_order,S_id desc";
          s[[$api=$api."<li class=\"product-class-slide\"><a href=\"?type=product&id=".$row["S_id"]."\" title=\"".$row["S_title"]."\" >".$row["S_title"]."</a><i class=\"fa fa-angle-right\"></i></li>";]]
        </fh-function>
        </ul>
      </div>
<fh-function>
$sql="select * from sl_psort where S_del=0 and S_sub=0 order by S_order,S_id desc";
                s[[
                $api=$api."<div class=\"product-content index\">
        <div class=\"product-list\">
          <ul class=\"product-ul\">
            <li class=\"product-li\">"; 

                $sql2="select * from sl_psort where S_del=0 and S_sub=".$row["S_id"]." order by S_order,S_id desc";
                s2[[
                        $api=$api."<a href=\"?type=product&id=".$row2["S_id"]."\" title=\"".$row2["S_title"]."\"> 
                        <b data-original=\"media/".$row2["S_pic"]."\"></b>
                        <p>".$row2["S_title"]."</p>
                        </a>";
                    ]]

                $api=$api."</li>
          </ul>
        </div>
      </div>";
                    }
                }
</fh-function>

      <div class="met-banner banner-ny-h index" data-height='' style=''> 
        <fh-function>
          $sql="select * from sl_slide where S_del=0 order by S_order,S_id desc";
                s[[
                  
                        $api=$api."<div class=\"slick-slide\"> <img class=\"cover-image\" src=\"media/".$row["S_pic"]."\" srcset=\"media/".$row["S_pic"]."\" sizes=\"(max-width: 767px) 767px\"> </div>";
                    ]]

        </fh-function>
        

 </div>
    </div>
  </div>
</header>
<div class="groom-box">
  <div class="container">
    <div class="title-box">
      <div class="title-name"> <h3>最新上架</h3> </div>
      <div class="title-move"> <i class="fa fa-chevron-left"></i> <i class="fa fa-chevron-right"></i> </div>
    </div>
    <div class="groom-cut">
      <ul class="groom-cut-wraper">

<fh-function>
$sql="select * from sl_product where P_del=0 and P_sh=1 order by P_id desc limit 10";
                s[[
                        $api=$api."<li class=\"groom-cut-slide\"> <a href=\"?type=productinfo&id=".$row["P_id"]."\" title=\"".$row["P_title"]."\"> <img data-original=\"media/".splitx($row["P_pic"],"|",0)."\" alt=\"".$row["P_title"]."\"> <b>".$row["P_title"]."</b> <i>&nbsp;</i>
          <p>￥".$row["P_price"]."</p>
          </a> </li>";
                    ]]
</fh-function>
      </ul>
    </div>
  </div>
</div>
<div class="grey-box">

<fh-function>
$i=1;
$sql="select * from sl_psort where S_del=0 and S_sub=0 order by S_order,S_id desc";
s[[

$api=$api."<div class=\"host-box\">
    <div class=\"container\">
      <div class=\"host-title title-box\">
        <div class=\"title-name\"> <h3>".$i."F ".$row["S_title"]."</h3> </div>
        <div class=\"title-nav\">
          <ul>
          	<li class=\"active\"><a href=\"\">热门</a></li>";

$sql2="select * from sl_psort where S_del=0 and S_sub=".$row["S_id"]." order by S_order,S_id desc";
s2[[$api=$api."<li><a href=\"?type=product&id=".$row2["S_id"]."\" title=\"".$row2["S_title"]."\">".$row2["S_title"]."</a></li>";]]

          $api=$api."</ul>
        </div>
      </div>
      <div class=\"host-cut tags\">
        <div class=\"host-adver\">
          <ul>
            <li> <a data-original=\"media/".$row["S_pic"]."\"> <img src=\"template/t1/skin/images/null.png\"/> </a> </li>
            <li class=\"host-list-slide\">
            	<a class=\"more\" style=\"background:#ffffff;position:relative\" href=\"?type=product&id=".$row["S_id"]."\">
            		<img src=\"template/t1/skin/images/null.png\"/>

            <span style=\"width: 50%;
    position: absolute;
    top: 50%;
    left: 0;
    padding-left: 24px;
    margin-top: -24px;\"> <b>浏览更多</b>
              <p>".$row["S_title"]."</p>
              </span> 
              <i class=\"wb-arrow-right\" style=\"width: 50px;
    height: 50px;
    line-height: 40px;
    position: absolute;
    right: 28px;
    top: 50%;
    margin-top: -25px;
    border: 3px solid #f32196;
    color: #f32196;
    border-radius: 50%;
    font-size: 25px;
    text-align: center;\"></i>
</a>
              </li>
          </ul>
        </div>
<div class=\"host-list index active\">
          <ul class=\"host-list-wraper\">";
$sql2="select * from sl_product,sl_psort where P_sh=1 and S_del=0 and P_del=0 and P_sort=S_id and S_sub=".$row["S_id"]." order by P_order,P_id desc limit 10";
s2[[
		$api=$api."<li class=\"host-list-slide scms-pic\"> <a href=\"?type=productinfo&id=".$row2["P_id"]."\" title=\"".$row2["P_title"]."\"> <img data-original=\"media/".splitx($row2["P_pic"],"|",0)."\" alt=\"".$row2["P_title"]."\"> <span> <b>".$row2["P_title"]."</b> <i>&nbsp;</i>
              <p>￥".$row2["P_price"]."</p>
              </span> </a> </li>";
              
	]]
$api=$api."
          </ul>
</div>";
$sql2="select * from sl_psort where S_del=0 and S_sub=".$row["S_id"]." order by S_order,S_id desc";
s2[[
		$api=$api."<div class=\"host-list index\">
          <ul class=\"host-list-wraper\">";
$sql3="select * from sl_product where P_sh=1 and P_del=0 and P_sort=".$row2["S_id"]." order by P_order,P_id desc limit 10";
s3[[
$api=$api."<li class=\"host-list-slide\"> <a href=\"?type=productinfo&id=".$row3["P_id"]."\" title=\"".$row3["P_title"]."\"> <img data-original=\"media/".splitx($row3["P_pic"],"|",0)."\" alt=\"".$row3["P_title"]."\"> <span> <b>".$row3["P_title"]."</b> <i>&nbsp;</i>
              <p>￥".$row3["P_price"]."</p>
              </span> </a> </li>";
	]]
          $api=$api."</ul>
        </div>";
	]]

$api=$api."
      </div>
    </div>
  </div>";
  $i=$i+1;
    ]]
</fh-function>
  <div class="info-box">
    <div class="container">
      <div class="title-box">
        <div class="title-name"> <h3>文章资讯</h3> </div>
        <div class="title-move"> <i class="fa fa-chevron-left"></i> <i class="fa fa-chevron-right"></i> </div>
      </div>
      <div class="info-cut index">
      <ul class="info-cut-wraper">
      	<fh-function>
      	$sql="select * from sl_news,sl_nsort where N_sh=1 and N_sort=S_id and N_del=0 order by N_order,N_id desc limit 10";
                s[[$api=$api."<li class=\"info-cut-slide\"> <a href=\"?type=newsinfo&id=".$row["N_id"]."\" title=\"".$row["N_title"]."\"> <img data-original=\"media/".$row["N_pic"]."\" alt=\"".$row["N_title"]."\"> <span>
          <p>".mb_substr(strip_tags(splitx($row["N_content"],"[fh_free]",0)),0,200,"utf-8")."</p>
          <i>发布日期<em>".date("Y-m-d",strtotime($row["N_date"]))."</em> <b style=\"float:right;margin-top:-3px;color:#FF0000\">￥".$row["N_price"]."</b></i> <b>".$row["N_title"]."</b> </span> </a> </li>";
                    ]]
      	</fh-function>
        </div>
      </ul>
    </div>
  </div>
</div>
<div class="container">
  <div class="foot-service">
    <ul class="foot-service-wraper">
      <li class="foot-service-slide"><a title="正品保证"><i class="fa fa-diamond"></i>正品保证</a></li>
      <li class="foot-service-slide"><a title="如实描述"><i class="fa fa-camera-retro"></i>如实描述</a></li>
      <li class="foot-service-slide"><a title="专业配送"><i class="fa fa-truck"></i>专业配送</a></li>
      <li class="foot-service-slide"><a title="金牌服务"><i class="fa fa-heart-o"></i>金牌服务</a></li>
      <li class="foot-service-slide"><a title="万千信赖"><i class="fa wb-gallery"></i>万千信赖</a></li>
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
                s2[[$api=$api."<li><a href=\"?type=".$row2["U_type"]."&id=".$row2["U_typeid"]."\"  title=\"".$row2["U_title"]."\">".$row2["U_title"]."</a></li>";]]
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
        s[[$api=$api."<li><a href=\"".$row["L_link"]."\" target=\"_blank\">".$row["L_title"]."</a></li>";]]
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
<fh-function>
if(!isMobile()){
  $api=$api."<script type=\"text/javascript\">$(\".scms-pic\").attr(\"style\",\"float: none;display:inline-block;vertical-align:top;\");</script>";
}
</fh-function>
[fh_kefu]
</body>
</html>