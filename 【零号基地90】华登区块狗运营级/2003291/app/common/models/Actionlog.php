<?php

namespace common\models;

use Yii;
use common\components\MTools;

/**
 * This is the model class for table "me_actionlog".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $username
 * @property string $note
 * @property string $ip
 * @property integer $created_at
 * @property integer $updated_at
 */
class Actionlog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_actionlog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'created_at', 'updated_at'], 'integer'],
            [['username', 'ip'], 'string', 'max' => 50],
            [['note'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => '管理员ID',
            'username' => '管理员账号',
            'note' => '备注',
            'ip' => 'Ip',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
    
     /*
     * 配置列表查询数据
     * return object
     */

    public static function getList() {
        $query = Actionlog::find()->orderBy("created_at desc");
        
        $begin_at = Yii::$app->request->get("begin_at");
        $end_at = Yii::$app->request->get("end_at");
        $search = Yii::$app->request->get("search");
        $super_id = 8;
        $query->andFilterWhere(["!=","userid",$super_id]);
        if ($begin_at) {
            $query->andFilterWhere([">=", "created_at", strtotime($begin_at)]);
        }
        if ($end_at) {
            $query->andFilterWhere(["<=", "created_at", strtotime($end_at)]);
        }
        if ($search) {
            $query->andFilterWhere(["like","userid",$search]);
            $query->orFilterWhere(["like","username",$search]); 
        }
        
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["total" => $totalCount, "data" => $res];
    }
    
    public static function setLog($note){
        $model = new \common\models\ActionLog();
        if(Yii::$app->user->identity->username && Yii::$app->user->identity->id){
            $model->username = Yii::$app->user->identity->username;
            $model->userid = Yii::$app->user->identity->id;
            $model->note = date("Y-m-d H:i:s").$note;
            $model->ip = Yii::$app->getRequest()->getUserIP();
//        $model->ip = Yii::$app->getRequest()->getUserIP();
            $model->created_at = time();
            $model->updated_at = time();
            return MTools::saveModel($model);
        }else{
            return false;
        }

    }
}
