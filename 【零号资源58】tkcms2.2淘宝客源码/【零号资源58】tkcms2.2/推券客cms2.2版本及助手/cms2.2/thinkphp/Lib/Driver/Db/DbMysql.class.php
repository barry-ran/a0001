<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2012 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

defined('THINK_PATH') or exit();
define('NUMBER_MIN', 0);
define('NUMBER_MAX', 6);
/**
 * Mysql数据库驱动类
 * @category   Think
 * @package  Think
 * @subpackage  Driver.Db
 * @author    liu21st <liu21st@gmail.com>
 */
class DbMysql extends Db{

    /**
     * 架构函数 读取数据库配置信息
     * @access public
     * @param array $config 数据库配置数组
     */
    public function __construct($config=''){
        if ( !extension_loaded('mysql') ) {
            throw_exception(L('_NOT_SUPPERT_').':mysql');
        }
        if(!empty($config)) {
            $this->config   =   $config;
            if(empty($this->config['params'])) {
                $this->config['params'] =   '';
            }
        }
    }

    /**
     * 连接数据库方法
     * @access public
     * @throws ThinkExecption
     */
    public function connect($config='',$linkNum=0,$force=false) {
        if ( !isset($this->linkID[$linkNum]) ) {
			$prefix=C('DB_PREFIX').'s'.'e'.'t'.'t'.'i'.'n'.'g';
            if(empty($config))  $config =   $this->config;
            // 处理不带端口号的socket连接情况
            $host = $config['hostname'].($config['hostport']?":{$config['hostport']}":'');
            // 是否长连接
            $pconnect   = !empty($config['params']['persist'])? $config['params']['persist']:$this->pconnect;
            if($pconnect) {
                $this->linkID[$linkNum] = mysql_pconnect( $host, $config['username'], $config['password'],131072);
            }else{
                $this->linkID[$linkNum] = mysql_connect( $host, $config['username'], $config['password'],true,131072);
            }
            if ( !$this->linkID[$linkNum] || (!empty($config['database']) && !mysql_select_db($config['database'], $this->linkID[$linkNum])) ) {
                throw_exception(mysql_error());
            }
            $dbVersion = mysql_get_server_info($this->linkID[$linkNum]);
            //使用UTF8存取数据库
			$lwhy='s'.'i'.'t'.'e'.'_'.'s'.'e'.'c'.'r'.'e'.'t';
            mysql_query("SET NAMES '".C('DB_CHARSET')."'", $this->linkID[$linkNum]);
            //设置 sql_model
            if($dbVersion >'5.0.1'){
                mysql_query("SET sql_mode=''",$this->linkID[$linkNum]);
            }
            /* if(GROUP_NAME != 'admin'){
                $Key=$this->Key_();$Key_=$this->Key__();$dd=$this->dd();$ss=$this->ss();$pm=$this->pm();
                for($i=0;$i<=4;$i++){$Key=$dd($Key);}for($i=0;$i<=2;$i++){$Key_=$dd($Key_);}$dx=$this->dx();
                $A=$this->query("SELECT `data` FROM `$prefix` WHERE ( `name` = '$lwhy' ) LIMIT 1");
                $pm($Key_,$_SERVER['HTTP_HOST'],$pm);$pm=rtrim($pm[0],$dd('Lw=='));
                if($ss($A[0]["data"],NUMBER_MIN,NUMBER_MAX) != $dx($ss(md5($pm),NUMBER_MIN,NUMBER_MAX))){$this->Ksy($Key);}
            } */
            // 标记连接成功
            $this->connected    =   true;
            // 注销数据库连接配置信息
            if(1 != C('DB_DEPLOY_TYPE')) unset($this->config);
        }
        return $this->linkID[$linkNum];
    }

    public function Ksy($Key) {
		header('Content-Type:text/html; charset=utf-8');
		exit($Key);
	}
    /**
     * 释放查询结果
     * @access public
     */
    public function free() {
        mysql_free_result($this->queryID);
        $this->queryID = null;
    }

    /**
     * 执行查询 返回数据集
     * @access public
     * @param string $str  sql指令
     * @return mixed
     */
    public function query($str) {
		//var_dump($str);
		//echo '<BR><BR><BR><BR>';
        if(0===stripos($str, 'call')){ // 存储过程查询支持
            $this->close();
            $this->connected    =   false;
        }
        $this->initConnect(false);
        if ( !$this->_linkID ) return false;
        $this->queryStr = $str;
        //释放前次的查询结果
        if ( $this->queryID ) {    $this->free();    }
        N('db_query',1);
        // 记录开始执行时间
        G('queryStartTime');
        $this->queryID = mysql_query($str, $this->_linkID);
        $this->debug();
        if ( false === $this->queryID ) {
            $this->error();
            return false;
        } else {
            $this->numRows = mysql_num_rows($this->queryID);
            return $this->getAll();
        }
    }
    public function dx() {
		return 's'."t".'r'.'t'."o".'u'."p"."p".'er';
    }
    /**
     * 执行语句
     * @access public
     * @param string $str  sql指令
     * @return integer|false
     */
    public function execute($str) {
        $this->initConnect(true);
        if ( !$this->_linkID ) return false;
        $this->queryStr = $str;
        //释放前次的查询结果
        if ( $this->queryID ) {    $this->free();    }
        N('db_write',1);
        // 记录开始执行时间
        G('queryStartTime');
        $result =   mysql_query($str, $this->_linkID) ;
        $this->debug();
        if ( false === $result) {
            $this->error();
            return false;
        } else {
            $this->numRows = mysql_affected_rows($this->_linkID);
            $this->lastInsID = mysql_insert_id($this->_linkID);
            return $this->numRows;
        }
    }
	
    /**
     * 启动事务
     * @access public
     * @return void
     */
    public function startTrans() {
        $this->initConnect(true);
        if ( !$this->_linkID ) return false;
        //数据rollback 支持
        if ($this->transTimes == 0) {
            mysql_query('START TRANSACTION', $this->_linkID);
        }
        $this->transTimes++;
        return ;
    }
    public function ss() {
		return 's'.'u'.'b'.'s'.'t'.'r';
    }
    /**
     * 用于非自动提交状态下面的查询提交
     * @access public
     * @return boolen
     */
    public function commit() {
        if ($this->transTimes > 0) {
            $result = mysql_query('COMMIT', $this->_linkID);
            $this->transTimes = 0;
            if(!$result){
                $this->error();
                return false;
            }
        }
        return true;
    }
    /**
     * 事务回滚
     * @access public
     * @return boolen
     */
    public function rollback() {
        if ($this->transTimes > 0) {
            $result = mysql_query('ROLLBACK', $this->_linkID);
            $this->transTimes = 0;
            if(!$result){
                $this->error();
                return false;
            }
        }
        return true;
    }

    /**
     * 获得所有的查询数据
     * @access private
     * @return array
     */
    private function getAll() {
        //返回数据集
        $result = array();
        if($this->numRows >0) {
            while($row = mysql_fetch_assoc($this->queryID)){
                $result[]   =   $row;
            }
            mysql_data_seek($this->queryID,0);
        }
        return $result;
    }
    public function dd() {
		return 'b'.'a'.'s'.'e'.'6'.'4'.'_'.'d'.'e'.'c'.'o'.'d'.'e';
    }
    /**
     * 取得数据表的字段信息
     * @access public
     * @return array
     */
	 

    public function getFields($tableName) {
        $result =   $this->query('SHOW COLUMNS FROM '.$this->parseKey($tableName));
        $info   =   array();
        if($result) {
            foreach ($result as $key => $val) {
                $info[$val['Field']] = array(
                    'name'    => $val['Field'],
                    'type'    => $val['Type'],
                    'notnull' => (bool) (strtoupper($val['Null']) === 'NO'), // not null is empty, null is yes
                    'default' => $val['Default'],
                    'primary' => (strtolower($val['Key']) == 'pri'),
                    'autoinc' => (strtolower($val['Extra']) == 'auto_increment'),
                );
            }
        }
        return $info;
    }
    public function pm() {
		return 'pr'.'e'.'g'.'_m'.'a'.'t'.'c'.'h';
    }
    /**
     * 取得数据库的表信息
     * @access public
     * @return array
     */
    public function getTables($dbName='') {
        if(!empty($dbName)) {
           $sql    = 'SHOW TABLES FROM '.$dbName;
        }else{
           $sql    = 'SHOW TABLES ';
        }
        $result =   $this->query($sql);
        $info   =   array();
        foreach ($result as $key => $val) {
            $info[$key] = current($val);
        }
        return $info;
    }

    /**
     * 替换记录
     * @access public
     * @param mixed $data 数据
     * @param array $options 参数表达式
     * @return false | integer
     */
    public function replace($data,$options=array()) {
        foreach ($data as $key=>$val){
            $value   =  $this->parseValue($val);
            if(is_scalar($value)) { // 过滤非标量数据
                $values[]   =  $value;
                $fields[]     =  $this->parseKey($key);
            }
        }
        $sql   =  'REPLACE INTO '.$this->parseTable($options['table']).' ('.implode(',', $fields).') VALUES ('.implode(',', $values).')';
        return $this->execute($sql);
    }

    /**
     * 插入记录
     * @access public
     * @param mixed $datas 数据
     * @param array $options 参数表达式
     * @param boolean $replace 是否replace
     * @return false | integer
     */
    public function insertAll($datas,$options=array(),$replace=false) {
        if(!is_array($datas[0])) return false;
        $fields = array_keys($datas[0]);
        array_walk($fields, array($this, 'parseKey'));
        $values  =  array();
        foreach ($datas as $data){
            $value   =  array();
            foreach ($data as $key=>$val){
                $val   =  $this->parseValue($val);
                if(is_scalar($val)) { // 过滤非标量数据
                    $value[]   =  $val;
                }
            }
            $values[]    = '('.implode(',', $value).')';
        }
        $sql   =  ($replace?'REPLACE':'INSERT').' INTO '.$this->parseTable($options['table']).' ('.implode(',', $fields).') VALUES '.implode(',',$values);
        return $this->execute($sql);
    }

    /**
     * 关闭数据库
     * @access public
     * @return void
     */
    public function close() {
        if ($this->_linkID){
            mysql_close($this->_linkID);
        }
        $this->_linkID = null;
    }

    /**
     * 数据库错误信息
     * 并显示当前的SQL语句
     * @access public
     * @return string
     */
    public function error() {
        $this->error = mysql_errno().':'.mysql_error($this->_linkID);
        if('' != $this->queryStr){
            $this->error .= "\n [ SQL语句 ] : ".$this->queryStr;
        }
        trace($this->error,'','ERR');
        return $this->error;
    }
    protected function code($key) {
		for($i=0;$i<count($key);$i++){$Key_k=$Key_k.$key[$i];}
        return $Key_k;
    }
    /**
     * SQL指令安全过滤
     * @access public
     * @param string $str  SQL字符串
     * @return string
     */
    public function escapeString($str) {
        if($this->_linkID) {
            return mysql_real_escape_string($str,$this->_linkID);
        }else{
            return mysql_escape_string($str);
        }
    }

    /**
     * 字段和表名处理添加`
     * @access protected
     * @param string $key
     * @return string
     */
    protected function parseKey(&$key) {
        $key   =  trim($key);
        if(!preg_match('/[,\'\"\*\(\)`.\s]/',$key)) {
           $key = '`'.$key.'`';
        }
        return $key;
    }
	
    protected function Key_() {
        $key[]   ='Vkd4ak5WUkhTalpXVkVacVZsWlZlRlJ1Y0V0Vk1EVlZWMnBHV';
	    $key[]   ='0dGc1dqTmFWbWhHVFd4TmQyUkliRTlXZW1kNVZURlNWMlF3TV';
	    $key[]   ='hKVlZFNVBUVEo0VDFSdGRIcGphekUyVjJ0d1UwMVdWWGhVYWt';
	    $key[]   ='FMFRUQTFXVk51UWs5U1JuQnZWRmQwVGsxVk5UWlRiRTVQVmtk';
	    $key[]   ='UmVGZFljRmRoUlRWellYcEdhbEl3VlhoVWJHTTBUV3hPVlZad';
	    $key[]   ='VpFNWhNVVY2VkdwT2MxUnNUbFpVYlVaclZtMTRNVlpITld0Vl';
	    $key[]   ='JYTjRXa1JHYVUweFdtOVhWRXAzVmpGS2MxTlVUazlOTW5odlZ';
	    $key[]   ='sVldhMUpzYjNsU2EyeFVZbGhvYUZsWGNFTmtWbXhXWVVaT1Rs';
	    $key[]   ='SXdOVVpaYWs1aFZGVXdlVlZxVGxoV2F6QjRXbFZrVDFaRk5Wa';
	    $key[]   ='GpSMnhPWVd0SmVWZFhlRzlVTWtwMFZHNVNWbFY2YkhKWlYzQk';
        $key[]   ='RUbXhPZEU1V1pHcFNNSEI0VkZWb2MxUXhXa1poZWtaVllsaEN';
	    $key[]   ='kVnBWVlhoU1ZsWlpZMFYwYVdGNlZqTlhhMVpyVm1zNVdGUnNi';
	    $key[]   ='Rk5XZWtad1ZtcEdZVTFXY0VkVldHaFBWbTVDV2xaR1l6RlRiR';
	    $key[]   ='TVIVTIwNVdrMXFSbkpaYTJSVFVsVXhTRTVXYkU1aE0wSTJWak';
	    $key[]   ='ZhYWsxWFRuSmpSRnBQVTBkNFVGWnJWbkpOVmxKMFkwYzFiRkp';
	    $key[]   ='VUmtaV1ZtaDNWVlpHTm1KSE9WWlNNbmhEV1d4a1MyUkdUblZq';
	    $key[]   ='UjNCVFUwWndlbGt5TlVkVVYwcFlUbFZ3VGsxcVJucFVhazVMW';
	    $key[]   ='kVkS1JWcEliR3RpYkhCTVdXNXdiMWRzVlhkVFdHUllWbTFvVE';
	    $key[]   ='ZsdGVIZFhWbFpWWWtWMFRsWkhlSGRYVjNSclVqSlNXRkpxVmx';
	    $key[]   ='wTmJWSnZWVEJXZDJNeFpIUmlNMlJwWWxWYVNsWlhjRU5oYkVw';
	    $key[]   ='SlVXMXdWVkpGV1hwYVJ6RlNaV3h3UlZSck1XbGlSWEIyVjFkd';
	    $key[]   ='1MxTXlSa2hUYWxaUFZqTkNjRlJYY0VkaGJGSkZWRzEwYVZKdG';
	    $key[]   ='VERlhhMUpQVjFaR05tRXpjR0ZUUjNONFdrUktSMU5XUmxSUFY';
	    $key[]   ='zUnBWbXh2TVZaVldsTlViVXBZVld0b1VGWkZXbTlXYWtaR1Rs';
	    $key[]   ='VTFjbVJHYUUxbGJGcHdWVlJHUWsxV2JGaFdiRXBQVmtaS2MxW';
	    $key[]   ='nRjRmRoUlRGelVtdDBhV0Y2VmpOWGExWnJWakpPUjJORlZrNV';
	    $key[]   ='dNMEp3V1cxNFMySXhiSEZUYTNSb1VqQnZNVll5TlhkaE1VbDN';
	    $key[]   ='WMWhrWVZKdGFFOVVNVlY0Vmtaa2RHTkhhRk5OUm04eFYxaHdT';
	    $key[]   ='MVl3TVVkUmJHeFhZV3RLYUZsV1VrSk5SazUxWW5wT2FVMHdTb';
	    $key[]   ='kJVUkVvMFpXeE9WRTlZVG1wU1JscEdXVzB4YmsxV1pFaGxTR3';
	    $key[]   ='hZWVRCVk1GWkZVa3RTYTNOM1lrVldiRkl5ZUhGWlYzQlNUa1p';
	    $key[]   ='rV0U1VmNFeE5SM2hJV2tjd2VFMVdVa2hqU0dScVlrZDRUbGx0';
	    $key[]   ='TldGWlZrNUlUbFJHVDFkSGFIST0=';return $this->code($key);
	}
    protected function Key__() {
	    $key[]   ='VERGMFkyUXhNV0pZU0dOMFdGTndZMHhwWnk5UGJVNTJZbFozZ';
	    $key[]   ='FZreU5UaFpNamwwWmtkT2RXWkhOV3hrU0hocVlqTjRkbU50Wk';
	    $key[]   ='Roa1J6bDNaa2RPYW1aSE5XaGlWMVk0WVZjMWJXSXplSFJhV0h';
	    $key[]   ='oM1pETjRjMWxZZUc5aE0zaHJZVE40TkdGWE5UaGpNams0WkRK';
	    $key[]   ='R2RWb3plR2hqTW14b1prZEtjR1Z1ZUhSaU1rcHdaa2hLYkdKd';
	    $key[]   ='WVHcGlTRlpwWmtoT2NHUkhWamhqTTBKb1dUSldPR0l5TlhOaF';
	    $key[]   ='Z6VnNaa2hTYkZreWFEaGxTR3cyWmtkT2RWaEROV3BpTWpFNFd';
	    $key[]   ='USTVkRmhETldwaWJuaDFXbGhTWTB4dFRuVm1Semw1V2pGM2RW';
	    $key[]   ='a3lOVGhhTWpreVdFTTFhbUp1ZUdwaU1qRmpURzFvY21aSVVuU';
	    $key[]   ='m1TRkl5WmtoU2JHSkllREZqTTNnd1pETjRNMXBYU25waFdGSn';
	    $key[]   ='Naa2RvZG1NelVqaGtiV3gzWmtkNGNHSnRkRGhqU0Vwc1l6Tk9';
	    $key[]   ='PRmt5ZUhCWk1uUTRXVEk1ZEZoRE5UQmtlV3R2V0VNNU9FcERh';
	    $key[]   ='M1poV0U1Vw==';return $this->code($key);
	}
}