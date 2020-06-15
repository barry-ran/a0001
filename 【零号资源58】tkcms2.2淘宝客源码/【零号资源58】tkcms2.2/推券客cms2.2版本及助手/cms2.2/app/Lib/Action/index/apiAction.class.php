<?php
import("@.ORG.Snoopy");
vendor('taobao.TopSdk');
set_time_limit(0);

class apiAction extends FirstendAction
{
    private $accessKey = '';
    
public function _initialize()
    {
        parent::_initialize();
        $this->accessKey = trim(C('yh_gongju'));

    }

public function userlist(){
//$this->check_key();
$openid = I('openid', $_SESSION['user']['openid'], 'trim');
$callback=I('callback', '', 'trim');
$uid=I('uid', '', 'trim');
$key=md5($this->accessKey);
if($openid==null || $openid=='' || $uid!=$key){
$json=array(
'status'=>'out',
'msg'=>'登录超时'
);
exit($callback.'('.json_encode($json).')');
}

$U=M('user');
$where=array(
'state'=>0,
);
$userlist_a=$U->where($where)->field('id,avatar')->select();
shuffle($userlist_a);
$where=array(
'openid'=>$openid,
);
$data=array(
'last_time'=>time(),
);
$res=$U->where($where)->save($data);
$time=time();
$userlist_b=$U->where('('.$time.'-last_time) < 3600 and state = 1')->field('id,avatar')->select();

$cout=count($userlist_b);
foreach($userlist_b as $ki=>$vi){
$userlist_b[$ki]['id']=$vi['id'];
$userlist_b[$ki]['avatar']=C('yh_site_url').$vi['avatar'];
}

foreach($userlist_a as $k=>$v){
if($k<25){
$userlist_b[$k+$cout]['id']=$v['id'];
$userlist_b[$k+$cout]['avatar']=C('yh_site_url').$v['avatar'];
}else{
 break;
}

}

M('hongbao')->where('push_time<'.time())->save(array(
'status'=>1,
));

if($userlist_b){
 $json = array(
                'result'=>$userlist_b,
                'count'=>count($userlist_b)+C('yh_person_num')+1,
                'status'=>'ok',
                'money'=>$U->where($where)->getField('money'),
                'cls'=>'person',
                'hongbao_time'=>M('hongbao')->where('status=0')->order('push_time asc')->getField('push_time'),
                'msg'=>'获取用户数据成功'
 );	
exit($callback.'('.json_encode($json).')');
}else{
$data=array(
'status'=>'no',
'msg'=>'没有用户数据！'
);
exit($callback.'('.json_encode($data).')');
}

}	


public function zhibo_save_hid(){
$callback=I('callback', '', 'trim');
$uid = I('openid', $_SESSION['user']['openid'], 'trim');
$ke=I('uid', '', 'trim');
$key=md5($this->accessKey);
if($uid==null || $uid=='' || $ke!=$key){
$json=array(
'status'=>'out',
'msg'=>'登录超时'
);
exit($callback.'('.json_encode($json).')');
}
$hid = I('id', '', 'trim');
$user=M('user')->where("openid='".$uid."'")->field('id,money')->find();
$userid=$user['id'];
$mod=M('hongbao_detail');
$ucount=$mod->where('uid='.$userid.' and hid='.$hid)->count();
if($ucount>0){
$json=array(
'status'=>'no',
'money'=>$user['money'],
//'msg'=>$ucount
'msg'=>'你已经抢过了<br/>把机会留给别人吧！'
);
exit($callback.'('.json_encode($json).')');	
}else{

$where=array(
'hid'=>$hid,
'status'=>0,
);
$res=$mod->where($where)->find();
if($res){
$data=array(
'status'=>1,
'uid'=>$userid,
'get_time'=>time()
);
$re=$mod->where('id='.$res['id'])->save($data);
if($re){
M('user')->where('id='.$userid)->save(array(
 'money'=>array('exp','money+'.$res['price'])
));

 M('user_cash')->add(array(
	    		'uid'         =>$userid,
	    		'money'       =>$res['price'],
	    		'remark'      =>'抢红包: '.$res['price'].'元',
	    		'type'        =>11, 
	    		'create_time' =>time(),
	    		'status'      =>1,
	    	));


$json=array(
'status'=>'ok',
'money'=>$user['money']+$res['price'],
'price'=>$res['price'],
'msg'=>'领取红包成功！'
);
}	
}else{
$json=array(
'status'=>'no',
'money'=>$user['money'],
'msg'=>'手慢了，红包派完了'
);

}
	
exit($callback.'('.json_encode($json).')');
}
	
}

public function push_hongbao(){
$json = array(
         'state'=>'no',
          'msg'=>'通行密钥不正确'
 );
$key = I('ikey', '', 'trim');
if(!$key || $key!=md5($this->accessKey)){
exit($callback.'('.json_encode($json).')');	
}	
$callback=I('callback', '', 'trim');
$token=I('token','','trim');
if(empty($sign) || $sign=='' && $sign==null ){
$sign=$token;
$mod=M('hongbao');
$mod_detail=M('hongbao_detail');
$task=$mod->where('push_time < now() and status=0')->order('push_time asc')->field('id,push_time')->find();
$now=time();
if($task && ($now-$task['push_time'])>0){
$hb_list=$mod_detail->where('hid='.$task['id'])->count();
if($hb_list){
	$json=array(
	'count'=>$hb_list,
	'hid'=>$task['id'],
	'cls'=>'hongbao',
	'status'=>'ok',
	'msg'=>'获取红包成功'
	);
exit($callback.'('.json_encode($json).')');	

}

}

}


$json=array(
'status'=>'no',
'msg'=>'暂时没有要推送的信息'
);
exit($callback.'('.json_encode($json).')');	

}

public function save_order(){
$this->check_key();
$content = I('content', '', 'trim');
if(!empty($content)){
$orderlist=explode(',', $content);
if(count($orderlist)>0){
$paymentlist=array();	
foreach($orderlist as $k=>$v){
$child=explode(':', $v);
$iis=strpos(serialize($paymentlist),$child[0]);
if($iis!==false && $child[1]==12){
		
$paymentlist[$child[0]]=array(
'payStatus'=>$child[1],
'totalAlipayFeeString'=>$child[2]+$paymentlist[$child[0]]['totalAlipayFeeString'],
'feeString'=>ceil($child[3]+$paymentlist[$child[0]]['feeString']),
);
	
}else{
		
$paymentlist[$child[0]]=array(
'payStatus'=>$child[1],
'totalAlipayFeeString'=>$child[2],
'feeString'=>ceil($child[3]),
);
	
}
}


$order=M('order')->where('status=0')->select();
if($order){
foreach($order as $kk=>$vv){
$is=strpos(serialize($paymentlist),$vv['orderid']);
if($is!==false){
$child=$paymentlist[$vv['orderid']];
if($child['payStatus']==12){
$data['status']=1;
$data['integral']=$child['feeString'];
$data['price']=$child['totalAlipayFeeString'];
}else{
$data['status']=2;
$data['integral']=0;	
}


$data['up_time']=time();
$res=M('order')->where('id='.$vv['id'])->save($data);

}else{
$data['status']=2;
$data['integral']=0;	
$data['up_time']=time();
$res=M('order')->where('id='.$vv['id'])->save($data);
	
}




	
}
	
	
}

	
}

}
	
	
}




public function save_order_jiesuan(){
$this->check_key();
$content = I('content', '', 'trim');
if(!empty($content)){

$orderlist=explode(',', $content);
if(count($orderlist)>0){
$paymentlist=array();	
foreach($orderlist as $k=>$v){
$part=explode(':', $v);
$paymentlist[$part[0]]=array(
'payStatus'=>$part[1]
);
	
}

$order=M('order')->where('status=1')->select();
if($order){
foreach($order as $kk=>$vv){
$is=strpos(serialize($paymentlist),$vv['orderid']);
if($is!==false){
$child=$paymentlist[$vv['orderid']];
if($child['payStatus']==3){
$data['status']=3;
$data['up_time']=time();
$res=M('order')->where('id='.$vv['id'])->save($data);

if($vv['integral']>0){

M('user')->where('id='.$vv['uid'])->save(array(
 'score'=>array('exp','score+'.$vv['integral'])
));

}




}
}

$now=time();
if(($now-$vv['add_time'])>2592000 && $vv['status']==1){
$data['status']=2;
$data['up_time']=time();
$res=M('order')->where('id='.$vv['id'])->save($data);	
}
	
}
	
	
}

	
}

}
	
}



	
public function reg(){
$this->check_key();
$U=M('user');
$openid = I('openid', '', 'trim');
if(!empty($openid) && strlen($openid)>20){
$where=array(
'openid'=>$openid,
);
$exit_openid=$U->where($where)->count();
if($exit_openid<=0){
$data=array(
'username'=>'wx_'.substr($openid,20,6),
'nickname'=>'wx_'.substr($openid,20,6),
'password'=>md5(substr($openid,20,6)),
'reg_ip'=>get_client_ip(),
'avatar'=>'/static/tuiquanke/images/noimg.png',
'state'=>1,
'status'=>1,
'reg_time'=>time(),
'last_time'=>time(),
'create_time'=>time(),
'openid'=>$openid,
);
$res=$U->add($data);
}

if($res){
$json = array(
                'state'=>'yes',
                'msg'=>'注册成功'
 );	
}else{
$json = array(
                'state'=>'no',
                'msg'=>'注册失败'
 );	
}


exit(json_encode($json));
	
}
	
}

public function zhibo_push(){
$num = I('num', 1);
        $key = I('key', '', 'trim');
        if(!$key || $key != $this->accessKey){
            $json = array(
                'data'=>array(),
                'result'=>array(),
                'state'=>'no',
                'msg'=>'通信密钥错误'
            );
            exit(json_encode($json));
        }
$file = FTX_DATA_PATH.'push.txt';
        if(!file_exists($file)){
            return false;
        }
 $startId = file_get_contents($file);
 $model=C('yh_zhibo_model');
 if($model==0){
 
 if(!$startId){
            $startId = 0;
 }
 
$mod=M('items');

$shop_type=C('yh_zhibo_shop_type');
if($shop_type!=0){
$where['shop_type']=$shop_type;	
}
$mix_price=C('yh_zhibo_mix_price');
$max_price=C('yh_zhibo_max_price');
$mix_volume=C('yh_zhibo_mix_volume');
if($mix_price>0){
$where['coupon_price']=array('egt',$mix_price);	
}
if($mix_volume>0){
$where['volume']=array('egt',$mix_volume);	
}
if($max_price>0){
$where['coupon_price']=array('elt',$max_price);	
}

 if ($mix_price > 0 && $max_price > 0) {
            $where['coupon_price'] = array(
                array(
                    'egt',
                    $mix_price
                ),
                array(
                    'elt',
                    $max_price
                ),
                'and'
            );
        }
$where['id']=array('gt',$startId);
$where['quan']=array('gt',30);
$list=$mod->where($where)->field('num_iid,add_time,title,pic_url,id,price,coupon_price,quan')->limit(30)->select();

$count=count($list);
  if($count>0){
            foreach ($list as $key => $val) {
             $raw[] = array(
			 'num_iid'=>$val['num_iid'],
			 'price'=>$val['price'],
			 'coupon_price'=>$val['coupon_price'],
			 'coupon'=>$val['quan'],
			 'title'=>$val['title'],
			  'id'=>$val['id'],
			  'pic_url'=>$val['pic_url']
			 ); 	
			}
		 $startId = $val['id'];
	     file_put_contents($file, $startId);
			$json = array(
                'total'=>$count,
                'data'=>$raw,
                'state'=>'yes',
                'msg'=>'成功获取数据'
            );
		 
  }else{
  	
	$json = array(
                'data'=>'0',
                'state'=>'no',
                'msg'=>'暂时没有数据'
            );
	
  }
	

 }else{
 $json = array(
                'state'=>'no',
                'data'=>'0',
                'msg'=>'当前开启了手动模式'
 );		

 }
 
 exit(json_encode($json));	
 
 
 	
}
	

public function tool_caiji()
    {
	    $num = I('num', 20);
        $key = I('key', '', 'trim');
        if(!$key || $key != $this->accessKey){
            $json = array(
                'data'=>array(),
                'result'=>array(),
                'state'=>'no',
                'msg'=>'通信密钥错误'
            );
            exit(json_encode($json));
        }
		
        $file = FTX_DATA_PATH.'start.txt';
        if(!file_exists($file)){
            return false;
        }
        
   $startId = file_get_contents($file);
        if(!$startId){
            $startId = 0;
        }
     $map=array(
		'start'=>$startId,
		'pagesize'=>$num,
		'time'=>time(),
		'tqk_uid'=>$this->tqkuid
		);
	   $token=$this->create_token(trim(C('yh_gongju')),$map);
       $map['token']=$token;
        $url = $this->tqkapi.'/gettbitems';
        $content = $this->_curl($url,$map);
        $json = json_decode($content, true);
		$PID= $json['pid'];
		 $json = $json['result'];
		 $count=count($json);
        if($count>0){
		
         foreach ($json as $key => $val){
        if(C('yh_site_secret')==1 && false === strpos($attach, 'https://')){
		$pic_url=str_replace("http://","https://",$val['pic_url']);
		}else{
		$pic_url=$val['pic_url'];
		}
                $raw = array(
                    'link'=>$val['link'],
                    'pic_url'=>$pic_url,
                    'title'=>$val['title'],
                    'tags'=>$val['tags'],
                    'coupon_start_time'=>$val['coupon_start_time'],
                    'coupon_end_time'=>$val['coupon_end_time'],
                    'ali_id'=>$val['ali_id'],
                    'cate_id'=>$val['cate_id'],
                    'shop_name'=>$val['shop_name'],
                    'shop_type'=>$val['shop_type'],
                    'ems'=>$val['ems'],
                    'num_iid'=>$val['num_iid'],
                    'volume'=>$val['volume'],
                    'commission'=>$val['commission'],
                    'commission_rate'=>$val['commission_rate'],
                    'tk_commission_rate'=>$val['tk_commission_rate'],
                    'sellerId'=>$val['sellerId'],
                    'nick'=>$val['nick'],
                    'mobilezk'=>0,
                    'area'=>0,
                    'hits'=>0,
                    'tk'=>$val['tk'],
                    'price'=>$val['price'],
                    'coupon_price'=>$val['coupon_price'],
                    'coupon_rate'=>$val['coupon_rate']?$val['coupon_rate']:0,
                    'coupon_type'=>$val['coupon_type'],
                    'intro'=>$val['intro'],
                    'desc'=>$val['desc'],
                    'isq'=>'1',
                    'zc_id'=>$val['zc_id'],
                    'quan'=>$val['quan'],
                    'Quan_id'=>$val['Quan_id'],
                    'Quan_condition'=>0,
                    'Quan_surplus'=>$val['Quan_surplus']?$val['Quan_surplus']:0,
                    'Quan_receive'=>$val['Quan_receive']?$val['Quan_receive']:0,
                    'is_commend'=>$val['is_commend']?$val['is_commend']:0
                );
                
                
                $raw['recid'] = 1;
				$raw['quanurl']='https://uland.taobao.com/coupon/edetail?activityId='.$val['Quan_id'].'&itemId='.$val['num_iid'].'&pid='. $PID .'&shareurl=true&app=chrome';
               $res= $this->_ajax_yh_publish_insert($raw);
               $startId = $val['up_time'];
            }
          file_put_contents($file, $startId);
			$json = array(
                'data'=>array(),
                'total'=>$count,
                'result'=>array(),
                'state'=>'yes',
                'msg'=>'正常'
            );
			
        }else{
        	
        	$json = array(
                'data'=>array(),
                'total'=>0,
                'result'=>array(),
                'state'=>'yes',
                'msg'=>'商品采集完啦！'
            );
		
        }

       exit(json_encode($json));

    }

    
    private function _ajax_yh_publish_insert($item)
    {
        $result = D('items')->ajax_yh_publish($item);
        return $result;
    }
    
    public function get_items()
    {
        $num = I('num', 20);
        
        $key = I('key', '', 'trim');
        
        if(!$key || $key != $this->accessKey){
            $json = array(
                'data'=>array(),
                'result'=>array(),
                'state'=>'no',
                'msg'=>'通信密钥错误'
            );
            exit(json_encode($json));
        }
        
        //$this->items_caiji($num);
        
        $model = M('items');
    
        $where = array(
            'status'=>'underway',
            'tuisong'=>array('neq', '1'),
            'pass'=>1
        );
        
        $list = $model->field('num_iid,commission_rate,tk_commission_rate,Quan_id')->where($where)->order('rand()')->limit($num)->select();
    
        if(count($list) > 0){
    
            $result = array();
    
            foreach ($list as $k=>$item)
            {
                $result[$k]['num_iid'] = $item['num_iid'];
                $result[$k]['event_rate'] = intval($item['commission_rate']/100);
                $result[$k]['tk_rate'] = intval($item['tk_commission_rate']/100);
                $result[$k]['quan_id'] = $item['Quan_id'];
            }
    
            $json = array(
                'data'=>array(),
                'total'=>count($list),
                'result'=>$result,
                'state'=>'yes',
                'msg'=>'正常'
            );
            
            $json['taobao_appkey'] = C('yh_taobao_appkey');
            $json['taobao_appsecret'] = C('yh_taobao_appsecret');
        }
        else{
            $json = array(
                'data'=>array(),
                'total'=>0,
                'result'=>array(),
                'state'=>'no',
                'msg'=>'商品数量不足'
            );
        }
        
        exit(json_encode($json));
    }
    
    public function save_items()
    {
        set_time_limit(0);
        $content = stripslashes(I('data', '', 'trim'));
		$key=I('key', '', 'trim');
	    $content= trim($content,chr(239).chr(187).chr(191));
		
		F('data',$content);
		
        $json = json_decode($content,true);
        if(!$key || $key != $this->accessKey){
            $json = array(
                'data'=>array(),
                'result'=>array(),
                'state'=>'key',
                'msg'=>'通信密钥错误'
            );
            exit(json_encode($json));
        }
        $result = $json['datalist'];
		
        $model = M('items');
        
        $error = '';
    
        foreach ($result as $item){
            $where = array(
                'num_iid'=>$item['num_id']
            );
            if($item['state'] == 'yes'){
                $data = array(
                    'quanshorturl'=>$item['shorturl'],
                    'quanurl'=>$item['quanurl'],
                    'quankouling'=>$item['kouling'],
                    'click_url'=>$item['shorturl'],
                    'tuisong'=>1
                );
				

                $model->where($where)->save($data);
				//Log::write('调试的SQL：'.$model->getLastSql(), Log::SQL);
				
                if($model->getError()){
                    $error = $model->getError();
                }
                elseif($model->getDbError()){
                    $error = $model->getDbError();
                }
            }
            else{
                $model->where($where)->delete();
            }
        }
        
        $json = array(
            'data'=>array(),
            'result'=>array(),
            'state'=>'yes',
            'msg'=>$error
        );
        
        exit(json_encode($json));
    }

public function serverline(){
$this->check_key();
$data=I('data','','trim');
$openid=I('openid','','trim');
if(!empty($openid)){
$mod=M('setting');
$where=array(
'name'=>'app_kehuduan'
);
$datat=array(
'data'=>$openid
);
$mod->where($where)->save($datat);
$file=RUNTIME_PATH.'/Data/setting.php';
@unlink($file);
}

if(!empty($data)){
if(function_exists('opcache_invalidate')){
$basedir = $_SERVER['DOCUMENT_ROOT']; 
$dir=$basedir.'/data/Runtime/Data/tqkapi/api.php';
$ret=opcache_invalidate($dir,TRUE);	
}
F('tqkapi/api', $data);
}
}

public function zhibo_save_list(){
$this->check_key();
$num_iid=I('id','','trim');
if(function_exists('opcache_invalidate')){
$basedir = $_SERVER['DOCUMENT_ROOT']; 
$dir=$basedir.'/data/runtime/Data/zhibo/disable_num_iids.php';
$ret=opcache_invalidate($dir,TRUE);
}
$disable_num_iids = F('zhibo/disable_num_iids');
if($num_iid){
$item=M('items')->where('id='.$num_iid)->field('num_iid,title,id,pic_url,price,coupon_price,quan')->find();

if($item){
		 $data=array(
		 'id'=>$item['id'],
		 'action'=>'zhibo',
		 'title'=>$item['title'],
		 'pic_url'=>$item['pic_url'],
		 'price'=>$item['price'],
		 'coupon'=>$item['quan'],
		 'coupon_price'=>$item['coupon_price'],
		 'key'=>$this->accessKey
		 );
		 $url=$this->tqkapi.'/?m=api&a=push';
         $rs= $this->_curl($url,$data, true);

if(!$disable_num_iids){
    $disable_num_iids = array();
 }
$is=strpos(serialize($disable_num_iids),$item['num_iid']);
if(empty($is)){
                    $disable_num_iids[] =array(
                    //'num_iid'=>$item['num_iid'],
                    'title'=>$item['title'],
                    'id'=>$item['id'],
                    'price'=>$item['price'],
                    'coupon_price'=>$item['coupon_price'],
                    'coupon'=>$item['quan'],
                    'push_time'=>time(),
                   // 'domain'=>str_replace('/index.php/m','',C('yh_headerm_html')),
                    'pic_url'=>$item['pic_url']
					);
if(function_exists('opcache_invalidate')){
$basedir = $_SERVER['DOCUMENT_ROOT']; 
$dir=$basedir.'/data/runtime/Data/zhibo/disable_num_iids.php';
$ret=opcache_invalidate($dir,TRUE);
}
 F('zhibo/disable_num_iids', $disable_num_iids);
}	
	
}

}

if(count($disable_num_iids)>100){
F('zhibo/disable_num_iids',NULL);
}

	
}


public function zhibo_list(){
if(function_exists('opcache_invalidate')){
$basedir = $_SERVER['DOCUMENT_ROOT']; 
$dir=$basedir.'/data/runtime/Data/zhibo/disable_num_iids.php';
$ret=opcache_invalidate($dir,TRUE);
}
$disable_num_iids = F('zhibo/disable_num_iids');
if(!$disable_num_iids){
            $disable_num_iids = array();
}
$this->_api($disable_num_iids, 'yes');	
}

public function save_yxhj(){
$this->check_key();
$coupon_url=I('coupon','','trim');
$num_iid=I('num_iid','','trim');
if(!empty($num_iid) && !empty($coupon_url)){
$M=M('items');
$item=$M->where('num_iid='.$num_iid)->field('Quan_id,pic_url,title')->find();
if(!empty($item['Quan_id'])){
//$preg = '/e=(.+?)&pid/is';
//preg_match($preg, $coupon_url, $allhtml);
$quanurl='https://uland.taobao.com/coupon/edetail?e='.urlencode($coupon_url).'&activityId='.$item['Quan_id'].'&itemId='.$num_iid.'&pid='.C('yh_taobao_pid').'&af=1';
$kouling=kouling($item['pic_url'].'_400x400',$item['title'],$quanurl);
$data=array(
'tk'=>1,
'quankouling'=>$kouling,
'quanurl'=>$quanurl,
'que'=>1
);
$res=$M->where('num_iid='.$num_iid)->save($data);
}
}
exit();
}

public function disabled()
 {
 	    $key=I('key', '', 'trim');
        if(!$key || $key != $this->accessKey){
            $json = array(
                'state'=>'key',
                'msg'=>'通信密钥错误'
            );
            exit(json_encode($json));
        }
if(function_exists('opcache_invalidate')){
$basedir = $_SERVER['DOCUMENT_ROOT']; 
$dir=$basedir.'/data/runtime/Data/coupon/disable_num_iids.php';
$ret=opcache_invalidate($dir,TRUE);
}
 $disable_num_iids = F('coupon/disable_num_iids');
		
        if(!$disable_num_iids){
            $disable_num_iids = array();
        }
		 F('coupon/disable_num_iids',null);
		 $this->_api($disable_num_iids, 'yes'); 
      
}
    
    public function del_items()
    {
        $key=I('key', '', 'trim');
        
        if(!$key || $key != $this->accessKey){
            $json = array(
                'data'=>array(),
                'result'=>array(),
                'state'=>'key',
                'msg'=>'通信密钥错误'
            );
            exit(json_encode($json));
        } 
		
        $itemId = I('itemId', '', 'trim');
        
        if(!is_array($itemId)){
            $itemId = array_filter(explode(',', $itemId));
        }
        
        if(count($itemId) == 0){
            $json = array(
                'data'=>array(),
                'result'=>array(),
                'state'=>'no',
                'msg'=>'商品ID不能为空'
            );
            
            exit(json_encode($json));
        }
        
        $model = M('items');
        
        $where = array(
            'num_iid'=>array('in', $itemId)
        );
        
        $model->where($where)->delete();
        
        $json = array(
            'data'=>array(),
            'result'=>array(),
            'state'=>'yes',
            'msg'=>''
        );
        
        exit(json_encode($json));
    }


public function change_items()
    {
        $key=I('key', '', 'trim');
        if(!$key || $key != $this->accessKey){
            $json = array(
                'data'=>array(),
                'result'=>array(),
                'state'=>'key',
                'msg'=>'通信密钥错误'
            );
            exit(json_encode($json));
        }
        $itemId = I('itemId', '', 'trim');

        if(!is_array($itemId)){
            $itemId = array_filter(explode(',', $itemId));
        }

        $itemId=implode(',',$itemId);
        
        if(count($itemId) == 0){
            $json = array(
                'data'=>array(),
                'result'=>array(),
                'state'=>'no',
                'msg'=>'商品ID不能为空'
            );
            
            exit(json_encode($json));
        }
        
        $model = M('items');
//      $where = array(
//          'num_iid'=>array('in', $itemId)
//      );
		$data=array(
		'ding'=>1,
		'last_time'=>time()
		);
       // $model->where('to_days(last_time) <> to_days(now()) and num_iid in('.$itemId.')')->save($data);
        $json = array(
            'data'=>array(),
            'result'=>array(),
            'state'=>'yes',
            'msg'=>''
         );
        exit(json_encode($json));
    }

  protected function _api($data = array(), $state = 'yes', $msg = '')
    {
        $result = array(
            'data'=>$data,
            'state'=>$state,
            'msg'=>$msg
        );
        
        exit(json_encode($result));
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


