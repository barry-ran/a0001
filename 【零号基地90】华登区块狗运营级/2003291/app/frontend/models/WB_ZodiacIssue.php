<?php

namespace frontend\models;

use common\models\Zodiac;
use common\models\ZodiacGrade;
use yii\behaviors\TimestampBehavior;
use Yii;
use common\models\ZodiacIssue;
use common\models\ZodiacApply;


class WB_ZodiacIssue extends ZodiacIssue
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

    public static function array_unique_fb($array2D) {
        foreach ($array2D as $v) {
            $v = join(",", $v); //降维,也可以用implode,将一维数组转换为用逗号连接的字符串
            $temp[] = $v;
        }
        $temp = array_unique($temp);//去掉重复的字符串,也就是重复的一维数组
        foreach ($temp as $k => $v) {
            $temp[$k] = explode(",", $v);//再将拆开的数组重新组装
        }
        return $temp;
    }
    //首页数据
    public static function zodiaclist($userdata,$page)
    {
        $query = self::find()->where('issel = 0')->orderBy("created_at asc");

        $pagesize = 9;
        $res = $query->asArray()->all();
        //声明初始化
        $zodiac_ini = [];
        $list = [];         //声明空数组
        $totalCount = 0;    //初始化

        if(!empty($res)){
            foreach ($res as $k => $v){
                $ini['zodiac_id'] = $v['zodiac_id'];
                $ini['zodiac_grade_id'] = $v['zodiac_grade_id'];
                array_push($zodiac_ini,$ini);
            }
            $zodiac_ini = self::array_unique_fb($zodiac_ini);
            $zodiac_last = [];
            foreach ($zodiac_ini as $k => $v){
                $last_ini['zodiac'] = Zodiac::findOne($v[0]);
                $last_ini['zodiac_grade'] = ZodiacGrade::findOne($v[1]);
                array_push($zodiac_last,$last_ini);
            }
            $totalCount = count($zodiac_last);
            $offset = ($page-1) * $pagesize;
            $zodiac_last = array_slice($zodiac_last,$offset,$pagesize);

            //获取当日零点时间
            $begintoday = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
            foreach ($zodiac_last as $k => $v){
                $data['zodiac_id'] = $v['zodiac']['id'];      //宠物表id
                $data['name'] = $v['zodiac']['name'];         //宠物名称
                $data['picture'] = $v['zodiac']['picture'];   //宠物图片url
                $data['seckill'] = $v['zodiac']['seckill'];   //抢购花费
                $data['subscribe'] = $v['zodiac']['subscribe'];   //预约话费
                $data['begin_at_hour'] = $v['zodiac']['begin_at_hour'];       //开抢时间（时）
                $data['begin_at_minu'] = $v['zodiac']['begin_at_minu']?$v['zodiac']['begin_at_minu']:'00';       //开抢时间（分）
                $data['end_at_hour'] = $v['zodiac']['end_at_hour'];           //结束时间（时）
                $data['end_at_minu'] = $v['zodiac']['end_at_minu']?$v['zodiac']['end_at_minu']:'00';           //结束时间（分）
                $data['due'] = $v['zodiac']['due'];                       //周期
                $data['award'] = $v['zodiac']['award'];                   //收益比例
                $zodiac_grade = ZodiacGrade::find()->where('id = :id',[':id' => $v['zodiac_grade']['id']])->asArray()->all();
                $begin_time = $v['zodiac']['begin_at_hour'] * 3600 + $v['zodiac']['begin_at_minu'] * 60 + $begintoday;     //每日开抢开始时间
                $end_time = $v['zodiac']['end_at_hour'] * 3600 + $v['zodiac']['end_at_minu'] * 60 + $begintoday;           //每日开抢结束时间
                foreach ($zodiac_grade as $key => $value){
                    //判断当前用户是否有预约
                    $is_subscribe = ZodiacApply::find()
                        ->where('userid = :userid and zodiac_id = :zodiac_id and zodiac_grade_id = :zodiac_grade_id and status = 0',
                            [':userid'=>$userdata->id,':zodiac_id'=>$v['zodiac']['id'],':zodiac_grade_id'=>$value['id']])->orderBy('created_at desc')->one();
                    $data['zodiac_grade_id'] = $value['id'];
                    $data['hcg_min'] = $value['hcg_min'];
                    $data['hcg_max'] = $value['hcg_max'];
                    $data['cash_min'] = $value['cash_min'];
                    $data['cash_max'] = $value['cash_max'];

                    if($is_subscribe){
                        $data['active_status'] = '待领养';
                        $data['is_click'] = '0';
                        $data['color'] = 2;
                    }else{
                        if(time() > $end_time){
                            $data['active_status'] = '成长中';
                            $data['is_click'] = '0';
                            $data['color'] = 4;
                        }elseif (time() < $begin_time && time() > $begintoday){
                            $data['active_status'] = '可预约';
                            $data['is_click'] = '1';
                            $data['color'] = 1;
                        }elseif(time() < $end_time && time() > $begin_time){
                            $data['active_status'] = '可抢购';
                            $data['is_click'] = '1';
                            $data['color'] = 3;
                        }
                    }
                    $begintamp = $begintoday + ($data['begin_at_hour']*3600) +($data['begin_at_minu']*60);
                    $data['begintamp'] = $begintamp;
                    array_push($list,$data);
                }
            }
        }
        return ["total" => $totalCount, "data" => $list];

    }

    // 获取发售列表
    public static function getIssuelist($page){

        $query = self::find()->orderBy("created_at asc");
        $countQuery = clone $query;
        $pagesize = 4;
        $limit = 4;
        $offset = ($page-1) * $pagesize;
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        $list = [];
        foreach ($res as $k => $v){
            $zodiac = Zodiac::findOne($v['zodiac_id']);
            $zodiac_grade = ZodiacGrade::findOne($v['zodiac_grade_id']);

            $data['id'] = $v['id'];
            $data['name'] = $zodiac->name;
            $data['picture'] = $zodiac->picture;
            $data['seckill'] = $zodiac->seckill;
            $data['subscribe'] = $zodiac->subscribe;
            $data['begin_at_hour'] = $zodiac->begin_at_hour;
            $data['begin_at_minu'] = $zodiac->begin_at_minu;
            $data['end_at_hour'] = $zodiac->end_at_hour;
            $data['end_at_minu'] = $zodiac->end_at_minu;
            $data['due'] = $zodiac->due;
            $data['award'] = $zodiac->award;
            $data['is_show'] = $zodiac->is_show;
            $data['cash_min'] = $zodiac_grade->cash_min;
            $data['cash_max'] = $zodiac_grade->cash_max;
            array_push($list,$data);
        }
        return ["total" => $totalCount, "data" => $list];
    }

    /**
     * 获取未卖出的宠物
     * @param $zodiac_id
     * @param $zodiac_grade_id
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getUnbelong($userid,$zodiac_id){
        $count= Yii::$app->redis->lpop('zodiac_issue:'.$zodiac_id); // 踢除redis存储的数量
        if(!$count){
            $redis_num = count(Yii::$app->redis->lrange("zodiac_issue:".$zodiac_id,0,-1));
            file_put_contents('../runtime/logs/redis_log.txt', '时间：'.time().'，用户ID：'.$userid.'，抢购宠物'.$zodiac_id.'子失败，原因：redis没有宠物'.'num:'.$redis_num.PHP_EOL,FILE_APPEND);
            return false;
        }else{
            $res = WB_ZodiacIssue::find()->where('issel = 0 and zodiac_id = :zodiac_id and belong_id != :userid',[':zodiac_id'=>$zodiac_id,':userid'=>$userid])->orderBy('created_at asc')->one();
            $redis_num = count(Yii::$app->redis->lrange("zodiac_issue:".$zodiac_id,0,-1));
            file_put_contents('../runtime/logs/redis_log.txt', '时间：'.time().'，用户ID：'.$userid.'，抢购宠物'.$zodiac_id.'子成功，发行ID:'.$res->id.'num:'.$redis_num.PHP_EOL,FILE_APPEND);

            return $res;
        }

    }
}
