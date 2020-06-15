<?php

namespace backend\models;

/**
 * @author  shuang
 * @date    2016-10-9 7:50:14
 * @version V1.0
 * @desc    
 */
use common\models\Admin;
use Yii;

/**
 * This is the model class for table "me_admin".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $phone
 * @property integer $status
 * @property string $email
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $app_token
 */
class MY_Admin extends \yii\db\ActiveRecord {

    public $repassword;
    public $password;
    public $upadminpwd;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'me_admin';
    }

    public function scenarios() {
        return [
            'create' => ['username', 'phone', 'email', "authids", "password", "repassword"],
            'update' => ['phone', 'email', "authids"],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['username'], 'filter', 'filter' => 'trim'],
            [['username'], 'required', "message" => "用户名不能为空", "on" => ["create"]],
            [['username'], 'unique', 'targetClass' => '\common\models\Admin', 'message' => '用户名已存在', "on" => ["create"]],
            [['username'], 'string', 'min' => 2, 'max' => 255],
            [['phone'], 'filter', 'filter' => 'trim'],
            [['phone'], 'required'],
            [['phone'], "match", "pattern" => "/^((0\\d{2,3}(-){0,1}\\d{7,8})|(1[3584]\\d{9}))$/", "message" => "联系方式格式不正确"],
            [['phone','app_token'], 'string', 'max' => 255],
            [['phone'], 'unique', 'targetClass' => '\common\models\Admin', 'message' => '手机号已存在'],
            [["email"], "required", "message" => "请输入邮箱"],
//            [["email"], "email", "message" => "邮箱格式不正确"],
            [["email"], "unique", "message" => "该邮箱已经被注册，请更换"],
            [['password'], 'required', "message" => "密码不能为空", "on" => ["create"]],
            [['password'], 'string', 'min' => 6, "on" => ["create"]],
            [["repassword"], "required", "on" => ["create"]],
            [["repassword"], "compare", "compareAttribute" => "password", "message" => "两次密码不一致", "on" => ["create"]],
            [['status', 'last_login_at', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /*
     * 设置表字段的中文描述
     * return array
     */

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => '管理员ID',
            'username' => '用户名称',
            'password' => '用户密码',
            "repassword" => "重复密码",
            'created_at' => '用户创建时间',
            'email' => '电子邮箱',
            'icon' => '用户图标',
            'phone' => '联系方式',
            "authids" => "选择权限",
            'updated_at' => '更新时间',
        ];
    }

    /*
     * 配置列表查询数据
     * return object
     */

    public static function getList() {
//        ->where("id != 8")
        $query = MY_Admin::find()->where("id != 8")->orderBy("created_at desc");
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
        $model = $id ? MY_Admin::findOne($id) : new MY_Admin();
        $id ? $model->setScenario('update') : $model->setScenario('create');
        try {
            $model->load(Yii::$app->request->post());
            
            $post = Yii::$app->request->post();
            if($post['upadminpwd'] && $post['upadminpwd'] == 'upadminpwd'){
                if($post['MY_Admin']['password'] != $post['MY_Admin']['repassword']){
                    return false;
                }
                $admin_id = $post['MY_Admin']['id'];
                $admin = Admin::findOne($admin_id);
                if(!$admin){
                    return false;
                }
                $admin->setPassword($model->password);
                $admin->generateAuthKey();
                \common\models\Actionlog::setLog('修改管理员'.$admin->username.'的密码');
                return $admin->save();
            }
            
            $model->authids = $model->authids ? implode(",", $model->authids) : null;
            if (!$model->validate()) {
                return array("errors" => $model->getErrors(), "model" => $model);
            }
            if ($id) {
                \common\models\Actionlog::setLog('编辑管理员'.$model->username.'信息');
                return $model->save();
            } else {
                $user = new Admin();
                $user->username = $model->username;
                $user->phone = $model->phone;
                $user->email = $model->email;
                $user->authids = $model->authids;
                $user->setPassword($model->password);
                $user->generateAuthKey();
                \common\models\Actionlog::setLog('新增管理员'.$model->username);
                return $user->save();
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
}
