<?php

/*
 * file : MY_Dictionary
 * author: shuang
 * email : shuangbrother@126.com
 * created_at : 2015-12-9 -- 10:44:26
 */

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\models\Dictionary;
use common\components\MTools;

class MY_Dictionary extends Dictionary {
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
     * 设置表字段的中文描述
     * return array
     */

    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), [
            "name" => "通用名称",
            "column_id" => "通用父级ID",
            "description" => "通用描述",
            "created_at" => "创建时间",
            "updated_at" => "更新时间",
            "min" => "最大值",
            "max" => "最小值",
            "icon" => "上传图标",
            "sortid" => "排序"
        ]);
    }

    //验证表单域
    public function rules() {
        return array_merge(parent::rules(), [
            ["name", "required", "message" => "通用名称不能为空"],
            ["name", "unique", "message" => "通用名称已存在"],
        ]);
    }

    /*
     * 插入、更新数据
     * @params $data array
     * @params $id int 主键
     * return boolean 
     */

    public static function createData($id = null) {
        $model = $id ? MY_Dictionary::findOne($id) : new MY_Dictionary();
        try {
            $model->load(Yii::$app->request->post());
            $filename = Yii::$app->imgload->UploadPhoto($model, 'icon');
            if ($filename !== false) {
                $model->icon = $filename;
            }
            if ($model->column_id) {
                $res = self::getSortId($model->column_id);
                if ($res && $res[0]["sortid"] > 0) {
                    $model->sortid = intval($res[0]["sortid"]) + 1;
                } else {
                    $model->sortid = mt_rand(1001, 1999);
                }
            }
            return MTools::saveModel($model);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /*
     * 配置列表查询数据
     * @params $column_id
     * return object
     */

    public static function getList($column_id = null) {
        $query = MY_Dictionary::find()->where(["column_id" => $column_id])->orderBy("sortid desc");
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["total" => $totalCount, "data" => $res];
    }

    /*
     * 获取分类的排序
     * @params $column_id
     * return array
     */

    public static function getSortId($column_id) {
        $query = MY_Dictionary::find();
        $res = $query->where(["column_id" => $column_id])->orderBy("sortid desc")->all();
        $temp = [];
        if ($res) {
            foreach ($res as $var) {
                array_push($temp, array("id" => $var->id, "sortid" => $var->sortid));
            }
        }
        return $temp;
    }

    /*
     * 获取字典值
     * @params $id
     */

    public static function getOneForID($id) {
        $res = MY_Dictionary::findOne($id);
        if ($res instanceof MY_Dictionary) {
            return $res;
        }
        return false;
    }

    /*
     * 获取字典信息
     */

    public static function getDictAllInfo() {
        $res = MY_Dictionary::find()->all();
        $temp = [];
        foreach ($res as $item) {
            if ($item->column_id === 0) {
                $temp[$item->id] = $item->attributes;
            } else {
                $temp[$item->column_id]["son"][] = $item->attributes;
            }
        }
        return $temp;
    }

}
