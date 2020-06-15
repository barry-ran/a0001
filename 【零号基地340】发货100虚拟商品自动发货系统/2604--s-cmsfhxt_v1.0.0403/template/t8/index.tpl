
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
<title>[fh_title]</title>
<link href="media/[fh_ico]" rel="shortcut icon" />
<meta name="description" content="[fh_description]" />
<meta name="keywords" content="[fh_keyword]" />
<meta name="author" content="powered by fahuo100.cn" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.2/style/weui.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.0/css/jquery-weui.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="template/t8/css/font-awesome.min.css">
    <link rel="stylesheet" href="template/t8/css/swiper.min.css">
    <link rel="stylesheet" href="template/t8/css/main.css">
    <link rel="stylesheet" href="template/t8/css/index.css">
    <link rel="stylesheet" href="template/t8/css/theme-color.css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<header class="zyw-header">
    <div class="zyw-container white-color">
        <div class="head-l"><i class="head-l-svg" aria-hidden="true"></i></div>
        <form  name="formsearch" action="?type=search" method="post" class="head-search">
            <i class="fa fa-search" aria-hidden="true"></i>
            <input type="text" placeholder="输入您当前要搜索的商品" name="keyword" class="white-color">
        </form>
        <div class="head-r"><a href="member/cart.php"><i class="head-r-svg" aria-hidden="true"></i></a></div>
    </div>
</header>
<footer class="zyw-footer">
    <div class="zyw-container white-bgcolor clearfix">
        <div class="weui-tabbar">
            <a href="./" class="weui-tabbar__item weui-bar__item--on">
                <div class="weui-tabbar__icon">
                    <img src="template/t8/img/tab1_2.png" alt="">
                </div>
                <p class="weui-tabbar__label">首页</p>
            </a>
            <a href="?type=product&id=0" class="weui-tabbar__item">
                <div class="weui-tabbar__icon">
                    <img src="template/t8/img/tab2.png" alt="">
                </div>
                <p class="weui-tabbar__label">商品</p>
            </a>
            <a href="?type=news&id=0" class="weui-tabbar__item">
                <div class="weui-tabbar__icon">
                    <img src="template/t8/img/tab3.png" alt="">
                </div>
                <p class="weui-tabbar__label">文章</p>
            </a>
            <a href="member" class="weui-tabbar__item">
                <div class="weui-tabbar__icon">
                    <img src="template/t8/img/tab4.png" alt="">
                </div>
                <p class="weui-tabbar__label">我的</p>
            </a>
            
        </div>
    </div>
</footer>
<section class="zyw-container">
    <div class="swiper-container">
        <div class="swiper-wrapper">

            <fh-function>
          $sql="select * from sl_slide where S_del=0 order by S_order,S_id desc";
                s[[
                
$api=$api."<div class=\"swiper-slide\"><a href=\"".$row["S_link"]."\"><img src=\"media/".$row["S_pic"]."\" alt=\"\"></a></div>";
                    ]]

        </fh-function>

        </div>
        <!-- 如果需要分页器 -->
        <div class="swiper-pagination"></div>
    </div>
    <div class="index-class white-bgcolor">
        <div class="weui-flex">

        <fh-function>
            $sql="select * from sl_psort where S_del=0 order by S_sub,S_order,S_id desc limit 4";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($result)) {
            $api=$api."<div  style=\"width:25%;margin:5px;text-align:center;\">
                <a href=\"?type=product&id=".$row["S_id"]."\">
                    <div class=\"index-class-img\">
                        <img src=\"media/".$row["S_pic"]."\" alt=\"\" style=\"width:70%;border-radius:100%\">
                    </div>
                    <p class=\"index-class-text\">".$row["S_title"]."</p>
                </a>
            </div>";
        } 
        </fh-function>
            
        </div>

        <div class="weui-flex">

        <fh-function>
            $sql="select * from sl_psort where S_del=0 order by S_sub,S_order,S_id desc limit 5,3";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($result)) {
            $api=$api."<div  style=\"width:25%;margin:5px;text-align:center;\">
                <a href=\"?type=product&id=".$row["S_id"]."\">
                    <div class=\"index-class-img\">
                        <img src=\"media/".$row["S_pic"]."\" alt=\"\" style=\"width:70%;border-radius:100%\">
                    </div>
                    <p class=\"index-class-text\">".$row["S_title"]."</p>
                </a>
            </div>";
        } 
        </fh-function>
            
            <div style="width:25%;margin:5px;text-align:center;">
                <a href="?type=product&id=0">
                    <div class="index-class-img">
                        <img src="template/t8/img/noorder.png" alt="" style="width:70%;border-radius:100%">
                    </div>
                    <p class="index-class-text">全部商品</p>
                </a>
            </div>
        </div>

    </div>
    <div class="index-news">
        <div class="news-cont white-bgcolor">
            <strong>最新<em>文章</em>：</strong>
            <div class="infoBox">
                <ul class="swiper-wrapper">

<fh-function>
            $sql="select * from sl_news where N_del=0 order by N_order,N_id desc limit 5";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($result)) {
            $api=$api."<li class=\"swiper-slide\"><a href=\"?type=newsinfo&id=".$row["N_id"]."\"><span>".$row["N_title"]."</span></a></li>";
        } 

</fh-function>

                </ul>
            </div>
            <ul>
                <li><a href=""></a></li>
            </ul>
            <a href="?type=news&id=0" class="news-more">更多</a>
        </div>
    </div>
    <div class="index-seckill white-bgcolor">
        <div class="seckill-hd">
            <span class="seckill-hd-title red-color"><i class="fa fa-clock-o" aria-hidden="true"></i> 新品上架</span>
            <strong>折扣优惠</strong>
            <div id="time"></div>
            <a href="?type=product" class="seckill-hd-r">查看全部 <i class="fa fa-angle-right theme-color" aria-hidden="true"></i></a>
        </div>
        <div class="seckill-bd">
            <div class="seckill-wares">
                <div class="swiper-wrapper">
                    <fh-function>
$sql="select * from sl_product where P_del=0 and P_sh=1 order by P_id desc limit 10";
                s[[

          $api=$api."<div class=\"swiper-slide seckill-ware\">
                        <a href=\"?type=productinfo&id=".$row["P_id"]."\">
                            <img src=\"media/".splitx($row["P_pic"],"|",0)."\" alt=\"\">
                            <p class=\"red-color\">￥<strong>".$row["P_price"]."</strong></p>
                            <del>￥".$row["P_price"]*1.2."</del>
                        </a>
                    </div>";

                    ]]
</fh-function>

                </div>
            </div>
        </div>
    </div>
    
    <div class="index-wares">
        <div class="wares-title"><img src="http://gw.alicdn.com/tfs/TB1Aw9JSVXXXXXQXXXXXXXXXXXX-1500-68.png" alt=""></div>
        <div class="wares-cont">
            <ul class="clearfix">

                    <fh-function>
$sql="select * from sl_product,sl_psort where P_sort=S_id and S_del=0 and P_del=0 and P_sh=1 order by rand() limit 20";
                s[[
                    $api=$api."<li class=\"col-sm-6 col-xs-6 ware-box scms-pic\">
                    <a href=\"?type=productinfo&id=".$row["P_id"]."\">
                        <div class=\"ware-img\">
                            <img src=\"media/".splitx($row["P_pic"],"|",0)."\" alt=\"\">
                            <span class=\"ware-vip\">".$row["S_title"]."</span>
                        </div>
                        <h3 class=\"ware-title\">".$row["P_title"]."</h3>
                        <p class=\"ware-des\">".$row["P_tag"]."</p>
                        <span class=\"ware-prince red-color\">￥".$row["P_price"]."</span>
                    </a>
                </li>";
                    ]]
</fh-function>


                
            </ul>
        </div>
    </div>
</section>
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>
<script src="template/t8/js/swiper.min.js"></script>
<script src="template/t8/js/bootstrap.min.js"></script>
<script type="text/javascript">
    // 轮播
    $(document).ready(function () {
        // 顶部轮播图
        var mySwiper = new Swiper ('.swiper-container', {
            // 如果需要分页器
            autoplay:true,
            pagination: {
                el: '.swiper-pagination'
            }
        });
        // 秒杀商品滑动
        var swiper = new Swiper('.seckill-wares', {
            slidesPerView: 3.5,
            spaceBetween: 5,
            freeMode: true
        });
        // 新闻资讯
        var swiper2 = new Swiper('.infoBox', {
            autoplay:true,
            delay: 5000,
            direction: 'vertical'
        });
    })
    $(".scms-pic").attr("style","float: none;display:inline-block;vertical-align:top;");
</script>

</body>
</html>