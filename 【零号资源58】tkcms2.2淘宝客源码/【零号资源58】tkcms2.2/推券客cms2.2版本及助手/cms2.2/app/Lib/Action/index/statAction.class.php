<?php 
vendor('PHPExcel.PHPExcel');
class statAction extends FirstendAction
{
private $accessKey = '';
	
public function _initialize()
    {
        parent::_initialize();
        $this->accessKey = trim(C('yh_gongju'));
		$tkapi=F('tqkapi/api');
		if(false ===$tkapi){
		$this->tqkapi = 'http://ap.tuiquanke.com';
		}else{
		$this->tqkapi = $tkapi;
		}

    }
	
	
	
public function update_pay_stat(){
$this->check_key();
$cookie=I('cookie','','trim');
$alixls=I('alixls','','trim');
$local = FTX_DATA_PATH ."runtime/Data/2.xls";
if(!empty($alixls)){
if(is_file($alixls)){
 $file_name=$alixls;
                $objReader = PHPExcel_IOFactory::createReader('Excel5');
                $objPHPExcel = $objReader->load($file_name,$encode='utf-8');
                $sheet = $objPHPExcel->getSheet(0);
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn(); 
				$n=0;
                for($i=2;$i<=$highestRow;$i++)
                {
                	$data['orderid']= $objPHPExcel->getActiveSheet()->getCell("Y".$i)->getValue();
				$data['status']= $objPHPExcel->getActiveSheet()->getCell("I".$i)->getValue();
				$data['up_time']= strtotime($objPHPExcel->getActiveSheet()->getCell("Q".$i)->getValue());  
                	$data['price']= number_format($objPHPExcel->getActiveSheet()->getCell("M".$i)->getValue(), 2, '.', '');  
				$data['goods_iid']= $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
			    if($this->_ajax_yh_publish_update($data)){
			    $n++;
			    }
			
				}  	
			
	 	    $json = array(
                'data'=>array(),
                'total'=>$n,
                'state'=>'yes',
                'msg'=>'同步成功！'
            );
			
		  @unlink($alixls);
$this->ajaxReturn(1, '同步成功');
		   exit(json_encode($json));
	
}

}

if(!empty($cookie)){
if(function_exists('opcache_invalidate')){
$dir=FTX_DATA_PATH.'runtime/Data/coupon/stat_update.php';
$ret=opcache_invalidate($dir,TRUE);
}
$start = F('coupon/stat_update');
if(!$start){
$start =date('Y-m-d',strtotime("-2 day"));
}
F('coupon/stat_update', date('Y-m-d',time()));
$end=date('Y-m-d',time());
$url="http://pub.alimama.com/report/getTbkPaymentDetails.json?queryType=3&payStatus=3&DownloadID=DOWNLOAD_REPORT_INCOME_NEW&startTime=".$start."&endTime=".$end;
set_time_limit(0);
$cp = curl_init($url);
$fp = fopen($local,"w");
curl_setopt($cp, CURLOPT_FILE, $fp);
curl_setopt($cp, CURLOPT_HEADER, 0);
curl_setopt($cp, CURLOPT_COOKIE, $cookie);
curl_exec($cp);
curl_close($cp);
fclose($fp);

if(is_file($local)){
                $file_name=$local;
                $objReader = PHPExcel_IOFactory::createReader('Excel5');
                $objPHPExcel = $objReader->load($file_name,$encode='utf-8');
                $sheet = $objPHPExcel->getSheet(0);
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn(); 
				$n=0;
                for($i=2;$i<=$highestRow;$i++)
                {
                	$data['orderid']= $objPHPExcel->getActiveSheet()->getCell("Y".$i)->getValue();
				$data['status']= $objPHPExcel->getActiveSheet()->getCell("I".$i)->getValue();
				$data['up_time']= strtotime($objPHPExcel->getActiveSheet()->getCell("Q".$i)->getValue());  
                	$data['price']= number_format($objPHPExcel->getActiveSheet()->getCell("M".$i)->getValue(), 2, '.', '');  
				$data['goods_iid']= $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
			    if($this->_ajax_yh_publish_update($data)){
			    $n++;
			    }
			
				}  	
			
	 	    $json = array(
                'data'=>array(),
                'total'=>$n,
                'state'=>'yes',
                'msg'=>'同步成功！'
            );
			
		@unlink($local);
		exit(json_encode($json));
	
}

 $json = array(
                'data'=>array(),
                'total'=>'0',
                'state'=>'no',
                'msg'=>'暂时没有新数据，或者抓取数据异常'
        );

	exit(json_encode($json));

	
}

}

	
public function putin_pay_stat(){
$this->check_key();
$cookie=I('cookie','','trim');
$alixls=I('alixls','','trim');
$local = FTX_DATA_PATH ."runtime/Data/1.xls";

if(!empty($alixls)){
if(is_file($alixls)){
                $file_name=$alixls;
                $objReader = PHPExcel_IOFactory::createReader('Excel5');
                $objPHPExcel = $objReader->load($file_name,$encode='utf-8');
                $sheet = $objPHPExcel->getSheet(0);
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn(); 
				$n=0;
                for($i=2;$i<=$highestRow;$i++)
                {
                	$data['orderid']= $objPHPExcel->getActiveSheet()->getCell("Y".$i)->getValue();  
				$data['add_time']= strtotime($objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue());  
				$data['status']= $objPHPExcel->getActiveSheet()->getCell("I".$i)->getValue();
                	$data['price']= number_format($objPHPExcel->getActiveSheet()->getCell("M".$i)->getValue(), 2, '.', '');  
				$data['goods_iid']= $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
				$data['goods_title']= $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
				$data['goods_num']= $objPHPExcel->getActiveSheet()->getCell("G".$i)->getValue();
				$data['ad_id']= $objPHPExcel->getActiveSheet()->getCell("AC".$i)->getValue();
				$data['income']= $objPHPExcel->getActiveSheet()->getCell("N".$i)->getValue();
				$data['ad_name']= $objPHPExcel->getActiveSheet()->getCell("AD".$i)->getValue();
				$data['goods_rate']= $objPHPExcel->getActiveSheet()->getCell("R".$i)->getValue();
			    if($this->_ajax_yh_publish_insert($data)){
			    $n++;
			    }
				
				}  	
			
	 	    $json = array(
                'data'=>array(),
                'total'=>$n,
                'state'=>'yes',
                'msg'=>'成功入库'.$n.'个订单'
       );
			
	    @unlink($alixls);
		$this->ajaxReturn(1, '成功入库'.$n.'个订单');
		exit(json_encode($json));	
	
}
	
}

if(!empty($cookie)){
if(function_exists('opcache_invalidate')){
$dir=FTX_DATA_PATH.'runtime/Data/coupon/stat_start.php';
$ret=opcache_invalidate($dir,TRUE);
}
$start = F('coupon/stat_start');
if(!$start){
$start =date('Y-m-d',strtotime("-2 day"));
}
F('coupon/stat_start', date('Y-m-d',time()));
$end=date('Y-m-d',time());
$url="http://pub.alimama.com/report/getTbkPaymentDetails.json?queryType=1&payStatus=12&DownloadID=DOWNLOAD_REPORT_INCOME_NEW&startTime=".$start."&endTime=".$end;
set_time_limit(0);
$cp = curl_init($url);
$fp = fopen($local,"w");
curl_setopt($cp, CURLOPT_FILE, $fp);
curl_setopt($cp, CURLOPT_HEADER, 0);
curl_setopt($cp, CURLOPT_COOKIE, $cookie);
curl_exec($cp);
curl_close($cp);
fclose($fp);

if(is_file($local)){
	
                $file_name=$local;
                $objReader = PHPExcel_IOFactory::createReader('Excel5');
                $objPHPExcel = $objReader->load($file_name,$encode='utf-8');
                $sheet = $objPHPExcel->getSheet(0);
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn(); 
				$n=0;
                for($i=2;$i<=$highestRow;$i++)
                {
                	$data['orderid']= $objPHPExcel->getActiveSheet()->getCell("Y".$i)->getValue();  
				$data['add_time']= strtotime($objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue());  
				$data['status']= $objPHPExcel->getActiveSheet()->getCell("I".$i)->getValue();
                	$data['price']= number_format($objPHPExcel->getActiveSheet()->getCell("M".$i)->getValue(), 2, '.', '');  
				$data['goods_iid']= $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
				$data['goods_title']= $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
				$data['goods_num']= $objPHPExcel->getActiveSheet()->getCell("G".$i)->getValue();
				$data['ad_id']= $objPHPExcel->getActiveSheet()->getCell("AC".$i)->getValue();
				$data['income']= $objPHPExcel->getActiveSheet()->getCell("N".$i)->getValue();
				$data['ad_name']= $objPHPExcel->getActiveSheet()->getCell("AD".$i)->getValue();
				$data['goods_rate']= $objPHPExcel->getActiveSheet()->getCell("R".$i)->getValue();
			    if($this->_ajax_yh_publish_insert($data)){
			    $n++;
			    }
				
				}  	
			
	 	    $json = array(
                'data'=>array(),
                'total'=>$n,
                'state'=>'yes',
                'msg'=>'成功入库'.$n.'个订单'
            );
			
		 @unlink($local);
		exit(json_encode($json));
	
}

 $json = array(
                'data'=>array(),
                'total'=>'0',
                'state'=>'no',
                'msg'=>'暂时没有新数据，或者抓取数据异常'
        );

	exit(json_encode($json));

	
}	
}	
	
	

 private function _ajax_yh_publish_update($item)
    {
        $result = $this->ajax_yh_update_order($item);
		
        return $result;
    }


 private function _ajax_yh_publish_insert($item)
    {
        $result =$this->ajax_yh_publish_stat($item);
		
        return $result;
    }
	
	
private function ajax_yh_update_order($item) {
	$prefix = C(DB_PREFIX);
	$table=$prefix.'order';
	$sql='select id,uid,integral from '.$table.' where status=1 and orderid ="'.$item['orderid'].'" and goods_iid="'.$item['goods_iid'].'" and format('.$table.'.price,2) = format('.$item['price'].',2)';
	$res=M()->query($sql);

 if ($item['status']=='订单结算' && $res){
	$map=array(
	'id'=>$res[0]['id']
	);
    	
	$data=array(
	'up_time'=>$item['up_time'],
	'status' =>3
	);
	$result=M('order')->where($map)->save($data);
	if($result){
if($res[0]['integral']>0){
M('user')->where('id='.$res[0]['uid'])->save(array(
 'score'=>array('exp','score+'.$res[0]['integral'])
));
}
	return 1;
	}else{
	return 0;
	}
		
		
	}else{
			
		return 0;

        }
     
    }

    
	
private function ajax_yh_publish_stat($item){

	$prefix = C(DB_PREFIX);
	 $table=$prefix.'order';
	$sql='select id from '.$table.' where status=1 and orderid ="'.$item['orderid'].'" and goods_iid="'.$item['goods_iid'].'" and format('.$table.'.price,2) = format('.$item['price'].',2)';
	$num=M()->execute($sql);
	$mod=M('order');
if($num<=0 && $item['status']=='订单付款'){
	
	 $item['status']=1;
		$mod->create($item);
        $item_id = $mod->add();
        if ($item_id) {
            return 1;
        } else {
            return 0;
        }
	
}else{
	
	return 0;
	
}

     
    }


protected  function check_key(){
 $json = array(
         'state'=>'no',
          'msg'=>'通行密钥不正确'
         );

$key = I('key', '', 'trim');
if(!$key || $key!=$this->accessKey){
exit(json_encode($json));
}	
 }



	
}