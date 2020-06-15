<?php

namespace backend\models;

/**
 * @author  shuang
 * @date    2016-10-9 16:34:35
 * @version V1.0
 * @desc    
 */
use common\models\Permission;
use backend\models\MY_Mgmt;
use Yii;
use common\components\MTools;
use yii\behaviors\TimestampBehavior;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class MY_Permission extends Permission {
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

    public function rules() {
        return \yii\helpers\ArrayHelper::merge(parent::rules(), [
                    ["name", "unique", "message" => "权限名称不能重复"]
        ]);
    }

    /*
     * 配置列表查询数据
     * return object
     */

    public static function getList() {
        $query = MY_Permission::find()->orderBy("created_at desc");
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
        $model = $id ? MY_Permission::findOne($id) : new MY_Permission();
        try {
            $model->load(Yii::$app->request->post());
            $model->authitems = $model->authitems ? implode(",", $model->authitems) : null;
            
            \common\models\Actionlog::setLog('添加权限：'.$model->name);
            return MTools::saveModel($model);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /*
     * 获取所有的方法
     * return array
     */

    public static function getFunctionsData() {
        $res = MY_Mgmt::find()->where("controller is not null and description is not null and isallowed=0")->select("controller,name,description")->asArray()->all();
        $temp = array();
        foreach ($res as $item) {
            $temp[strtolower($item["controller"]) . "-" . strtolower($item["name"])] = $item["description"];
        }
        return $temp;
    }

    /*
     * 获取所有的权限
     * return array
     */

    public static function getAllpermission() {
        $res = MY_Permission::find()->select("id,name")->asArray()->all();
        $temp = \yii\helpers\ArrayHelper::map($res, 'id', 'name');
        return $temp;
    }

    /*
     * 获取管理员权限
     * @params $id  管理员ID
     * return array
     */

    public static function getAdministratorPrivileges($id) {
        //非公共权限
        $query = (new Query())->select("*")->from(MY_Permission::tableName())->where("find_in_set(id,(select authids from me_admin where id={$id}))")->all();
        $authstring = "";
        foreach ($query as $item) {
            $authstring .= ArrayHelper::getValue($item, "authitems") . ",";
        }
        $notAllowed = array_unique(explode(",", trim($authstring, ",")));
        //公告权限
        $allowed = MY_Mgmt::getPublicFunctions();
        return array_keys(array_flip($notAllowed) + array_flip($allowed));
    }

}
