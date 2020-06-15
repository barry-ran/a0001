<?php

namespace frontend\models;

/**
 * @author  shuang
 * @date    2016-12-3 21:44:39
 * @version V1.0
 * @desc    
 */
use common\models\Article;
use yii\behaviors\TimestampBehavior;
use Yii;

class WB_Article extends Article {
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

    public static function getList($page,$type) {
        $query = WB_Article::find()->where('typeid = :typeid', [':typeid' => $type])->orderBy("created_at desc");
        $pagesize = 10;
        $offset = ($page - 1)*$pagesize;
        $limit = Yii::$app->request->get("limit", $pagesize);
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return $res;
    }

}
