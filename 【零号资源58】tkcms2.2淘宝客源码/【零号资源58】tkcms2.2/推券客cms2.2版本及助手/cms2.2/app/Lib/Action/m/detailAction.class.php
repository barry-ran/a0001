<?php
class detailAction extends FirstendAction {
	public function _initialize() {
		parent::_initialize();
		$this->_mod = D('items');
		if($this->getRobot()==false){
			$this->getrobot='no';
		}
	}
	
	
	public function index(){
		
		
		$id = I('id', '','trim');
		$item = $this->_mod->where(array('id' => $id))->find(); !$item && $this->_404();
        $this->assign('mdomain',str_replace('/index.php/m','',C('yh_headerm_html')));
		if($this->getrobot=='no')
		{
			$last_time=date('Y-m-d',$item['last_time']);
			$today=date('Y-m-d',time());

			if($last_time!=$today){
				$api_err='no';
				
$apiurl=$this->tqkapi.'/gconvert';
$apidata=array(
'tqk_uid'=>$this->tqkuid,
'time'=>time(),
'good_id'=>''.$item['num_iid'].''
);
$token=$this->create_token(trim(C('yh_gongju')),$apidata);
$apidata['token']=$token;
$res= $this->_curl($apiurl,$apidata, false);
$res = json_decode($res, true);
				$me=$res['me'];
				if(strlen($me)>5){
					$quanurl='https://uland.taobao.com/coupon/edetail?e='.$me.'&activityId='.$item['Quan_id'].'&itemId='.$item['num_iid'].'&pid='.trim(C("yh_taobao_pid")).'&af=1';
					$kouling=kouling($item['pic_url'].'_400x400',$item['title'],$quanurl);
					$data=array(
						'last_time'=>time(),
						'quankouling'=>$kouling,
						'quanurl'=>$quanurl,
						'ding'=>0,
						'que'=>1
						);
					$re=$this->_mod->where(array(
						'num_iid' => $item['num_iid']
						))->save($data);


					if($re){

						$item['quankouling']=$kouling;
						$item['quanurl']=$quanurl;
						$item['que']=1;
					}else{

						$api_err='yes';

					}	

				}else{

					$api_err='yes';

				}

			}
		}

		if(C('yh_item_hit')){
			$hits_data = array('hits'=>array('exp','hits+1'));
			$this->_mod->where(array('id'=>$id))->setField($hits_data);
		}

		$this->_config_seo(C('yh_seo_config.item'), array(
			'title' => $item['title'],
			'intro' => $item['intro'],
			'price' => $item['price'],
			'quan' => floattostr($item['quan']),
			'coupon_price' => $item['coupon_price'],
			'tags' => $tags,
			'seo_title' => $item['seo_title'],
			'seo_keywords' => $item['seo_keys'],
			'seo_description' => $item['seo_desc'],
			));

		$cid = $item["cate_id"];
		$where=array(
			'cate_id'=>$cid,
			'id'=>array('neq',$id)
			);
		$orlike = $this->_mod->where($where)->field('id,title,pic_url,coupon_price,price,shop_type')->limit('0,6')->order('is_commend desc,id desc')->select();
		$this->assign('orlike', $orlike);
		if(empty($item['quankouling']) || $item['quankouling']=='0' || $item['quankouling']=='undefined'){
			$kouling=kouling($item['pic_url'].'_200x200.jpg',$item['title'],$item['quanurl']);
			$item['quankouling']=$kouling;
			$this->_mod->where(array(
				'num_iid' => $item['num_iid']
				))->setField('quankouling',$kouling);
		}


		if($this->getrobot=='no' && $api_err=='yes')
		{
			$last_time=date('Y-m-d',$item['last_time']);
			$today=date('Y-m-d',time());
//if($last_time!=$today || $item['ding']==1 || ($item['tk']==1 && $item['que']==0) ){
			if($last_time!=$today){	
				if(function_exists('opcache_invalidate')){
					$basedir = $_SERVER['DOCUMENT_ROOT']; 
					$dir=$basedir.'/data/runtime/Data/coupon/disable_num_iids.php';
					$ret=opcache_invalidate($dir,TRUE);
				}
				$disable_num_iids = F('coupon/disable_num_iids');
				if(!$disable_num_iids){
					$disable_num_iids = array();
				}
				$is=strpos(serialize($disable_num_iids),$item['num_iid']);
				if(empty($is)){
					$disable_num_iids[] =array(
						'num_iid'=>$item['num_iid'],
						'rate'=>$item['commission_rate'],
						'zc_id'=>$item['zc_id']
						); 
					
					if(function_exists('opcache_invalidate')){
						$basedir = $_SERVER['DOCUMENT_ROOT']; 
						$dir=$basedir.'/data/runtime/Data/coupon/disable_num_iids.php';
						$ret=opcache_invalidate($dir,TRUE);
					}

					F('coupon/disable_num_iids', $disable_num_iids);
					$data=array(
						'last_time'=>time(),
						'ding'=>0,
						'que'=>1,
						);
					$this->_mod->where(array(
						'num_iid' => $item['num_iid']
						))->save($data);

				}
			}
		}





		if($this->getrobot=='no'){
			$track_val=cookie('trackid');
			if(!empty($track_val)){
				
$apiurl=$this->tqkapi.'/gconvert';
$track='_'.base64_decode($track_val);
$par_pid=$this->parent_pid();
$npid=str_replace($par_pid,$track,trim(C('yh_taobao_pid')));
$apidata=array(
'tqk_uid'=>$this->tqkuid,
'good_id'=>$item['num_iid'],
'time'=>time(),
'pid'=>$npid
);
$token=$this->create_token(trim(C('yh_gongju')),$apidata);
$apidata['token']=$token;
$res= $this->_curl($apiurl,$apidata, false);
$res = json_decode($res, true);
				$me=$res['me'];
				if(strlen($me)>5){
					$quanurl='https://uland.taobao.com/coupon/edetail?e='.$me.'&activityId='.$item['Quan_id'].'&itemId='.$item['num_iid'].'&pid='. $npid .'&af=1';
					$item['quanurl']=$quanurl;
					$item['quankouling']=kouling($item['pic_url'].'_400x400',$item['title'],$quanurl);
				}
				$this->assign('act','yes');
			}

		}
		if($this->getrobot=='no'){
			$Now=time();
			$this->assign('uptime',$Now-$item['up_time']);
		}
		
		$agent=strtolower($_SERVER['HTTP_USER_AGENT']);
		if(strpos($agent,'ucbrowser')>10){
		$item['quankouling']=str_replace("￥","《",$item['quankouling']);	
		}
		
		$this->assign('item', $item);

		$this->display();

	}

	public function productinfo(){
		$num_iid=I('numiid');
		if ($num_iid) {
			$descUrl = 'http://hws.m.taobao.com/cache/mtop.wdetail.getItemDescx/4.1/?data=%7B%22item_num_id%22%3A%22' . $num_iid . '%22%7D';
			$yhxia_https = new yhxia_https();
			$yhxia_https->fetch($descUrl);
			$source = $yhxia_https->results;
			if (!$source) {
				$source = file_get_contents($descUrl);
			}
			$result_data = json_decode($source, true);
			$dinfo = array();
			$num = $result_data['data']['images'];
			for ($i = 0; $i < count($num); $i++) {
				$images = $i + 1;
				$desc[$images] = $num[$i];
				$desc[$images] = '<img class="lazy" src=' . $desc[$images] . '>';
			}
			if(count(explode(".gif", $desc[1])) > 1){$desc[1]='';}
			$desc = $desc[1] . '' . $desc[2] . '' . $desc[3] . '' . $desc[4] . '' . $desc[5] . '' . $desc[6] . '' . $desc[7] . '' . $desc[8] . '' . $desc[9] . '' . $desc[10] . '' . $desc[11] . '' . $desc[12] . '' . $desc[13] . '' . $desc[14] . '' . $desc[15] . '' . $desc[16] . '' . $desc[17] . '' . $desc[18] . '' . $desc[19] . '' . $desc[20] . '' . $desc[21] . '' . $desc[22] . '' . $desc[23] . '' . $desc[24] . '' . $desc[25] . '' . $desc[26] . '' . $desc[27] . '' . $desc[28] . '' . $desc[29] . '' . $desc[30];
			$data['desc'] = $desc;
			$json=array(
				'status'=>'ok',
				'content'=>$desc
				);
			$this->_mod->where(array('num_iid' => $num_iid))->save($data);
			exit(json_encode($json));
		}



	}

	public function qrcode(){
		vendor("phpqrcode.phpqrcode");
		$data= I('dataurl', '', 'trim');
		$data=urldecode($data);
		$level = 'H';  
		$size = 4;
		QRcode::png($data, false, $level, $size,0);
	} 

	public function pic_conversion(){
		$image = $this->getImage(I('pic_url','','trim'));
		if($image){
			exit(json_encode($image));
		}

	} 


 private function getImage($url,$save_dir='',$filename='',$type=0){
	if(trim($url)==''){
		return array('file_name'=>'','save_path'=>'','error'=>1);
	}
	if(trim($save_dir)==''){
		$save_dir='./';
	}
            if(trim($filename)==''){
            	$ext=strrchr($url,'.');
            	if($ext!='.gif'&&$ext!='.jpg'&&$ext!='.png'&&$ext!='.jpeg'){
            		return array('file_name'=>'','save_path'=>'','error'=>3);
            	}
            	$filename=time().rand(0,10000).$ext;
            }
            if(0!==strrpos($save_dir,'/')){
            	$save_dir.="/" . C("yh_attach_path") . 'avatar/';
            }
            if(!file_exists($save_dir)&&!mkdir($save_dir,0777,true)){
            	return array('file_name'=>'','save_path'=>'','error'=>5);
            }
            if($type){
            	$ch=curl_init();
            	$timeout=5;
            	curl_setopt($ch,CURLOPT_URL,$url);
            	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
            	$img=curl_exec($ch);
            	curl_close($ch);
            }else{
            	ob_start();
            	readfile($url);
            	$img=ob_get_contents();
            	ob_end_clean();
            }
            $fp2=@fopen($save_dir.$filename,'a');
            fwrite($fp2,$img);
            fclose($fp2);
            unset($img,$url);
            $save_dir = mb_substr($save_dir, 2);
            return array('file_name'=>$filename,'save_path'=>$save_dir.$filename,'error'=>0);
        }

	public function del_img(){
		$url = I('address','','trim');
		$file = FTX_IMG_DATA_PATH.$url; 
		$result = @unlink ($file); 
		exit(json_encode($file));
	}



	
	
}



        function floattostr( $val ){
        	preg_match( "#^([\+\-]|)([0-9]*)(\.([0-9]*?)|)(0*)$#", trim($val), $o );
        	return $o[1].sprintf('%d',$o[2]).($o[3]!='.'?$o[3]:'');
        }	