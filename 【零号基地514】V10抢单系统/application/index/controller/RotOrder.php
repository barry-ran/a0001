<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;

/**
 * 下单控制器
 */
class RotOrder extends Base
{
    /**
     * 首页
     */
    public function index()
    {
        $where = [
            ['uid','=',session('user_id')],
            ['addtime','between',strtotime(date('Y-m-d')).','.time()],
        ];
        $this->day_deal = Db::name('xy_convey')->where($where)->where('status','in',[1,3,5])->sum('commission');
//        $this->day_l_count = Db::name('xy_convey')->where($where)->where('status',5)->count('num');//交易冻结单数

        $yes1 = strtotime( date("Y-m-d 00:00:00",strtotime("-1 day")) );
        $yes2 = strtotime( date("Y-m-d 23:59:59",strtotime("-1 day")) );
        $this->price = Db::name('xy_users')->where('id',session('user_id'))->sum('balance');

        $this->day_d_count = Db::name('xy_convey')->where($where)->where('status','in',[0,1,3,5])->count('id');
        $this->lock_deal = Db::name('xy_users')->where('id',session('user_id'))->sum('freeze_balance');
        $this->yes_team_num = Db::name('xy_reward_log')->where('uid',session('user_id'))->where('addtime','between',[$yes1,$yes2])->where('status',1)->sum('num');//获取下级返佣数额
        $this->today_team_num = Db::name('xy_reward_log')->where('uid',session('user_id'))->where('addtime','between',[strtotime('Y-m-d'),time()])->where('status',1)->sum('num');//获取下级返佣数额

        //分类
        $type = input('get.type/d',1);
        $this->cate = Db::name('xy_goods_cate')->alias('c')
            ->leftJoin('xy_level u','u.id=c.level_id')
            ->field('c.name,c.cate_info,c.cate_pic,u.name as levelname,u.pic,u.level,u.bili,u.order_num')
            ->find($type);;
        $this->beizhu = db('xy_index_msg')->where('id',9)->value('content');;


        $this->yes_user_yongjin = db('xy_convey')->where('uid',session('user_id'))->where('status',1)->where('addtime','between',[$yes1,$yes2])->sum('commission');
        $this->user_yongjin = db('xy_convey')->where('uid',session('user_id'))->where('status',1)->sum('commission');


        $member_level = db('xy_level')->order('level asc')->select();;
        $order_num = $member_level[0]['order_num'];
        $uinfo = db('xy_users')->where('id', session('user_id'))->find();
        if (!empty($uinfo['level'])){
            $order_num = db('xy_level')->where('level',$uinfo['level'])->value('order_num');;
        }
        $this->order_num = $order_num;

        return $this->fetch();
    }
  /**
    *提交抢单
    */
    public function submit_order()
    {
        $tmp = $this->check_deal();
        if($tmp) return json($tmp);
        $res = check_time(9,22);
        //if($res) return json(['code'=>1,'info'=>'禁止在9:00~22:00以外的时间段执行当前操作!']);

        $res = check_time(config('order_time_1'),config('order_time_2'));
        $str = config('order_time_1').":00  - ".config('order_time_2').":00";
        if($res) return json(['code'=>1,'info'=>'禁止在'.$str.'以外的时间段执行当前操作!']);

        $uid = session('user_id');
        $add_id = db('xy_member_address')->where('uid',$uid)->value('id');//获取收款地址信息
        if(!$add_id) return json(['code'=>1,'info'=>'还没有设置收货地址']);
        //检查交易状态
        // $sleep = mt_rand(config('min_time'),config('max_time'));
        $res = db('xy_users')->where('id',$uid)->update(['deal_status'=>2]);//将账户状态改为等待交易
        if($res === false) return json(['code'=>1,'info'=>'抢单失败，请稍后再试！']);
        // session_write_close();//解决sleep造成的进程阻塞问题
        // sleep($sleep);
        //
        $cid = input('post.cid/d',1);
        $count = db('xy_goods_list')->where('cid','=',$cid)->count();
        

        if($count < 1) return json(['code'=>1,'info'=>'抢单失败，商品库存不足！']);


        $res = model('admin/Convey')->create_order($uid,$cid);
        return json($res);
    }

    /**
     * 停止抢单
     */
    public function stop_submit_order()
    {
        $uid = session('user_id');
        $res = db('xy_users')->where('id',$uid)->where('deal_status',2)->update(['deal_status'=>1]);
        if($res){
            return json(['code'=>0,'info'=>'操作成功!']);
        }else{
            return json(['code'=>1,'info'=>'操作失败!']);
        }
    }

}