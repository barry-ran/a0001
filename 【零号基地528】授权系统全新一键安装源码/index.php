<?php
define('ROOT', dirname(__FILE__).'/');
require_once(ROOT.'includes/common.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title><?=$conf['name'].' - 首页'?></title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    
    <link href="http://www.fontawesome.cn/assets/font-awesome/css/font-awesome.css" rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>  
    <!-- Left column -->
    <div class="templatemo-flex-row">
      <!-- Main content --> 
      <div class="templatemo-content col-1 light-gray-bg">
        <div class="templatemo-content-container">
          <div class="templatemo-flex-row flex-content-row">
            <div class="templatemo-content-widget white-bg col-2">
              <i class="fa fa-times"></i>
              <div class="square"></div>
              <h2 class="templatemo-inline-block">查询授权</h2><hr>
				<div class="templatemo-search-form" role="search">
				  <div class="input-group">
						<input type="text" class="form-control" placeholder="请输入查询域名" id="query_url">      
						<button type="button" id="query_msg" onclick="query();" class="fa fa-search"></button>					  
				  </div>
				</div>
				<hr />
				<div class="" id="query">
					<h5>查询域名：<a href="http://<?=$_SERVER['SERVER_NAME'];?>" target="_blank"><?=$_SERVER['SERVER_NAME'];?></a></h5>
					<hr />
					<h5>ＱＱ账号：<?=$conf['kfqq']?></h5>
					<hr />
					<h5>状态：<font color="#13895F">正版授权</font></h5>
				</div>
            </div>
            <div class="templatemo-content-widget white-bg col-1 text-center">
              <i class="fa fa-times"></i>
              <h2 class="text-uppercase">下载程序</h2>
              <h3 class="text-uppercase margin-bottom-10">点击即可进行下载</h3>
              <a href="Ajax.php?my=download" target="_blank">
				<img src="images/zip.png" alt="Bicycle" class="img-circle-8 img-thumbnail">
			  </a>
            </div>
            <div class="templatemo-content-widget white-bg col-1">
              <i class="fa fa-times"></i>
              <h2 class="text-uppercase">在线申请授权</h2>
              <h4 class="text-uppercase">24小时全天在线提供授权申请！</h4><hr>
              <div class="form-group">
			  	<div class="input-group">
			  		<div class="input-group-addon"><i class="fa fa-link fa-fw"></i></div>	        		
			  		<input type="text" class="form-control" value="" id="url" placeholder="域名 如:<?=$_SERVER['SERVER_NAME']?>">
			  	</div>
			  </div>
			  <div class="form-group">
			  	<div class="input-group">
			  		<div class="input-group-addon"><i class="fa fa-qq fa-fw"></i></div>	        		
			  		<input type="text" class="form-control" value="" id="value" placeholder="QQ账号">
			  	</div>
			  </div>
			  <div class="form-group">
			  	<div class="input-group">
			  		<div class="input-group-addon"><i class="fa fa-credit-card fa-fw"></i></div>	        		
			  		<input type="text" class="form-control" value="" id="km" placeholder="卡密">
			  	</div>
			  </div>
			  <div class="form-group">
			  	<button type="button" id="button_auth" onclick="zaixianauth();" class="templatemo-blue-button width-100">提交申请</button>
			  </div>
			  <span>温馨提示：</span><p>提交前仔细检查，提交后无法修改！</p>
			  <button type="button" onclick="pay_url();" class="templatemo-blue-button width-100">购买卡密</button>
            </div>
          </div>
          <div class="templatemo-flex-row flex-content-row">
            <div class="col-1">              
              <div class="templatemo-content-widget orange-bg">
                <i class="fa fa-times"></i>
                <div class="media">
                  <div class="media-left">
                    <a href="#">
                      <img class="media-object img-circle" src="images/sunset.jpg" alt="Sunset">
                    </a>
                  </div>
                  <div class="media-body">
                    <h2 class="media-heading text-uppercase"><?=$conf['name']?>公告①</h2>
                    <p><?=$conf['gg1']?></p>  
                  </div>        
                </div>                
              </div>            
              <div class="templatemo-content-widget white-bg">
                <i class="fa fa-times"></i>
                <div class="media">
                  <div class="media-left">
                    <a href="#">
                      <img class="media-object img-circle" src="images/sunset.jpg" alt="Sunset">
                    </a>
                  </div>
                  <div class="media-body">
                    <h2 class="media-heading text-uppercase"><?=$conf['name']?>公告②</h2>
                    <p><?=$conf['gg2']?></p>  
                  </div>
                </div>                
              </div>            
            </div>
            <div class="col-1">
              <div class="panel panel-default templatemo-content-widget white-bg no-padding templatemo-overflow-hidden">
                <i class="fa fa-times"></i>
				<i class="fa fa-times fa fa-refresh" onclick="shuax();" style="right: 39px;"></i><!--机智的我，嗯哼~-->
                <div class="panel-heading templatemo-position-relative"><h2 class="text-uppercase">最新授权</h2></div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <td>No.</td>
                        <td>域名</td>
                        <td>QQ账号</td>
                        <td>操作</td>
                      </tr>
                    </thead>
                    <tbody>
<?php
$page = is_numeric($_GET['page']) ? $_GET['page'] : '1';
$pagein = $page + 8;
$pagesize = 10;
$start = ($page - 1) * $pagesize;
	$pages = ceil($DB->count("select count(id) as count from " . DBQZ . "_list limit 5") / $pagesize);
	$sql_list = $DB->query("select * from " . DBQZ . "_list order by id desc limit 5");
if ($pagein > $pages) $pagein = $pages;
if ($page == 1) {
    $prev = 1;
} else {
    $prev = $page - 1;
}
if ($page == $pages) {
    $next = $page;
} else {
    $next = $page + 1;
}
while ($row_list = $DB->fetch($sql_list)) {
?>
                      <tr id="dei_<?=$row_list['id']?>">
                        <td><?=$row_list['id']?></td>
                        <td><a href="http://<?=$row_list['url']?>" target="_blank"><?=$row_list['url']?></a></td>
                        <td><?=$row_list['value']?></td>
                        <td>
							<a href="http://<?=$row_list['url']?>" target="_blank" onclick="" class="templatemo-edit-btn">访问</a>
						</td>
                      </tr>
<?php } ?>
                    </tbody>
                  </table> 
                </div>                          
              </div>
            </div>           
          </div> <!-- Second row ends -->
          
          <footer class="text-right">
            <p>Copyright &copy; 2020 <?= $conf['name'] ?></p>
          </footer>        
        </div>
      </div>
    </div>
    
    <!-- JS -->
    <script src="js/jquery-1.11.2.min.js"></script>      <!-- jQuery -->
    <script src="js/jquery-migrate-1.2.1.min.js"></script> <!--  jQuery Migrate Plugin -->
    <script src="https://www.google.com/jsapi"></script> <!-- Google Chart -->
    <script>
		function zaixianauth(){
			var url = $('#url').val();
			var value = $('#value').val();
			var km = $('#km').val();
			$('#button_auth').attr('disabled',"true");
			$('#button_auth').text('申请授权中...');
			$.get('Ajax.php?my=zaixanauth&url='+url+"&value="+value+"&km="+km,function(data){
				$('#button_auth').removeAttr("disabled");
				$('#button_auth').text(data);
			});
		}
		$(document).keypress(function(event){  
			var keycode = (event.keyCode ? event.keyCode : event.which);  
			if(keycode == '13'){
				query();
			}  
		}); 
		function query(){
			var url = $('#query_url').val();
			if(url==""){
				return;
			}
			//$('#query_msg').addClass('fa fa-retweet');
			$('#query_msg').attr('class','fa fa-retweet');
			$('#query_msg').attr('disabled',"true");
			$.get('Ajax.php?my=query&query_url='+url,function(data){
				//$('#query_msg').addClass('fa fa-search');
				$('#query_msg').attr('class','fa fa-search');
				$('#query_msg').removeAttr("disabled");
				$('#query').html(data);
			});
		}
		function shuax(){
			history.go(0);
		}
		function pay_url(){
			window.open("<?=$conf['pay_url']?>");
		}
      /* Google Chart 
      -------------------------------------------------------------------*/
      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart); 
      
      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

          // Create the data table.
          var data = new google.visualization.DataTable();
          data.addColumn('string', 'Topping');
          data.addColumn('number', 'Slices');
          data.addRows([
            ['Mushrooms', 3],
            ['Onions', 1],
            ['Olives', 1],
            ['Zucchini', 1],
            ['Pepperoni', 2]
          ]);

          // Set chart options
          var options = {'title':'How Much Pizza I Ate Last Night'};

          // Instantiate and draw our chart, passing in some options.
          var pieChart = new google.visualization.PieChart(document.getElementById('pie_chart_div'));
          pieChart.draw(data, options);

          var barChart = new google.visualization.BarChart(document.getElementById('bar_chart_div'));
          barChart.draw(data, options);
      }

      $(document).ready(function(){
        if($.browser.mozilla) {
          //refresh page on browser resize
          // http://www.sitepoint.com/jquery-refresh-page-browser-resize/
          $(window).bind('resize', function(e)
          {
            if (window.RT) clearTimeout(window.RT);
            window.RT = setTimeout(function()
            {
              this.location.reload(false); /* false to get page from cache */
            }, 200);
          });      
        } else {
          $(window).resize(function(){
            drawChart();
          });  
        }   
      });
      
    </script>
    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script -->

  </body>
</html>