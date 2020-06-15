<?php

namespace backend\models;

use common\models\Dirfile;
use backend\models\MY_Dirctory;
use yii\behaviors\TimestampBehavior;
use common\components\MTools;
use Yii;

class MY_Dirfile extends Dirfile {

    public $content;

    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), [
            "content" => "文件内容",
            "url" => "文件地址"
        ]);
    }

    /*
     * 数据验证规则
     */

    public function rules() {
        return array_merge(parent::rules(), [
            ["content", "required", "message" => "文件内容不能为空！"]
        ]);
    }

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

    public function validateCheckExist() {
        $result = MY_Dirfile::findOne(["cid" => $this->cid, "name" => $this->name]);
        if ($result) {
            $this->addError("name", "所输入的文件名已经存在");
        }
    }

    /*
     * 配置列表查询数据
     * return object
     */

    public static function getList() {
        $query = MY_Dirfile::find()->with(["dirID"])->orderBy("created_at desc");
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["total" => $totalCount, "data" => $res];
    }

    /*
     * 关联目录
     */

    public function getDirID() {

        return $this->hasOne(MY_Dirctory::className(), ['id' => 'cid']);
    }

    /*
     * 插入、更新数据
     * @params $data array
     * @params $id int 主键
     * return boolean 
     */

    public static function createData($id = null) {
        $model = $id ? MY_Dirfile::findOne($id) : new MY_Dirfile();

        try {
            $model->load(Yii::$app->request->post());
            $model->cid = Yii::$app->request->post("cid");
            //验证文件是否重复
            !$id ? $model->validateCheckExist() : null;
            if (empty($model->errors)) {
                $file = MY_Dirfile::getFilePath($model->cid, $model->name);
                if ($file !== false) {
                    if (MTools::createFile($file)) {
                        file_put_contents($file, $model->content);
                        return MTools::saveModel($model);
                    }
                } else {
                    return array("errors" => ["name"=>["您填写的目录不存在，请回到目录列表添加文件！"]], "model" => $model);
                }
            } else {
                return array("errors" => $model->getErrors(), "model" => $model);
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    /*
     * 删除记录  及文件
     * @params $cid
     * @params $id
     * return boolean
     */

    public static function deleteData($cid, $id) {
        if ($id && $cid) {
            $model = MY_Dirfile::findOne($id);
            $file = self::getFilePath($cid, $model->name);
            if ($file !== false) {
                if ($model->delete()) {
                    if (MTools::isExist($file)) {
                        unlink($file);
                    }
                    return true;
                }
            }
        }
        return false;
    }

    /*
     * 获取文件 物理地址
     * @params $filename
     * @params $cid
     * return string
     */

    public static function getFilePath($cid, $filename) {
        $dirmod = MY_Dirctory::findOne($cid);
        if ($dirmod instanceof MY_Dictionary) {
            return MTools::setfilepath($dirmod->name . '/' . $filename);
        }
        return false;
    }

}
