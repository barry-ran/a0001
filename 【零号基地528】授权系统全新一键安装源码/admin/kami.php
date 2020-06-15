<?php
require_once ('state.php');
$row = $DB->get_row("select * from " . DBQZ . "_user where uid='{$userrow['uid']}' limit 1");

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title><?=$conf['name'].' - 卡密管理'?></title>
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
                <li><a href="../">首页</a></li>
                <li><a href="maix.php">后台中心</a></li>
                <li><a href="kami.php" class="active">卡密管理</a></li>
                <li><a href="logout.php">注销退出</a></li>
              </ul>  
            </nav> 
          </div>
        </div>
		<!-- 导航栏结束 -->
        <div class="templatemo-content-container">
          <div class="templatemo-flex-row flex-content-row">
            <div class="templatemo-content-widget white-bg col-1">
              <i class="fa fa-times"></i>
              <div class="square"></div>
              <h2 class="templatemo-inline-block">生成卡密</h2><hr>
				<form class="templatemo-login-form" role="search">
					<div class="form-group">
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-sort-numeric-asc fa-fw"></i></div>	        		
								<input type="text" id="num" class="form-control" value="1" placeholder="">  
								<span class="input-group-addon">张</span>								
							</div>
						</div>
					</div>
					<div class="form-group">
						<button type="button" id="button_scbtn" onclick="sckami();" class="templatemo-blue-button width-100">生成卡密</button>
					</div>
				</form>
				<hr />
				<div class="" id="html_km"></div><!--卡密显示-->
            </div>
			<div class="col-2">
              <div class="panel panel-default templatemo-content-widget white-bg no-padding templatemo-overflow-hidden">
                <i class="fa fa-times"></i>
                <i class="fa fa-times fa fa-refresh" onclick="shuax();" style="right: 39px;"></i><!--机智的我，嗯哼~-->
                <div class="panel-heading templatemo-position-relative"><h2 class="text-uppercase">卡密列表</h2></div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <td>No.</td>
                        <td>卡密</td>
                        <td>状态</td>
                        <td>生成时间</td>
                        <td>操作</td>
                      </tr>
                    </thead>
                    <tbody>
<?php
$page = is_numeric($_GET['page']) ? $_GET['page'] : '1';
$pagein = $page + 8;
$pagesize = 10;
$start = ($page - 1) * $pagesize;
	$pages = ceil($DB->count("select count(id) as count from " . DBQZ . "_kms") / $pagesize);
	$sql_list = $DB->query("select * from " . DBQZ . "_kms order by id desc limit $start,$pagesize");
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
                        <td><?=$row_list['km']?></td>
                        <td><?php if($row_list['state']==1){echo'<font color="#FF0000">已使用</font>';}elseif($row_list['state']==0){echo'<font color="#13895F">正常</font>';}else{echo'未知';} ?></td>
                        <td><?=$row_list['date']?></td>
                        <td>
							<a id="button_<?=$row_list['id']?>" onclick="del_km(<?=$row_list['id']?>);" class="templatemo-edit-btn">删除</a>
						</td>
                      </tr>     
<?php } ?>
                    </tbody>
                  </table>    
<?php
if ($pagedo != 'seach') { ?>
			<div class="" style="text-align:center;">
				<div class="pagination">
					<li <?php
    if ($page == 1) {
        echo 'class="disabled"';
    } ?>><a class="btn btn-sm btn-alt" href="?page=1">首页</a></li>
					<li <?php
    if ($prev == $page) {
        echo 'class="disabled"';
    } ?>><a class="btn btn-sm btn-alt" href="?page=<?php echo $prev ?>">&laquo;</a></li>
					<?php
    for ($i = $page; $i <= $pagein; $i++) { ?>
					<li <?php
        if ($i == $page) {
            echo 'class="active"';
        } ?>><a class="btn btn-sm btn-alt" href="?page=<?php echo $i ?>"><?php echo $i ?></a></li>
					<?php
    } ?>
					<li <?php
    if ($next == $page) {
        echo 'class="disabled"';
    } ?>><a class="btn btn-sm btn-alt" href="?page=<?php echo $next ?>">&raquo;</a></li>
					<li <?php
    if ($page == $pages) {
        echo 'class="disabled"';
    } ?>><a class="btn btn-sm btn-alt" href="?page=<?php echo $pages ?>">末页</a></li>
				</div>
			</div>
			<?php
}  ?>
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
    <script src="../js/jquery-1.11.2.min.js"></script>      <!-- jQuery -->
    <script src="../js/jquery-migrate-1.2.1.min.js"></script> <!--  jQuery Migrate Plugin -->
    <!--script src="https://www.google.com/jsapi"></script> <!-- Google Chart -->
    <script>
		function sckami(){
			var num = $('#num').val();
			$('#button_scbtn').attr('disabled',"true");
			$('#button_scbtn').text('生成中...');
			$.get("Ajax.php?my=sckami&num="+num,function(data){
				$('#button_scbtn').removeAttr("disabled");
				$('#button_scbtn').text('生成卡密');
				$('#html_km').html(data);
			});
		}
		function del_km(id){
			$('#button_'+id).attr('disabled',"true");
			$('#button_'+id).text('删除中...');
			$.get('Ajax.php?my=del_km&id='+id,function(data){
				if(data=='删除成功'){
					$('#button_'+id).text('删除成功');
					$('#dei_'+id).remove();
				}else{
					$('#button_'+id).removeAttr("disabled");
					$('#button_'+id).text(data);
				}
			});
		}
		function shuax(){
			history.go(0);
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