<?php
include '../includes/common.php';
if($userrow['user_status']==2){
  @header('Content-Type: text/html; charset=UTF-8');
    exit("<script language='javascript'>alert('您的账号处于冻结状态,所有权限不能使用！请联系管理员或您的上级代理！');window.location.href='./';</script>");
  exit();
  }
  $woid = $_GET['id'];
   $work_row = $DB->get_row("select * from ku_complain where  username = '".$userrow['username']."' and id = ".$woid." limit 1");
?>
<!doctype html>
<html lang="en"> 
<head>
   <title>用户后台 | <?=$conf['title']?></title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/vendor/linearicons/style.css">
  <link rel="stylesheet" href="assets/vendor/chartist/css/chartist-custom.css">
  <link rel="stylesheet" href="assets/css/main.css">
  <link rel="stylesheet" href="assets/css/demo.css">
  <link rel="stylesheet" href="assets/css/user.css">
  <link rel="stylesheet" href="assets/foot/iconfont.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head> 
<body>
<?php
include 'header.php';
?>
<?php 
 include 'nav.php';
 ?>
   <div class="main">
		<div class="main-content">
				<div class="container-fluid">
					<div class="alert alert-info alert-dismissible" role="alert">
			 <?=$conf['ts-line_tips']?>
				</div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-body">
                            <h3 class="box-title m-b-0">回复工单</h3>
                            <br>
                            <form class="form-horizontal" method="post">
                            <input type="hidden" name="id" class="form-control" value="<?=$woid?>">
                                <div class="form-group">
                                    <label class="col-md-12">工单标题</label>
                                    <div class="col-md-4">
                                       <input type="text" placeholder="这里填入产品类型" class="form-control" value="<?=$work_row['title']?>">
                                </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-md-12">工单类型</label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="Product">
                                <option value="0" <?=$work_row['type']==0?"selected":""?>>
                                BUG反馈
                              </option>
                              <option value="1" <?=$work_row['type']==1?"selected":""?>>
                                账号问题 
                              </option>
                              <option value="2" <?=$work_row['type']==2?"selected":""?>>
                               代理问题
                              </option>
                              <option value="3" <?=$work_row['type']==3?"selected":""?>>
                               订单问题
                              </option>
                              <option value="4" <?=$work_row['type']==4?"selected":""?>>
                               授权问题
                              </option>
                              <option value="5" <?=$work_row['type']==5?"selected":""?>>
                               其他/建议
                              </option>
                           </select>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" for="example-email">回复内容</label>
                                    <div class="col-md-8">
                                      <textarea rows="3" cols="5" class="form-control" placeholder="该工单暂未处理，当前无回复内容"><?=$work_row['hfconte']?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" for="example-email">内容</label>
                                    <div class="col-md-8">
                                      <textarea rows="3" cols="5" name="comp" class="form-control" placeholder="这里填写您的回复内容" value=""></textarea>
                                    </div>
                                </div>
                           
                              <button type="button" id="work" class="btn btn-info">确定提交</button>
                               
                            </form>
                        </div>
                    </div>
                </div>
           </div>
      </div>
</div>
	<div class="clearfix"></div>
    <footer>
      <div class="container-fluid">
        <p class="copyright"><a href="http://www.kuxiangcms.com/" title="YSの余生" target="_blank"><?php echo $conf['copyright'] ?></a></p>
      </div>

     
    </footer>
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <script src="assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
  <script src="assets/vendor/chartist/js/chartist.min.js"></script>
 
  <script src="/public/layer/layer.js"></script>
  <script>
$(function () {          
  $("#work").click(function(){
            var id=$("input[name='id']").val();
            var comp=$("textarea[name='comp']").val();

            if (id=='' ){
                    layer.alert('缺少参数！',{icon:5,title:'提示信息！'});
                        return false;}
             if (comp=='' ){
                    layer.alert('回复内容不能为空！',{icon:5,title:'提示信息！'});
                        return false;}
            
            var load = layer.load(0, {shade:[0.1,'#fff']});
                $.ajax({
                    type : "POST",
                    url : "ajax.php?act=work",
                    data : {id:id,comp:comp},
                    dataType : 'json',
                    success : function(data) {
                        layer.close(load);
                        if(data.code == -1){
                            layer.alert(data.msg,{icon:5,title:'提示信息！'});
                        }else{
                             if (data.code == 1){
                                 layer.alert(data.msg,{icon:6,title:'提示信息！'},function(){
                               window.location.href = "workOrder.html";
                               });
                            }else{
                                layer.alert(data.msg,{icon:5,title:'提示信息！'});
                            }
                        }
                    }
                });
            });
   });
</script>
</body>
</html>