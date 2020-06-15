<?php

namespace common\models;

use common\components\MTools;
use Yii;

/**
 * This is the model class for table "me_email_config".
 *
 * @property integer $id
 * @property string $host
 * @property string $port
 * @property string $email
 * @property string $password
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $is_active
 * @property string $encryption
 */
class EmailConfig extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_email_config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at', 'is_active'], 'integer'],
            [['host', 'port', 'email', 'password','encryption'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'host' => '邮件服务商(英文)',
            'port' => '端口号',
            'email' => '邮箱地址',
            'password' => '密码',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'is_active' => '是否启用',
            'encryption' => '加密方式',
        ];
    }
    public static $is_active = [['id'=>1,'name' => '启用'],['id'=>2,'name'=>'未启用']];
    public static $is_active2 = [1 => '启用',2=>'未启用'];

    /*
    * 配置列表查询数据
    * return object
    */

    public static function getList()
    {
        $query = EmailConfig::find();
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

    public static function createData($id = null)
    {
        $model = $id ? EmailConfig::findOne($id) : new EmailConfig();
        try {
            $model->load(Yii::$app->request->post());
//            $model->host = 'smtp.'.$model->host.'.com';
            $model->port = $model->port?$model->port:'25';
            $model->email = $model->email;
            $model->password = $model->password;
            $model->encryption = $model->encryption ? $model->encryption : "tls";
//            if($id){ // 编辑
//                if($model->is_active == 1){ // 启用
//                    $old = EmailConfig::find()->where('is_active = 1')->one();
//                    if($old){
//                        $old->is_active = 2;
//                        $old->save();
//                    }
//                } else{
//                    $old = EmailConfig::find()->orderBy('id desc')->one();
//                    $old->is_active = 1;
//                    $old->save();
//                }
//            } else {
//                if($model->is_active == 1){ // 启用
//                    $old = EmailConfig::find()->where('is_active = 1')->one();
//                    if($old){
//                        $old->is_active = 2;
//                        $old->save();
//                    }
//                }
//                $model->created_at = time();
//            }
            $model->updated_at = time();
            \common\models\Actionlog::setLog('修改成功');
            return MTools::saveModel($model);
        } catch (Exception $e) {
            throw $e;
        }
    }

    // 获取邮箱配置
    public static function getConfig() {
//        $email_config = \common\models\EmailConfig::find()->where(['is_active' => 1])->asArray()->one();

        $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y')); // 今日开始时间戳
        $email_code = EmailCode::find()->where('create_at >= :create_at',[':create_at' => $beginToday])->count();
        $email = \common\models\EmailConfig::find()->asArray()->all();

        if($email_code < 1000){
            $email_config = $email[0];
        } elseif ($email_code >= 1000 && $email_code < 2000) {
            $email_config = $email[1];
        } elseif($email_code >= 2000 && $email_code < 3000){
            $email_config = $email[2];
        } elseif($email_code >= 3000 && $email_code < 4000){
            $email_config = $email[3];
        } else{
            $email_config = $email[4];
        }
        return $email_config;
    }

    public static function setConfig() {
        // 获取邮件配置表数据
        $email_config = EmailConfig::getConfig();
        if(!$email_config){
            Yii::$app->set('mailer', [
                'class' => 'yii\swiftmailer\Mailer',
                'viewPath' => '@common/mail',
                'transport' => [
                    'class' => 'Swift_SmtpTransport',
                    'host' => 'smtp.qy.tom.com',
                    'username' => 'bbablockchain@bba-bt.com',
                    'password' => 'why@1988',
                    'port' => '465',
                    'encryption' => 'ssl',
                ],
                'messageConfig'=>[
                    'charset'=>'UTF-8',
                    'from'=>[$email_config['email']=>'BBA']
                ],
            ]);
        } else {
            Yii::$app->set('mailer', [
                'class' => 'yii\swiftmailer\Mailer',
                'viewPath' => '@common/mail',
                'transport' => [
                    'class' => 'Swift_SmtpTransport',
                    'host' => $email_config['host'],
                    'username' => $email_config['email'],
                    'password' => $email_config['password'],
                    'port' => $email_config['port'],
                    'encryption' => $email_config['encryption'],
                ],
                'messageConfig'=>[
                    'charset'=>'UTF-8',
                    'from'=>[$email_config['email']=>'BBA']
                ],
            ]);
        }
        return true;
    }

}
