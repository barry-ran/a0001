<?php

namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * @author  shuang
 * @date    2016-10-11 15:38:29
 * @version V1.0
 * @desc    
 */
class SystemForm extends Model {

    public $fileRootDir; //静态文件目录
    public $admindefaultImage; // 后台默认显示图片
    public $website; //站点根网址
    public $powerby; //网站版权信息
    public $seo_keywords; //站点默认关键字
    public $seo_description; //站点描述
    public $seo_title; //站点标题
    public $beian; //网站备案号

    /**
     * @inheritdoc
     */

    public function rules() {
        return [
            [['fileRootDir', 'admindefaultImage', 'website'], 'required'],
            [['powerby', 'beian'], 'string', 'max' => 100],
            [['seo_keywords', 'seo_description', 'seo_title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'fileRootDir' => '静态文件目录',
            'admindefaultImage' => '后台默认显示图片',
            'website' => '网站地址',
            "powerby" => "网站版权信息",
            'seo_keywords' => '站点默认关键字',
            'seo_description' => '站点描述',
            'seo_title' => '站点标题',
            'beian' => '网站备案号',
        ];
    }

    public function updateParams() {
        if ($this->validate()) {
            $string = "<?php\n return \n [";
            foreach ($this->attributes as $attributes => $value) {
                $string .="'$attributes'=>'$value',";
            }
            $string .= "];";
            return file_put_contents(Yii::getAlias('@backend/config/params.php'), $string);
        } else {
            return ["errors" => $this->getErrors(), "model" => $this];
        }
    }

}
