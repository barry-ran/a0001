<?php

namespace backend\models;

/**
 * @author  shuang
 * @date    2016-12-15 14:11:44
 * @version V1.0
 * @desc    
 */
use common\models\UserServer;
use yii\behaviors\TimestampBehavior;
use Yii;
use common\components\MTools;
use yii\web\User;

class MY_UserServer extends UserServer {
    /*
     * 设置表操作行为动作
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
     * return object
     */

    public static function getList($type = '') {
        if($type){
            $query = MY_UserServer::find()->where('type = :type',[':type' => $type])->orderBy("created_at desc");
        }else{
            $query = MY_UserServer::find()->where('type != 4')->orderBy("created_at desc");
        }

        if (Yii::$app->request->get("search")) {
            $query->andWhere("problem like :search", [":search" => '%' . Yii::$app->request->get("search") . '%']);
        }
        $branch_id= Yii::$app->user->identity->branch_id;
        if ($branch_id != 0) {
            if($branch_id == '1863'){
                $query->andFilterWhere(["in", "branch_id", ['1863', '1872', '1875', '1889']]);
            }else {
                $query->andFilterWhere(["=", "branch_id", $branch_id]);
            }
        }
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["total" => $totalCount, "data" => $res];
    }

    /*
     * 插入、更新数据
     * @params $data array
     * @params $id int 主键
     * return boolean 
     */

    public static function createData($id = null) {
        $model = $id ? MY_UserServer::findOne($id) : new MY_UserServer();
        if($id){
            try {
                $model->load(Yii::$app->request->post());
                $model->status = 2;
                $model->replayd_at = time();
                $model->adminid = Yii::$app->user->id;
                $model->adminname = Yii::$app->user->identity->username;
                \common\models\Actionlog::setLog('回复id为：'.$model->id.'，会员'.$model->username.'的留言');
                return MTools::saveModel($model);

            } catch (Exception $e) {
                throw $e;
            }
        }else{
            try {
                $post = Yii::$app->request->post();
                $userid = $post['MY_UserServer']['userid'];
                $content = $post['MY_UserServer']['content'];
                $user = \common\models\User::findOne($userid);
                if(!$user){
                    Yii::$app->getSession()->setFlash('error', "会员不存在");
                }
                $model->userid = $userid;
                $model->username = $user->username;
                $model->content = $content;
                $model->adminid = Yii::$app->user->id;
                $model->adminname = Yii::$app->user->identity->username;
                $model->type = 4;
                $model->isread = 1;
                $model->branch_id = Yii::$app->user->identity->branch_id;
                $model->created_at = time();
                return MTools::saveModel($model);

            } catch (Exception $e) {
                throw $e;
            }
        }

    }

}
