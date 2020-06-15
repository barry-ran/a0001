<?php
require '../conn/conn.php';
require '../conn/function.php';

function readtxt($path){
    if(is_file($path)){
        return file_get_contents($path);
    }else{
        return "";
    }
}

$t1 = microtime(true);
$dir=str_replace("/", "\\",dirname(__FILE__));
$dirx="";

$action=$_GET["action"];


if($action=="clear"){
    @removeDir("../conn/file");  //更新模板
    @mkdir("../conn/file",0755,true);
    die("清理缓存完毕！");
}

if($action!="update"){
    $version_info=trim(readtxt($dirx."version.txt"),"\xEF\xBB\xBF");
    $update=GetBody("http://fahuo100.oss-cn-shenzhen.aliyuncs.com/php/update.txt","","GET");
    $update=str_replace("\r\n","",$update);
    $update=trim($update,"\xEF\xBB\xBF");
    $up_list=splitx($update,"|",1);
    $file_list=splitx($update,"|",2);
    $file_list2=splitx($update,"|",3);
    $md5_list=splitx($update,"|",5);
    
    $f=explode("@",$file_list2);
    for($i=0;$i<count($f);$i++){
        $md5=$md5.md5(trim(readtxt($dirx.$f[$i]),"\xEF\xBB\xBF"))."@";
    }

    $md5=substr($md5,0,strlen($md5)-1); 

    if($md5_list==$md5){
        $b="最新版程序 ".$version_info."，无文件需更新";
        $c="";
        $d="";
        $e="";
    }else{
        for($i=0;$i<count(explode("@",$md5_list));$i++){
            if(splitx($md5_list,"@",$i)!=splitx($md5,"@",$i)){
                $b=$b.splitx(str_replace("admin/",$C_admin."/",$file_list),"@",$i)."<br>";
                $c=$c.splitx($file_list2,"@",$i)."@";
                $d=$d.splitx($file_list,"@",$i)."@";
                $e=$e.splitx($md5_list,"@",$i)."@";
            }
        }
        $c=substr($c,0,strlen($c)-1); 
        $d=substr($d,0,strlen($d)-1);
        $e=substr($e,0,strlen($e)-1); 
    }
    $num=count(explode("@",$d));
    file_put_contents($dirx."update.txt",$d."|".$c."|".$e);
}

if($action=="md5"){
    if($md5_list==$md5){
        die("md5一致，所有文件都已更新成功！");
    }else{
        for($i=0;$i<count(explode("@",$md5_list));$i++){
            if(splitx($md5_list,"@",$i)!=splitx($md5,"@",$i)){
                $g=$g.splitx(str_replace("admin/",$C_admin."/",$file_list),"@",$i)."<br>";
            }
        }
        die("md5不一致，以下文件未更新成功（检查是否开启了写入权限）！<br>".$g);
    }
}

if($action=="update"){
    $id=intval($_GET["id"]);
    $f1=splitx(splitx(readtxt($dirx."update.txt"),"|",0),"@",$id);
    $f2=splitx(splitx(readtxt($dirx."update.txt"),"|",1),"@",$id);
    $f3=splitx(splitx(readtxt($dirx."update.txt"),"|",2),"@",$id);

    if(!is_file($dirx.$f2)){
        $file_str=trim(GetBody("http://fahuo100.oss-cn-shenzhen.aliyuncs.com/php/".$f1.".txt","","GET"),"\xEF\xBB\xBF");
        if(!is_dir(dirname($dirx.$f2))){
            mkdirs_2(dirname($dirx.$f2));
        }
        file_put_contents($dirx.$f2,$file_str);
        
        $t2 = microtime(true);
        die($f2."|1|".round($t2-$t1,3));
    }else{
        if($f3!=md5(trim(readtxt($dirx.$f2),"\xEF\xBB\xBF"))){
            $file_str=trim(GetBody("http://fahuo100.oss-cn-shenzhen.aliyuncs.com/php/".$f1.".txt","","GET"),"\xEF\xBB\xBF");
            if(md5($file_str)!=md5(trim(readtxt($dirx.$f2),"\xEF\xBB\xBF"))){
                if(!is_dir(dirname($dirx.$f2))){
                    mkdirs_2(dirname($dirx.$f2));
                }

		        file_put_contents($dirx.$f2,$file_str);

                $t2 = microtime(true);
                die($f2."|1|".round($t2-$t1,3));
            }else{
                $t2 = microtime(true);
                die($f2."|0|".round($t2-$t1,3));
            }
        }else{
            $t2 = microtime(true);
            die($f2."|0|".round($t2-$t1,3));
        }
    }
}

if($action=="function"){
	@eval(trim(splitx($update,"|",4),"\xEF\xBB\xBF"));
    unlink($dirx."update.txt");
    die();
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>检测更新 - 后台管理</title>
		<!--favicon -->
		<link rel="icon" href="../media/<?php echo $C_ico?>" type="image/x-icon"/>
		<!--Bootstrap.min css-->
		<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
		<!--Icons css-->
		<link rel="stylesheet" href="assets/css/icons.css">
		<!--Style css-->
		<link rel="stylesheet" href="assets/css/style.css">
		<!--mCustomScrollbar css-->
		<link rel="stylesheet" href="assets/plugins/scroll-bar/jquery.mCustomScrollbar.css">
		<!--Sidemenu css-->
		<link rel="stylesheet" href="assets/plugins/toggle-menu/sidemenu.css">
		<!--Morris css-->
		<link rel="stylesheet" href="assets/plugins/morris/morris.css">
		<!--Toastr css-->
		<link rel="stylesheet" href="assets/plugins/toastr/build/toastr.css">

		<style type="text/css">
		.showpic{height: 50px;border: solid 1px #DDDDDD;padding: 5px;}
	</style>

    <script>
window.$num=<?php echo $num?>;
window.$j=0;
window.filelist="<?php echo $c?>";

function clearc(){
	$("#version").hide();
    $("#print").show();
    $("#log").show();
    $("#print").height($(window).height()-350);
	$.ajax({
        type: 'get',
        url: '?action=clear',
        success: function(data) {
        	$("#print").html("缓存文件清理完毕！<br><a class='btn btn-sm btn-success' href='../' target='_blank'><i class='fa fa-reply'></i> 前往首页</a>")
        }
    })
}

function md5(){
    $("#version").hide();
    $("#print").show();
    $("#log").show();
    $("#print").height($(window).height()-200);
    $.ajax({
            type: 'get',
            url: '?action=md5',
            success: function(data) {
                $("#print").html(data+"<br><a class='btn btn-sm btn-success' href=''><i class='fa fa-reply'></i> 返回</a>");
            }
        })
}

function updateall(i){

    $("#version").hide();
    $("#progressx").show();
    $("#print").show();
    $("#log").show();
    $("#print").height($(window).height()-100);

    if(filelist==""){
        $.get("?action=function", function(result){
            $("#progress").attr("style","width: "+(((i+1)/$num)*100)+"%");
            $("#progress").html((((i+1)/$num)*100).toFixed(2)+"%");
            $t2=(new Date()).getTime();
            $("#print").html("<p style='color:#0099ff;font-weight:bold;'>本次共更新"+$j+"个文件，耗时"+(($t2-$t1)/1000)+"秒，更新已完成，请重启浏览器！<button class='btn btn-xs btn-success' onClick='md5()' type='button'><i class='fa fa-key'></i> 校验md5</button></p>"+$("#print").html());
        });
    }else{
        $.ajax({
            type: 'get',
            url: '?action=update&id='+i,
            success: function(data) {

                $("#progress").attr("style","width: "+(((i+1)/$num)*100-1)+"%");
                $("#progress").html((((i+1)/$num)*100-1).toFixed(2)+"%");

                datax=data.split("|");
                if(datax[1]=="1"){
                    info="<p style='color:#ff9900'>更新文件 "+datax[0]+" 成功！耗时"+datax[2]+"秒</p>";
                }else{
                    info="<p style='color:#009900'>程序文件 "+datax[0]+" 无需更新！</p>";
                }
                $j=$j+Number(datax[1]);

                if(i==0){
                    $("#print").html(info);
                }else{
                    $("#print").html(info+$("#print").html());
                }
                
                if(i<$num-1){
                    updateall(i+1);
                }else{
                    $.get("?action=function", function(result){
                        $("#progress").attr("style","width: "+(((i+1)/$num)*100)+"%");
                        $("#progress").html((((i+1)/$num)*100).toFixed(2)+"%");
                        $t2=(new Date()).getTime();
                        $("#print").html("<p style='color:#0099ff;font-weight:bold;'>本次共更新"+$j+"个文件，耗时"+(($t2-$t1)/1000)+"秒，更新已完成，请重启浏览器！<button class='btn btn-xs btn-success' type='button' onClick='md5()'><i class='fa fa-key'></i> 校验md5</button></p>"+$("#print").html());
                    });
                }
            },
            error:function(data) {
                data="x|0|x";

                $("#progress").attr("style","width: "+(((i+1)/$num)*100-1)+"%");
                $("#progress").html((((i+1)/$num)*100-1).toFixed(2)+"%");

                datax=data.split("|");
                info="<p style='color:#ff0000'>更新文件 "+filelist.split("@")[i]+" 失败！[请检查目录是否存在]</p>";
                $j=$j+Number(datax[1]);

                if(i==0){
                    $("#print").html(info);
                }else{
                    $("#print").html(info+$("#print").html());
                }
                
                if(i<$num-1){
                    updateall(i+1);
                }else{
                    $.get("?action=function", function(result){
                        $t2=(new Date()).getTime();
                        $("#print").html("<p style='color:#0099ff;font-weight:bold;'>本次共更新"+$j+"个文件，耗时"+(($t2-$t1)/1000)+"秒，更新已完成，请重启浏览器！<button class='btn btn-xs btn-success' onClick='md5()' type='button'><i class='fa fa-key'></i> 校验md5</button></p>"+$("#print").html());
                    });
                }
            }
        })
    }
    
}
</script>

	</head>

	<body class="app ">

		<div id="spinner"></div>

		<div id="app">
			<div class="main-wrapper" >
				
					<?php
					require 'nav.php';
					?>

				<div class="app-content">
					<section class="section">
                    	<ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">后台管理</a></li>
                            <li class="breadcrumb-item active" aria-current="page">检测更新</li>
                        </ol>

						<div class="section-body ">
							<form id="form">
							<div class="row">
								
								<div class="col-lg-12">
									<div class="card card-primary">
										<div class="card-header ">
											<h4>检测更新</h4>
										</div>
										<div class="card-body">
												
<div class="progress progress-striped active" style="display: none;margin-bottom: 10px" id="progressx">
    <div class="progress-bar progress-bar-success" role="progressbar"
         aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
         style="width: 0%;" id="progress">
    </div>
</div>

<p style="display: none" id="log">更新日志：</p>
<div id="print" class="form-control" style="margin-top:10px;display: none;background: #f7f7f7;overflow: auto;word-wrap:break-word">
</div>


<div id="version">
<p style="font-weight: bold;">当前版本号：<?php echo $version_info?></p>
<div style="width: 100%;height: 225px;overflow: auto;background: #EEEEEE;padding: 10px;">
<?php
echo $up_list;
?>
</div>
<div style="margin: 5px 0;font-weight: bold;">需要更新的文件列表：</div>
<div style="width: 100%;height: 225px;overflow: auto;background: #EEEEEE;padding: 10px;">
<?php
echo str_replace("@","<br>",$b);
?>
</div>
<?php 
if(splitx($update,"|",0)!=$version_info || $md5!=$md5_list){
    echo "<p>更新过程请勿中断，如果遇到更新失败请联系客服寻求解决方案。</p><button type='button' class='btn btn-xs btn-success' onClick='window.\$t1=(new Date()).getTime();updateall(0);'><i class='fa fa-refresh'></i> 开始更新</button>";
}else{
    echo "<p>当前为最新版本，如有需要可强制更新。</p><button type='button' class='btn btn-xs btn-primary' onClick='window.\$t1=(new Date()).getTime();updateall(0);'><i class='fa fa-refresh'></i> 强制更新</button>";
}
?>
 <button class="btn btn-info" type="button" onclick="clearc()"><i class="fa fa-times-circle"></i> 清理缓存</button>
</div>
											
										</div>
									</div>
								</div>
							
							</div>
							</form>
						</div>
					</section>
				</div>

			</div>
		</div>

		<!--Jquery.min js-->
		<script src="assets/js/jquery.min.js"></script>

		<!--Bootstrap.min js-->
		<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

		<!--Sidemenu js-->
		<script src="assets/plugins/toggle-menu/sidemenu.js"></script>

		<!--mCustomScrollbar js-->
		<script src="assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>

		<!--Scripts js-->
		<script src="assets/js/scripts.js"></script>

		<script src="assets/plugins/toastr/build/toastr.min.js"></script>
		
	</body>
</html>
<?php
function mkdirs_2($path){
    if(!is_dir($path)){
        mkdirs_2(dirname($path));
        if(!mkdir($path, 0777)){
            return false;
        }
    }
    return true;
}
function download($url, $path){
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
  $file = curl_exec($ch);
  curl_close($ch);
  $filename = pathinfo($url, PATHINFO_BASENAME);
  $resource = fopen($path . $filename, 'a');
  fwrite($resource, $file);
  fclose($resource);
}
function get_extension($file){
    return substr($file, strrpos($file, '.')+1);
}
?>