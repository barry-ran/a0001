<?php

namespace common\components;

/**
 * @author  shuang
 * @date    2016-12-14 14:17:23
 * @version V1.0
 * @desc    
 */
use yii\base\Event;
use Yii;
use frontend\models\WB_User;
use common\components\MTools;
use yii\helpers\ArrayHelper;
use frontend\models\WB_UserWalletRecord;
use frontend\models\WB_UserProfile;
use frontend\models\WB_UserStockTrade;
use frontend\models\WB_SysWalletRecord;
use frontend\models\WB_SysWallet;
use frontend\models\WB_StockIssueRecord;
use frontend\models\WB_UserWallet;


class TradeEvent extends Event {

    private $_tuser;
    protected $_fuser;
    protected $fuser_wa;
    protected $tuser_wa;
    protected $buser;
    public $trademodel;
    protected $stockprice;
    protected $nodeid;
    protected $nodeidArr;
    protected $baseidArr;
    public $tcash_wa;
    public $commit = true;
    /*
     * 获取用户基本信息
     * @params $userid
     */

    protected function getUser($id = null) {
        $userid = $id ? $id : Yii::$app->user->id;
        $result = WB_User::find()->where("id=:userid", [":userid" => $userid])->with(["userprofile", "wallet"])->one();
        //$result = WB_User::find()->where("id=:userid", [":userid" => $userid])->one();
        if (!$result instanceof WB_User) {
            throw new \yii\web\NotFoundHttpException;
        }
        //$this->fuser_wa = WB_UserWallet::find()->where("userid = :userid",[":userid"=>$userid])->one();
        $this->_fuser = $result;
        return $result;
    }
    protected function getBuser($id = null) {
        $userid = $id ? $id : Yii::$app->user->id;
        $result = WB_User::find()->where("id=:userid", [":userid" => $userid])->with(["userprofile", "wallet"])->one();
        //$result = WB_User::find()->where("id=:userid", [":userid" => $userid])->one();
        if (!$result instanceof WB_User) {
            throw new \yii\web\NotFoundHttpException;
        }
        //$this->tuser_wa = WB_UserWallet::find()->where("userid = :userid",[":userid"=>$userid])->one();
        $this->buser = $result;
        return $this->buser;
    }
    protected function getSuser($id = null) {
        $userid = $id ? $id : Yii::$app->user->id;
        $result = WB_User::find()->where("id=:userid", [":userid" => $userid])->with(["userprofile", "wallet"])->one();
        if (!$result instanceof WB_User) {
            throw new \yii\web\NotFoundHttpException;
        }
        $this->suser = $result;
        return $this->suser;
    }

    /*
     * 数据模型错误提示
     * @params $array ["errors"=>[]]
     */

    private function errorMessage($errors) {
        foreach ($errors as $item) {
            $this->sender->message = $item[0];
            break;
        }
    }

    /*
     * 当前股票价格
     */

    protected function getStockPrice() {
        if (!$this->stockprice) {
            $this->stockprice = \backend\models\MY_StockPriceRecord::searchStockCurrentPrice();
        }
        return $this->stockprice;
    }

    /*
     * 是否开启币种转让/交换功能
     */

    private function currencyTransOff() {
        if (MTools::getYiiParams("currencyTransOff") == 1) {
            return true;
        }else{
            $this->sender->message = "系统已经关闭了币种转让/交换功能，请耐心等待......";
            return false;
        }
    }
    /*
     * 是否开启币现金币交易功能
     */

    private function cashtradeOff() {
        if (MTools::getYiiParams("cashtradeOff") == 1) {
            return true;
        }else{
            $this->sender->message = "系统已经关闭了注册金交易功能，请耐心等待......";
            return false;
        }
    }

    /*
     * 是否开启股票交易，交易时间是否正常
     */

    private function stockOff() {
        if (!MTools::getYiiParams("stockOff") > 0) {
            $this->sender->message = "SDK交易时间已过，请在下一交易时间进行交易！";
            return false;
        }
        $now = time();
        $date = date("Y-m-d", $now);
        $begin = strtotime($date . " " . MTools::getYiiParams("stockTradeBegin"));
        $end = strtotime($date . " " . MTools::getYiiParams("stockTradeEnd"));
        if ($begin > $now || $end < $now) {
            $this->sender->message = "SDK交易时间已过，请在下一交易时间进行交易！";
            return false;
        }
        if ($begin > $now || $end < $now) {
            $this->sender->message = "SDK交易时间已过，请在下一交易时间进行交易！";
            return false;
        }
        return true;
    }
    
    /*
     * 出售股票判断价格
     */
    private function checkTradePrice(){
        $curprice = $this->getStockPrice(); 
        $issue_time = \common\models\StockIssueRecord::find()->count();
        //当前价位只能出售一次
        $stocktrademodel = WB_UserStockTrade::find()->where("suserid = :userid and issue_time = :issue_time and selltype = 0", [":userid"=> Yii::$app->user->identity->id,":issue_time"=>$issue_time])->orderBy("created_at desc")->one();
        
        if($stocktrademodel instanceof WB_UserStockTrade && $curprice == $stocktrademodel->price){
            $this->sender->message = "当前价位已出售过DFC，不可再次出售！";
            return false;
        }
        
        return true;
    }
    /*
     * 根据用户名查找用户
     */

    protected function getUserForname() {
        $tusermodel = WB_User::find()->where("username=:username && iseal=0", [":username" => $this->trademodel->tusername])->with(["wallet","userprofile"])->one();
        if (!$tusermodel instanceof WB_User) {
            $this->sender->message = "您填写的账号不存在或者已被冻结";
            return false;
        }
//        if ($this->_fuser->wallet->regist_wa < $this->trademodel->amount) {
//            $this->sender->message = "您的账号卢宝不足";
//            return false;
//        }
        $this->_tuser = $tusermodel;
        return true;
    }

    /*
     * 根据用户ID查找用户
     */

    protected function getUserForid() {
        $tusermodel = WB_User::find()->where("id=:userid && iseal=0", [":userid" => $this->trademodel->tuserid])->with(["wallet","userprofile"])->one();
        if (!$tusermodel instanceof WB_User) {
            $this->sender->message = "用户不存在或者已被冻结";
            return false;
        }
        $this->_tuser = $tusermodel;
        return true;
    }

    
    /*
     * 监测交易密码是否正确
     */

    protected function validPass() {
        $user = \common\models\User::findOne($this->_fuser->id);
        if (!$user->validatePassword2(ArrayHelper::getValue($this->data, "traspass"))) {
            $this->sender->message = "您填写的交易密码不正确";
            return false;
        }
        return true;
    }
    
    protected function validPass2($userid) {
        $user = \common\models\User::findOne($userid);
        if (!$user->validatePassword2(ArrayHelper::getValue($this->data, "traspass"))) {
            $this->sender->message = "您填写的交易密码不正确";
            return false;
        }
        return true;
    }
    
    protected function validPassBuystock() {
        $user = \common\models\User::findOne($this->buser->id);
        if (!$user->validatePassword2(ArrayHelper::getValue($this->data, "traspass"))) {
            $this->sender->message = "您填写的交易密码不正确";
            return false;
        }
        return true;
    }

    /*
     * 判断交易双方是否在统一平台分支
     */

    protected function checkSamebranch() {
        if ($this->_fuser->syscode !== $this->_tuser->syscode) {
//            $this->sender->message = "交易双方不在同一个平台分支下，无法进行交易";
//            return false;
        }
        return true;
    }
    
    /*
     * 检测接受方的报单中心是否为转让方
     */
    protected function checkCenterforTuser(){
        $resArray = \frontend\models\WB_UserProfile::find()->select('userid')->where("center_serial= :center_serial",[":center_serial"=> Yii::$app->user->identity->id])->asArray()->all();
        $tuserArray=[];
        foreach ($resArray as $item){
            foreach ($item as $id){
                $tuserArray[] = $id;
            }
        }
        if(!in_array($this->_tuser->id, $tuserArray)){
            $this->sender->message = "转入会员不是当前报单中心下面的会员";
            return false;
        }
        return true;
    }
    
    /*
     * 检测接受方是否为转让方的下线
     */
    protected function checkOffLineforTuser(){
        //获取当前的用户节点
        $usermodel = \frontend\models\WB_UserProfile::find()->where("userid = :userid",[":userid"=>Yii::$app->user->id])->one();
        $userreside = $usermodel->reside;
        $resArray = \frontend\models\WB_UserProfile::find()->where(["like","reside",$userreside])->asArray()->all();
        //该用户下面所有的会员ID
        $tuserArray=[];
        foreach ($resArray as $items){
                $tuserArray[] = $items['userid'];
        }
        if(!in_array($this->_tuser->id, $tuserArray)){
            $this->sender->message = "转入会员不是当前用户的下级会员";
            return false;
        }
        return true;
    }
    /*
     * 检测转让方是否为保单中心
     */
    protected function checkCenter(){
        $this->getUser();
        if($this->_fuser->userprofile->is_center){
            
            return true;
        }else{
            $this->sender->message = "交易方必须为报单中心，才能转给下面会员";
        }
        return true;
    }    
    
    /*
     * @params $userid  会员ID
     * @params $amount 总量
     * @params $eventnote 事件描述
     */
    public function makeWalletRecord($userid, $amount, $event, $pay_type,$wallet_amount, $eventnote) {  
            //$count = Yii::$app->formatter->asDecimal($amount, $dobule);
            //记录产生的奖项，及奖项数量
            $model = new WB_UserWalletRecord();
            $model->userid = $userid;
            $model->amount = $amount;
            $model->event_type = $event;
            $model->pay_type = $pay_type;
            $model->wallet_amount = $wallet_amount;
            $model->note = $eventnote;
            $model->ip = Yii::$app->api->realIp();
            $model->created_at = time();
            return $model->save();
    }
    
    /*
     * 检测vm数量
     */
    protected function checkVmAmount() {
        if ($this->_fuser->wallet->vm_wa < $this->trademodel->amount) {
            $this->sender->message = "您的vm卢宝不足,转账失败";
            return false;
        } else {
            $this->_fuser->wallet->vm_wa -= $this->trademodel->amount;
        }
        return true;
    }
    
    /*
     * 检测转入用户
     */
    protected function checkTransInUser() {
        $user = WB_UserProfile::find()->where("wallet_token = :token",[":token"=> $this->trademodel->wallet_token])->one();
        if (! $user instanceof WB_UserProfile) {
            $this->sender->message = "钱包地址有误，请重输";
            return false;
        }
        $this->getBuser($user->userid);//$this->buser
        return true;
    }
    
    /*
     * 提交转账
     */
    public function walletTransfer() {
        $this->getUser(); // _fuser
        if ($this->validPass() && $this->checkVmAmount() && $this->checkTransInUser()) {
            $trans = Yii::$app->db->beginTransaction();
            try {
                $per = MTools::getYiiParams("transferper");
                $amount = Yii::$app->formatter->asDecimal($this->trademodel->amount , 6);//实际交易数量
                $samount = Yii::$app->formatter->asDecimal($this->trademodel->amount * (1-$per), 6);//实际交易数量
                $this->trademodel->samount = $samount;
                $this->trademodel->userid = $this->buser->id;
                $this->trademodel->username = $this->buser->username;
                $this->buser->wallet->hcg_wa += $amount;
                if ($this->trademodel->save()) {
                    if($this->buser->wallet->save() && $this->_fuser->wallet->save()){
                        //钱包记录 流水
                        $frecord = $this->makeWalletRecord($this->_fuser->id, $amount, 1, 2, $this->_fuser->wallet->vm_wa, "转入钱包地址".$this->trademodel->wallet_token.",转入数量".$samount);
                        $brecord = $this->makeWalletRecord($this->buser->id, $samount, 1, 1, $this->buser->wallet->vm_wa, "钱包地址".$this->_fuser->userprofile->wallet_token."转入,数量".$samount);
                        if($frecord & $brecord){
                            $this->sender->flag = true;
                            $trans->commit();
                        }else{
                            $this->sender->message = "系统错误，转账失败";
                        }
                    }else{
                        $this->errorMessage($this->fuser_wa->errors);
                    }
                } else {
                    $this->errorMessage($this->trademodel->errors);
                }
            } catch (Exception $ex) {
                $trans->rollBack();
                throw new \yii\web\NotFoundHttpException;
            }
        }
    }
    
    
    
    
    
    
    
    /*
     * 币种转让  现金币转账
     */

    public function walletTransfercash() {
        $this->getUser(); //_fuser
        //if ($this->currencyTransOff() && $this->validPass() && $this->getUserForname() && $this->checkSameCenter() && $this->checkSamebranch()) {
        if ($this->currencyTransOff() && $this->validPass() && $this->getUserForid() && $this->checkCurrencyAmount()) {
            $trans = Yii::$app->db->beginTransaction();
            try {
                $this->trademodel->tuserid = $this->_tuser->id;
                $this->trademodel->tusername = $this->_tuser->username;
                $this->trademodel->samount = $this->trademodel->amount - $this->trademodel->amount * $this->trademodel->pound_per;
                if($this->trademodel->save()){
                    //现金卢呗减少入库
//                    $downawardrecord=new \frontend\models\WB_UserAwardRecord();
//                    $downawardrecord->userid = $this->trademodel->fuserid;
//                    $downawardrecord->amount = $this->trademodel->amount;
//                    $downawardrecord->award_type = 9;
//                    $downawardrecord->pay_type = 2;
//                    $downawardrecord->cash_amount = $this->trademodel->amount;
//                    $downawardrecord->cash_wa = $cash_wa;
//                    $downawardrecord->event_type = 4;
//                    //$tuserid = $this->trademodel->tuserid;
//                    $tusername = $this->getUserName($this->trademodel->tuserid);
//                    $downawardrecord->note="与会员{$tusername}的现金卢呗交易";
//                    $downawardrecord->created_at = time();
//                    $downawardrecord->updated_at = time();
                    if($this->_fuser->wallet->save()){
                        $this->sender->flag = true;
                        $this->sender->message = "请点击确认或者取消转账";
                        $trans->commit();
                    }
                }else{
                    $this->errorMessage($this->trademodel->errors);
                }
            } catch (Exception $ex) {
                $trans->rollBack();
                throw new \yii\web\NotFoundHttpException;
            }
        }
    }

    
    /*
     * 币种交换
     */

    public function walletConvert() {
        $this->getUser();//_fuser
        if ($this->currencyTransOff() && $this->checkCurrencyAmount()) {
            $trans = Yii::$app->db->beginTransaction();
            try {
                $this->trademodel->samount = $this->trademodel->amount - $this->trademodel->amount * $this->trademodel->pound_per;
                $this->trademodel->created_at = time();
            //    $this->_fuser->wallet->cash_wa = $this->_fuser->wallet->cash_wa - $this->trademodel->amount;
                if ($this->trademodel->save() && $this->_fuser->wallet->save()) {
                    $this->sender->flag = true;
                    $this->sender->message = "提交成功";
                    $trans->commit();
                } else {
                    $this->errorMessage($this->trademodel->errors);
                }
            } catch (Exception $ex) {
                $trans->rollBack();
                throw new \yii\web\NotFoundHttpException;
            }
        }
    }

    /*
     * 判断购买股票账号
     */

    protected function checkStockBuyAmount() {
        if (!$this->getStockPrice()) {
            $this->sender->message = "系统暂时无法进行SDK交易，请您联系系统管理员";
            return false;
        }
//        if ($this->_fuser->wallet->hcg_wa < $this->trademodel->number * $this->getStockPrice()) {
//            $this->sender->message = "您的账号卢宝不足";
//            return false;
//        }
        return true;
    }

    /*
     * 判断可卖出股票 && 购买队列中的股票总量
     */
    protected function checkStockSellAmount() {
        $userstock = \backend\models\MY_UserStock::find()->where("userid=:userid", [":userid" => $this->_fuser->id])->one();
        $stocknumcount = \frontend\models\WB_UserStockTrade::getStockTradeListStockCount();
        if (!$userstock instanceof \backend\models\MY_UserStock) {
            $this->sender->message = "您没有可交易的DFC";
            return false;
        }
//        if ($userstock->sell_stock < $this->trademodel->number) {
//        //if ($userstock->sell_stock < $this->trademodel->number * $this->getStockPrice()) {
//            $this->sender->message = "您的DFC数量不足";
//            return false;
//        }
//        $userstock->sell_stock = $userstock->sell_stock - $this->trademodel->number;
//        if (!$userstock->save()) {
//            $this->errorMessage($userstock->errors);
//            return false;
//        }
        if(!$stocknumcount > 0 ){
            $this->sender->message = "队列的DFC卢呗不足购买一个DFC，不可出售DFC！";
            return false;
        }
        if($stocknumcount < $this->trademodel->number){
            $this->sender->message = "出售的DFC不能大于队列中可购买DFC的总量";
            return false;
        }
        return true;
    }
    
    /*
     * 购买股票 
     */
    public function stockTradeBuy() {
        $this->getBuser();//$this->buser
        $this->getStockPrice();
        if ($this->validPassBuystock() && $this->checkStockBuyAmount() && $this->stockOff()) {
            $trans = Yii::$app->db->beginTransaction();
            try {
                //直接保存成为购买队列
                $this->buser->wallet->hcg_wa -= $this->trademodel->transprice;
                if(!$this->buser->wallet->save()){
                    $this->errorMessage($this->buser->walle->errors);   
                }
                //出售队列
                $selllist = WB_UserStockTrade::getselllist($this->trademodel->price);//$this->buser->id
                if($selllist){
                    $re_num = $this->trademodel->re_num;//购买余量
                //    $value = 0;//用户统计购买总金额
                    foreach ($selllist as $sellmodel){
                        //卖方钱包模型
                        $sellwallet = WB_UserWallet::find()->where("userid =:userid",[":userid"=>$this->trademodel->suserid])->one();
                        if($re_num == 0){
                            //购买余量等于0，则保存购买
                            $this->trademodel->status = 1;
                            $this->trademodel->save();
                            $this->re_transprice = 11111;
                            $this->sender->message="购买成功！";
                            $this->sender->flag=true;
                            break;
                        }
                        if($re_num >= $sellmodel->re_num){
                            //购买余量大于模型余量，则全部成交
                            $re_num = $re_num - $sellmodel->re_num;//剩余量扣掉交易量
                            $num = $sellmodel->re_num;//交易数量
                            $tradeprice = $sellmodel->price;//交易单价
                            $tradevalue = $tradeprice * $num;//交易价格
                            $sellmodel->status = 1;
                            $sellmodel->re_num = 0;
                            $sellmodel->re_transprice = 0;
                            $this->trademodel->re_transprice -= $tradevalue;
                            if($sellmodel->save()){
                                //保存排队模型，并创建双方交易模型
                                $trademodel = new WB_UserStockTrade();
                                $trademodel->userid = $this->trademodel->userid;
                                $trademodel->username = $this->trademodel->username;
                                $trademodel->suserid = $sellmodel->suserid;
                                $trademodel->susername = $sellmodel->susername;
                                $trademodel->number = $num;
                                $trademodel->price = $tradeprice;
                                $trademodel->transprice = $tradevalue;
                                $trademodel->status = 1;
                                $trademodel->type = 3;
                                $trademodel->created_at = time();
                            //    $value += $tradeprice * $num;//累计交易价格
                                if($trademodel->save()){
                                    //买卖双方的钱包收入， 以及入账明细
                                    $sellwallet->hcg_wa += $tradevalue;
                                    $this->buser->wallet->hcg_wa -= $tradevalue;
                                    $this->buser->stock->stock += $num;
                                    if($sellwallet->save() && $this->buser->wallet->save()&& $this->buser->stock->save()){
                                        //明细 awardrecord
                                        

                                    }else{
                                        $this->sender->message="购买失败,请重试或联系管理员!";
                                        $this->commit = false;
                                        break;
                                    }
                                }else{
                                    $this->errorMessage($trademodel->errors);
                                    $this->commit = false;
                                    break;
                                }
                            }else{
                                $this->errorMessage($sellmodel->errors);
                                $this->commit = false;
                                break;
                            }
                        }else{
                            //购买余量小于模型余量，则购买全部成交
                            $this->trademodel->re_num = 0;
                            $this->trademodel->status = 1;
                            if($this->trademodel->save()){
                                //保存交易模型,并创建双方交易模型
                                $trademodel = new WB_UserStockTrade();
                                $trademodel->userid = $this->trademodel->userid;
                                $trademodel->username = $this->trademodel->username;
                                $trademodel->suserid = $sellmodel->suserid;
                                $trademodel->susername = $sellmodel->susername;
                                $trademodel->number = $re_num;
                                $trademodel->price = $sellmodel->price;
                                $trademodel->transprice = $sellmodel->price * $re_num;
                                $trademodel->status = 1;
                                $trademodel->type = 3;
                                $trademodel->created_at = time();
                                if($trademodel->save()){
                                    //买卖双方的钱包收入， 以及入账明细
                                    $sellwallet->hcg_wa += $tradevalue;
                                    $this->buser->wallet->hcg_wa -= $tradevalue;
                                    $this->buser->stock->stock += $re_num;
                                    if($sellwallet->save() && $this->buser->wallet->save() && $this->buser->stock->save()){
                                        //明细 awardrecord
                                        
                                        
                                        //继续排队
                                        $overplus_num1 = $sellmodel->re_num - $re_num;//中转
                                        $sellmodel->re_num = $overplus_num1;
                                        $sellmodel->re_transprice = $sellmodel->re_transprice - $overplus_num1 * $sellmodel->price;
                                        $sellmodel->save();
                                    }else{
                                        $this->sender->message="购买失败,请重试或联系管理员!";
                                        $this->commit = false;
                                        break;
                                    }
                                }else{
                                    $this->errorMessage($trademodel->errors);
                                    $this->commit = false;
                                    break;
                                }
                            }else{
                                $this->errorMessage($this->trademodel->errors);
                                $this->commit = false;
                                break;
                            }
                        }                        
                    }
                }else{
                    if ($this->trademodel->save()) {
                        $this->sender->flag = true;
                        $this->sender->message = "操作成功";
                    } else {
                        $this->errorMessage($this->trademodel->errors);
                        $this->commit = false;
                    }
                }
                //判断事务执行
                if($this->commit){
                    $this->sender->flag = true;
                    $this->sender->message = "操作成功";
                    $trans->commit();
                }else{
                    $this->sender->message = "操作失败";
                    $trans->rollBack();
                }
            } catch (Exception $ex) {
                $this->sender->message="购买失败,请重试或联系管理员!";
                $trans->rollBack();
                throw new \yii\web\NotFoundHttpException;
            }
            
        }
    }

    /*
     * 出售股票   自动交易 
     */
    public function stockTradeSell(){
        $this->getUser();//获取卖方用户模型 _fuser
        $this->getStockPrice();
        if ($this->stockOff() && $this->validPass()) {
            $trans = Yii::$app->db->beginTransaction();
            try{
                //股数减少以及记录
                
                //购买队列
                $buylist = WB_UserStockTrade::getBuylist($this->trademodel->price);
                if($buylist){
                    //卖方剩余交易数量
                    $re_num = $this->trademodel->re_num;
                    foreach ($buylist as $buymodel){
                        if($re_num == 0){
                            //剩余量等于0，则保存出售模型
                            $this->trademodel->status = 1;
                            $this->trademodel->re_num = 0;
                            $this->trademodel->re_transprice = 0;
                            $this->trademodel->save();
                            $this->sender->message="出售成功！";
                            $this->sender->flag=true;  
                            break;
                        }
                        $this->getBuser($buymodel->userid);//$this->buser  买方模型
                        if($re_num >= $buymodel->re_num){
                            //卖方大于买方交易剩余购买数量
                            $re_num = $re_num - $buymodel->re_num;//扣除交易量
                            $buymodel->status = 1;
                            $buymodel->re_num = 0;
                            $buymodel->re_transprice = 0;
                            if($buymodel->save()){
                                //保存排单模型  创建双方排单模型
                                $trademodel = new WB_UserStockTrade();
                                $trademodel->userid = $buymodel->userid;
                                $trademodel->username = $buymodel->username;
                                $trademodel->suserid = $this->trademodel->suserid;
                                $trademodel->susername = $this->trademodel->susername;
                                $trademodel->number = $buymodel->re_num;
                                $trademodel->price = $buymodel->price;
                                $trademodel->transprice = $buymodel->price * $buymodel->re_num;
                                $trademodel->status = 1;
                                $trademodel->type = 3;
                                $trademodel->created_at = time();
                                if($trademodel->save()){
                                    //保存交易模型  双方钱包以及记录
                                    if($this->buser->wallet->save()&& $this->_fuser->wallet->save()){
                                        
                                        
                                    }else{
                                        $this->commit = false;
                                        break;
                                    }
                                }else{
                                    $this->errorMessage($trademodel->errors);
                                    $this->commit = false;
                                    break;
                                }
                            }else{
                                $this->errorMessage($buymodel->errors);
                                $this->commit = false;
                                break;
                            }
                            
                        }else{
                            //卖方不足买方购买数量  $re_num  就是交易数量    买方继续排队，卖方结束
                            $this->trademodel->re_num = 0;
                            $this->trademodel->status = 1;
                            if($this->trademodel->save()){
                                //创建双方交易模型
                                $trademodel = new WB_UserStockTrade();
                                $trademodel->userid = $buymodel->userid;
                                $trademodel->username = $buymodel->username;
                                $trademodel->suserid = $this->trademodel->suserid;
                                $trademodel->susername = $this->trademodel->susername;
                                $trademodel->number = $re_num;
                                $trademodel->price = $buymodel->price;
                                $trademodel->transprice = $buymodel->price * $re_num;
                                $trademodel->status = 1;
                                $trademodel->type = 3;
                                $trademodel->created_at = time();
                                if($trademodel->save()){
                                    //买方继续排队
                                    $re_num1 = $buymodel->re_num - $re_num;//中转
                                    $buymodel->re_num = $re_num1;
                                    $buymodel->re_transprice = $re_num1 * $buymodel->price;
                                    $re_num = 0;
                                    if($buymodel->save()){
                                        //保存买方模型  保存钱包以及记录
                                        
                                        
                                        if($this->buser->wallet->save() && $this->_fuser->wallet->save()){
                                            $this->sender->message = "操作成功";
                                             break;//完成交易
                                        }else{
                                            $this->commit = false;
                                            break;
                                        }
                                    }else{
                                        $this->errorMessage($buymodel->errors);
                                        $this->commit = false;
                                        break;
                                    }
                                }else{
                                    $this->errorMessage($trademodel->errors);
                                    $this->commit = false;
                                    break;
                                }
                            }else{
                                $this->errorMessage($this->trademodel->errors);
                                $this->commit = false;
                                break;
                            }
                        }
                    }
                }else{
                    //直接进入出售列表
                    if(!$this->trademodel->save()){
                        $this->sender->message = "操作失败";
                        $trans->rollBack();
                    }
                }
                //判断事务执行
                if($this->commit){
                    $this->sender->flag = true;
                    $this->sender->message = "操作成功";
                    $trans->commit();
                }else{
                    $this->sender->message = "操作失败";
                    $trans->rollBack();
                }
            } catch (Exception $ex) {
                $this->sender->message = "出售失败，请重试或联系管理员";
                $trans->rollBack();
                throw new \yii\web\NotFoundHttpException;
            }           
        }
    }
    
    
    /*
     * 强制出售股票   自动交易 系统
     */
    public function stockTradeSellSys(){
        //$this->trademodel = ArrayHelper::getValue($this->data, "model");
//        var_dump($this->trademodel);exit;
        $this->getUser($this->trademodel->userid);//获取卖方用户模型 _fuser
        $this->getStockPrice();
        $trans = Yii::$app->db->beginTransaction();
        try{
            if($this->trademodel->save()){
                //$num = $this->trademodel->number;
                $this->_fuser->stock->stock = $this->_fuser->stock->stock - $this->trademodel->num;
                if($this->_fuser->stock->save()){
                    $cash_wa = Yii::$app->formatter->asDecimal($this->trademodel->actual_value * 0.6, 2);
                    $care_wa = Yii::$app->formatter->asDecimal($this->trademodel->actual_value * 0.1, 2);
                    $hcg_wa = Yii::$app->formatter->asDecimal($this->trademodel->actual_value * 0.3, 2);
                    $this->_fuser->wallet->cash_wa = $this->_fuser->wallet->cash_wa + $cash_wa;
                    $this->_fuser->wallet->care_wa = $this->_fuser->wallet->care_wa + $care_wa;
                    $this->_fuser->wallet->hcg_wa = $this->_fuser->wallet->hcg_wa + $hcg_wa;
                    if($this->_fuser->wallet->save()){
                        $awardmodel = new WB_UserAwardRecord();
                        $awardmodel->userid = $this->_fuser->id;
                        $awardmodel->amount = $this->trademodel->actual_value;
                        $awardmodel->award_type = 8;
                        $awardmodel->event_type = 3;
                        $awardmodel->pay_type = 1;
                //        $awardmodel->poundage = 0;
                        $awardmodel->cash_amount = $cash_wa;
                        $awardmodel->care_amount = $care_wa;
                        $awardmodel->hcg_amount = $hcg_wa;
                        $awardmodel->note = "系统强制出售单价为".$this->trademodel->price."的SDK股".$this->trademodel->number."。";
                        if($awardmodel->save()){
                            $res = MTools::BSMSTRADE($this->_fuser->userprofile->phone,$this->_fuser->userprofile->username);
                           // var_dump($res);exit; //   打印提示，缺少提示模板
                            //保存资金池
//                            $array = ['phoneLimit'=> MTools::getYiiParams("phoneLimit"),'registerOff'=> MTools::getYiiParams("registerOff"),'registerOff2'=>MTools::getYiiParams("registerOff2"),'uplevelOff'=>MTools::getYiiParams("uplevelOff"),'systementert'=>MTools::getYiiParams("systementert"),'loginStatus'=>MTools::getYiiParams("loginStatus"),'stockOff'=>MTools::getYiiParams("stockOff"),'currencyTransOff'=>MTools::getYiiParams("currencyTransOff"),'cashtradeOff'=>MTools::getYiiParams("cashtradeOff"),'sysStockissue'=>MTools::getYiiParams("sysStockissue") + $num,'stockTradeBegin'=>MTools::getYiiParams("stockTradeBegin"),'stockTradeEnd'=>MTools::getYiiParams("stockTradeEnd"),'sellstockPoper'=>MTools::getYiiParams("sellstockPoper"),'forcesellPoper'=>MTools::getYiiParams("forcesellPoper"),'forcesellLine'=>MTools::getYiiParams("forcesellLine"),'rate'=>MTools::getYiiParams("rate"),'releasedays'=>MTools::getYiiParams("releasedays"),'webimagepath'=>MTools::getYiiParams("webimagepath")];
//                            $string = "<?php\n return \n [";
//                            foreach ($array as $attributes => $value) {
//                                $string .="'$attributes'=>'$value',"; 
//                            }
//                            $string .= "];";
//                            file_put_contents(Yii::getAlias('@common/config/params-local.php'), $string);
//                            $this->sender->flag = true;
//                            $this->sender->message = "出售成功！";
                            $trans->commit();
                        }else{
                            $this->errorMessage($awardmodel->errors);
                        }
                    }else{
                        $this->errorMessage($this->_fuser->wallet->errors);
                    }                        
                }else{
                    $this->errorMessage($this->_fuser->stock->errors);
                }
            }else{
                $this->errorMessage($this->trademodel->errors);
            }
        } catch (Exception $ex) {
            $trans->rollBack();
            throw new \yii\web\NotFoundHttpException;
        }  
    }


    /*
     * 确认成交币种交易   转换
     */

    public function walletAccept() {
        $this->getBuser($this->trademodel->tuserid);//buser
        $trans = Yii::$app->db->beginTransaction();
        //$tuserwallet = WB_UserWallet::find()->where("userid = :userid",[":userid"=> $this->trademodel->tuserid])->one();
        try {
            if($this->trademodel->status == 0){
                if ($this->trademodel->t_int_type == 1) {
                    $this->buser->wallet->regist_wa = $this->buser->wallet->regist_wa +  $this->trademodel->samount;
                } else if ($this->trademodel->t_int_type == 2) {
                    $this->buser->wallet->cash_wa = $this->buser->wallet->cash_wa + $this->trademodel->samount;
                } else if ($this->trademodel->t_int_type == 3) {
                    $this->buser->wallet->care_wa = $this->buser->wallet->care_wa + $this->trademodel->samount;
                }else{
                    $this->sender->message = "无次币种交易";
                    return false;
                }
                if(!$this->trademodel->status == 1){
                    $this->trademodel->status = 1;
                    $this->trademodel->paystatus = 3;
                    $this->trademodel->audited_at = time();
                } else {
                    return false;
                }
                //$this->trademodel->aduit_id = Yii::$app->user->id;
                //$this->trademodel->aduit_name = Yii::$app->user->identity->username;
                if ($this->trademodel->save()) {
                    if($this->buser->wallet->save()){
                        $this->addRecordToAward($this->trademodel);
                        $this->sender->flag = true;
                        $trans->commit();
                    }
                } else {
                    $this->errorMessage($this->trademodel->errors);
                }
            }
        } catch (Exception $ex) {
            $trans->rollBack();
            throw new \yii\web\NotFoundHttpException;
        }
    }

    /*
     * 确认取消币种交易
     */

    public function walletCancel() {
        $this->getUser($this->trademodel->fuserid);
        $trans = Yii::$app->db->beginTransaction();
        try {
            if($this->trademodel->status == 0){
                if ($this->trademodel->f_int_type == 1) {
                    $this->_fuser->wallet->regist_wa = $this->_fuser->wallet->regist_wa + $this->trademodel->amount;
                    $upawardrecord = new WB_UserAwardRecord();
                    $upawardrecord->userid = $this->trademodel->fuserid;
                    $upawardrecord->amount = $this->trademodel->amount;
                    $upawardrecord->award_type = 10;
                    $upawardrecord->pay_type = 1;
                    $upawardrecord->regist_amount = $this->trademodel->amount;
                    $upawardrecord->event_type = 5;
                    $upawardrecord->note ="撤销注册钱包转换入账";
                    if($this->trademodel->type == 3){
                        $upawardrecord->note ="撤销注册钱包转入".$this->trademodel->tusername;
                    }
                    $upawardrecord->created_at = time();
                    $upawardrecord->updated_at = time();
                    $upawardrecord->save();
                    //现金卢呗退
                } else if ($this->trademodel->f_int_type == 2) {
                    $this->_fuser->wallet->cash_wa = $this->_fuser->wallet->cash_wa + $this->trademodel->amount;
                    $upawardrecord = new WB_UserAwardRecord();
                    $upawardrecord->userid = $this->trademodel->fuserid;
                    $upawardrecord->amount = $this->trademodel->amount;
                    $upawardrecord->award_type = 9;
                    $upawardrecord->pay_type = 1;
                    $upawardrecord->cash_amount = $this->trademodel->amount;
                    $upawardrecord->event_type = 5;
                    $upawardrecord->note ="撤销现金钱包转换入账";
                    $upawardrecord->created_at = time();
                    $upawardrecord->updated_at = time();
                    $upawardrecord->save();
                }elseif ($this->trademodel->f_int_type == 3) {
                    $this->_fuser->wallet->care_wa = $this->_fuser->wallet->care_wa + $this->trademodel->amount;
                    $upawardrecord = new WB_UserAwardRecord();
                    $upawardrecord->userid = $this->trademodel->fuserid;
                    $upawardrecord->amount = $this->trademodel->amount;
                    $upawardrecord->award_type = 11;
                    $upawardrecord->pay_type = 1;
                    $upawardrecord->care_amount = $this->trademodel->amount;
                    $upawardrecord->event_type = 5;
                    $upawardrecord->note ="撤销关联钱包转换入账";
                    $upawardrecord->created_at = time();
                    $upawardrecord->updated_at = time();
                    $upawardrecord->save();
                }else{
                    $this->sender->message = "无次币种交易";
                    return false;
                }
                
                if($this->trademodel->status == 0){
                    $this->trademodel->status = 2;
                    $this->trademodel->audited_at = time();
                }else{
                    return false;
                }
//                $this->trademodel->aduit_id = ArrayHelper::getValue($this->data, "aduit_note") ? "" : Yii::$app->user->id;
//                $this->trademodel->aduit_name = ArrayHelper::getValue($this->data, "aduit_name") ? ArrayHelper::getValue($this->data, "aduit_name") : Yii::$app->user->identity->username;
//                $this->trademodel->aduit_note = ArrayHelper::getValue($this->data, "aduit_note","取消了交易");
                if ($this->trademodel->save() && $this->_fuser->wallet->save()) {
                    $this->sender->flag = true;
                    $trans->commit();
                } else {
                    $this->errorMessage($this->trademodel->errors);
                }
            }
        } catch (Exception $ex) {
            $trans->rollBack();
            throw new \yii\web\NotFoundHttpException;
        }
    }

    /*
     * 确认股票交易通过
     */

    public function stockTradePass() {
        $trans = Yii::$app->db->beginTransaction();
        try {
            $this->getUser($this->trademodel->userid);
            if ($this->trademodel->type == 1) { //购买股票
                //保存用户股票
                if ($this->_fuser->stock) {
                    $this->_fuser->stock->stock = $this->_fuser->stock->stock + $this->trademodel->actual_value / $this->trademodel->price;
                    $this->_fuser->stock->sell_stock = $this->_fuser->stock->sell_stock + $this->trademodel->actual_value / $this->trademodel->price;
                    if (!$this->_fuser->stock->save()) {
                        $this->errorMessage($this->_fuser->stock->errors);
                        return false;
                    }
                } else {
                    $stockmodel = new \frontend\models\WB_UserStock();
                    $stockmodel->userid = $this->trademodel->userid;
                    $stockmodel->username = $this->trademodel->username;
                    $stockmodel->stock = $this->trademodel->actual_value / $this->trademodel->price;
                    $stockmodel->sell_stock = $this->trademodel->actual_value / $this->trademodel->price;
                    if (!$stockmodel->save()) {
                        $this->errorMessage($stockmodel->errors);
                        return false;
                    }
                }
            } else {
                $this->_fuser->stock->stock = $this->_fuser->stock->stock - $this->trademodel->number;
                $this->_fuser->wallet->hcg_wa = $this->_fuser->wallet->hcg_wa + $this->trademodel->actual_value;
                if (!$this->_fuser->stock->save() || $this->_fuser->wallet->save()) {
                    $this->sender->message = "审核失败";
                    return false;
                }
            }
            //保存审核记录
            $this->trademodel->status = 1;
            $this->trademodel->audited_at = time();
            $this->trademodel->auditid = Yii::$app->user->id;
            $this->trademodel->auditname = Yii::$app->user->identity->username;
            $this->trademodel->audit = 1;
            if ($this->trademodel->save()) {
                $trans->commit();
                $this->sender->flag = true;
            } else {
                $this->errorMessage($this->trademodel->errors);
                return false;
            }
        } catch (Exception $ex) {
            $trans->rollBack();
            throw new \yii\web\NotFoundHttpException;
        }
    }

    /*
     * 确认股票交易不通过
     */

    public function stockTradeNopass() {
        $trans = Yii::$app->db->beginTransaction();
        try {
            $this->getUser($this->trademodel->userid);
            if ($this->trademodel->type == 1) { //购买股票
                $this->_fuser->wallet->hcg_wa = $this->_fuser->wallet->hcg_wa + $this->trademodel->transprice;
                if (!$this->_fuser->wallet->save()) {
                    $this->errorMessage($this->_fuser->wallet->errors);
                    return false;
                }
            } else {
                $this->_fuser->stock->sell_stock = $this->_fuser->stock->sell_stock + $this->trademodel->number;
                if (!$this->_fuser->stock->save()) {
                    $this->errorMessage($this->_fuser->stock->errors);
                    return false;
                }
            }
            //保存审核记录
            $this->trademodel->status = 2;
            $this->trademodel->audited_at = time();
            $this->trademodel->auditid = Yii::$app->user->id;
            $this->trademodel->auditname = Yii::$app->user->identity->username;
            $this->trademodel->audit = 1;
            if ($this->trademodel->save()) {
                $trans->commit();
                $this->sender->flag = true;
            } else {
                $this->errorMessage($this->trademodel->errors);
                return false;
            }
        } catch (Exception $ex) {
            $trans->rollBack();
            throw new \yii\web\NotFoundHttpException;
        }
    }

    protected function checkCurRegistWa() {
        if ($this->_fuser->wallet->cash_wa < $this->trademodel->number) {
            $this->sender->message = "您的现金钱包卢宝不足";
            return false;
        } else {
            $this->_fuser->wallet->cash_wa = $this->_fuser->wallet->cash_wa - $this->trademodel->number;
        }
        return true;
    }
    
    protected function checkBlance() {
        //$this->buser->wallet
        if ($this->buser->levelid < 3) {
            $this->sender->message = "该级别不能进行现金钱包交易，请提升等级。";
            return false;
        }
        $blance = WB_UserRegistBalance::find()->where("userid = :userid",[':userid'=> $this->buser->id])->one();
        if($blance instanceof WB_UserRegistBalance){
            $left = $blance->zlscore;
            $right = $blance->zrscore;
        }else{
            $left = 0;
            $right = 0;
        }
        if ($left < $this->buser->level->left_score || $right < $this->buser->level->right_score) {
            $this->sender->message = "业绩不达标，不可以进行现金钱包交易，左右区均要达到1000以上业绩";
            return false;
        }
        return true;
    }
    
    protected function checkBuyMax($userid,$num) {
        $start = $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
        $end = time();
        $res = UserRegistTrade::find()->where("userid = :userid && type = 1",[":userid" => $userid])
               ->andWhere(['between', 'created_at',$start, $end])->sum("number");
        if($res + $num > 3000){
            $this->sender->message = "每天最多只能购买3000注册金";
            return false;
        }
        return true;
    }
    
    /*
     * 注册币购买
     */
    public function walletCashbuy() {
        $this->getBuser();//buser
        if ($this->validPass2($this->trademodel->userid) && $this->cashtradeOff() && $this->checkBlance()&& $this->checkBuyMax($this->trademodel->userid,$this->trademodel->number)) {
            $trans = Yii::$app->db->beginTransaction();
            try {
                //购买队列
                $selllist = UserRegistTrade::getselllist($this->buser->id);
                if($selllist){
                    //购买数量
                    $overplus_num = $this->trademodel->overplus_num;
                    foreach ($selllist as $sellmodel){
                        if($overplus_num == 0){
                            //剩余量等于0，则保存出售模型
                            $this->trademodel->status = 1;
                            $this->trademodel->save();
                            $this->sender->message="购买成功！";
                            $this->sender->flag=true;
                            break;
                        }
                        $this->getSuser($sellmodel->suserid);//$this->suser  卖方模型
                        if($overplus_num >= $sellmodel->overplus_num){
                            //买方大于卖方交易数量
                            $overplus_num = $overplus_num - $sellmodel->overplus_num;//剩余量扣掉交易量
                            $sellmodel->status = 1;
                            $sellmodel->overplus_price = 0;
                            $sellmodel->save();//保存排单模型
                            if($this->trademodel->save()){
                                //创建双方交易模型
                                $registTrade = new UserRegistTrade();
                                $registTrade->order_sn = date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
                                $registTrade->userid = $this->buser->id;
                                $registTrade->username = $this->buser->username;
                                $registTrade->suserid = $sellmodel->suserid;
                                $registTrade->susername = $sellmodel->susername;
                                $registTrade->number =  $sellmodel->overplus_num;
                                $registTrade->overplus_num =  $sellmodel->overplus_num;
                                $registTrade->transprice =  $sellmodel->overplus_num * $sellmodel->rate;//MTools::getYiiParams("rate");
                                $registTrade->overplus_price =  $sellmodel->overplus_num * $sellmodel->rate;//MTools::getYiiParams("rate");;
                                $registTrade->rate = $sellmodel->rate;//MTools::getYiiParams("rate");
                                $registTrade->type = 1;
                                $registTrade->paystatus = 1;
                                $registTrade->status = 2;
                                $registTrade->real_name = $sellmodel->real_name;
                                $registTrade->phone = $sellmodel->phone;
                                $registTrade->bank_name = $sellmodel->bank_name;
                                $registTrade->bank_card = $sellmodel->bank_card;
                                $registTrade->bank_address = $sellmodel->bank_address;
                                $registTrade->created_at = time();
                                if($registTrade->save()){
                                    if(!UserRegistTrade::getSelllist($this->buser->id)){
                                        //再次判断，如果队列为空，则剩余量进入出售队列
                                        if($overplus_num == 0){
                                            $this->trademodel->status = 1;
                                            $this->trademodel->save();
                                            $this->sender->message="交易成功！";
                                            $this->sender->flag = true;
                                            break; 
                                        }else{
                                            $this->trademodel->overplus_num = $overplus_num;
                                            $this->trademodel->save();
                                            $this->sender->message="交易成功！";
                                            $this->sender->flag = true;
                                            //break; 
                                        }
                                    }
                                }else{
                                     $this->errorMessage($registTrade->errors);
                                }
                            } else {
                                $this->errorMessage($this->trademodel->errors);
                            }
                        }else{
                            //不足购买数量  $overplus_num  就是交易数量                $buymodel->overplus_num
                            $this->trademodel->overplus_num = 0;
                            $this->trademodel->status = 1;
                            if($this->trademodel->save()){
                                //创建双方交易模型
                                $registTrade = new UserRegistTrade();
                                $registTrade->order_sn = date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
                                $registTrade->userid = $this->buser->id;
                                $registTrade->username = $this->buser->username;
                                $registTrade->suserid = $sellmodel->suserid;
                                $registTrade->susername = $sellmodel->susername;
                                $registTrade->number =  $overplus_num;
                                $registTrade->overplus_num =  $overplus_num;
                                $registTrade->transprice =  $overplus_num * $sellmodel->rate;//MTools::getYiiParams("rate");
                                $registTrade->overplus_price =  $overplus_num * $sellmodel->rate;//MTools::getYiiParams("rate");;
                                $registTrade->rate = $sellmodel->rate;//MTools::getYiiParams("rate");
                                $registTrade->type = 1;
                                $registTrade->paystatus = 1;
                                $registTrade->status = 2;
                                $registTrade->real_name = $sellmodel->real_name;
                                $registTrade->phone = $sellmodel->phone;
                                $registTrade->bank_name = $sellmodel->bank_name;
                                $registTrade->bank_card = $sellmodel->bank_card;
                                $registTrade->bank_address = $sellmodel->bank_address;
                                $registTrade->created_at = time();
                                if($registTrade->save()){
                                    if($sellmodel->overplus_num - $overplus_num == 0){
                                        $overplus_num = 0;
                                        //保存买方模型
                                        $sellmodel->overplus_num = 0;
                                        $sellmodel->overplus_price = 0;
                                        $sellmodel->status = 1;
                                        $sellmodel->save();
                                    }else{
                                        //继续排队
                                        $overplus_num1 = $sellmodel->overplus_num - $overplus_num;//中转
                                        $sellmodel->overplus_num = $overplus_num1;
                                        $sellmodel->overplus_price = $overplus_num1 * $sellmodel->rate;
                                        $overplus_num = 0;
                                        $sellmodel->save();
                                    }
                                }else{
                                     $this->errorMessage($registTrade->errors);
                                }
                            }else{
                                $this->errorMessage($this->trademodel->errors);
                            }
                        }
                    }
//                    if ($this->_fuser->wallet->save()) {     
                        $this->sender->flag = true;
                        $this->sender->message = "操作成功";
                        $trans->commit();
//                    } else {
//                        $this->errorMessage($this->_fuser->wallet->errors);
//                    }
                }else{
                    //直接保存成为购买队列
                    if ($this->trademodel->save()) {     
                        $this->sender->flag = true;
                        $this->sender->message = "操作成功";
                        $trans->commit();
                    } else {
                        $this->errorMessage($this->trademodel->errors);
                    }
                }
            } catch (Exception $ex) {
                $trans->rollBack();
                $this->sender->message = "操作失败";
                throw new \yii\web\NotFoundHttpException;
            }
        }
    }
    
    /*
     * 现金钱包出售
     */
    public function walletCashsell() {
        $this->getUser();//_fuser
        if ($this->checkCurRegistWa() && $this->validPass() && $this->cashtradeOff()) {
            $trans = Yii::$app->db->beginTransaction();
            try {
                //注册现金减少
                $fawardrecord = new WB_UserAwardRecord();
                $fawardrecord->userid = $this->trademodel->suserid;
                $fawardrecord->amount = $this->trademodel->number;
                $fawardrecord->award_type = 9;
                $fawardrecord->pay_type = 2;
                $fawardrecord->regist_amount = $this->trademodel->number;
                $fawardrecord->event_type = 6;
                $fawardrecord->note = "出售现金钱包消耗";
                $fawardrecord->created_at = time();
                $fawardrecord->updated_at = time();
                $fawardrecord->save();
                //购买队列
                $buylist = UserRegistTrade::getBuylist($this->_fuser->id);
                if($buylist){
                    //卖方剩余交易数量
                    $overplus_num = $this->trademodel->overplus_num;
                    foreach ($buylist as $buymodel){
                        if($overplus_num == 0){
                            //剩余量等于0，则保存出售模型
                            $this->trademodel->status = 1;
                            $this->trademodel->save();
                            $this->sender->message="出售成功！";
                            $this->sender->flag=true;
                            break;
                        }
                        $this->getBuser($buymodel->userid);//$this->buser  买方模型
                        if($overplus_num >= $buymodel->overplus_num){
                            //卖方大于买方交易数量
                            $overplus_num = $overplus_num - $buymodel->overplus_num;//剩余量扣掉交易量
                            $buymodel->status = 1;
                            $buymodel->overplus_price = 0;
                            $buymodel->save();//保存排单模型
                            if($this->trademodel->save()){
                                //创建双方交易模型
                                $registTrade = new UserRegistTrade();
                                $registTrade->order_sn = date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
                                $registTrade->userid = $buymodel->userid;
                                $registTrade->username = $buymodel->username;
                                $registTrade->suserid = $this->_fuser->id;//$this->trademodel->suserid;
                                $registTrade->susername = $this->_fuser->username;//$this->trademodel->susername;
                                $registTrade->number =  $buymodel->overplus_num;
                                $registTrade->overplus_num =  $buymodel->overplus_num;
                                $registTrade->transprice =  $buymodel->overplus_num * $buymodel->rate;//MTools::getYiiParams("rate");
                                $registTrade->overplus_price =  $buymodel->overplus_num * $buymodel->rate;//MTools::getYiiParams("rate");;
                                $registTrade->rate = $buymodel->rate;//MTools::getYiiParams("rate");
                                $registTrade->type = 1;
                                $registTrade->paystatus = 1;
                                $registTrade->status = 2;
                                $registTrade->real_name = $this->trademodel->real_name;
                                $registTrade->phone = $this->trademodel->phone;
                                $registTrade->bank_name = $this->trademodel->bank_name;
                                $registTrade->bank_card = $this->trademodel->bank_card;
                                $registTrade->bank_address = $this->trademodel->bank_address;
                                $registTrade->created_at = time();
                                if($registTrade->save()){
                                    if(!UserRegistTrade::getBuylist($this->_fuser->id)){
                                        //再次判断，如果队列为空，则剩余量进入出售队列
                                        if($overplus_num == 0){
                                            $this->trademodel->status = 1;
                                            $this->trademodel->save();
                                            $this->sender->message="交易成功！";
                                            $this->sender->flag = true;
                                            break; 
                                        }else{
                                            $this->trademodel->overplus_num = $overplus_num;
                                            $this->trademodel->save();
                                            $this->sender->message="交易成功！";
                                            $this->sender->flag = true;
                                            //break; 
                                        }
                                    }
                                }else{
                                     $this->errorMessage($registTrade->errors);
                                }
                            } else {
                                $this->errorMessage($this->trademodel->errors);
                            }
                        }else{
                            //不足购买数量  $overplus_num  就是交易数量                $buymodel->overplus_num
                            $this->trademodel->overplus_num = 0;
                            $this->trademodel->status = 1;
                            if($this->trademodel->save()){
                                //创建双方交易模型
                                $registTrade = new UserRegistTrade();
                                $registTrade->order_sn = date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
                                $registTrade->userid = $buymodel->userid;
                                $registTrade->username = $buymodel->username;
                                $registTrade->suserid = $this->_fuser->id;//$this->trademodel->suserid;
                                $registTrade->susername = $this->_fuser->username;//$this->trademodel->suserid;
                                $registTrade->number =  $overplus_num;
                                $registTrade->overplus_num =  $overplus_num;
                                $registTrade->transprice =  $overplus_num * $buymodel->rate;//MTools::getYiiParams("rate");
                                $registTrade->overplus_price =  $overplus_num * $buymodel->rate;//MTools::getYiiParams("rate");;
                                $registTrade->rate = $buymodel->rate;//MTools::getYiiParams("rate");
                                $registTrade->type = 1;
                                $registTrade->paystatus = 1;
                                $registTrade->status = 2;
                                $registTrade->real_name = $this->trademodel->real_name;
                                $registTrade->phone = $this->trademodel->phone;
                                $registTrade->bank_name = $this->trademodel->bank_name;
                                $registTrade->bank_card = $this->trademodel->bank_card;
                                $registTrade->bank_address = $this->trademodel->bank_address;
                                $registTrade->created_at = time();
                                if($registTrade->save()){
                                    if($overplus_num - $buymodel->overplus_num == 0){
                                        $overplus_num = 0;
                                        //保存买方模型
                                        $buymodel->overplus_num = 0;
                                        $buymodel->overplus_price = 0;
                                        $buymodel->status = 1;
                                        $buymodel->save();
                                    }else{
                                        //继续排队
                                        $overplus_num11 = $buymodel->overplus_num - $overplus_num;//中转
                                        $buymodel->overplus_num = $overplus_num11;
                                        $buymodel->overplus_price = $overplus_num11 * $buymodel->rate;
                                        $overplus_num = 0;
                                        $buymodel->save();
                                    }
                                }else{
                                     $this->errorMessage($registTrade->errors);
                                }
                            }else{
                                $this->errorMessage($this->trademodel->errors);
                            }
                        }
                    }
                    if ($this->_fuser->wallet->save()) {     
                        $this->sender->flag = true;
                        $this->sender->message = "操作成功";
                        $trans->commit();
                    } else {
                        $this->errorMessage($this->_fuser->wallet->errors);
                    }
                }else{
                    //直接保存成为出售队列
                    if ($this->trademodel->save() && $this->_fuser->wallet->save()) {     
                        $this->sender->flag = true;
                        $this->sender->message = "操作成功";
                        $trans->commit();
                    } else {
                        $this->errorMessage($this->trademodel->errors);
                    }
                }
            } catch (Exception $ex) {
                $trans->rollBack();
                $this->sender->message = "操作失败";
                throw new \yii\web\NotFoundHttpException;
            }
        }
    }
    
    public function addRecordToAward($trademodel){
        if($trademodel->f_int_type == 1){
            //注册现金减少
            $fawardrecord = new WB_UserAwardRecord();
            $fawardrecord->userid = $trademodel->fuserid;
            $fawardrecord->amount = $trademodel->amount;
            $fawardrecord->award_type = 10;
            $fawardrecord->pay_type = 2;
            $fawardrecord->regist_amount = $trademodel->samount;
            $fawardrecord->event_type = 5;
            $fawardrecord->note = "注册钱包转换消耗";
            if($trademodel->type == 3){
                $fawardrecord->note = "注册钱包转入".$trademodel->tusername;
            }
            $fawardrecord->created_at = time();
            $fawardrecord->updated_at = time();
            $fawardrecord->save();
        }elseif($trademodel->f_int_type == 2){
            //现金钱包减少
            $fawardrecord = new WB_UserAwardRecord();
            $fawardrecord->userid = $trademodel->fuserid;
            $fawardrecord->amount = $trademodel->amount;
            $fawardrecord->award_type = 9;
            $fawardrecord->pay_type = 2;
            $fawardrecord->cash_amount = $trademodel->samount;
            $fawardrecord->event_type = 5;
            $fawardrecord->note = "现金钱包转换消耗";
            if($trademodel->type == 2){
                $fawardrecord->note = "转入关联账号".$trademodel->tusername;
            }
            $fawardrecord->created_at = time();
            $fawardrecord->updated_at = time();
            $fawardrecord->save();
        }elseif($trademodel->f_int_type == 3){
            //关联钱包减少
            $fawardrecord = new WB_UserAwardRecord();
            $fawardrecord->userid = $trademodel->fuserid;
            $fawardrecord->amount = $trademodel->amount;
            $fawardrecord->award_type = 11;
            $fawardrecord->pay_type = 2;
            $fawardrecord->care_amount = $trademodel->samount;
            $fawardrecord->event_type = 5;
            $fawardrecord->note = "关联钱包转换消耗";
            if($trademodel->type == 2){
                $fawardrecord->note = "转入关联账号".$trademodel->tusername;
            }
            $fawardrecord->created_at = time();
            $fawardrecord->updated_at = time();
            $fawardrecord->save();
        }
        
        //注册卢呗交易入库
        if($trademodel->t_int_type == 1){
            //注册卢呗入库
            $tawardrecord = new WB_UserAwardRecord();
            $tawardrecord->userid = $trademodel->tuserid;
            $tawardrecord->amount = $trademodel->samount;
            $tawardrecord->award_type = 10;
            $tawardrecord->pay_type = 1;
            $tawardrecord->regist_amount = $trademodel->samount;
            $tawardrecord->event_type = 5;
            $tawardrecord->note = "钱包转换入账";
            if($trademodel->type == 3){
                $tawardrecord->note = $trademodel->fusername."转入注册钱包";
            }
            $tawardrecord->created_at = time();
            $tawardrecord->updated_at = time();
            $tawardrecord->save();
        }elseif($trademodel->t_int_type == 2){
            //现金钱包入库
            $tawardrecord = new WB_UserAwardRecord();
            $tawardrecord->userid = $trademodel->tuserid;
            $tawardrecord->amount = $trademodel->samount;
            $tawardrecord->award_type = 9;
            $tawardrecord->pay_type = 1;
            $tawardrecord->cash_amount = $trademodel->samount;
            $tawardrecord->event_type = 5;
            $tawardrecord->note = "钱包转换入账";
            if($trademodel->type == 2){
                $tawardrecord->note = "关联账号".$trademodel->fusername."转入";
            }
            $tawardrecord->created_at = time();
            $tawardrecord->updated_at = time();
            $tawardrecord->save();
        }elseif($trademodel->t_int_type == 3){
            //关联钱包入库
            $tawardrecord = new WB_UserAwardRecord();
            $tawardrecord->userid = $trademodel->tuserid;
            $tawardrecord->amount = $trademodel->samount;
            $tawardrecord->award_type = 11;
            $tawardrecord->pay_type = 1;
            $tawardrecord->care_amount = $trademodel->samount;
            $tawardrecord->event_type = 5;
            $tawardrecord->note = "钱包转换入账";
            if($trademodel->type == 2){
                $tawardrecord->note = "关联账号".$trademodel->fusername."转入";
            }
            $tawardrecord->created_at = time();
            $tawardrecord->updated_at = time();
            $tawardrecord->save();
        }
        if($fawardrecord->save() && $tawardrecord->save()){
            return true;
        }else{
            return false;
        }
    }
    
    public function registAccept() {
        $this->getBuser($this->trademodel->userid);//buser
        $trans = Yii::$app->db->beginTransaction();
        //$tuserwallet = WB_UserWallet::find()->where("userid = :userid",[":userid"=> $this->trademodel->tuserid])->one();
        try {
            if($this->trademodel->paystatus == 2){
                if($this->trademodel->status != 2){
                    $this->sender->message = "请求出错";
                    return false;
                } else {
                    $this->trademodel->status = 1;
                    $this->trademodel->paystatus = 3;
                    $this->trademodel->audited_at = time();
                }
                //$this->trademodel->aduit_id = Yii::$app->user->id;
                //$this->trademodel->aduit_name = Yii::$app->user->identity->username;
                $this->buser->wallet->regist_wa = $this->buser->wallet->regist_wa + $this->trademodel->number;
                if ($this->trademodel->save()) {
                    if($this->buser->wallet->save()){
                        $tawardrecord = new WB_UserAwardRecord();
                        $tawardrecord->userid = $this->trademodel->userid;
                        $tawardrecord->amount = $this->trademodel->number;
                        $tawardrecord->award_type = 10;
                        $tawardrecord->pay_type = 1;
                        $tawardrecord->regist_amount = $this->trademodel->number;
                        $tawardrecord->event_type = 6;
                        $tawardrecord->note = "购买会员".$this->trademodel->susername."的注册金入账";
                        $tawardrecord->created_at = time();
                        $tawardrecord->updated_at = time();
                        $tawardrecord->save();
                        $this->sender->flag = true;
                        $trans->commit();
                    }
                } else {
                    $this->errorMessage($this->trademodel->errors);
                }
            }
        } catch (Exception $ex) {
            $trans->rollBack();
            throw new \yii\web\NotFoundHttpException;
        }
    }
}
