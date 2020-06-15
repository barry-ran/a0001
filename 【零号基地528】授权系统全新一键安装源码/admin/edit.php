<?php
require_once ('state.php');
$row = $DB->get_row("select * from " . DBQZ . "_user where uid='{$userrow['uid']}' limit 1");
$row_edit = $DB->get_row("select * from ". DBQZ ."_list where `id` = '{$_GET['id']}' limit 1");
//取得QQ头像：http://q4.qlogo.cn/headimg_dl?dst_uin=账号&spec=100
//联系QQ临时聊天：http://wpa.qq.com/msgrd?v=3&uin=账号&site=qq&menu=yes
if(!$row_edit)msg('数据错误,或记录不存在','maix.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title><?=$conf['name'].' - 域名编辑'?></title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    
    <link href="http://www.fontawesome.cn/assets/font-awesome/css/font-awesome.css" rel='stylesheet' type='text/css'>
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/templatemo-style.css" rel="stylesheet">
    
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
		<div class="templatemo-top-nav-container">
          <div class="row">
            <nav class="templatemo-top-nav col-lg-12 col-md-12">
              <ul class="text-uppercase">
                <li><a href="../" class="active">首页</a></li>
                <li><a href="maix.php">后台中心</a></li>
                <li><a href="kami.php">卡密管理</a></li>
                <li><a href="logout.php">注销退出</a></li>
              </ul>  
            </nav> 
          </div>
        </div>
		<!-- 导航栏结束 -->
        <div class="templatemo-content-container">
          <div class="templatemo-flex-row flex-content-row">
            <div class="templatemo-content-widget white-bg col-2">
              <i class="fa fa-times"></i>
              <div class="square"></div>
              <h2 class="templatemo-inline-block">编辑域名</h2><hr>
				<form class="templatemo-login-form" role="search">
					<div class="form-group">
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-crosshairs fa-fw"></i></div>	        		
								<input type="text" class="form-control" disabled value="<?=$row_edit['id']?>" placeholder="">           
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-link fa-fw"></i></div>	        		
								<input type="text" id="url" class="form-control" value="<?=$row_edit['url']?>" placeholder="">           
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-qq fa-fw"></i></div>	        		
								<input type="text" id="value" class="form-control" value="<?=$row_edit['value']?>" placeholder="">           
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-code fa-fw"></i></div>	        		
								<input type="text" id="authorization" class="form-control" value="<?=$row_edit['authorization']?>" placeholder="">           
							</div>
						</div>
						
					</div>
					<div class="form-group">
						<button type="button" id="button_edid" onclick="edid_url();" class="templatemo-blue-button width-100">确定修改</button>
					</div>
				</form>
            </div>
			
          </div> <!-- Second row ends -->
          
          <footer class="text-right">
            <p>Copyright &copy; 2020 <?= $conf['name'] ?></p>
          </footer>         
        </div>
      </div>
    </div>
    
    <!-- JS -->
    <script src="../js/jquery-1.11.2.min.js"></script>      <!-- jQuery -->
    <script src="../js/jquery-migrate-1.2.1.min.js"></script> <!--  jQuery Migrate Plugin -->
    <!--script src="https://www.google.com/jsapi"></script> <!-- Google Chart -->
    <script>
		function edid_url(){
			var url = $('#url').val();
			var value = $('#value').val();
			var authorization = $('#authorization').val();
			$('#button_edid').attr('disabled',"true");
			$('#button_edid').text('修改中...');
			$.get("Ajax.php?my=edit_url&id=<?=$row_edit['id']?>&url="+url+"&value="+value+"&authorization="+authorization,function(data){
				$('#button_edid').removeAttr("disabled");
				$('#button_edid').text(data);
			});
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
    <script type="text/javascript" src="../js/templatemo-script.js"></script>      <!-- Templatemo Script -->

  </body>
</html>