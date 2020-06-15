<?php

namespace backend\models;

use common\models\User;
use backend\models\MY_UserProfile;
use Yii;
use yii\helpers\ArrayHelper;
use common\components\MTools;

class UserupdateForm extends MY_User {

    public $username;
    public $phone;
    public $email;
    public $truename;
    public $idcard;
    public $start;
    public $iseal;
    public $issend;
    public $issell;
    public $is_turn_reg;
    public $phome;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            // username and password are both required
            [['truename', 'idcard', 'phone'], 'required'],
            [['phone'], "match", "pattern" => "/^((0\\d{2,3}(-){0,1}\\d{7,8})|(1[3584]\\d{9}))$/", "message" => "联系方式格式不正确"],
            ['phone', "checkphone"],
            ['email', 'email'],
            [['iseal','issend','issell','start','is_turn_reg'], 'integer'],
            ['idcard', 'checkidcard']
        ];
    }

    public function checkphone($attr, $params) {
        $count = MY_UserProfile::find()->where("phone=:phone", [":phone" => $this->phone])->count();
        if ($count >= MTools::getYiiParams("phoneLimit")) {
            $this->addError($attr, "同一个手机号最多只能注册" . MTools::getYiiParams("phoneLimit") . "个会员");
        }
    }

    public function checkidcard($attr, $params) {
        if (!preg_match("  /^([\d]{17}[xX\d]|[\d]{15})$/", $this->idcard)) {
            $id = strtoupper($this->idcard);
            //ミダだ计皚
            $headPoint = array(
                'A' => 1, 'I' => 39, 'O' => 48, 'B' => 10, 'C' => 19, 'D' => 28,
                'E' => 37, 'F' => 46, 'G' => 55, 'H' => 64, 'J' => 73, 'K' => 82,
                'L' => 2, 'M' => 11, 'N' => 20, 'P' => 29, 'Q' => 38, 'R' => 47,
                'S' => 56, 'T' => 65, 'U' => 74, 'V' => 83, 'W' => 21, 'X' => 3,
                'Y' => 12, 'Z' => 30
            );
            //ミ舦膀计皚
            $multiply = array(8, 7, 6, 5, 4, 3, 2, 1);
            //浪琩ōΑ琌タ絋
            if (preg_match("/^[a-zA-Z][1-2][0-9]+$/", $id) && strlen($id) == 10) {
                //ち秨﹃
                $stringArray = str_split($id);
                //眔ダだ计(繷)
                $total = $headPoint[array_shift($stringArray)];
                //眔ゑ癸絏(Ю)
                $point = array_pop($stringArray);
                //眔计场だだ计
                $len = count($stringArray);
                for ($j = 0; $j < $len; $j++) {
                    $total += $stringArray[$j] * $multiply[$j];
                }
                //璸衡緇计絏ゑ癸
                $last = (($total % 10) == 0 ) ? 0 : (10 - ( $total % 10 ));
                if ($last != $point) {
                    $this->addError($attr, "身份证号格式不正确");
                }
            } else {
                $this->addError($attr, "身份证号格式不正确");
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            "truename" => "真实姓名",
//            'phone' => '联系电话',
            'idcard' => '身份证号',
            'email' => "电邮地址",
            "username" => "会员账号",
            "start" => "信用等级",
            "iseal" => "是否被封",
            "issend" => "冻结保单",
            "issell" => "交易限制",
            "is_turn_reg" => "是否能够转出母B",
            "password_hash" => "登录密码",
            "password_hash2" => "交易密码",
            "seal_reason" => "封号原因",
            'phone' => '手机号'
        ];
    }

    public static function createData($id) {

        $uid = $id;
        $model = MY_UserProfile::find()->where("userid=:userid", [":userid" => $id])->one();

//        $old_phone = $model->phone;
//        $new_phone = ArrayHelper::getValue(Yii::$app->request->post(), "UserupdateForm.phone");
        $model->truename = ArrayHelper::getValue(Yii::$app->request->post(), "UserupdateForm.truename");
        $model->phone = ArrayHelper::getValue(Yii::$app->request->post(), "UserupdateForm.phone");
        $model->email = ArrayHelper::getValue(Yii::$app->request->post(), "UserupdateForm.email");
        $model->idcard = ArrayHelper::getValue(Yii::$app->request->post(), "UserupdateForm.idcard");

        $trans = Yii::$app->db->beginTransaction();
        try {
            $res = MTools::saveModel($model);

            if ($res === true) {
//                $model = \common\models\User::find()->where("id=:id", [":id" => $uid])->one();
                $model = \common\models\User::findOne($uid);
                $model->iseal = (int)ArrayHelper::getValue(Yii::$app->request->post(), "UserupdateForm.iseal");
//                $model->seal_reason = ArrayHelper::getValue(Yii::$app->request->post(), "UserupdateForm.seal_reason");
//                $model->issend = (int)ArrayHelper::getValue(Yii::$app->request->post(), "UserupdateForm.issend");
                $model->issell = (int)ArrayHelper::getValue(Yii::$app->request->post(), "UserupdateForm.issell");
                if((int)ArrayHelper::getValue(Yii::$app->request->post(), "UserupdateForm.issell") == 0) {
                    $model->overtime_num = 0;
                    $model->except_num = 0;
                }
//                $model->start = (int)ArrayHelper::getValue(Yii::$app->request->post(), "UserupdateForm.start");
//                $model->is_turn_reg = (int)ArrayHelper::getValue(Yii::$app->request->post(), "UserupdateForm.is_turn_reg");
                
                $post = Yii::$app->request->post();
                $password_hash = $post['UserupdateForm']['password_hash'];
                $password_hash2 = $post['UserupdateForm']['password_hash2'];
                if($password_hash){//修改登录密码
                   $model->setPassword($password_hash);
                }
                if($password_hash2){//修改交易密码
                   $model->setPassword2($password_hash2);
                }
                
                $res2 = MTools::saveModel($model);
                if($res2 === true){
                    \common\models\Actionlog::setLog('编辑会员：'.$model->username.'信息');
//                    if($old_phone != $new_phone){
//                        $sql = "update `sys_user` set user_tel='".$new_phone."' where user_tel = '".$old_phone."' and user_name = '".$model->username."'";
//                        Yii::$app->db2->createCommand($sql)->execute();
//                    }
                    $trans->commit();
                }
            }
            return $res2;
        } catch (Exception $ex) {
            $trans->rollBack();
            throw new \yii\web\NotFoundHttpException($ex);
        }
    }

    public static $onOroff = [
        ["id" => 0, "name" => "正常"],
        ["id" => 1, "name" => "被封"]
    ];

    public static $lkcsellOrnot = [
        ["id" => 0, "name" => "未限制"],
        ["id" => 1, "name" => "已限制"]
    ];

}
