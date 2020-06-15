<?php
namespace common\redisphp\lib;
/* 
 * 此类用于处理所有redis哈希（hash）命令
 */
use common\redisphp\lib\RedisPhp;

class RedisHash extends RedisPhp{
    
/* 
 *  HSET KEY_NAME FIELD VALUE  
 *  将哈希表 key 中的字段 field 的值设为 value 。
 *  Redis Hset 命令用于为哈希表中的字段赋值 。
 *  如果哈希表不存在，一个新的哈希表被创建并进行 HSET 操作。
 *  如果字段已经存在于哈希表中，旧值将被覆盖。
 *  可用版本 >= 2.0.0
 *  返回值:如果字段是哈希表中的一个新建字段，并且值设置成功，返回 1 。如果哈希表中域字段已经存在且旧值已被新值覆盖，返回 0 。
 */
    public function hset($key,$field,$value){
        
        //检查数据
        $key = $this->check_key($key);
        //$field = $this->check_field($field);
        $value = $this->check_value($value);

        //redis步骤
        $redis = $this->new_redis();
        $rule = $redis->hSet($key,$field,$value);
        return $rule;
    }

/* 
 *  HGETALL KEY_NAME 
 *  Redis Hgetall 命令用于返回哈希表中，所有的字段和值。
 *  在返回值里，紧跟每个字段名(field name)之后是字段的值(value)，所以返回值的长度是哈希表大小的两倍。
 *  可用版本 >= 2.0.0
 *  以列表形式返回哈希表的字段及字段值。 若 key 不存在，返回空列表。
 */
    public function hgetall($key){
        
        //检查数据
        $key = $this->check_key($key);
        
        //redis步骤
        $redis = $this->new_redis();
        $rule = $redis->hGetAll($key);
        return $rule;
    }
    
/* 
 *  HGET KEY_NAME FIELD_NAME  
 *  Redis Hget 命令用于返回哈希表中指定字段的值。
 *  可用版本 >= 2.0.0
 *  返回给定字段的值。如果给定的字段或 key 不存在时，返回 nil 。
 */

    public function hget($key,$field){
        //检查数据
        $key = $this->check_key($key);
        $field = $this->check_field($field);
        
        //redis步骤
        $redis = $this->new_redis();
        $rule = $redis->hGet($key,$field);
        $rule = $this->return_value($rule);
        return $rule;
    }
    
    
/* 
 *  HDEL KEY_NAME FIELD1.. FIELDN  
 *  Redis Hdel 命令用于删除哈希表 key 中的一个或多个指定字段，不存在的字段将被忽略。
 *  可用版本 >= 2.0.0
 *  被成功删除字段的数量，不包括被忽略的字段。
 */
    public function hdel($key,$field){
        
        //检查数据
        $key = $this->check_key($key);
        $field = $this->check_field($field);
        
        //redis步骤
        $redis = $this->new_redis();
        $rule = $redis->hDel($key,$field);
        return $rule;
    }
    
    
/* 
 *  HEXISTS KEY_NAME FIELD_NAME  
 *  Redis Hexists 命令用于查看哈希表的指定字段是否存在。
 *  可用版本 >= 2.0.0
 *  如果哈希表含有给定字段，返回 true 。 如果哈希表不含有给定字段，或 key 不存在，返回 false 。
 */

    public function hexists($key,$field){
        
        //检查数据
        $key = $this->check_key($key);
        $field = $this->check_field($field);
        
        //redis步骤
        $redis = $this->new_redis();
        $rule = $redis->hExists($key,$field);
        return $rule;
        
    }
    
    
    
/* 
 *  HINCRBY KEY_NAME FIELD_NAME INCR_BY_NUMBER   
 *  Redis Hincrby 命令用于为哈希表中的字段值加上指定增量值。
 *  增量也可以为负数，相当于对指定字段进行减法操作。
 *  如果哈希表的 key 不存在，一个新的哈希表被创建并执行 HINCRBY 命令。
 *  如果指定的字段不存在，那么在执行命令前，字段的值被初始化为 0 。
 *  对一个储存字符串值的字段执行 HINCRBY 命令将造成一个错误。
 *  本操作的值被限制在 64 位(bit)有符号数字表示之内。
 *  可用版本 >= 2.0.0
 *  执行 HINCRBY 命令之后，哈希表中字段的值。
 */

    public function hincrby($key,$field,$num){
        
        //检查数据
        $key = $this->check_key($key);
        $field = $this->check_field($field);
        $num = $this->check_int_num($num);
        
        //redis步骤
        $redis = $this->new_redis();
        $rule = $redis->hIncrBy($key,$field,$num);
        return $rule;
    }
    
    
/* 
 *  HINCRBYFLOAT KEY_NAME FIELD_NAME INCR_BY_NUMBER    
 *  Redis Hincrbyfloat 命令用于为哈希表中的字段值加上指定浮点数增量值。
 *  如果指定的字段不存在，那么在执行命令前，字段的值被初始化为 0 。
 *  可用版本 >= 2.0.0
 *  执行 Hincrbyfloat 命令之后，哈希表中字段的值。
 */
    
    public function hincrbyfloat($key,$field,$num){
        
        //检查数据
        $key = $this->check_key($key);
        $field = $this->check_field($field);
        $num = $this->check_num($num);
        
        //redis步骤
        $redis = $this->new_redis();
        $rule = $redis->hIncrByFloat($key,$field,$num);
        return $rule;
    }
    
    
    
/* 
 *  HKEYS key    
 *  Redis Hkeys 命令用于获取哈希表中的所有域（field）。
 *  可用版本 >= 2.0.0
 *  包含哈希表中所有域（field）列表。 当 key 不存在时，返回一个空列表。
 */
    public function hkeys($key){
        
        //检查数据
        $key = $this->check_key($key);

        //redis步骤
        $redis = $this->new_redis();
        $rule = $redis->hKeys($key);
        return $rule;
    } 

/* 
 *  HLEN KEY_NAME    
 *  Redis Hlen 命令用于获取哈希表中字段的数量。
 *  可用版本 >= 2.0.0
 *  哈希表中字段的数量。 当 key 不存在时，返回 0 。
 */    
    public function hlen($key){
        
        //检查数据
        $key = $this->check_key($key);

        //redis步骤
        $redis = $this->new_redis();
        $rule = $redis->hLen($key);
        return $rule;
    }
    
    
/* 
 *  HMGET KEY_NAME FIELD1...FIELDN   
 *  Redis Hmget 命令用于返回哈希表中，一个或多个给定字段的值。
 *  如果指定的字段不存在于哈希表，那么返回一个 nil 值。
 *  可用版本 >= 2.0.0
 *  一个包含多个给定字段关联值的表，表值的排列顺序和指定字段的请求顺序一样。
 */    
    public function hmget($key,$field){
        
        //检查数据
        $key = $this->check_key($key);
        $field = $this->check_field($field);
    }
}