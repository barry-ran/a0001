<?php
namespace common\redisphp\lib;
/* 
 * 此类用于配置当前redis所使用的大部分参数信息并且完成实例化redis操作
 * redis存储时使用字符串，所以将数据封装成json格式
 */

class RedisPhp {
    
    //ip地址
    private $phpredisH = '127.0.0.1';
    //端口号
    private $phpredisP = '6379';
    //可自增参数
    
    //实例化redis 
    public function new_redis(){
        $redis = new \Redis();
        $redis->connect($this->phpredisH, $this->phpredisP);
        return $redis;
    }
    
    //将数据转化成json数组
    public function set_json($data){
        $data = json_encode($data);
        return $data;
    }
    
    //检查key是否符合要求
    public function check_key($key){
        if(empty($key)){
            echo 'key不能为空';
            exit;
        } else {
            $rule = is_string($key);
            if($rule == TRUE){
                return $key;
            } else {
                echo 'key必须为一个字符串';
                exit;
            }
        }
        
    }
    
    //检查field是否符合要求
    public function check_field($field){
        if(empty($field)){
            echo 'field不能为空';
            exit;
        } else {
            $rule = is_string($field);
            if($rule == TRUE){
                return $field;
            } else {
                echo 'field必须为一个字符串';
                exit;
            }
        }
    }
    
    
    public function check_value($value){
        if(empty($value)){
            echo 'value不能为空';
            exit;
        } else {
             $rule = is_string($value);
            if($rule == TRUE){
                return $value;
            } else {
                $rule = is_array($value);
                if($rule == TRUE){
                    $value = $this->set_json($value);
                    return $value;
                } else {
                    $rule = is_numeric($value);
                    if($rule == TRUE){
                        return $value;
                    } else {
                        echo 'value必须为数组或者字符串或者数字';
                        exit;
                    }
                }
            }
        }
    }
    
    //返回值为json时解析为输出否则返回字符串
    public function return_value($value){        
        $res = json_decode($value, true);
        $error = json_last_error();
        if(empty($error)){
            return $res;
        } else {
            return $value;
        }
    }
    
    
    //检查传值是否为整数
    public function check_int_num($num){       
        $rule = is_int($num);
        if($rule == TRUE){
            return $num;
        } else {
            echo '数值必须为整数';
            exit;
        }
    }
    
    
    //检查传值是否为数字
    public function check_num($num){        
        $rule = is_numeric($num);
        if($rule == true){
            return $num;
        } else {
            echo '数值必须为数字';
            exit;
        }
        
    }
}
