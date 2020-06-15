<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_user_bank".
 *
 * @property string $id
 * @property integer $userid
 * @property string $username
 * @property integer $bank_id
 * @property string $bank
 * @property string $bank_number
 * @property integer $state
 * @property integer $isdefault
 * @property string $phone
 * @property string $zmpath
 * @property string $fmpath
 */
class UserBank extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_user_bank';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'username', 'bank_number', 'bank', 'phone'], 'required'],
            [['userid', 'state', 'isdefault'], 'integer'],
            [['username', 'truename', 'bank_number', 'bank'], 'string', 'max' => 50],
            [['sub_bank', 'phone'], 'string', 'max' => 20],
            [['zmpath', 'fmpath'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => '会员ID',
            'username' => '会员账号',
            'truename' => '持卡人姓名',
            'bank_number' => '银行卡号',
            'phone' => '持卡人手机号',
            'bank' => '银行名称',
            'state' => '状态',
            'isdefault' => '是否为默认银行卡',
            'zmpath' => '银行卡正面路径',
            'fmpath' => '银行卡反面路径',
        ];
    }

    public function check_bank_number($attr, $params){
        $reg = '/^[\d]+$/';
        if(!preg_match($reg,$this->bank_number)){
            $this->addError($attr, Yii::t('app','银行卡号格式不正确'));
        }
    }

    public function check_path($attr, $params){
        $reg = '/^[A-Za-z0-9_.-\/]+$/u';
        if(!empty($this->zmpath)){
            if (!preg_match($reg,$this->zmpath)) {
                $this->addError($attr, "路径格式不对");
            }
        }
        if(!empty($this->fmpath)){
            if (!preg_match($reg,$this->fmpath)) {
                $this->addError($attr, "路径格式不对");
            }
        }

    }
    // 用户银行卡列表显示
    public static function getUserbankLoad($user,$page){
        $query =  UserBank::find()->where('userid = :userid and state = 1',[':userid' => $user->id]);

        $pagesize = 10;
        $offset = ($page - 1)*$pagesize;
        $limit = Yii::$app->request->get("limit", $pagesize);
        $res = $query->offset($offset)->limit($limit)->all();

        $temp = [];
        foreach($res as $key=>$value){
            $temp[$key] = [
                'id' => $value['id'],
                'truename' => $value['truename'],
                'bank_number' => $value['bank_number'],
                'bank' => $value['bank'],
                'type' => '银行卡'
            ];
        }
        return $temp;
    }
}
