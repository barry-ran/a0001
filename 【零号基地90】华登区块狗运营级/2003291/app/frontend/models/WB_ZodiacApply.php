<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\models\ZodiacApply;

class WB_ZodiacApply extends ZodiacApply
{
    /*
     * 设置表操作行为动作
     * return array
     */
    public function behaviors() {
        return[
            [
                'class' => TimestampBehavior::className()
            ]
        ];
    }

    // 插入钱包记录
    public static function insertrecord($userid,$zodiac_id,$subscribe){
        $Record = new self();
        $Record->userid = $userid;                      //预约用户id
        $Record->zodiac_id = $zodiac_id;                //宠物表id
        $Record->money = $subscribe;                //预约冻结的金额
        $Record->moneyed = 0;                       //返还的金额
        $Record->status = 0;                        //预约状态 0:预约成功  1:预约已完成
        $Record->created_at = time();                   // 预约时间
        $Record->updated_at = time();                   // 更新时间
        $Record->ip = Yii::$app->getRequest()->getUserIP();       //预约ip
        return $Record->save();
    }

    public static function get_list($userid,$page){
        $query = self::find()->where("userid = :userid",[":userid" => $userid]);
        $query->orderBy("id desc");
        $countQuery = clone $query;
        $pagesize = 10;
        $offset = ($page - 1)*$pagesize;
        $limit = Yii::$app->request->get("limit", $pagesize);
        $totalCount = $countQuery->count();
        $mysql = $countQuery->createCommand()->getRawSql();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["total" => $totalCount, "data" => $res];
    }

    public static function isapply($userid,$zodiac_id,$zodiac_grade_id){
        // 当天零点时间戳
        $zerotimestamp = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        return WB_ZodiacApply::find()->where('created_at>:zerotimestamp and zodiac_id = :zodiac_id and zodiac_grade_id = :zodiac_grade_id and status = 0 and userid = :userid',[':zerotimestamp'=>$zerotimestamp,'zodiac_id'=>$zodiac_id,'zodiac_grade_id'=>$zodiac_grade_id,'userid'=>$userid])->all();
    }
}
