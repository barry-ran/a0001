<?php

namespace backend\models;

/**
 * @author  shuang
 * @date    2016-8-4 16:12:20
 * @version V1.0
 * @desc    
 */
use yii\behaviors\TimestampBehavior;
use common\components\MTools;
use Yii;
use common\models\StaticFile;

class MY_StaticFile extends StaticFile {
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
     * return object
     */

    public static function getList() {
        $query = MY_StaticFile::find()->with(["dHttp", "dFiletype","dDir"])->orderBy("created_at desc");
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["total" => $totalCount, "data" => $res];
    }

    /*
     * 关联字典表  允许访问地址
     */

    public function getDHttp() {

        return $this->hasOne(MY_Dictionary::className(), ['id' => 'http']);
    }

    /*
     * 关联字典表 生成文件类型
     */

    public function getDFiletype() {

        return $this->hasOne(MY_Dictionary::className(), ['id' => 'filetype']);
    }
      /*
     * 关联字典表 目录
     */

    public function getDDir() {

        return $this->hasOne(MY_Dictionary::className(), ['id' => 'dir']);
    }

    /*
     * 插入、更新数据
     * @params $data array
     * @params $id int 主键
     * return boolean 
     */

    public static function createData($id = null) {
        $model = $id ? MY_StaticFile::findOne($id) : new MY_StaticFile();
        try {
            $model->load(Yii::$app->request->post());
            return MTools::saveModel($model);
        } catch (Exception $e) {
            throw $e;
        }
    }
    /*
     * 获取静态资源文件内容
     * @params $path
     * return string | array |  json
     */

    public static function getFileContent($path) {
        if (MTools::isExist($path)) {
            return require $path;
        }
        return false;
    }

}
