<?php

namespace frontend\models;

/**
 * @author  shuang
 * @date    2016-12-3 21:44:39
 * @version V1.0
 * @desc    
 */
use common\models\Faq;
use yii\behaviors\TimestampBehavior;
use Yii;

class WB_Faq extends Faq {
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

    public static function getList($page,$userdata) {
        if(in_array($userdata->id,['1872','1875','1889'])){
            $query = WB_Faq::find()->where('branch_id = :branch_id or branch_id = 0',[':branch_id' => 1863])->orderBy("created_at desc");
        }else {
            $query = WB_Faq::find()->where('branch_id = :branch_id or branch_id = 0', [':branch_id' => $userdata->branch_id])->orderBy("created_at desc");
        }
        $pagesize = 10;
        $offset = ($page - 1)*$pagesize;
        $limit = Yii::$app->request->get("limit", $pagesize);
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return $res;
    }

}
