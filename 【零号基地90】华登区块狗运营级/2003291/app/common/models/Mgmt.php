<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "me_mgmt".
 *
 * @property string $name
 * @property integer $ismenu
 * @property integer $shortcut
 * @property integer $shorttype
 * @property string $menuname
 * @property string $module
 * @property string $description
 * @property string $controller
 * @property string $depends
 * @property integer $isallowed
 * @property integer $sortid
 * @property string $breadcrumbs
 * @property string $icon
 * @property integer $created_at
 * @property integer $updated_at
 */
class Mgmt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_mgmt';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['ismenu', 'shortcut', 'shorttype', 'isallowed', 'sortid', 'created_at', 'updated_at'], 'integer'],
            [['breadcrumbs'], 'string'],
            [['name', 'controller', 'depends'], 'string', 'max' => 50],
            [['menuname', 'module'], 'string', 'max' => 20],
            [['description', 'icon'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => '名称',
            'ismenu' => '导航菜单',
            'shortcut' => '快捷方式',
            'shorttype' => '快捷类型',
            'menuname' => '菜单说明',
            'module' => '模型名称',
            'description' => '功能描述',
            'controller' => '控制器名称',
            'depends' => '依赖菜单',
            'isallowed' => '是否共用',
            'sortid' => '排序',
            'breadcrumbs' => '操作位置',
            'icon' => '图标',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
}
