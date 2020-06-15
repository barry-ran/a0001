<?php

namespace frontend\models;


use common\components\MTools;
use common\models\ZodiacApply;
use Yii;
use common\models\Zodiac;
use common\models\ZodiacGrade;
use yii\behaviors\TimestampBehavior;
class WB_Zodiac extends Zodiac
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

    public static function zodiaclist($userdata,$page)
    {
        $query = self::find()->where('is_show = 1')->orderBy("begin_at_hour asc");
        $countQuery = clone $query;
        $pagesize = 9;
//        $limit = 4;
//        $offset = ($page-1) * $pagesize;
        $totalCount = $countQuery->count();
        $res = $query->asArray()->all();

        $list = [];
        //获取当日零点时间
        $begintoday = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        foreach ($res as $k => $v){
            $data['zodiac_id'] = $v['id'];      //宠物表id
            $data['name'] = $v['name'];         //宠物名称
            $data['picture'] = $v['picture'];   //宠物图片url
            $data['seckill'] = $v['seckill'];   //抢购花费
            $data['subscribe'] = $v['subscribe'];   //预约话费
            $data['begin_at_hour'] = $v['begin_at_hour'];       //开抢时间（时）
            $data['begin_at_minu'] = $v['begin_at_minu'];       //开抢时间（分）
            $data['end_at_hour'] = $v['end_at_hour'];           //结束时间（时）
            $data['end_at_minu'] = $v['end_at_minu'];           //结束时间（分）
            $data['due'] = $v['due'];                       //周期
            $data['award'] = $v['award'];                   //收益比例
            $data['hcg_min'] = $v['hcg_min'];                   //宠物价格下限
            $data['hcg_max'] = $v['hcg_max'];                   //宠物价格上限
            $data['kmd'] =Yii::$app->formatter->asDecimal($v['kmd'],2);                   //可挖KMD
            $data['cash'] = Yii::$app->formatter->asDecimal($v['cash'],2);                   //dragon数量
            $begin_time = $v['begin_at_hour'] * 3600 + $v['begin_at_minu'] * 60 + $begintoday;     //每日开抢开始时间
            $end_time = $v['end_at_hour'] * 3600 + $v['end_at_minu'] * 60 + $begintoday;           //每日开抢结束时间
            $data['flagtime'] = $begin_time;                   //今日开始时间,作为人前端倒计时判断
            $data['last_time'] = $begin_time - time();         //倒计时剩余时间
            $data['now_time'] = time();         //服务器当前时间
            //判断当前用户是否有预约
            $is_subscribe = ZodiacApply::find()->where('userid = :userid and zodiac_id = :zodiac_id and status = 0',
                    [':userid'=>$userdata->id,':zodiac_id'=>$v['id']])->orderBy('created_at desc')->one();
            if(time() > $end_time){
                $data['active_status'] = '繁殖中';
                $data['is_click'] = '0';
                $data['color'] = 4;
            }elseif (time() < $begin_time && time() > $begintoday){
                if($is_subscribe){
                    $data['active_status'] = '待领养';
                    $data['is_click'] = '0';
                    $data['color'] = 2;
                }else{
                    $data['active_status'] = '可预约';
                    $data['is_click'] = '1';
                    $data['color'] = 1;
                }
            }elseif(time() < $end_time && time() > $begin_time){
                $data['active_status'] = '开抢';
                $data['is_click'] = '1';
                $data['color'] = 3;
            }
            array_push($list,$data);
        }
        return ["total" => $totalCount, "data" => $list];

    }
}
