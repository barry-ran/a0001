<?php

namespace common\components;

use Yii;
/**
 * @author  shuang
 * @date    2016-10-12 9:53:42
 * @version V1.0
 * @desc   数据库基本操作类，用于数据表查询、优化、修复、结构查询、备份等操作
 */
class DbTools extends \yii\base\Object {
    
    public $_db;

    public function init() {
        parent::init();
        $this->_db = Yii::$app->db;
    }
    /*
     * 数据库表查询
     * return array
     */
    public function searchTables(){
        $command = $this->_db->createCommand();
        $command->sql =  "select table_name,engine,table_rows,table_collation,table_comment from information_schema.tables where table_schema='metools' and table_type='base table';";
        return  $command->queryAll();
    }
    /*
     * 查看数据表结构
     * @params $tablename
     * return string
     */
    public function getTableStruct($tablename){
        $command = $this->_db->createCommand();
        $command->sql = "SHOW CREATE TABLE $tablename";
        return $command->query();
    }
    /*
     * 优化表
     * @params $tablename
     * return boolean
     */
    public function optimizeTable($tablename){
        $command = $this->_db->createCommand();
        $command->sql = "OPTIMIZE TABLE $tablename ";
        return $command->query();
    }
     /*
     * 修复表
     * @params $tablename
     * return boolean
     */
    public function repairTable($tablename){
        $command = $this->_db->createCommand();
        $command->sql = "REPAIR TABLE $tablename ";
        return $command->query();
    }
}
