<?php

namespace common\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "me_bank_realname".
 *
 * @property string $id
 * @property integer $userid
 * @property string $username
 * @property string $name
 * @property string $phoneNo
 * @property string $idNo
 * @property string $bankName
 * @property string $bankKind
 * @property string $bankType
 * @property string $bankCode
 * @property string $cardNo
 * @property integer $created_at
 * @property integer $is_success
 * @property string $reason
 */
class BankRealname extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_bank_realname';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid'], 'required'],
            [['userid', 'created_at', 'is_success'], 'integer'],
            [['username', 'name', 'bankName', 'bankKind', 'bankType', 'bankCode', 'reason'], 'string', 'max' => 255],
            [['phoneNo', 'idNo', 'cardNo'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => '用户id',
            'username' => '用户账号',
            'name' => '真实姓名',
            'phoneNo' => '银行卡绑定手机',
            'idNo' => '身份证号',
            'bankName' => '银行卡名称',
            'bankKind' => '银行卡种类',
            'bankType' => '银行卡类型',
            'bankCode' => '银行简称',
            'cardNo' => '银行卡号',
            'created_at' => '创建时间',
            'is_success' => '是否认证成功',
            'reason' => '备注说明',
        ];
    }

    // 批量审核查询出用户信息
    public static function getCertificationlist() {
        $query = self::find(); // 关联钱包表 和 用户信息表

        $search = Yii::$app->request->get("search");                            // 用户ID/用户名/手机号
        $type = Yii::$app->request->get("type");                                // 查询伞上会员或伞下会员

        // 通过 用户ID/用户名/手机号 查询出当前用户
        if($search != ''){
            $query->where('username = :username or userid = :userid', [':username' => $search,'userid'=>$search]);
        }
        $query->orderBy("created_at desc");
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["total" => $totalCount, "data" => $res];
    }

    public function getUserprofile() {
        return $this->hasOne(MY_User::className(), ['id' => 'userid']);
    }
}
