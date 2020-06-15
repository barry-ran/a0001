<?php

namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * @author  shuang
 * @date    2016-10-11 15:38:29
 * @version V1.0
 * @desc    
 */
class TaskparamsForm extends Model {

    //宠物九子=>strat
    public $webimagepath;           // 前台图片地址
    public $adminimagepath;         // 后台图片地址
    public $frontendimagepath;      // 前端域名地址
    public $tradeswitch;            // 交易中心开关
    public $applytradeswitch;       // 预约开关
    public $autotradeswitch;        // 交易中心自动匹配开关
    public $turnout_hcg_min;        // 积分最小转出数量
    public $turnout_hcg_max;        // 积分最大转出数量
    public $serverqq;               // 客服qq号
    public $weixin;                 // 客服微信号
    public $recharge_position;      // 积分充值比例(1积分等于?元)
    public $recharge_number_min;    // 积分充值最低数量
    public $recharge_number_max;    // 积分充值最大数量
    public $qq_code;                // qq二维码
    public $weixin_code;            // 微信二维码
    public $withdraw_deposit;       // 提现限制
    public $buyertradeovertime;     // 买家交易超时时间
    public $sellertradeovertime;    // 卖家交易超时时间
    public $buyeruntradelimit;      // 买家超过X次交易未付款封号
    public $activeperson;           // 激活会员积分拥有数限制

    //十二宠物=>end



    public $buyertradeaward;        // 买家交易完结获得永久区奖励
    public $sellertradeaward;       // 卖家交易完结获得永久区奖励
    public $priceincrement;         // 价格增量
    public $sellnumlimit;           // 卖出最低数量
    public $userstar;               // 用户每笔交易信用度增加值
    public $substar;                // 收付款超时扣除的信用值

    public $dayreleaseper;          // 每日签到释放比例
    public $buytocashper;           // 对冲报单对冲账号获得卢宝比例
    public $buytohcgper;            // 对冲报单对冲账号获得卢呗比例
    public $turncashawardper;       // 对冲报单返回自己账户的卢呗比例
    public $cashtohcg;              // 卢宝与卢呗比例 1卢宝 = ？ 卢呗
    public $tbthawper;              // 定存LKC每日释放比例
    public $buycarelimit;           // 用户每期限购LKC数量
    public $givehcg;                // 注册赠送bba
    public $min_care;               // LKC 最低转出/卖出
    public $transfer_fee;           // LKC转让手续费
    public $available;              // 可用LKC每日释放比例
    public $terrace_fee;            // LKC交易卖家手续费
    public $exchange_welfare;       // V4特殊福利 额外释放卢呗（卢宝兑换卢呗）
    public $circulation_welfare;    // V4特殊福利 额外释放卢呗（流通）
    public $miner_rate;             // 申购手续费率（矿工费）
    public $superprofit;            // 超级节点分润
    public $idrandmax;              // 会员id随机增长最大值
    public $superprofit2;           // 超级节点分润2，余下5%
    public $temrecommendgive;           // 直推临时会员奖励
    public $formalrecommendgive;           // 直推正式会员奖励
    public $permanent_scale;           // 永久区释放比例
    public $sign_give_coin;           // 签到赠送金币
    public $system_email;           // 联系客服
    public $temrecommendnum;           // 推荐临时会员奖励人数限制
    public $formalrecommendgivenum;           // 正式推正式超过推荐人数获取的奖励
    public $formalrecommendgivelimit;           // 正式推正式人数限制
    public $provisional;           // 正式推临时奖励
    public $provisionallimit;           // 正式推临时人数限制
    public $sign_give_day;           // 签到赠送奖励天数
    public $formally_sign_give;           // 正式会员签到赠送币
    public $formally_sign_day;           // 正式会员签到赠送奖励天数
    public $release;                    // 测试用户（领取挖矿收益）

    /**
     * @inheritdoc
     */

    public function rules() {
        return [
            [['idrandmax'], 'integer'],
            [
                [
                //十二宠物=>start
                    "tradeswitch","applytradeswitch", "autotradeswitch","turnout_hcg_min","serverqq","recharge_position","recharge_number_min","withdraw_deposit","recharge_number_max",'turnout_hcg_max',
                //十二宠物=>end
                    "turncashawardper","activeperson",
                    "cashtohcg","dayreleaseper","buytocashper",
                    "buytohcgper","tbthawper","userstar","substar","buycarelimit","givehcg","min_care","transfer_fee","available", "terrace_fee","exchange_welfare","circulation_welfare","miner_rate", "superprofit","buyertradeovertime", "sellertradeovertime","superprofit2", "buyertradeaward", "sellertradeaward", "priceincrement", "buyeruntradelimit", "sellnumlimit",
                        "temrecommendgive","formalrecommendgive","permanent_scale","sign_give_coin","temrecommendnum","formalrecommendgivenum","formalrecommendgivelimit","provisional","provisionallimit","sign_give_day","formally_sign_give","formally_sign_day",
                ], 'number'
            ],
            [
                [
            //十二宠物=>start
                'webimagepath','adminimagepath',"frontendimagepath","qq_code","weixin_code","weixin",
            //十二宠物=>end
                "system_email",'release'
                ], 'string'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            //十二宠物=>start
            "webimagepath"          => "前台地址",
            "adminimagepath"        => "后台地址",
            "frontendimagepath"     => "前端地址",
            "tradeswitch"           => "交易系统",
            "applytradeswitch"      => "预约开关",
            "autotradeswitch"       => "自动撮合",
            "turnout_hcg_min"       => "积分最小转出数量",
            "turnout_hcg_max"       => "积分最大转出数量",
            "serverqq"              => "客服qq号",
            "weixin"                => "客服微信号",
            "recharge_position"     => "积分充值比例",
            "recharge_number_min"   => "积分充值最低数量",
            "recharge_number_max"   => "积分充值最大数量",
            "weixin_code"           => "微信二维码",
            "qq_code"               => "qq二维码",
            "withdraw_deposit"      => "推广收益提现限制",
            "activeperson"          => "激活会员积分拥有数限制",
            //交易相关
            "buyertradeovertime"    => "买家超时时间",
            "sellertradeovertime"   => "卖家超时时间",
            "buyeruntradelimit"     => "交易买家未付款次数",
            //十二宠物=>end


            "buytocashper"          => "对冲报单时对冲账号获得卢宝比例",
            "buytohcgper"           => "对冲报单时对冲账号获得卢呗比例",
            "turncashawardper"      => "对冲报单返回自己账户的卢呗比例",
            "dayreleaseper"         => "每日签到释放比例",
            "buycarelimit"          => "用户每期限购LKC数量",
            "tbthawper"             => "定存LKC每日释放比例",
            "cashtohcg"             => "兑换卢呗[复投]（1卢宝等于）",
            "givehcg"               => "成为正式会员获取的平台赠送的奖励",
            "min_care"              => "LKC最低转出/卖出数量",
            "transfer_fee"          => "LKC转让手续费",
            "available"             => "可用LKC每日增加比例",
            "terrace_fee"           => "LKC交易手续费",
            "exchange_welfare"      => "LV3特殊福利（兑换卢呗）",
            "circulation_welfare"   => "LV3特殊福利（流通）",
            "miner_rate"            => "申购矿工费率",
            "superprofit"           => "首个超级节点分润",
            "superprofit2"          => "其余超级节点分润",
            "idrandmax"             => "会员id随机增长最大值",
            //小余2019-03-25-start
            "temrecommendgive"             => "临时推临时奖励",
            "formalrecommendgive"             => "正式推正式奖励",
            "permanent_scale"             => "永久区静态释放比例",
            "sign_give_coin"             => "临时会员签到赠送币",
            "sign_give_day"             => "临时会员签到赠送奖励天数",
            "system_email"             => "联系客服",
            "temrecommendnum"             => "临时推荐临时会员奖励人数限制",
            "formalrecommendgivenum"             => "正式推正式超过推荐人数获取的奖励",
            "formalrecommendgivelimit"             => "正式推正式人数限制",
            "provisional"             => "正式推临时奖励",
            "provisionallimit"             => "正式推临时人数限制",
            "formally_sign_give"             => "正式会员签到每天赠送币",
            "formally_sign_day"             => "正式会员签到赠送奖励天数",
            //小余2019-03-25-end
            "release"             => "测试用户（领取挖矿收益）",
        ];
    }

    public function updateParams() {
        if ($this->validate()) {
            $string = "<?php\n return \n [";
            foreach ($this->attributes as $attributes => $value) {
                $string .="'$attributes'=>'$value',";

            }
            $string .= "];";
            return file_put_contents(Yii::getAlias('@common/config/params-local.php'), $string);
        } else {
            return ["errors" => $this->getErrors(), "model" => $this];
        }
    }

    public static $onOroff = [
        ["id" => 0, "name" => "关闭"],
        ["id" => 1, "name" => "开启"]
    ];
    
    public static $login = [
        ["id" => 0, "name" => "关闭"],
        ["id" => 1, "name" => "维护"],
        ["id" => 2, "name" => "封盘"],
    ];

    public static $view = [
        ["id" => 0, "name" => "屏蔽"],
        ["id" => 1, "name" => "显示"],
    ];
}
