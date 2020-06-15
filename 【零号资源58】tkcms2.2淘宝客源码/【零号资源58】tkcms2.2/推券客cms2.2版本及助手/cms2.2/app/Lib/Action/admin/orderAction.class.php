<?php
vendor('PHPExcel.PHPExcel');
class orderAction extends BackendAction
{
  //  protected $list_relation = true;
    
    public function _initialize()
    {
        parent::_initialize();
        $this->assign('list_table', true);
        $this->_name = 'order';
    }
	
	
public function delete_f()
    {
        $mod = D($this->_name);
        $pk = $mod->getPk();
        $ids = trim($this->_request($pk), ',');
        if ($ids) {
            if (false !== $mod->delete($ids)) {
                IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
                $this->success(L('operation_success'));
            } else {
                IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
                $this->error(L('operation_failure'));
            }
        } else {
            IS_AJAX && $this->ajaxReturn(0, L('illegal_parameters'));
            $this->error(L('illegal_parameters'));
        }
    }
    
    protected function _search()
    {
        $map = array();
        
        if($_GET['status']){
            $map['status'] = $this->_get('status', 'trim');
        }
        
        if($_GET['keyword']){
            $map['orderid'] = $this->_get('keyword', 'trim');
        }
		
        return $map;
    }
	
	
	
public function export_payed(){
		
 if (IS_AJAX) {
                $response = $this->fetch();
                $this->ajaxReturn(1, '', $response);
            } else {
                $this->display();
            }
	
}


public function export_sus(){
 if (IS_AJAX) {
                $response = $this->fetch();
                $this->ajaxReturn(1, '', $response);
            } else {
                $this->display();
            }
	
}



	
public function ajax_upload_xls() {
        if (!empty($_FILES['img']['name'])) {
            $result = $this->_upload($_FILES['img'], 'xls/');
            if ($result['error']) {
                $this->error(0, $result['info']);
            } else {
                $data['img'] = $result['info'][0]['savename'];
                $this->ajaxReturn(1, L('operation_success'), "./".C( "yh_attach_path" ).'xls/'.$data['img']);
            }
        } else {
            $this->ajaxReturn(0, L('illegal_parameters'));
        }
    }
	
public function export(){
	
$start_time=I('time_start');
$end_time=I('time_end');

if(empty($start_time) || empty($end_time)){
	
exit('Export time must be chosen');
	
}

$webmaster=I('webmaster');
$status=I('status');

if($status == 3){
	
$filed_time='up_time';	
	
}else{
	
$filed_time='add_time';
}

$where[$filed_time] = array(
            array(
                'egt',
                strtotime($start_time)
            ),
            array(
                'elt',
                strtotime($end_time)
            )
);

if(!empty($status)){

$where['status']= $status;
	
}

if(!empty($webmaster)){

$where['ad_id']= $webmaster;
	
}
$prefix = C(DB_PREFIX);
$field='*,
(select webmaster_rate from '.$prefix.'user where '.$prefix.'user.webmaster_pid = '.$prefix.'order.ad_id) as rates';
$result=M('order')->field($field)->where($where)->select();

if($result){
	

	
 $objPHPExcel = new PHPExcel();
	
 $objPHPExcel->getProperties()->setCreator("tuiquanke.com")
                               ->setLastModifiedBy("tuiquanke.com")
                               ->setTitle("订单数据导出")
                               ->setSubject("订单数据导出")
                               ->setDescription("备份数据")
                               ->setKeywords("excel")
                               ->setCategory("result file");
							   
        $objPHPExcel->getActiveSheet()->setCellValue('A1', '订单号');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', '付款时间');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', '付款');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', '返积分');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', '结算时间');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', '商品链接');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', '推广位');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', '佣金比例');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', '预估收入');
		$objPHPExcel->getActiveSheet()->setCellValue('J1', '站长分成');
		$objPHPExcel->getActiveSheet()->setCellValue('K1', '扣除站长积分返款');
							   	
							   
 foreach($result as $k => $v){
              $num=$k+2;
	 if($v['up_time']){
				$up_time=date('Y-m-d H:i:s',$v['up_time']);
				}else{
				$up_time='--';
		}
				
	$cashback=round(($v['integral']*(abs(C('yh_fanxian'))/100))*($v['rates']/100),2);
	
	$income=round($v['income']*($v['rates']/100),2);
	 
              $objPHPExcel->setActiveSheetIndex(0)
                          ->setCellValue('A'.$num, ' '.$v['orderid'])    
                          ->setCellValue('B'.$num, date('Y-m-d H:i:s',$v['add_time']))
                          ->setCellValue('C'.$num, $v['price'])
						  ->setCellValue('D'.$num, $v['integral'])
						  ->setCellValue('E'.$num, $up_time)
						  ->setCellValue('F'.$num, 'https://item.taobao.com/item.htm?id='.$v['goods_iid'])
					      ->setCellValue('G'.$num, $v['ad_name'])
						  ->setCellValue('H'.$num, $v['goods_rate'])
						  ->setCellValue('I'.$num, $v['income'])
						  ->setCellValue('J'.$num, $income)
						  ->setCellValue('K'.$num, $cashback);
            }
 
           $objPHPExcel->setActiveSheetIndex(0);
             header('Content-Type: application/vnd.ms-excel');
             header('Content-Disposition: attachment;filename="'.date('Y-m-d',NOW_TIME).'.xls"');
             header('Cache-Control: max-age=0');
             $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
             $objWriter->save('php://output');
             exit;
		
	
}else{
	
	exit('no data');
	
}



	
	
}
	
	
public function index(){
	
	
$webmaster=M('user')->field('phone,webmaster_pid,nickname')->where('webmaster = 1')->select();
$this->assign('webmaster',$webmaster);
	
	
$p = I('p', 1, 'intval');
$page_size = 20;
$start = $page_size * ($p - 1);
$mod=M($this->_name);
if($_GET['status']){
$where['status']=$this->_get('status', 'trim');
 } 

 if($_GET['keyword']){
     $where['orderid'] = $this->_get('keyword', 'trim');
 }
 
$prefix = C(DB_PREFIX);
$field = '*,
   (select nickname from '.$prefix.'user where '.$prefix.'user.webmaster_pid = '.$prefix.'order.ad_id) as webmaster,
   (select nickname from '.$prefix.'user where '.$prefix.'user.id = '.$prefix.'order.uid) as nickname';
$rows = $mod->field($field)->where($where)->order('add_time desc')->limit($start . ',' . $page_size)->select();
$count = $mod->where($where)->count();
$pager = $this->_pager($count, $page_size);
$this->assign('page', $pager->show());
$this->assign('total_item', $count);
$this -> assign('page_size',$page_size);
foreach($rows as $k=>$v){
       //$cashback=round(($v['integral']*($this->fanxian/100))*($webmaster_rate/100),2);
	//	$income=round($v['income']*($webmaster_rate/100),2);
		
		$list[$k]['status']=$this->orderstatic($v['status']);
		$list[$k]['orderid']=$v['orderid'];
		$list[$k]['id']=$v['id'];
		$list[$k]['integral']=$v['integral'];
		$list[$k]['income']=$v['income'];
		$list[$k]['add_time']=date('m-d H:i:s',$v['add_time']);
		if($v['up_time']){
		$list[$k]['up_time']=date('m-d H:i:s',$v['up_time']);	
		}
		$list[$k]['goods_iid']=$v['goods_iid'];
	    $list[$k]['goods_title']=$v['goods_title'];
		$list[$k]['ad_name']=$v['ad_name'];
		$list[$k]['price']=$v['price'];
		if($v['integral']){
		//$list[$k]['cashback']=$cashback;
		}
		//$list[$k]['payment']=round($income-$cashback,2);
		$list[$k]['nickname']=$v['nickname'];
		if($v['webmaster']){
			$list[$k]['webmaster']='('.$v['webmaster'].')';
		}
		
	
	
	
}




$this->assign('orderlist',$list);

	
$this->display();
	
	
}



protected function orderstatic($id){
switch($id){
	case 0 :
	return '待处理';
	break;
	case 1 :
	return '已付款';
	break;
	case 2 :
	return '无效订单';
	break;
	case 3 :
	return '已结算';
	break;
	default : 
	return '订单失效';
	break;
}
	
}	
	
	

public function update_pay_stat(){
	
if(IS_POST){
$alixls=I('alixls','','trim');
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

}


}



public function putin_pay_stat(){
	if(IS_POST){
$alixls=I('alixls','','trim');
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

	
	
	
public function add_score(){
if(IS_POST){
$id=I('id');
$score=I('score','','trim');
$price=I('price','','trim');
if(!empty($id) && !empty($score) && !empty($price)){
$info=M('order')->where('id='.$id)->find();
if($info){
$res=M('order')->where('id='.$id)->save(array(
'status'=>3,
'integral'=>$score,
'price'=>$price,
'up_time'=>time()
));

if($res){
M('user')->where('id='.$info['uid'])->save(array(
 'score'=>array('exp','score+'.$score)
));

return $this->ajaxReturn(1, '操作成功');	
}

	
}

}

return $this->ajaxReturn(0, '操作失败');	

}

if (IS_AJAX) {
            $response = $this->fetch();
            $this->ajaxReturn(1, '', $response);
        } else {
            $this->display();
        }
		
}
	
    
    public function audit()
    {
        $mod = D($this->_name);
        $pk = $mod->getPk();
        
        if(IS_POST){
                
            $id = $this->_post($pk, 'intval');
                
            if (false === $data = $mod->create()) {
                IS_AJAX && $this->ajaxReturn(0, $mod->getError());
                $this->error($mod->getError());
            }
            
            if (false !== $mod->where(array('id'=>$id))->save($data)) {
                
                $item = $mod->find($id);
                
                if($item['status'] == 1){
                    M('user_cash')->add(array(
                        'uid'=>$item['uid'],
                        'money'=>$item['money'],
                        'type'=>1,
                        'remark'=>'充值：'.$item['money'].'元',
                        'data'=>$item['id'],
                        'create_time'=>NOW_TIME,
                        'status'=>1,
                    ));
                    
                    M('user')->where(array('id'=>$item['uid']))->setInc('money', $item['money']);
                }
                
                
                IS_AJAX && $this->ajaxReturn(1, L('operation_success'), '', 'audit');
                return $this->success(L('operation_success'));
            } else {
                IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
                return $this->error(L('operation_failure'));
            }
        }
        
        $id = $this->_get($pk, 'intval');
        $info = $mod->find($id);
        $this->assign('info', $info);
        $this->assign('open_validator', true);
        if (IS_AJAX) {
            $response = $this->fetch();
            $this->ajaxReturn(1, '', $response);
        } else {
            $this->display();
        }
    }

    public function ajax_upload_img() {
        if (!empty($_FILES['img']['name'])) {
            $result = $this->_upload($_FILES['img'], 'charge/');
            if ($result['error']) {
                $this->error(0, $result['info']);
            } else {
                $data['img'] = $result['info'][0]['savename'];
                $this->ajaxReturn(1, L('operation_success'), "/".C( "yh_attach_path" ).'charge/'.$data['img']);
            }
        } else {
            $this->ajaxReturn(0, L('illegal_parameters'));
        }
    }
}