<fh-function>
mysqli_query($conn, "update sl_product set P_view=P_view+1 where P_id=".$id);
$sql="select * from sl_product,sl_psort where P_sort=S_id and P_id=".$id;
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  if (mysqli_num_rows($result) > 0) {
    $S_id=$row["S_id"];
    $P_id=$row["P_id"];
    $P_pic=$row["P_pic"];

    switch ($row["P_selltype"]) {
		case 0:
		$P_rest=1;
		break;

		case 1:
		$P_rest=getrs("select count(C_id) as C_count from sl_card where C_sort=".intval($row["P_sell"])." and C_use=0","C_count");
		break;

		case 2:
		$P_rest=$row["P_rest"];
		break;
	}
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
<title>[P_title] - [fh_title]</title>
<link href="media/[fh_ico]" rel="shortcut icon" />
<meta name="description" content="[fh_description]" />
<meta name="keywords" content="[fh_keyword]" />
<meta name="author" content="powered by fahuo100.cn" />
<link rel='stylesheet' href='template/t1/skin/css/index.css'>
<style>
#buy .add{
  height:25px; width:25px; margin:0 5px 0 5px;line-height:100%;
  border: hidden;
  background-color: #f32196;
  color: #FFFFFF;
  font-size: 15px;
  line-height: 100%;
  cursor: pointer;
  border-radius:3px;
}

#buy .add:hover {
  border: #f32196 solid 1px;
  background-color: #FFFFFF;
  color: #f32196;
}

#amount{
  border-top:1px solid #ABADB3;
  border-left:1px solid #ABADB3;
  border-right:1px solid #ddd;
  border-bottom:1px solid #ddd;
  height:24px;
  width:50px;
  padding:0 5px;
  line-height:100%;

}
.btn{padding: 5px;margin-top: 10px;}
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

                if($row["U_id"]==getrs("select * from sl_menu where U_del=0 and U_type='product' and U_typeid=$S_id","U_id") || $row["U_id"]==getrs("select * from sl_menu where U_del=0 and U_type='product' and U_typeid=$S_id","U_sub")){
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
<div class="met-position  pattern-show">
  <div class="container">
    <div class="row">
      <ol class="breadcrumb">
        <li> <i class="icon wb-home" aria-hidden="true"></i><a href='./'>主页</a> > <a href='?type=product&id=[S_id]'>[S_title]</a> > [P_title] > </li>
      </ol>
    </div>
  </div>
</div>
<div class="page met-showproduct pagetype1">
  <div class="met-showproduct-head">
    <div class="container">
      <div class="row">



        <div class="col-md-6">
          <div class='met-showproduct-list fngallery text-center slick-dotted' id="met-imgs-carousel">

<fh-function>
$pic=explode("|",$P_pic);
for($i=0;$i<count($pic);$i++){
  $api=$api."<div class=\"slick-slide lg-item-box\" data-src=\"media/".$pic[$i]."\" data-exthumbimage=\"media/".$pic[$i]."\"> <span> <img src=\"media/".$pic[$i]."\" data-src=\"media/".$pic[$i]."\" class=\"img-responsive\" alt=\"\" height=\"210\" width=\"380\" title=\"\">               </span> </div>";
}
</fh-function>        
            

          </div>
        </div>



        <div class="col-md-6 product-intro">
          <h1 class='font-weight-300'>[P_title]</h1>
          <div>[P_tag]</div>
          <div class="shop-product-intro grey-500">
            <div class="padding-20 bg-grey-100 price"> <span id="price" class="red-600">价格：￥[P_price]</span></div>
            
            <div class="form-group inline-block margin-top-30">
              <form id="buy" method="post" action="buy.php?type=productinfo&id=[P_id]">
                <p style="margin-bottom: 10px"><b>购买数量：</b>
              <input type='button' class='add' value='-' onClick='javascript:if(this.form.amount.value>=2){this.form.amount.value--;}'>
              <input type='text' name='no' value='1' id='amount'>
              <input type='button' class='add' value='+' id='plus' onClick='javascript:if(this.form.amount.value<[P_rest]){this.form.amount.value++;}'>
              （库存：[P_resttitle]）</p>
              [fh_address]
              <fh-function>
              if($P_rest==0){
                $api=$api."<input type=\"submit\" name=\"button\" class=\"btn btn-lg btn-squared btn-primary margin-right-10\" value=\"暂时缺货\"  disabled=\"disabled\"/>";
              }else{
                $api=$api."<input type=\"submit\" name=\"button\" class=\"btn btn-lg btn-squared btn-primary margin-right-10\" value=\"立即购买\" />";
                $api=$api.unlogin_product("btn btn-lg btn-squared btn-primary margin-right-10",$id);
              }
              </fh-function>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="met-showproduct-body">
    <div class="container mobile-not-padding">
      <div class="row">
        <div class="col-md-9">
          <div class="product-content-body">
            <div class="panel product-detail">
              <div class="panel-body">
                <ul class="nav nav-tabs nav-tabs-line met-showproduct-navtabs affix-nav">
                  <li class="active"><a data-toggle="tab" href="#product-details" data-get="product-details">详细信息</a></li>
                  <li><a data-toggle="tab" href="#list" data-get="product-details">购买记录([B_count])</a></li>
                  <li><a data-toggle="tab" href="#evaluate" data-get="product-details">商品评价([E_count])</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane met-editor lazyload clearfix active" id="product-details"> 
                    [P_content]
                  </div>
                  <div class="tab-pane met-editor lazyload clearfix" id="list"> 
                    <fh-function>
              $sql="select * from sl_orders,sl_member where not O_state=2 and O_mid=M_id and O_pid=".$P_id." and O_del=0";
              $result = mysqli_query($conn,  $sql);
                if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
$api=$api."<p><b>用户：".enname($row["M_login"])."</b> 购买了 <span style=\"color: #f32196\">".$row["O_title"]."</span> <br><span style=\"color: #AAAAAA\">".$row["O_time"]." </span></p>";
                }
              }else{
              $api=$api."<div>暂无购物记录</div>";
            }
            </fh-function>
                  </div>

                  <div class="tab-pane met-editor lazyload clearfix" id="evaluate"> 
<style>
.evaluate li{border-bottom:solid 1px #EEEEEE;padding:10px 0;list-style:none;}
.evaluate li div{line-height: 150%}
.evaluate li .left{width: 100px;vertical-align: top;display: inline-block;text-align:center}
.evaluate li .left img{width:50px;height:50px;border-radius:10px;}
.evaluate li .right{vertical-align: top;display: inline-block;width:calc(100% - 120px)}
</style>
<ul class="evaluate">
                    <fh-function>
                $sql="select * from sl_evaluate,sl_member,sl_orders where E_mid=M_id and E_oid=O_id and O_pid=$P_id order by E_id desc";
                $result = mysqli_query($conn,  $sql);
                if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                  $api=$api."<li>
                    <div class=\"left\">
                      <img src=\"media/".$row["M_head"]."\">
                    </div>
                    <div class=\"right\">
                      <div style=\"font-weight: bold;\">".enname($row["M_login"])."</div>
                      <div>[".$row["E_star"]."星] ".$row["E_content"]."</div>
                      <div style=\"font-size: 12px;color: #AAAAAA\">".$row["E_time"]."</div>";
                      if($row["E_reply"]!=""){
                      $api=$api."<div style=\"font-size: 12px;color: #AF874D\">商家回复：".$row["E_reply"]."</div>";
                    }
                    $api=$api."</div>
                  </li>";
                }
              }else{
              $api=$api."<div>暂无商品评价</div>";
            }
                    </fh-function>
                  </ul>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="panel product-hot">
            <div class="panel-body">
              <h2 class="margin-bottom-15 font-size-16 font-weight-300">热门推荐</h2>
              <ul class="blocks-2 blocks-sm-3 blocks-md-100 blocks-xlg-100  mob-masonry" data-scale='1'>

                <fh-function>
                $sql="select * from sl_product where P_del=0 and P_sort=$S_id order by P_order,P_id desc limit 5";
                s[[
                  $api=$api."<li> <a href=\"?type=productinfo&id=".$row["P_id"]."\" class=\"img\" title=\"".$row["P_title"]."\"> <img data-original=\"media/".splitx($row["P_pic"],"|",0)."\" class=\"cover-image\" style=\"height:200px;\" alt=\"".$row["P_title"]."\"> </a> <a href=\"?type=productinfo&id=".$row["P_id"]."\" class=\"txt\" title=\"".$row["P_title"]."\">".$row["P_title"]."</a>
                  <p class='margin-bottom-0 red-600'>￥".$row["P_price"]."</p>
                </li>";
                ]]
                </fh-function>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<link rel='stylesheet' href='template/t1/skin/css/shop_v3.css'>
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
[fh_kefu]
</body>
</html>
