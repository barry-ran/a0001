<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_recharge".
 *
 * @property integer $id
 * @property integer $userid
 * @property integer $username
 * @property string $hcg
 * @property string $money
 * @property string $scale
 * @property integer $created_at
 */
class Recharge extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_recharge';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'created_at'], 'integer'],
            [['hcg', 'money', 'scale'], 'number'],
            [['username'], 'string', 'max' => 11],
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
            'hcg' => '获得积分',
            'money' => '充值面额',
            'scale' => '充值比例',
            'created_at' => '创建时间',
        ];
    }

    public static function getList(){
        $query = self::find()->orderBy("created_at desc");
        $search = Yii::$app->request->get("search");
        $created_at = Yii::$app->request->get("created_at");

        if ($search) {
            $query->andFilterWhere(["=", "username", $search]);
        }
        if ($created_at) {
            $query->andFilterWhere([">=", "created_at", strtotime($created_at)]);
        }
        $res = $query->createCommand()->getRawSql();
        $countQuery = clone $query;

        $offset = Yii::$app->request->get("offset");//0

        $limit = Yii::$app->request->get("limit");//10

        $totalCount = $countQuery->count();

        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["total" => $totalCount, "data" => $res];
    }
}
