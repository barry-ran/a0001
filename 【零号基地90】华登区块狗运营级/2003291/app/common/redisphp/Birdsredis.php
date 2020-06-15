<?php
namespace common\redisphp;

use common\redisphp\lib\RedisHash;
use common\redisphp\lib\RedisPhp;
use common\models\ZodiacIssue;
use common\models\ZodiacSlog;

class Birdsredis {
    
    private static $field="birdlist";  //出售表
    private static $purch="purchbird";     //抢购表



    /*
     * 保存百鸟出售记录
     */
    public static function BirdSellist() {
        $redis = new \common\redisphp\lib\RedisHash();  
        $field =self::$field;
        $Zodiac = ZodiacIssue::find()->where(["issel"=>0])->asArray()->all();
        if($Zodiac){
            foreach ($Zodiac as $value) {
                $key =$value["id"];       //键
                $data = json_encode($value); //值
                $res = $redis->hset($field, $key, $data);
            }
        }
    }
    
    
    //获取百鸟的出售表记录
    public static function GetBirdsList() {
        $redis = new \common\redisphp\lib\RedisHash();
        $field =self::$field;
        return $redis->hgetall($field);//表记录
    }
   
    /*
     * 单独添加一条出售鸟表的记录
     * $field  表
     * $id     表的ID
     * $data   数据
     */
    public static function AddBirsList($id,$value) {
        $field =self::$field;
        $redis = new \common\redisphp\lib\RedisHash();
        $key =$id;       //键
        $data = json_encode($value); //值
        $res = $redis->hset($field, $key, $data);
        return $res;
    }

/**************************************************************************************************************************************************************************************************************/


    /*
     * 从出售列表中,获取不是用户出售 并且等级一样的 出售列表
     * $userid     用户ID
     * $zodiac_id    百鸟等级ID
     */
    public static function ChoiceBird ($userid,$zodiac_id) {
        $lists = self::GetBirdsList();   //获取出售列表
        if(!$lists){
            return ["status"=>false,"msg"=>"没有该等级出售列表"]; 
        }
        $sid=0;
        foreach ($lists as $key => $list) {
            $Larr =json_decode($list, true);
            if($Larr["zodiac_id"]==$zodiac_id && $Larr["belong_id"]!=$userid){
                 $sid =$Larr['id']; break;
            }
        } 
        return $sid==0 ? ["status"=>false,"msg"=>"没有该等级出售列表"] :["status"=>true,"sid"=>$sid]; 
    }
    
    /*
     * 保存抢购的百鸟记录
     * $userid  用户ID
     * $zodiac_id 百鸟等级
     * $sellid   出售表ID
     */
    public static function purchase($userid,$gradeid,$sellid) {         
        $redis = new \common\redisphp\lib\RedisHash();
        $record=ZodiacSlog::addLog($userid, $sellid, $gradeid,1);
        if($record){
            //添加抢购记录
            $purch =self::$purch;      //抢购表
            $key =$record["id"];       //键
            $data = json_encode($record); //值
            $res = $redis->hset($purch, $key, $data);
            if($res){
               $field =self::$field;
               $sellid =(string)$sellid;
               $redis->hdel($field, $sellid);// 删除
            }
        } 
    }
    
    //获取抢购表的记录
    public static function GetPurch() {
        $redis = new \common\redisphp\lib\RedisHash();
        $purch =self::$purch;      //抢购表
        return $redis->hgetall($purch);//表记录
    }




/****************************************************************************************************************************************************************************************************/   
     /* 删除
     * $field 表名
     * $id 删除的key
     */
    public static function DelData($field,$id) {
        $redis = new \common\redisphp\lib\RedisHash();
        $id =(string)$id;
        return $redis->hdel($field, $id);
    }
}   