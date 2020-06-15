<?php
namespace frontend\models;

use common\components\MTools;
use Yii;
Class WB_Lottery extends \yii\db\ActiveRecord
{
  public static function tableName() {
    return 'me_lottery';
  }

  public static function getList($id){
    WB_Lottery::find()->select('*')->where(['=', 'username', $id])->offset(0)->limit(10)->all();
  }
}
?>