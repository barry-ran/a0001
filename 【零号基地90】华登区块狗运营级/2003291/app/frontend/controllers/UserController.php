<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\controllers;

use common\models\Recharge;
use common\models\User;
use common\models\UserTransform;
use common\models\UserBank;
use common\models\UserProfile;
use common\models\UserWallet;
use common\models\UserWalletRecord;
use common\models\UserZodiac;
use common\models\Zodiac;
use common\models\ZodiacApply;
use common\models\ZodiacIssue;
use common\models\ZtslAward;
use frontend\models\WB_Lottery;
use frontend\models\WB_UserWalletRecord;
use Yii;
use frontend\models\WB_UserServer;
use common\components\MTools;
use frontend\models\WB_Article;
use frontend\models\WB_UserBank;
use yii\base\Exception;
use yii\debug\models\search\Db;
use yii\helpers\HtmlPurifier;
use common\models\BankRealname;


/**
 * Description of UserController
 *
 * @author shuang
 */
class UserController extends \common\components\MController {

    public $flag = false;

    private function appList($token){

        $app = [
            //安全中心
            [
                'name' => '安全中心',
                'url' => MTools::getYiiParams("frontendimagepath").'/AnQuanZhongXin.html?token='.$token,
                'img' => MTools::getYiiParams("webimagepath").'/img/safecenter.png',
                'list_num' => '1',
            ],
            //实名认证
            [
                'name' => '实名认证',
                'url' =>  MTools::getYiiParams("frontendimagepath").'/sm_renzheng.html?token='.$token,
                'img' => MTools::getYiiParams("webimagepath").'/img/realname.png',
                'list_num' => '2',
            ],
            //我的银行卡
            [
                'name' => '收款方式',
                'url' =>  MTools::getYiiParams("frontendimagepath").'/tj_yinhangka.html?token='.$token,
                'img' => MTools::getYiiParams("webimagepath").'/img/mybank.png',
                'list_num' => '3',
            ],
            //我的团队
            [
                'name' => '我的团队',
                'url' => MTools::getYiiParams("frontendimagepath").'/MyTeam.html?token='.$token,
                'img' => MTools::getYiiParams("webimagepath").'/img/myteam.png',
                'list_num' => '4',
            ],

            //邀请好友
            [
                'name' => '邀请好友',
                'url' => MTools::getYiiParams("frontendimagepath").'/FenXiangHaoYou.html?token='.$token,
                'img' => MTools::getYiiParams("webimagepath").'/img/invite.png',
                'list_num' => '5',
            ],
            //系统消息
            [
                'name' => '系统消息',
                'url' => MTools::getYiiParams("frontendimagepath").'/xt_xiaoxi.html?token='.$token,
                'img' => MTools::getYiiParams("webimagepath").'/img/systemmsg.png',
                'list_num' => '6',
            ],

        ];
        
        return $app;
    }

    private function listRecord($token){

        $app = [
            //领养记录
            [
                'name' => '任命记录',
                'url' => MTools::getYiiParams("frontendimagepath").'/lingyang_jilu.html?token='.$token,
                'img' => MTools::getYiiParams("webimagepath").'/img/adopt.png',
                'list_num' => '1',
            ],
            //转让记录
            [
                'name' => '转让记录',
                'url' =>  MTools::getYiiParams("frontendimagepath").'/zr_jilu.html?token='.$token,
                'img' => MTools::getYiiParams("webimagepath").'/img/turnout.png',
                'list_num' => '2',
            ],
            //预约记录
            [
                'name' => '预约记录',
                'url' =>  MTools::getYiiParams("frontendimagepath").'/yuyue_jilu.html?token='.$token,
                'img' => MTools::getYiiParams("webimagepath").'/img/subscribe.png',
                'list_num' => '3',
            ],

        ];

        return $app;
    }

    //个人中心(我的)页面
    public function actionMycontent() {
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        $req = Yii::$app->request;
        $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));

        if($token == '') {
            $data['status'] = '0003';
            $data['message'] = Yii::t('app', '参数不能为空');
            echo json_encode($data);
            exit;
        }
        $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
        if(!$userdata) {
            $data['status'] = '0003';
            $data['message'] = Yii::t('app', '已登出1');
            echo json_encode($data);
            exit;
        }
        if(Yii::$app->request->isPost){
            $app_list = $this->appList($token);
            $wallet_list = $this->listRecord($token);
            //累计收益(产品增值 + 推广收益)
            $isactivate = User::find()->where('id = :id',[':id'=>$userdata->id])->one();
            $all_zodiac1 = UserZodiac::find()->where('userid = :id',[':id'=>$userdata->id])->sum('old_hcg');
            $all_zodiac2 = UserZodiac::find()->where('userid = :id',[':id'=>$userdata->id])->sum('hcg');
            $tuiguang = UserWalletRecord::find()->where('userid = :id and wallet_type = 3 and pay_type = 1',[':id'=>$userdata->id])->sum('amount');
            $recommend_award = $all_zodiac2 - $all_zodiac1 + $tuiguang;
            //总资产(我当前拥有的所有宠物价格总和)
            $all_award = ZodiacIssue::find()->where('belong_id = :id and issel != 1',[':id'=>$userdata->id])->sum('hcg');

            $res = [
                'status' => '0001',
                'message' => Yii::t('app','获取成功'),
                'data' => [
                    'userid' => $userdata->id,
                    'username' => $userdata->userprofile->truename ? $userdata->userprofile->truename : $userdata->userprofile->username,
                    'app' => $app_list,      //菜单列表
                    'list' => $wallet_list,    // 宠物相关菜单列表
                    'token' => $userdata->app_token,
                    'is_active' => $isactivate->isactivate == isactivate,
                    'hcg_wa' => $userdata->wallet->hcg_wa ? floor($userdata->wallet->hcg_wa * 10000)/10000 : 0,      //积分
                    'cash_wa' => $userdata->wallet->cash_wa ? floor($userdata->wallet->cash_wa * 10000)/10000 : 0,   //dragon
                    'gtc' => floor($userdata->wallet->kmd *100)/100,                                                //可挖kmd
                    'care_wa' => $userdata->wallet->care_wa ? floor($userdata->wallet->care_wa * 100)/100 : 0,   //推广收益
                    'recommend_award' => $recommend_award ? floor($recommend_award * 100)/100 : 0,               //累计收益
                    'total_award' => $all_award ? floor($all_award * 10000)/10000 : 0,     //总资产

                ],
            ];
        }else{
            $this->retjson('0002',Yii::t('app','非法请求'));exit;
        }
        return json_encode($res);
    }

    //修改昵称
    public function actionAlternickname(){
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');

        $req = Yii::$app->request;
        $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
        if($token == '') {
            $data['status'] = '0002';
            $data['message'] = Yii::t('app', '无效参数');
            echo json_encode($data);
            exit;
        }
        $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
        if(!$userdata) {
            $this->retjson('0003',Yii::t('app','已登出'));exit;
        }
        if(Yii::$app->request->isPost) {
            $nickname = HtmlPurifier::process(Yii::$app->request->post('nickname'));
            if(!$nickname) {
                $this->retjson('0002',Yii::t('app','昵称不能为空'));exit;
            }
            $userdata->userprofile->truename = $nickname;
            if($userdata->userprofile->save()){
                $this->retjson('0001',Yii::t('app','修改成功！'));exit;
            }else{
                $this->retjson('0002',Yii::t('app','修改失败'));exit;
            }
        }else{
            $this->retjson('0002',Yii::t('app','非法请求'));exit;
        }
    }
    //设置
    public function actionMycenterset(){
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        $req = Yii::$app->request;
        $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
        if($token == '') {
            $data['status'] = '0002';
            $data['message'] = Yii::t('app', '无效参数');
            echo json_encode($data);
            exit;
        }
        $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
        if(!$userdata) {
            $data['status'] = '0003';
            $data['message'] = Yii::t('app', '已登出');
            echo json_encode($data);
            exit;
        }
        if(Yii::$app->request->isPost){
            $res = [
                'status' => '0001',
                'message' => '获取成功',
                'data' => [
                    'phone' => $userdata->userprofile->phone,
                    'name' => $userdata->userprofile->username
                ]
            ];
            return json_encode($res);
        }else{
            return json_encode(['status'=>'0002','message'=>'非法操作']);
        }

    }

    //我的团队
    public function actionMyteam(){
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        $req = Yii::$app->request;
        $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
        if($token == '') {
            $this->retjson('0002',Yii::t('app','无效参数'));exit;
        }
        $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
        if(!$userdata) {
            $this->retjson('0003',Yii::t('app','已登出'));exit;
        }
        if(Yii::$app->request->isPost){
            $page = trim(HtmlPurifier::process(Yii::$app->request->post('page',1)));    //页数
            if(!empty($userdata->userprofile->down_team_id)){
                $all_down_id_num =  count(explode('-',$userdata->userprofile->down_team_id));   //团队总人数
            }else{
                $all_down_id_num = 0;
            }
            // 直推人数
            $query = UserProfile::find()->where('referrerid = :referrerid',[':referrerid' => $userdata->id]);
            $pagesize = 12;
            $offset = $pagesize * ($page - 1);
            $query_one = clone $query;
            $direct_num = $query_one->count();      //直推人数
            $direct_list = $query->offset($offset)->limit($pagesize)->asArray()->all();
            $indirect_count = 0;    //间推人数
            $ary = [];
            if(!empty($direct_list)){
                foreach($direct_list as $k => $v){
                    //获取用户信息
                    $down_user = User::find()->where('id = :id',[':id'=>$v['userid']])->one();
                    $count = UserProfile::find()->where('referrerid = :referrerid',[':referrerid' => $v['userid']])->count();
                    $indirect_count += $count;
                    $ary[$k]['id'] = $v['userid'];
                    $ary[$k]['username'] = substr($v['username'],0,5).'****';
                    $ary[$k]['truename'] = $v['truename'];
                    $ary[$k]['time'] = date("Y-m-d H:i:s",$v['created_at']);
                    $ary[$k]['active'] = $down_user->level_id == 0 ? '未激活' : '已激活';
                }
            }

            $data = [
                'team_num'=>$all_down_id_num,   //团队总人数
                'direct_num'=>$direct_num,      //直推人数
                'indirect' => $indirect_count,  //间推人数
                'list' => $ary      //直推列表
            ];
            $this->retjson('0001',Yii::t('app','获取成功'),$data);exit;
        }else{
            $this->retjson('0002',Yii::t('app','非法请求'));exit;
        }
    }

    // 查看团队
    public function actionViewteam(){
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        $req = Yii::$app->request;
        $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
        if($token == '') {
            $this->retjson('0002',Yii::t('app','无效参数'));exit;
        }
        $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
        if(!$userdata) {
            $this->retjson('0003',Yii::t('app','已登出'));exit;
        }
        if(Yii::$app->request->isPost){
            $page = HtmlPurifier::process(Yii::$app->request->post('page',1));
            $id = HtmlPurifier::process(Yii::$app->request->post('id',''));     //上级用户id
            $pagesize = 12;     //分页
            $offset = ($page - 1)*$pagesize;
            $query = UserProfile::find()->where('referrerid = :referrerid',[':referrerid' => $id]);
            $query_one = clone $query;
            $direct_num = $query_one->count();      //直推人数
            $uper = UserProfile::find()->where('userid = :id',[':id'=>$id])->one();
            $uper_name = $uper->truename ? $uper->truename : $uper->username;
            $direct_list = $query->offset($offset)->limit($pagesize)->asArray()->all();
            $ary = [];
            $flag = 0;  //标记
            if(!empty($direct_list)){
                foreach($direct_list as $k => $v){
                    //获取充值记录
                    $recharge = Recharge::find()->where('userid = :id',[':id'=>$userdata->id])->one();
                    if($recharge && $userdata->isactivate){
                        $flag = 1;
                    }
                    $ary[$k]['id'] = $v['userid'];
                    $ary[$k]['username'] = $v['username'];
                    $ary[$k]['truename'] = $v['truename'];
                    $ary[$k]['time'] = date("Y-m-d H:i:s",$v['created_at']);
                    $ary[$k]['active'] = $flag == 0 ? '未激活' : '已激活';
                }
            }

            $data = [
                'direct_num'=>$direct_num,      //直推人数
                'username' => $uper_name,       //直推人用户
                'list' => $ary      //直推列表
            ];
            $this->retjson('0001',Yii::t('app','获取成功'),$data);exit;
        }else{
            $this->retjson('0002',Yii::t('app','非法请求'));exit;
        }
    }

    //收款管理列表
    public function actionReceiptlist(){
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        $req = Yii::$app->request;
        $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
        if($token == '') {
            $data['status'] = '0002';
            $data['message'] = Yii::t('app', '无效参数');
            echo json_encode($data);
            exit;
        }
        $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
        if(!$userdata) {
            $data['status'] = '0003';
            $data['message'] = Yii::t('app', '已登出');
            echo json_encode($data);
            exit;
        }
        if(Yii::$app->request->isPost){
            $userbank = UserBank::getUserbankLoad($userdata,'1');
            if($userdata->userprofile->wechat){
                $wechat = [
                    'account' => $userdata->userprofile->wechat ? $userdata->userprofile->wechat : '',
                    'type' => '微信',
                    'name' => $userdata->userprofile->wechat_name ? $userdata->userprofile->wechat_name : '',
                    'url' => $userdata->userprofile->wechat_img ? $userdata->userprofile->wechat_img : ''
                ];
            }else{
                $wechat = '';
            }
            if($userdata->userprofile->alipay){
                $alipay = [
                    'account' => $userdata->userprofile->alipay ? $userdata->userprofile->alipay : '',
                    'type' => '支付宝',
                    'name' => $userdata->userprofile->alipay_name ? $userdata->userprofile->alipay_name : '',
                    'url' => $userdata->userprofile->alipay_img ? $userdata->userprofile->alipay_img : ''
                ];
            }else{
                $alipay = '';
            }

            $res = [
                'status' => '0001',
                'message' => Yii::t('app','获取成功'),
                'data' => [
                    'banklist' => $userbank,
                    'wechat' =>$wechat,
                    'alipay' => $alipay
                ],
            ];

        }else{
            $res = [
                'status' => '0002',
                'message' => Yii::t('app','非法请求'),
            ];
        }
        return json_encode($res);
    }

    //银行列表
    public function actionBanklist(){
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        $req = Yii::$app->request;
        $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
        if($token == '') {
            $this->retjson('0002',Yii::t('app','无效参数'));exit;
        }
        $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
        if(!$userdata) {
            $this->retjson('0003',Yii::t('app','已登出'));exit;
        }
        if(Yii::$app->request->isPost){
            $banklist = \common\models\Bank::find()->asArray()->all();
            $ary = [];
            if(!empty($banklist)){
                foreach($banklist as $k => $v){
                    $ary[$k]['name'] = $v['name'];
                }
            }
            return json_encode(['status'=>'0001','message'=>'获取成功','data'=>$ary]);
        }else{
            return json_encode(['status'=>'0002','message'=>'参数错误']);
        }


    }

    //添加银行卡
    public function actionAddbank(){
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        $req = Yii::$app->request;
        $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
        if($token == '') {
            $this->retjson('0002',Yii::t('app','无效参数'));exit;
        }
        $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
        if(!$userdata) {
            $this->retjson('0003',Yii::t('app','已登出'));exit;
        }
        if(Yii::$app->request->isPost){
            $truename = trim(HtmlPurifier::process(Yii::$app->request->post('truename','')));    //持卡人姓名
            $bank_number = trim(HtmlPurifier::process(Yii::$app->request->post('bank_number','')));    //银行卡号
            $bankname = trim(HtmlPurifier::process(Yii::$app->request->post('bankname','')));    //开户行

            if(!preg_match("/^(\d{16}|\d{19}|\d{17})$/",$bank_number)){
                $res = [
                    'status' => '0002',
                    'message' => Yii::t('app', '请填写正确的银行卡号'),
                ];
                return json_encode($res);
            }
            if(!preg_match("/^[\x7f-\xff]+$/",$truename)){
                $res = [
                    'status' => '0002',
                    'message' => Yii::t('app', '请填写正确的姓名'),
                ];
                return json_encode($res);
            }
            //创建用户银行表信息
            $userbank = new UserBank();
            //检验银行卡是否已经被添加过
            $allbanknum = UserBank::find()->where("bank_number = :bank_number && state = 1", [":bank_number" => $bank_number])->one();

            if ($allbanknum) {
                $this->retjson('0002',Yii::t('app','此卡已存在'));exit;
            }
            $userbank->userid = $userdata->id; // id
            $userbank->username = $userdata->username;    // 用户名
            $userbank->truename = $truename;    // 持卡人真实姓名
            $userbank->bank_number = $bank_number;  // 银行卡号
            $userbank->phone = $userdata->userprofile->phone;  // 持卡人手机号
            $userbank->bank = $bankname;    // 银行名称
            $userbank->sub_bank = '';    // 开户支行
            $userbank->zmpath = '';    // 银行卡正面路径
            $userbank->fmpath = '';    // 银行卡反面路径
            $userbank->isdefault = 2;// 设置银行卡为默认卡

            //检验数据
            if (!$userbank->validate()) {
                foreach ($userbank->errors as $errors) {
                    $message = $errors[0];
                    break;
                }
                echo json_encode(["status" => '0002', "message" => Yii::t('app', $message)]);
                exit();
            }

            $result = MTools::saveModel($userbank);
            if($result==true){
                $this->retjson('0001',Yii::t('app','添加成功！'));exit;
            }else{
                $this->retjson('0002',Yii::t('app','添加失败！'),$result);
            }

        }

    }

    //删除银行卡
    public function actionBank() {
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        $req = Yii::$app->request;
        $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
        if($token == '') {
            $data['status'] = '0002';
            $data['message'] = Yii::t('app', '无效参数');
            echo json_encode($data);
            exit;
        }
        $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
        if(!$userdata) {
            $data['status'] = '0003';
            $data['message'] = Yii::t('app', '已登出');
            echo json_encode($data);
            exit;
        }
        if(Yii::$app->request->isPost){
            //获取银行卡ID
            $bankid = trim(HtmlPurifier::process(Yii::$app->request->post('id')));
            // 获得要删除卡的模型
            $result = WB_UserBank::find()->where("id=:id and state = 1", [":id" => $bankid])->one();
            if($result) {
                // 将需要删除的卡状态设置为2（已删除），是否设置为默认卡，如果是，则需要将之前的默认卡isdefault值设置为2
                $result->state = 2;
                $result = MTools::saveModel($result);
                if($result==true){
                    $this->retjson('0001',Yii::t('app','删除成功！'));exit;
                }else{
                    $this->retjson('0002',Yii::t('app','删除失败！'),$result);
                }
            }else{
                $this->retjson('0002',Yii::t('app','银行卡不存在！'));exit;
            }
        }else{
            $this->retjson('0002',Yii::t('app','非法请求'));exit;
        }
    }

    //添加微信支付码
    public function actionAddweixin(){
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        $req = Yii::$app->request;
        $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
        if($token == '') {
            $this->retjson('0002',Yii::t('app','无效参数'));exit;
        }
        $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
        if(!$userdata) {
            $this->retjson('0003',Yii::t('app','已登出'));exit;
        }
        if(Yii::$app->request->isPost){
            //获取参数
            $wechat = trim(HtmlPurifier::process(Yii::$app->request->post('wechat','')));    //微信号
            $wechat_img = trim(HtmlPurifier::process(Yii::$app->request->post('wechat_img','')));    //微信收款码
            $wechat_name = trim(HtmlPurifier::process(Yii::$app->request->post('wechat_name','')));    //微信收款人姓名
            if(!preg_match("/^[\x7f-\xff]+$/",$wechat_name)){
                $res = [
                    'status' => '0002',
                    'message' => '请填写正确的姓名',
                ];
                return json_encode($res);
            }
            if(!$wechat || !$wechat_img){
                $this->retjson('0002','参数不能为空！');exit;
            }
            if($userdata->userprofile->wechat && $userdata->userprofile->wechat_img){
                $this->retjson('0002','只能存在一个微信收款账号！');exit;
            }
            if($wechat == $userdata->userprofile->wechat){
                $this->retjson('0002','此微信账号已经添加！');exit;
            }
            $userdata->userprofile->wechat = $wechat;
            $userdata->userprofile->wechat_img = $wechat_img;
            $userdata->userprofile->wechat_name = $wechat_name;
            if($userdata->userprofile->save()){
                $res = [
                    'status' => '0001',
                    'message' => '添加成功',
                ];
            }else{
                $res = [
                    'status' => '0002',
                    'message' => '添加失败',
                ];
            }
            return json_encode($res);
        }

    }

    //添加支付宝收款码
    public function actionAddalipay(){
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        $req = Yii::$app->request;
        $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
        if($token == '') {
            $this->retjson('0002',Yii::t('app','无效参数'));exit;
        }
        $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
        if(!$userdata) {
            $this->retjson('0003',Yii::t('app','已登出'));exit;
        }
        if(Yii::$app->request->isPost){
            $alipay = trim(HtmlPurifier::process(Yii::$app->request->post('alipay')));    //支付宝账号
            $alipay_img = trim(HtmlPurifier::process(Yii::$app->request->post('alipay_img','')));    //支付宝收款码
            $alipay_name = trim(HtmlPurifier::process(Yii::$app->request->post('alipay_name','')));    //支付宝收款人姓名
            if(!preg_match("/^[\x7f-\xff]+$/",$alipay_name)){
                $res = [
                    'status' => '0002',
                    'message' => '请填写正确的姓名',
                ];
                return json_encode($res);
            }
            if(!$alipay || !$alipay_img){
                $this->retjson('0002','参数不能为空！');exit;
            }
            if($userdata->userprofile->alipay && $userdata->userprofile->alipay_img){
                $this->retjson('0002','只能存在一个支付宝收款账号！');exit;
            }
            if($alipay == $userdata->userprofile->alipay){
                $this->retjson('0002','此支付宝账号已经添加！');exit;
            }
            $userdata->userprofile->alipay = $alipay;
            $userdata->userprofile->alipay_img = $alipay_img;
            $userdata->userprofile->alipay_name = $alipay_name;
            if($userdata->userprofile->save()){
                $res = [
                    'status' => '0001',
                    'message' => '添加成功',
                ];
            }else{
                $res = [
                    'status' => '0002',
                    'message' => '添加失败',
                ];
            }
            return json_encode($res);
        }

    }

    //删除微信/支付宝账号
    public function actionDelaccount(){
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        $req = Yii::$app->request;
        $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
        if($token == '') {
            $this->retjson('0002',Yii::t('app','无效参数'));exit;
        }
        $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
        if(!$userdata) {
            $this->retjson('0003',Yii::t('app','已登出'));exit;
        }
        if(Yii::$app->request->isPost){
            return json_encode(['status'=>'0001','message'=>'若要修改,请联系客服']);
            $type = trim(HtmlPurifier::process(Yii::$app->request->post('typeid')));
            if(!in_array($type,[1,2])){
                return json_encode(['status'=>'0002','message'=>'参数错误']);
            }
            if($type == 1){     //微信
                $userdata->userprofile->wechat = '';
                $userdata->userprofile->wechat_img = '';
                $userdata->userprofile->wechat_name = '';
            }else{      //支付宝
                $userdata->userprofile->alipay = '';
                $userdata->userprofile->alipay_img = '';
                $userdata->userprofile->alipay_name = '';
            }
            if($userdata->userprofile->save()){
                return json_encode(['status'=>'0001','message'=>'删除成功']);
            }else{
                return json_encode(['status'=>'0001','message'=>'删除失败']);
            }

        }

    }

    //修改登录密码
    public function actionAlterlogpwd() {
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');

        $req = Yii::$app->request;
        $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
        if($token == '') {
            $data['status'] = '0002';
            $data['message'] = Yii::t('app', '无效参数');
            echo json_encode($data);
            exit;
        }
        $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
        if(!$userdata) {
            $data['status'] = '0003';
            $data['message'] = Yii::t('app', '已登出');
            echo json_encode($data);
            exit;
        }
        if(Yii::$app->request->isPost) {
            $newpwd = HtmlPurifier::process(Yii::$app->request->post('newpwd'));
            $oldpwd = HtmlPurifier::process(Yii::$app->request->post("oldpwd"));
            $code = HtmlPurifier::process(Yii::$app->request->post("code"));
            if (empty($newpwd) || empty($oldpwd)) {
                $this->retjson('0002',Yii::t('app','密码不能为空！'));exit;
            }
            if (strlen($newpwd) < 6 || strlen($newpwd) > 20) {
                $this->retjson('0002',Yii::t('app','密码长度6-20位'));exit;
            }
            $this->checkPhoneCode($userdata,$code);

            if (!$userdata->validatePassword($oldpwd)) {
                $this->retjson('0002',Yii::t('app','旧密码错误'));exit;
            } else {
                $userdata->setPassword($newpwd);
                if (!$userdata->save()) {
                    $this->retjson('0002',Yii::t('app','修改失败'));exit;
                } else {
                    $this->retjson('0001',Yii::t('app','修改成功！'));exit;
                }
            }
        }else{
            $this->retjson('0002',Yii::t('app','非法请求'));exit;
        }
    }

    // 图片上传(app)
    public function actionAppupload() {
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        if (Yii::$app->request->isPost) {
            //  $_FILES重置, 重组原来的$_FILE
            $iconAry = array(
                "WB_UserServer" => [
                    "name" => ["picture" => $_FILES['file']['name']],
                    "type" => ["picture" => $_FILES['file']['type']],
                    "tmp_name" => ["picture" => $_FILES['file']['tmp_name']],
                    "error" => ["picture" => $_FILES['file']['error']],
                    "size" => ["picture" => $_FILES['file']['size']]
                ]
            );
            unset($_FILES['file']);
            $_FILES = $iconAry;

            $server = new WB_UserServer();
            $filename = Yii::$app->imgload->UploadPhotoQn($server, 'picture');
            if ($filename == 'error') {
                $res = [
                    'status' => '0002',
                    'message' => Yii::t('app','图片错误，请重新上传！')
                ];
            } elseif ($filename == 'oversize') {
                $res = [
                    'status' => '0002',
                    'message' => Yii::t('app','上传的图片大小不能超过5M')
                ];
            } else {
                $res = [
                    'status' => '0001',
                    'message' => Yii::t('app','上传成功！'),
                    'data' => [
                        'src' => $filename
                    ],
                ];
            }
        }else{
            $res = [
                'status' => '0002',
                'message' => Yii::t('app','非法请求')
            ];
        }
        return json_encode($res);
    }

    //投诉建议提交
    public function actionComsubmit() {
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        $req = Yii::$app->request;
        $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
        if($token == '') {
            $this->retjson('0002',Yii::t('app','无效参数'));exit;
        }
        $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
        if(!$userdata) {
            $this->retjson('0003',Yii::t('app','已登出'));exit;
        }
        if (Yii::$app->request->isPost) {
            $title = HtmlPurifier::process(Yii::$app->request->post('title',''));         // 标题
            $content = HtmlPurifier::process(Yii::$app->request->post('describe',''));    // 内容
            $src = HtmlPurifier::process(Yii::$app->request->post('src',''));             // 图片路径
            $cs_type = HtmlPurifier::process(Yii::$app->request->post('cs_type',''));     // 类型，1：建议；2：超时申请;3:卖家申诉
            $cs_id = HtmlPurifier::process(Yii::$app->request->post('cs_id',''));         // 订单id
            if(empty($title) || empty($content)){
                $this->retjson('0002',Yii::t('app','标题或内容不能为空'));exit;
            }
            if ($cs_type == 2) {
                $type = 2;
            } else if($cs_type == 3) {
                if(!$cs_id){
                   return json_encode(['status'=>'0002','message'=>'参数错误']);die;
                }
                $order = \common\models\UserAmountTrade::find()->where('id=:id', [':id' => $cs_id])->one();
                $order->status = 8;     // 设置订单状态为8，卖家申诉
                $order->save();
                $type = 3;
            } else {
                $type = 1;
            }
            // 创建投诉建议记录
            $server = new WB_UserServer();
            $server->picture = $src;
            $server->title = $title;
            $server->content = $content;
            $server->created_at = time();
            $server->userid = $userdata->id;
            $server->username = $userdata->username;
            $server->type = $type;
            $server->branch_id = $userdata->branch_id;
            if ($cs_id) {
                $server->order_id = $cs_id;
            }
            if ($server->save()) {
                $this->retjson('0001',Yii::t('app','提交成功'));exit;
            } else {
                $this->retjson('0002',Yii::t('app','提交失败'));exit;
            }
        }else{
            $this->retjson('0002',Yii::t('app','非法请求'));exit;
        }
    }

    //投诉建议记录(列表)
    public function actionMycomplain() {
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        $req = Yii::$app->request;
        $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
        if($token == '') {
            $this->retjson('0002',Yii::t('app','无效参数'));exit;
        }
        $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
        if(!$userdata) {
            $this->retjson('0003',Yii::t('app','已登出'));exit;
        }
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            //当前页
            $page = HtmlPurifier::process(isset($post['page']) ? $post['page'] : 1);
            //用户信息
            $userid = $userdata->id;
            //获取建议记录
            $record = WB_UserServer::getOutRecordLoad($userid,$page,'');
            $data = [];
            if($record){
                foreach($record as $key => $value){
                    $data[$key] = [
                        'id' => $value['id'],
                        'title' => $value['title'],
                        'type' => $value['type'],
                        'order_id' =>  $value['order_id'] ? $value['order_id'] : '' ,
                        'create_time' => $value['created_at']
                    ];
                }
                $this->retjson('0001',Yii::t('app','获取成功'),$data);exit;
            }else{
                $res = [
                    'status' => '0001',
                    'message' => Yii::t('app','暂无数据'),
                    'data' => $data,
                ];
                return json_encode($res);
            }
        }else{
            $this->retjson('0002',Yii::t('app','非法请求'));exit;
        }
    }

    //投诉建议记录(详情)
    public function actionComplaincontent() {
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        $req = Yii::$app->request;
        $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
        if($token == '') {
            $this->retjson('0002',Yii::t('app','无效参数'));exit;
        }
        $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
        if(!$userdata) {
            $this->retjson('0003',Yii::t('app','已登出'));exit;
        }
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            //记录ID
            $id = HtmlPurifier::process($post["id"]);
            //获取记录详情
            $result = WB_UserServer::find()->where("id=:id", [":id" => $id])->asArray()->one();
            if($result){
//                switch ($result['type']){
//                    case 1:
//                        $data = [
//                            'title' => Yii::t('app','我的建议'),
//                            'content' => $result['content'] ? $result['content'] : '',
//                            'src' => $result['picture'] ? $result['picture'] : '',
//                            'order_id' => $result['order_id'] ? $result['order_id'] : '',
//                            'replay' => $result['replay'] ? $result['replay'] : ''
//                        ];
//                        break;
//                    case 2:
//                        $data = [
//                            'title' => Yii::t('app','超时申请'),
//                            'content' => $result['content'] ? $result['content'] : '',
//                            'src' => $result['picture'] ? $result['picture'] : '',
//                            'order_id' => $result['order_id'] ? $result['order_id'] : '',
//                            'replay' => $result['replay'] ? $result['replay'] : ''
//                        ];
//                        break;
//                    case 3:
//                        $data = [
//                            'title' => Yii::t('app','卖家申诉'),
//                            'content' => $result['content'] ? $result['content'] : '',
//                            'src' => $result['picture'] ? $result['picture'] : '',
//                            'order_id' => $result['order_id'] ? $result['order_id'] : '',
//                            'replay' => $result['replay'] ? $result['replay'] : ''
//                        ];
//                        break;
//                    default:
//                        $data = [];
//                        break;
//                }
                $data = [
                    'title' => $result['title'] ? $result['title'] : '',
                    'content' => $result['content'] ? $result['content'] : '',
                    'src' => $result['picture'] ? $result['picture'] : '',
                    'order_id' => $result['order_id'] ? $result['order_id'] : '',
                    'replay' => $result['replay'] ? $result['replay'] : '',
                    'replayd_at' => $result['replayd_at'] ? date("Y-m-d H:i:s",$result['replayd_at']) : '',
                ];
                $this->retjson('0001',Yii::t('app','获取成功'),$data);exit;
            }else{
                $data = [
                    'title' => '',
                    'content' => '',
                    'src' => '',
                    'order_id' => '',
                    'replay' => '',
                    'replayd_at' => '',
                ];
                $this->retjson('0001',Yii::t('app','暂无数据'),$data);exit;
            }
        }else{
            $this->retjson('0002',Yii::t('app','非法请求'));exit;
        }
    }

    //公告列表
    public function actionNotice() {
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');

        $req = Yii::$app->request;
        $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
        if($token == '') {
            $data['status'] = '0002';
            $data['message'] = Yii::t('app', '无效参数');
            echo json_encode($data);
            exit;
        }
        $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
        if(!$userdata) {
            $data['status'] = '0003';
            $data['message'] = Yii::t('app', '已登出');
            echo json_encode($data);
            exit;
        }
        if(Yii::$app->request->isPost) {
            $page = trim(HtmlPurifier::process(Yii::$app->request->post('page'),1));    //默认页数
            $type = trim(HtmlPurifier::process(Yii::$app->request->post('typeid')));    //默认页数
            if(!in_array($type,[42,43])){
                $this->retjson('0002',Yii::t('app','请求参数错误'));exit;
            }
            $data = WB_Article::getList($page,$type);  //42:系统公告 43:新手指南
            if($data){
                $result = [];
                foreach ($data as $key => $value){
                        $result[$key] = [
                            'id' => $value['id'],
                            'title' => $value['title'],
                            'created_at' => date('Y-m-d H:i:s',$value['created_at']),
                        ];
                }
                $this->retjson('0001',Yii::t('app','获取成功'),$result);exit;
            }else{
                $res['status'] = '0001';
                $res['message'] = '暂无数据';
                $res['data'] = [];
                echo json_encode($res);exit;
            }
        }else{
            $this->retjson('0002',Yii::t('app','非法请求'));exit;
        }
    }

    //公告详情
    public function actionNoticecontent() {
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');

        $req = Yii::$app->request;
        $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
        if($token == '') {
            $data['status'] = '0002';
            $data['message'] = Yii::t('app', '无效参数');
            echo json_encode($data);
            exit;
        }
        $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
        if(!$userdata) {
            $data['status'] = '0003';
            $data['message'] = Yii::t('app', '已登出');
            echo json_encode($data);
            exit;
        }

        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            // 获取语言
            if(empty($post['id'])){
                $this->retjson('0002',Yii::t('app','请求参数错误'));exit;
            }
            $id = trim(HtmlPurifier::process($post["id"]));
            $result = WB_Article::findOne($id);
            if($result){
                $data = [
                    'title' => $result['title'],
                    'content' => $result['content'],
                    'created_at' => date('Y-m-d H:i:s',$result['created_at']),
                ];
                $this->retjson('0001',Yii::t('app','获取成功'),$data);exit;
            }else{
                $data = [];
                $this->retjson('0001',Yii::t('app','暂无数据'),$data);exit;
            }
        }else{
            $this->retjson('0002',Yii::t('app','非法请求'));exit;
        }
    }

    // 首页轮播图，点击进去的页面显示（新闻内容）
    public function actionNoticweb(){
        $lang = HtmlPurifier::process(Yii::$app->request->get('lang'));
        $id = HtmlPurifier::process(Yii::$app->request->get("id"));
        $res = WB_Article::findOne($id);
        return $this->render('noticweb',['data' => $res, 'lang' => $lang]);
    }

    //积分转出
    public function actionTurnouthcg(){
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        $req = Yii::$app->request;
        $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
        if($token == '') {
            $data['status'] = '0002';
            $data['message'] = Yii::t('app', '无效参数');
            echo json_encode($data);
            exit;
        }
        $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
        if(!$userdata) {
            $data['status'] = '0003';
            $data['message'] = Yii::t('app', '已登出');
            echo json_encode($data);
            exit;
        }

        if(Yii::$app->request->isPost){
            //获取后台参数
            $activeperson = MTools::getYiiParams('activeperson') ? MTools::getYiiParams('activeperson') : 10;   //激活会员龙之限制
            //获取参数
            $num = trim(HtmlPurifier::process(Yii::$app->request->post('num')));
            $account = trim(HtmlPurifier::process(Yii::$app->request->post('account')));
            $password = trim(HtmlPurifier::process(Yii::$app->request->post('traspass')));
            //获取后台转出积分最小值限制
            $hcg_min = MTools::getYiiParams('turnout_hcg_min') ? MTools::getYiiParams('turnout_hcg_min') : 20;    //最小转出积分
            $hcg_max = MTools::getYiiParams('turnout_hcg_max') ? MTools::getYiiParams('turnout_hcg_max') : 10000;    //最大转出积分
            $out_num = floor($num * 100)/100;
            if($out_num<0){
                echo json_encode(['status'=>'0002','message'=>'转出数量不能小于0']);
                exit;
            }
            //校验转出积分
            if(floor($num * 100)/100 < $hcg_min){
                echo json_encode(['status'=>'0002','message'=>'最少转出'.$hcg_min.'积分']);
                exit;
            }
            if(floor($num * 100)/100 > $hcg_max){
                echo json_encode(['status'=>'0002','message'=>'最少大转出'.$hcg_max.'积分']);
                exit;
            }
            if(floor($num * 100)/100 > $userdata->wallet->hcg_wa){
                echo json_encode(['status'=>'0002','message'=>'您的积分不足']);
                exit;
            }
            //不能转给自己
            if($userdata->userprofile->phone == $account){
                echo json_encode(['status'=>'0002','message'=>'转出的手机不能是自己']);
                exit;
            }
            //校验对方账号是否存在
            $other = UserProfile::find()->where('phone = :phone',[':phone' => $account])->one();
            if(!$other){
                echo json_encode(['status'=>'0002','message'=>'要转出的手机号不存在']);
                exit;
            }
            $user = User::find()->where('id = :id',[':id'=>$other->userid])->one();     //转入方信息
            //校验交易密码
            if(!$userdata->validatePassword2($password)){
                echo json_encode(['status'=>'0002','message'=>'交易密码不正确']);
                exit;
            }
            $trans = Yii::$app->db->beginTransaction();
            try{
                //  转让表数据插入
                $UserTransform = new UserTransform();
                $UserTransform->in_userid = $other->userid;//  转入id
                $UserTransform->in_username = $other->username;//  转入账号
                $UserTransform->out_userid = $userdata->id;//  转出id
                $UserTransform->out_username = $userdata->username;//  转出账户
                $UserTransform->amount = $num;//  转出积分数量
                $UserTransform->created_at = time();//  创建时间
                $UserTransform->updated_at = time();//  更新时间
                //更新账户记录
                $userdata->wallet->hcg_wa -= $num;  //当前账户的积分减少
                $user->wallet->hcg_wa += $num;     //对方账号积分增加
                if($user->wallet->hcg_wa >= $activeperson && $user->isactivate){
                    $user->level_id = 1;
                    $user->save();
                }
                //插入账户记录
                $note1 = '向'.$user->username.'转出积分 :'.$num;
                $note2 = '收到'.$userdata->username.'转来的积分 :'.$num;
                $record1 = UserWalletRecord::insertrecord($userdata->id,$num,4,2,1,$userdata->wallet->hcg_wa,$note1);
                $record2 = UserWalletRecord::insertrecord($user->id,$num,12,1,1,$user->wallet->hcg_wa,$note2);
                if($UserTransform->save() && $userdata->wallet->save() && $user->wallet->save() && $record1 && $record2){
                    $trans->commit();
                    $res = [
                        'status' => '0001',
                        'message' => Yii::t('app','积分转增成功')
                    ];

                }else{
                    $trans->rollBack();
                    $res = [
                        'status' => '0002',
                        'message' => Yii::t('app','转增失败')
                    ];
                }
                echo json_encode($res);
                exit;

            }catch(Exception $e){
                $trans->rollBack();
                throw new \yii\web\NotFoundHttpException;
            }

        }

    }

    //实名认证(请求)
    public function actionRealname()
    {
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');

        $req = Yii::$app->request;
        $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
        if($token == '') {
            $data['status'] = '0002';
            $data['message'] = Yii::t('app', '无效参数');
            echo json_encode($data);
            exit;
        }
        $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
        if(!$userdata) {
            $data['status'] = '0003';
            $data['message'] = Yii::t('app', '已登出');
            echo json_encode($data);
            exit;
        }

        if(Yii::$app->request->isPost){
            if($userdata->isactivate == 1){
                $res = [
                    'status' => '0002',
                    'message' => Yii::t('app', '您已实名认证过'),
                ];
                return json_encode($res);
            }
            //获取前端参数
            $idNo = HtmlPurifier::process(Yii::$app->request->post('idNo'));        //身份证号
            $idNo = trim($idNo);
            $name = HtmlPurifier::process(Yii::$app->request->post('name'));        //姓名
            $name = trim($name);
            //判断用户有没有收款方式
            $userbank = UserBank::find()->where('userid = :userid and state = 1',[':userid'=>$userdata->id])->one();
            if(!$userbank && !$userdata->userprofile->alipay && !$userdata->userprofile->wechat){
                return json_encode(['status'=>'0002','message'=>'请先绑定收款方式再进行实名认证！']);
            }
            if(!preg_match("/^([\d]{17}[xX\d]|[\d]{15})$/",$idNo)){
                $res = [
                    'status' => '0002',
                    'message' => Yii::t('app', '请填写正确的身份证号'),
                ];
                return json_encode($res);
            }
            if(!preg_match("/^[\x7f-\xff]+$/",$name)){
                $res = [
                    'status' => '0002',
                    'message' => Yii::t('app', '请填写正确的姓名'),
                ];
                return json_encode($res);
            }

            $checUser = BankRealname::find()->where('userid = :id',[':id' => $userdata->id])->one();
            if($checUser){
                if($checUser->is_success == 2){
                    $res = [
                        'status' => '0002',
                        'message' => Yii::t('app', '您填写的信息已经认证过，请认真核实'),
                    ];
                    return json_encode($res);
                }else{
                    $checUser->name = $name;
                    $checUser->idNo = $idNo;
                    $checUser->is_success = 0;
                    $checUser->reason = '';
                    $checUser->created_at = time();
                    if( $checUser->save()){
                        $res = [
                            'status' => '0001',
                            'message' => Yii::t('app','申请提交成功')
                        ];
                    }else{
                        $res = [
                            'status' => '0001',
                            'message' => Yii::t('app','申请提交失败')
                        ];
                    }
                    return json_encode($res);
                }

            }else{

                $trans = Yii::$app->db->beginTransaction();
                try{
                    //插入信息到数据库
                    $bankRealName = new BankRealname();
                    $bankRealName->userid = $userdata->id;
                    $bankRealName->username = $userdata->username;
                    $bankRealName->name = $name;
                    $bankRealName->phoneNo = '';
                    $bankRealName->idNo = $idNo;
                    $bankRealName->cardNo = '';
                    $bankRealName->is_success = 0;
                    $bankRealName->created_at = time();

                    if($bankRealName->save()){
                        $trans->commit();
                        $res = [
                            'status' => '0001',
                            'message' => Yii::t('app','申请提交成功')
                        ];
                    }else{
                        $res = [
                            'status' => '0002',
                            'message' => Yii::t('app','申请提交失败')
                        ];
                    }
                    return json_encode($res);
                }catch(Exception $e){
                    $trans->rollBack();
                    throw $e;
                }
            }

        }

    }

    //实名认证(页面)
    public function actionRealnamepage(){
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');

        $req = Yii::$app->request;
        $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
        if($token == '') {
            $data['status'] = '0002';
            $data['message'] = Yii::t('app', '无效参数');
            echo json_encode($data);
            exit;
        }
        $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
        if(!$userdata) {
            $data['status'] = '0003';
            $data['message'] = Yii::t('app', '已登出');
            echo json_encode($data);
            exit;
        }
        if(Yii::$app->request->isPost){
            //获取实名认证信息
            $bank = BankRealname::find()->where('userid = :userid',[':userid' => $userdata->id])->one();
            if($bank){
                $res = [
                    'status' => '0001',
                    'message' => Yii::t('app', '获取成功'),
                    'isactivate' => 1,
                    'data' => [
                        'name' => $bank->name,
                        'idNo' => $bank->idNo,
                    ]
                ];
                if($bank->is_success == 0){
                    $res['is_pass'] = 0;  //认证中
                }elseif($bank->is_success == 1){
                    $res['is_pass'] = 1;  //认证失败
                    $res['reason'] = $bank->reason;  //认证失败
                }else{
                    $res['is_pass'] = 2;  //认证成功
                }
            }else{
                $res = [
                    'status' => '0001',
                    'message' => Yii::t('app', '获取成功'),
                    'isactivate' => 0,
                    'is_pass' => 3,  //未认证
                    'data' => [
                        'name' => '',
                        'idNo' => '',
                    ]
                ];
            }

            return json_encode($res);
        }

    }

    //线上客服
    public function actionServerline(){
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        $req = Yii::$app->request;
        $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
        if($token == '') {
            $data['status'] = '0002';
            $data['message'] = Yii::t('app', '无效参数');
            echo json_encode($data);
            exit;
        }
        $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
        if(!$userdata) {
            $data['status'] = '0003';
            $data['message'] = Yii::t('app', '已登出');
            echo json_encode($data);
            exit;
        }
        if(Yii::$app->request->isPost){
            //获取后台参数设置
            $qq = MTools::getYiiParams('serverqq');
            $weixin = MTools::getYiiParams('weixin');
            $weixin_code = MTools::getYiiParams('weixin_code');
            $qq_code = MTools::getYiiParams('qq_code');
            $res = [
                'status' => '0001',
                'message' => '获取成功',
                'data' => [
                    'qq' => $qq ? $qq : '',
                    'qq_code' => $qq_code ? $qq_code : '',
                    'wechat' => $weixin ? $weixin : '',
                    'weixin_code' => $weixin_code ? $weixin_code : '',
                ]
            ];
            return json_encode($res);
        }else{
            return json_encode(['status'=>'0002','message'=>'非法操作']);
        }

    }

    //积分/推广收益等列表
    public function actionHcgrechargelist(){
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        $req = Yii::$app->request;
        $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
        if($token == '') {
            $data['status'] = '0002';
            $data['message'] = Yii::t('app', '无效参数');
            echo json_encode($data);
            exit;
        }
        $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
        if(!$userdata) {
            $data['status'] = '0003';
            $data['message'] = Yii::t('app', '已登出');
            echo json_encode($data);
            exit;
        }
        if(Yii::$app->request->isPost){
            //获取后台充值比例
            $recharge_position = MTools::getYiiParams('recharge_position') ? MTools::getYiiParams('recharge_position') : 1;
            $type = trim(HtmlPurifier::process(Yii::$app->request->post('typeid')));    //类型id
            $page = trim(HtmlPurifier::process(Yii::$app->request->post('page',1)));    //页数
            if(!in_array($type,[1,2,3])){
                return json_encode(['status'=>'0002','message'=>'参数错误']);
            }

            $pagesize = 12;
            $offset = $pagesize * ($page - 1);
            if($type == 1){ // 充消记录
                $list = WB_UserWalletRecord::find()->where("userid = :userid && wallet_type = 1 and event_type in(1,2,3,4,6,9,12) and pay_type in(1,2)",[":userid"=>$userdata->id])
                    ->orderBy("created_at desc")
                    -> offset($offset)->limit($pagesize)->asArray()->all();
            }elseif($type == 2){    // 推广收益列表
                $list = WB_UserWalletRecord::find()->where("userid = :userid && wallet_type = 3 ",[":userid"=>$userdata->id])
                    ->orderBy("created_at desc")
                    -> offset($offset)->limit($pagesize)->asArray()->all();
            }else{  //累计收益列表(产品增值 + 推广收益)
                $list1 = WB_UserWalletRecord::find()->select('event_type,created_at,amount')->where("userid = :userid && wallet_type = 3 and pay_type = 1 ",[":userid"=>$userdata->id])
                    ->orderBy("created_at desc")
                    -> offset($offset)->limit($pagesize)->asArray()->all();
                //获取产品增值
                $list2 = ZtslAward::find()->where('userid = :id',[':id'=>$userdata->id])-> offset($offset)->limit($pagesize)->asArray()->orderBy('created_at desc')->all();
                $ary1 = [];
                $ary2 = [];
                if(!empty($list1)){
                    foreach ($list1 as $k =>$v){
                        $ary1[$k]['event_type'] = $v['event_type'];
                        $ary1[$k]['pay_type'] = 1;
                        $ary1[$k]['amount'] = $v['amount'];
                        $ary1[$k]['created_at'] = $v['created_at'];
                        $ary1[$k]['wallet_type'] = 6;
                    }
                }
                if(!empty($list2)){
                    foreach ($list2 as $k =>$v){
                        $ary2[$k]['event_type'] = $v['zodiac_name'];
                        $ary2[$k]['pay_type'] = 1;
                        $ary2[$k]['amount'] = $v['award'];
                        $ary2[$k]['created_at'] = $v['created_at'];
                        $ary2[$k]['wallet_type'] = 6;
                    }
                }
                $list = array_merge($ary2,$ary1) ? array_merge($ary2,$ary1) : [];
            }
            $ary = [];
            if(!empty($list)){
                foreach ($list as $k => $v){
                    $event = WB_UserWalletRecord::$event_type;
                    if(is_numeric($v['event_type'])){
                        $ary[$k]['event_type'] = $event[$v['event_type']];
                    }else{
                        $ary[$k]['event_type'] = $v['event_type'];
                    }
                    if($v['wallet_type'] == 1){
                        $ary[$k]['amount'] = $v['pay_type'] == 1 ? '+'.floor($v['amount']*10000)/10000 : '-'.floor($v['amount']*10000)/10000;
                    }else{
                        $ary[$k]['amount'] = $v['pay_type'] == 1 ? '+'.floor($v['amount']*100)/100 : '-'.floor($v['amount']*100)/100;
                    }
                    $ary[$k]['created_at'] = date("Y-m-d H:i:s",$v['created_at']);
                }
            }
            $res = [
                'status' => '0001',
                'message' => '获取成功',
                'data' => $ary,
                'scale' => $recharge_position   //比例
            ];
            return json_encode($res);
        }else{
            return json_encode(['status'=>'0002','message'=>'非法操作']);
        }

    }

    //积分充值(页面)
    public function actionOnlinerecharge(){
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        $req = Yii::$app->request;
        $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
        if($token == '') {
            $data['status'] = '0002';
            $data['message'] = Yii::t('app', '无效参数');
            echo json_encode($data);
            exit;
        }
        $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
        if(!$userdata) {
            $data['status'] = '0003';
            $data['message'] = Yii::t('app', '已登出');
            echo json_encode($data);
            exit;
        }

        if(Yii::$app->request->isPost){
            //获取后台充值比例
            $weixin_code = MTools::getYiiParams('weixin_code') ? MTools::getYiiParams('weixin_code') : '';  //微信客服二维码
            return json_encode(['status'=>'0001','message'=>'获取成功','data'=>$weixin_code]);

        }

    }

    //推广收益提现
    public function actionWithdrawdeposit(){
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        $req = Yii::$app->request;
        $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
        if($token == '') {
            $data['status'] = '0002';
            $data['message'] = Yii::t('app', '无效参数');
            echo json_encode($data);
            exit;
        }
        $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
        if(!$userdata) {
            $data['status'] = '0003';
            $data['message'] = Yii::t('app', '已登出');
            echo json_encode($data);
            exit;
        }

        if(Yii::$app->request->isPost){
            //获取后台提现限制
            $withdraw_deposit = MTools::getYiiParams('withdraw_deposit') ? MTools::getYiiParams('withdraw_deposit') : 0;
            //获取前端参数
            $withdraw_num = trim(HtmlPurifier::process(Yii::$app->request->post('withdraw_num','')));    //提取数量
            $jy_pwd = trim(HtmlPurifier::process(Yii::$app->request->post('jy_pwd','')));     //交易密码
            if(!$withdraw_num || !$jy_pwd){
                return json_encode(['status'=>'0002','message'=>'参数不能为空']);
            }
            //校验提取数量
            if(floor($withdraw_num * 100)/100 < 0 ){
                return json_encode(['status'=>'0002','message'=>'请输入有效的提取额度']);
            }
            if(floor($withdraw_num * 100)/100 > $userdata->wallet->care_wa ){
                return json_encode(['status'=>'0002','message'=>'提取数额已超过当前拥有的最大量']);
            }
            if($userdata->wallet->care_wa < $withdraw_deposit){
                return json_encode(['status'=>'0002','message'=>'推广收益必须达到'.$withdraw_deposit.'才能提取']);
            }
            //判断提取额度是否超出宠物最大价格
            $dragon_max = Zodiac::find()->select('hcg_max')->orderBy('hcg_max desc')->one();
            if($dragon_max->hcg_max < $withdraw_num){
                return json_encode(['status'=>'0002','message'=>'提取数量已超出宠物价格最大值']);
            }
            //校验交易密码
            if(!$userdata->validatePassword2($jy_pwd)){
                return json_encode(['status'=>'0002','message'=>'交易密码不正确']);
            }
            // 匹配合适的宠物
            $zodiac = Zodiac::find()->where('hcg_min <= :hcg_min',[':hcg_min'=>$withdraw_num])->orderBy('hcg_min desc')->one();
            if(!$zodiac){
                return json_encode(['status'=>'0002','message'=>'提取数量不在宠物价格范围']);
            }
            //判断用户有没有收款方式
            $userbank = UserBank::find()->where('userid = :userid and state = 1',[':userid'=>$userdata->id])->one();
            if(!$userbank && !$userdata->userprofile->alipay && !$userdata->userprofile->wechat){
                return json_encode(['status'=>'0002','message'=>'你还没有添加任何一种收款方式']);
            }
            $trans = Yii::$app->db->beginTransaction();
            try{
                // 加入宠物发行表中
                $zodiac_issue = new ZodiacIssue();
                $zodiac_issue->zodiac_id = $zodiac->id;
                $zodiac_issue->zodiac_name = $zodiac->name;
                $zodiac_issue->zodiac_grade_id = 0;
                $zodiac_issue->zodiac_grade_name = 0;
                $zodiac_issue->hcg = $withdraw_num;
                $zodiac_issue->cash = $zodiac->cash;
                $zodiac_issue->issel = 0;  //（0待匹配，1已卖出 2:成长中）
                $zodiac_issue->created_at = time();
                $zodiac_issue->updated_at = time();
                $zodiac_issue->belong_id = $userdata->id;
                //加入我的宠物表
                if($zodiac_issue->save()){
                    $myzodiac = new UserZodiac();
                    $myzodiac->userid = $userdata->id;
                    $myzodiac->username = $userdata->username;
                    $myzodiac->issue_id = $zodiac_issue->id;
                    $myzodiac->zodiac_id = $zodiac->id;
                    $myzodiac->zodiac_grade_id = 0;
                    $myzodiac->old_hcg = $withdraw_num;
                    $myzodiac->hcg = $withdraw_num;
                    $myzodiac->created_at = time();
                    $myzodiac->due = $zodiac->due;
                    $myzodiac->award = $zodiac->award;
                    $myzodiac->over_time = time();
                    $myzodiac->is_rack = 1;
                    $myzodiac->is_overtime = 1;
                    $myzodiac->updated_at = time();
                    $myzodiac->rise_num = $zodiac->due;
                    $myzodiac->source = 1;      // 0:抢购  1:推广收益提取/后台发布
                    $myzodiac->allow_rack = 0;
                    //宠物表宠物发行数量增加
                    $zodiac->issue_num += 1;
                    //扣除用户的推广收益
                    $userdata->wallet->care_wa -= $withdraw_num;
                    $note = '推广收益提取';
                    $record = UserWalletRecord::insertrecord($userdata->id,$withdraw_num,5,2,3,$userdata->wallet->care_wa,$note);
//                    MTools::AddRedis(1,$zodiac->id); //添加到redis
                    Yii::$app->redis->lpush('zodiac_issue:'.$zodiac->id,'1');
                    $redis_num = count(Yii::$app->redis->lrange("zodiac_issue:".$zodiac->id,0,-1));
                    file_put_contents('../runtime/logs/redis_log.txt', '时间：'.time().'，用户ID：'.$userdata->id.'，提现宠物'.$zodiac->id.'子成功，发行ID:'.$zodiac_issue->id.'num:'.$redis_num.PHP_EOL,FILE_APPEND);
                    if($myzodiac->save() && $userdata->wallet->save() && $record && $zodiac->save()){
                        $trans->commit();
                        $res = [
                            'status' => '0001',
                            'message' => '提取成功'
                        ];
                    }else{
                        $trans->rollBack();
                        $res = [
                            'status' => '0002',
                            'message' => '提取失败'
                        ];
                    }
                }else{
                    $trans->rollBack();
                    $res = [
                        'status' => '0002',
                        'message' => '提取失败'
                    ];
                }
                return json_encode($res);

            }catch (Exception $e){
                $trans->rollBack();
                throw $e;
            }



        }

    }

    // 安全中心
    public function actionSafecenter(){
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
        header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        $req = Yii::$app->request;
        $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
        if($token == '') {
            $data['status'] = '0002';
            $data['message'] = Yii::t('app', '无效参数');
            echo json_encode($data);
            exit;
        }
        $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
        if(!$userdata) {
            $data['status'] = '0003';
            $data['message'] = Yii::t('app', '已登出');
            echo json_encode($data);
            exit;
        }
        if(Yii::$app->request->post()){
            $res = [
                'status' => '0001',
                'message' => '获取成功',
                'data' => [
                    'phone' => $userdata->userprofile->phone,
                    'token' => $userdata->app_token
                ]
            ];
            return json_encode($res);
        }else{
            return json_encode(['status'=>'0002','message'=>'非法请求']);
        }


    }

  //抽奖
  public function actionLottery()
  {
    header("Access-Control-Allow-Origin:*");
    header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
    header('Access-Control-Allow-Headers:x-requested-with,Authorization,Content-Type');
    header('Access-Control-Allow-Headers: Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, API-TOKEN, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
    $req = Yii::$app->request;
    $token = Yii::$app->session['token'] ? Yii::$app->session['token'] : trim(HtmlPurifier::process($req->post('token') ? $req->post('token') : $req->get('token')));
    if ($token == '') {
      $this->retjson('0002', Yii::t('app', '无效参数'));
      exit;
    }
    $userdata = \common\models\User::find()->where('app_token=:app_token', [':app_token' => $token])->one();
    if (!$userdata) {
      $this->retjson('0003', Yii::t('app', '已登出'));
      exit;
    }
    $userid = $userdata['id'];
    if (Yii::$app->request->isPost) {
      $data['username'] = $userdata['username'];
      $data['content'] = $_POST['info'];
      $data['time'] = date('Y-m-d H:i:s', time());
      if ($userdata['lotterytimes'] == 0) {
        if ($userdata->wallet->hcg_wa < 10) {
          return json_encode(['status' => '0003', 'message' => '积分不足！']);
        }
        $hcg = $userdata->wallet->hcg_wa - 10;
        $query = UserWallet::find()->where("userid=:id", [":id" => $userid])->one();
        $query->hcg_wa = $hcg;
        $query->save();
      }
      $award = $req->post('id');
      if($award==2){
        $hcg = $userdata->wallet->hcg_wa + 10;
        $query = UserWallet::find()->where("userid=:id", [":id" => $userid])->one();
        $query->hcg_wa = $hcg;
        $query->save();
      }elseif($award==3){
        $hcg = $userdata->wallet->hcg_wa + 40;
        $query = UserWallet::find()->where("userid=:id", [":id" => $userid])->one();
        $query->hcg_wa = $hcg;
        $query->save();
      }elseif($award==5){
        $this->award($userid);
      }elseif($award==6){
        $hcg = $userdata->wallet->hcg_wa + 30;
        $query = UserWallet::find()->where("userid=:id", [":id" => $userid])->one();
        $query->hcg_wa = $hcg;
        $query->save();
      }elseif($award==7){
        $this->award($userid);
      }elseif($award==8){
        $hcg = $userdata->wallet->hcg_wa + 20;
        $query = UserWallet::find()->where("userid=:id", [":id" => $userid])->one();
        $query->hcg_wa = $hcg;
        $query->save();
      }
      Yii::$app->db->createCommand()->batchInsert(WB_Lottery::tableName(), ['username', 'content', 'time'], [
        [$data['username'], $data['content'], $data['time']],
      ])->execute();
      return json_encode(['status' => '0001', 'message' => '获取成功']);
    } else {
      return json_encode(['status' => '0002', 'message' => '参数错误']);
    }
  }

  public function award($userid){
    //获取要发行的宠物
    $zodiacid = 1;//宠物id
    $zodiac = Zodiac::findOne($zodiacid);
    $userdata = \common\models\User::findOne($userid);
    $trans = Yii::$app->db->beginTransaction();
    $num = 1;//宠物数量
    $hcg = 222;//宠物价格
    try {
      for ($i=1;$i<=$num;$i++){
        //批量插入发行表
        $zodiacissue = new ZodiacIssue();
        $zodiacissue->zodiac_id = $zodiacid;
        $zodiacissue->zodiac_name = $zodiac->name;
        $zodiacissue->hcg = $hcg;
        $zodiacissue->issel = 0;
        $zodiacissue->cash = $zodiac->cash;
        $zodiacissue->created_at = time();
        $zodiacissue->updated_at = time();
        $zodiacissue->belong_id = $userid;
        if(!$zodiacissue->save()){
          return ["errors" => $zodiacissue->errors, "model" => $zodiacissue];
        }
        //批量插入用户宠物表
        $zodiacUser = new UserZodiac();
        $zodiacUser->userid = $userid;
        $zodiacUser->username = $userdata->username;
        $zodiacUser->issue_id = $zodiacissue->id;
        $zodiacUser->zodiac_id = $zodiacid;
        $zodiacUser->old_hcg = $hcg;
        $zodiacUser->hcg = $hcg;
        $zodiacUser->created_at = time();
        $zodiacUser->over_time = time();
        $zodiacUser->updated_at = time();
        $zodiacUser->due = $zodiac->due;
        $zodiacUser->award = $zodiac->award;
        $zodiacUser->is_rack= 1;
        $zodiacUser->is_overtime= 1;
        $zodiacUser->rise_num= $zodiac->due;
        $zodiacUser->source = 1;      // 0:抢购  1:推广收益提取/后台发布
        $zodiacUser->allow_rack = 0;
        //宠物列表发行数增加
        $zodiac->issue_num += 1;
        $zodiac->save();
        // 用户推广收益减少
        $userdata->wallet->care_wa -= $hcg;
        $note = '后台发布宠物,扣除推广收益';
        UserWalletRecord::insertrecord($userid,$hcg,11,2,3,$userdata->wallet->care_wa,$note);
        if(!$zodiacUser->save() || !$userdata->wallet->save()){
          return ["errors" => $zodiacissue->errors, "model" => $zodiacissue];
        }
      }
      $ac_log = \common\models\Actionlog::setLog('发行宠物：'.$zodiac->name.'数量：'.$num.'归属用户ID：'.$userid);
      if($ac_log){
        MTools::AddRedis($num,$zodiacid); //添加到redis
        $redis_num = count(Yii::$app->redis->lrange("zodiac_issue:".$zodiacid,0,-1));
        file_put_contents('../runtime/logs/redis_log.txt', '时间：'.time().'，后台发行宠物'.$zodiacid.'子'.$num.'个成功'.'num:'.'归属用户ID：'.$userid.$redis_num.PHP_EOL,FILE_APPEND);
        $trans->commit();
        return true;
      }
    } catch (Exception $ex) {
      $trans->rollBack();
      throw new \yii\web\NotFoundHttpException($ex);
    }
  }



}
