<?php

namespace backend\models;

/**
 * @author  shuang
 * @date    2016-8-2 10:58:26
 * @version V1.0
 * @desc    
 */
use common\models\Faq;
use yii\behaviors\TimestampBehavior;
use common\components\MTools;
use Yii;

class MY_Faq extends Faq {
    /*
     * 设置表操作行为动作
     * return array
     */

    public function behaviors() {
        return[
            [
                'class' => TimestampBehavior::className()
            ]
        ];
    }

    /*
     * 配置列表查询数据
     * 条件
     * @params $pid
     * @params $typeid
     * @params $title
     * return object
     */

    public static function getList($pid , $typeid , $title) {

        $query = MY_Faq::find()->orderBy("created_at desc");

        $pid > 0 ? $query->where("pid='$pid'") : null;
        $typeid > 0 ? $query->andWhere("typeid='$typeid'") : null;
        $title ? $query->andWhere("title like '%$title%'") : null;

        if(Yii::$app->user->identity->branch_id != 0){
            $query->andFilterWhere(["=","branch_id",Yii::$app->user->identity->branch_id]);
        }
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["total" => $totalCount, "data" => $res];
    }

    /*
     * 关联字典表  所属列别
     */

    public function getTypeID() {

        return $this->hasOne(MY_Dictionary::className(), ['id' => 'typeid']);
    }

    /*
     * 插入、更新数据
     * @params $data array
     * @params $id int 主键
     * return boolean 
     */

    public static function createData($id = null) {

        $model = $id ? MY_Faq::findOne($id) : new MY_Faq();
        $branch_id = Yii::$app->user->identity->branch_id;
        try {
            $model->load(Yii::$app->request->post());
            $model->flags ? $model->flags = implode(",", $model->flags) : null;
            $model->senddate = time();//strtotime($model->senddate);
            $filename = Yii::$app->imgload->UploadPhoto($model, 'thumb');
            if ($filename !== false) {
                $model->thumb = $filename;
                $model->branch_id = $branch_id>0?$branch_id:0;
            }
            if($id){
                \common\models\Actionlog::setLog('编辑常见问题：'.$model->title.'的信息');
            }else{
                \common\models\Actionlog::setLog('新增常见问题：'.$model->title);
            }
            return MTools::saveModel($model);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static $flags = [ "h" => "商户", "c" => "刷手"];
    

}
