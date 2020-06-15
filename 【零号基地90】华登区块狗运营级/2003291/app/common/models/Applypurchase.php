<?php

namespace common\models;

use Yii;
use yii\helpers\HtmlPurifier;

/**
 * This is the model class for table "me_applypurchase".
 *
 * @property string $id
 * @property integer $userid
 * @property string $username
 * @property string $wallet_token
 * @property string $number
 * @property string $totalamount
 * @property string $miner_fee
 * @property string $miner_rate
 * @property string $coin_price
 * @property string $coin_type
 * @property string $add_label
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $branch_id
 */
class Applypurchase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_applypurchase';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'number', 'totalamount', 'miner_fee', 'miner_rate', 'coin_price'], 'number'],
            [['status', 'created_at', 'updated_at','branch_id'], 'integer'],
            [['username', 'wallet_token', 'coin_type','add_label'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'userid'        => '用户id',
            'username'      => '用户名',
            'wallet_token'  => '钱包地址',
            'add_label'     => '地址标签',
            'number'        => '申购数量',
            'totalamount'   => '总支出(LKC)',
            'miner_fee'     => '手续费',
            'miner_rate'    => '手续费率',
            'coin_price'    => '数字货币价格',
            'coin_type'     => '数字货币类型',
            'status'        => '订单状态',
            'created_at'    => '创建时间',
            'updated_at'    => '更新时间',
            'branch_id'     => '分公司id',
        ];
    }

    public static $status_cn = [0 => '申购中', 1 => '申购已完成', 2 => '申购未成功'];

    public static $status_en = [0 => 'Applying', 1 => 'Finished', 2 => 'unsuccess'];

    // 创建申购订单
    public static function createOrder($userid, $username, $wallet_token, $number, $totalamount, $miner_fee, $miner_rate, $coin_price, $coin_type, $status,$add_label,$branch) {
        $ap = new Applypurchase();
        $ap->userid         = $userid;              // 用户id
        $ap->username       = $username;            // 用户名
        $ap->wallet_token   = $wallet_token;        // 钱包地址
        $ap->number         = $number;              // 申购数量
        $ap->totalamount    = $totalamount;         // 总支出(LKC)
        $ap->miner_fee      = $miner_fee;           // 手续费(矿工费)
        $ap->miner_rate     = $miner_rate;          // 手续费率(矿工费率)
        $ap->coin_price     = $coin_price;          // 数字货币价格
        $ap->coin_type      = $coin_type;           // 数字货币类型
        $ap->status         = $status;              // 订单状态, 1: 申购成功, 2: 申购失败
        $ap->add_label      = $add_label;           // 地址标签
        $ap->created_at     = time();               // 创建时间
        $ap->updated_at     = time();               // 更新时间
        $ap->branch_id      = $branch;              // 分区id

        return $ap->save();
    }

    // 后台申购订单列表
    public static function getList() {
        $query          = Applypurchase::find();
        $begin_at       = Yii::$app->request->get("begin_at");
        $end_at         = Yii::$app->request->get("end_at");
        $search         = Yii::$app->request->get("search");            // 用户ID 或 用户名
        $searchorderid  = Yii::$app->request->get('searchorderid');     // 申购订单号
        $status         = Yii::$app->request->get("status");            // 订单状态

        if($searchorderid) {    // 根据订单号搜索订单信息
            $query->andFilterWhere(["=", "id", $searchorderid]);
        }

        if ($begin_at) {    // 根据订单创建时间搜索订单信息
            $query->andFilterWhere([">=", "created_at", strtotime($begin_at)]);
        }
        if ($end_at) {      // 根据订单创建时间搜索订单信息
            $query->andFilterWhere(["<=", "created_at", strtotime($end_at)]);
        }
        if ($search) {      // 根据用户id或用户名搜索订单信息
            $query->andFilterWhere(["like", "userid", $search]);
            $query->orFilterWhere(["like", "username", $search]);
        }
        if(Yii::$app->user->identity->branch_id != 0){
            if(Yii::$app->user->identity->branch_id == '1863'){
                $query->andFilterWhere(["in", "branch_id", ['1863', '1872', '1875', '1889']]);
            }else{
                $query->andFilterWhere(["=","branch_id",Yii::$app->user->identity->branch_id]);
            }
        }

        if ($status != '') {
            $query->andFilterWhere(["=", "status", $status]);
        }

//        $sort = Yii::$app->request->get("sort");
//        $order = Yii::$app->request->get("order");
//        $query->orderBy($sort . " " . $order);
        $query->orderBy("created_at desc");
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        // var_dump($res);die;
        return ["total" => $totalCount, "data" => $res];
    }

    // 获取我的申购订单列表
    public static function getMyapplylistload($userid, $status) {
        $query = Applypurchase::find()->where('userid=:userid && status=:status', [':userid' => $userid, ':status' => $status]);

        $sort   = isset($_GET['sort']) ? $_GET['sort'] : 'created_at';
        $order  = isset($_GET['order']) ? $_GET['order'] : 'desc';
        $query->orderBy($sort . " " . $order);
//        $res = $query->createCommand()->getRawSql();

        $sort = Yii::$app->request->post("sort", 'created_at');
        $order = Yii::$app->request->post("order",'desc');
        $query->orderBy($sort . " " . $order);

        $pagesize = 6;
        $offset = (Yii::$app->request->post("page")-1)*$pagesize;
        $limit = Yii::$app->request->post("limit", $pagesize);
        $res = $query->offset($offset)->limit($limit)->asArray()->all();

        // 获得当前用户选择的语言
//        $key = $userid."language";
//        $lang = Yii::$app->cache->get($key);
        $lang = isset(Yii::$app->session['language']) ? Yii::$app->session['language'] : 'en_US';
        for($i = 0;$i < count($res);$i++){
            if($lang == 'en_US') {
                $res[$i]['status'] = Applypurchase::$status_en[$res[$i]['status']];
            } else {
                $res[$i]['status'] = Applypurchase::$status_cn[$res[$i]['status']];
            }

            unset($res[$i]['wallet_token']);
            unset($res[$i]['totalamount']);
            unset($res[$i]['miner_fee']);
            unset($res[$i]['miner_rate']);
            unset($res[$i]['coin_price']);
            unset($res[$i]['updated_at']);

            $res[$i]['number'] = str_replace(',', '', Yii::$app->formatter->asDecimal($res[$i]['number'], 4));

//            $res[$i]['totalamount'] = str_replace(',', '', Yii::$app->formatter->asDecimal($res[$i]['totalamount'], 4));

            $res[$i]['created_at'] = Yii::$app->formatter->asDatetime($res[$i]["created_at"]);
//            $res[$i]['updated_at'] = Yii::$app->formatter->asDatetime($res[$i]["updated_at"]);
        }
        return $res;
    }

    // 获取单条申购记录 -> AJAX
    public static function singleapply($userid, $id) {
        $res = Applypurchase::find()->where('userid=:userid AND id=:id', [':userid' => $userid, ':id' => $id])->asArray()->one();

        // 获得当前用户选择的语言
//        $key = $userid."language";
//        $lang = Yii::$app->cache->get($key);
        $lang = isset(Yii::$app->session['language']) ? Yii::$app->session['language'] : 'en_US';

        if($lang == 'en_US') {
            $res['status'] = Applypurchase::$status_en[$res['status']];
        } else {
            $res['status'] = Applypurchase::$status_cn[$res['status']];
        }

        $res['miner_rate'] = $res['miner_rate'] . '%';

        $res['number'] = str_replace(',', '', Yii::$app->formatter->asDecimal($res['number'], 2));

        $res['totalamount'] = str_replace(',', '', Yii::$app->formatter->asDecimal($res['totalamount'], 2));

        $res['created_at'] = Yii::$app->formatter->asDatetime($res["created_at"]);

        return $res;
    }
}
