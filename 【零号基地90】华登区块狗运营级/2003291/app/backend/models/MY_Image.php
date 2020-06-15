<?php

/*
 * @Filename     : MY_Image
 * @Author       : shuangbrother
 * @Email        : shuangbrother@126.com
 * @create_at    : 2015-12-23
 * @Description  : 
 */

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\models\Image;
use common\components\MTools;
use backend\models\MY_Dictionary;

class MY_Image extends Image {
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

//验证表单域
    public function rules() {
        return array_merge(parent::rules(), [
            ['picpath', 'unique', 'targetClass' => '\common\models\Image', 'message' => '图片已存在.'],
        ]);
    }

    /*
     * 配置列表查询数据
     * return object
     */

    public static function getList() {
        $query = MY_Image::find()->with(["appType", "sizeType"])->orderBy("created_at desc");
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["total" => $totalCount, "data" => $res];
    }

    /*
     * 关联字典表   应用类型
     */

    public function getAppType() {

        return $this->hasOne(MY_Dictionary::className(), ['id' => 'apptype']);
    }

    /*
     * 关联字典表  图片尺寸
     */

    public function getSizeType() {

        return $this->hasOne(MY_Dictionary::className(), ['id' => 'size']);
    }

    /*
     * 插入、更新数据
     * @params $data array
     * @params $id int 主键
     * return boolean 
     */

    public static function createData($id = null) {
        $model = $id ? MY_Image::findOne($id) : new MY_Image();
        try {
            $model->load(Yii::$app->request->post());
            //获取图片尺寸
            $sizefield = $model->size;
            $apptype = $model->apptype;
            $sizes = MY_Dictionary::getOneForID($model->size);
            if ($sizes) {
                list($toW, $toH) = explode("x", $sizes->name);
                $filenames = Yii::$app->imgload->UploadPhoto($model, 'picpath[]', 2, $toW, $toH);
                if (is_array($filenames)) {
                    foreach ($filenames as $filename) {
                        if ($filename !== false) {
                            $model = new MY_Image();
                            $model->size = $sizefield;
                            $model->picpath = $filename;
                            $model->apptype = $apptype;
                            $model->save();
                        }
                    }
                    return true;
                }
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(),[
            "imageurl"=>"图片地址"
        ]);
    }
}
