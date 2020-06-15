<?php

namespace common\widgets;

use yii\base\Widget;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * @author  shuang
 * @date    2016-10-13 16:51:02
 * @version V1.0
 * @desc    
 */
class Toolbar extends Widget {

    public $barClass = "toolbar";
    public $buttons = [];

    /*
     * 配置按钮
     */

    public function getButtons() {
        $string = "";
        $auth = \common\components\MTools::getAdministratorPrivileges();
        foreach ($this->buttons as $url => $item) {
            $string .= $this->getButton($url, $item, $auth);
        }
        return $string;
    }

    /*
     * 获取按钮
     * @params $url
     * @params $item
     * @params $auth default false
     */

    protected function getButton($url, $item, $auth = false) {
        $href = $this->setUrl($url, ArrayHelper::getValue($item, "params"));
        if ($auth === false) {
            $flag = true;
        } else {
            $flag = in_array(str_replace("/", "-", str_replace(".html", "", trim(substr($href,0,strlen($href) - strlen(strstr($href,"?"))), "/"))), $auth);
        }
        $string = "";
        if ($flag) {
            $string .="<li>";
            $string .= Html::beginTag("a", ArrayHelper::merge(ArrayHelper::getValue($item, "options", []), ["href" => $href]));
            $string .="<span>";
            $string .= Html::img($this->getIcon[$item["icon"]], ["alt" => $item["title"]]);
            $string .="</span>" . $item["title"] . "</a></li>";
        }
        return $string;
    }

    /*
     * 获取权限
     */

    protected function getAuth() {
        if (\common\components\MTools::getYiiParams("auth") === true) {
            return \backend\models\MY_Permission::getAdministratorPrivileges(Yii::$app->user->id);
        }
        return false;
    }

    /*
     * 配置URL
     * @params $url
     * @params $params
     * return string
     */

    protected function setUrl($url, $params = null) {
        if ($url === "javascript:;" || strstr($url, "#")) {
            return $url;
        } else {
            if (!is_array($params)) {
                $params = [];
            }
            array_unshift($params, $url);
            return Url::toRoute($params);
        }
    }

    /*
     * 配置按钮图标
     * @params $icon
     * return string
     */

    protected $getIcon = [
        "create" => "/images/t01.png",
        "edit" => "/images/t02.png",
        "delete" => "/images/t03.png",
        "count" => "/images/t04.png",
        "setting" => "/images/t05.png"
    ];

    public function init() {
        echo Html::beginTag("div", ["class" => "tools", "id" => "toolbar"]);
        echo Html::beginTag("ul", ["class" => $this->barClass]);
        echo $this->getButtons();
        echo Html::endTag("ul");
        echo Html::endTag("div");
    }

    public function run() {
        
    }

}
