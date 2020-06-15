<?php

namespace backend\models;

/**
 * @author  shuang
 * @date    2016-7-1 11:56:14
 * @version V1.0
 * @desc    
 */
use common\models\Mgmt;
use yii\behaviors\TimestampBehavior;
use Yii;
use yii\helpers\Json;
use yii\helpers\Url;

class MY_Mgmt extends Mgmt {
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
     * return object
     */

    public static function getList() {
        $controller = Yii::$app->request->get("controller", null);
        $query = MY_Mgmt::find()->orderBy("ismenu desc, sortid desc");
        if (empty($controller)) {
            $query->where("controller is NUll ");
        } else {
            $query->where("controller='" . $controller . "'");
        }
        $countQuery = clone $query;
        $offset = Yii::$app->request->get("offset");
        $limit = Yii::$app->request->get("limit");
        $totalCount = $countQuery->count();
        $res = $query->offset($offset)->limit($limit)->asArray()->all();
        return ["total" => $totalCount, "data" => $res];
    }

    /*
     * 获取添加的控制器名称
     */

    public static function getControllers() {
        $controllers = self::_getControllers();
        $data = MY_Mgmt::find()->asArray()->all();
        if (!empty($data)) {
            foreach ($data as $item) {
                foreach ($controllers as $key => $controller) {
                    if ($item["name"] . "Controller" === $controller) {
                        unset($controllers[$key]);
                    }
                }
            }
        }
        $item = [];
        foreach ($controllers as $key => $controller) {
            $item[] = [str_replace("Controller", "", $controller)];
        }
        return $item;
    }

    /*
     * 获取所有的控制器
     */

    private static function _getControllers() {
        $contPath = Yii::$app->getControllerPath();
        $controllers = self::_scanDir($contPath);

        //Scan modules
        $modules = Yii::$app->getModules();
        $modControllers = [];
        foreach ($modules as $mod_id => $mod) {
            $moduleControllersPath = Yii::$app->getModule($mod_id)->controllerPath;
            $modControllers = self::_scanDir($moduleControllersPath, $mod_id, "", $modControllers);
        }
        return array_merge($controllers, $modControllers);
    }

    private static function _scanDir($contPath, $module = "", $subdir = "", $controllers = array()) {
        $handle = opendir($contPath);
        $del = '-';
        while (($file = readdir($handle)) !== false) {
            $filePath = $contPath . DIRECTORY_SEPARATOR . $file;
            if (is_file($filePath)) {
                if (preg_match("/^(.+)Controller.php$/", basename($file))) {
                    if (self::checkModule($module)) {
                        $controllers[] = (($module) ? $module . $del : "") .
                                (($subdir) ? $subdir . "." : "") .
                                str_replace(".php", "", $file);
                    }
                }
            } else if (is_dir($filePath) && $file != "." && $file != "..") {
                $controllers = self::_scanDir($filePath, $module, $file, $controllers);
            }
        }
        return $controllers;
    }

    //获取控制器方法名称
    public static function getActions($file) {
        $control = Yii::getAlias('@backend') . '/controllers/' . $file . 'Controller.php';
        if (\common\components\MTools::isExist($control)) {
            $actions = [];
            $h = file($control);
            for ($i = 0; $i < count($h); $i++) {
                $line = trim($h[$i]);
                if (preg_match("/^(.+)function( +)action*/", $line)) {
                    $posAct = strpos(trim($line), "action");
                    $posPar = strpos(trim($line), "(");
                    $string = trim(substr(trim($line), $posAct, $posPar - $posAct));
                    if ($string !== "actions") {
                        //查看方法是否已经导入
                        $condition = "name='" . str_replace("action", "", $string) . "' and controller='$file'";
                        if (!MY_Mgmt::find()->where($condition)->one()) {
                            array_push($actions, str_replace("action", "", $string));
                        }
                    }
                }
            }
            $actionList = Yii::$app->createControllerByID(strtolower($file))->actions();
            foreach ($actionList as $key => $value) {
                $condition = "name='" . $key . "' and controller='$file'";
                if (!MY_Mgmt::find()->where($condition)->one()) {
                    array_push($actions, $key);
                }
            }
            $data = [];
            foreach (array_unique($actions) as $action) {
                array_push($data, [$action, $file]);
            }
            return $data;
        } else {
            return false;
        }
    }

    private static function checkModule($module) {
        if (empty($module) || !in_array($module, ["debug", "gii"])) {
            return true;
        }
        return false;
    }

    /*
     * 获取菜单依赖数据
     */

    public static function getMenuDepends() {
        $condition = "ismenu=1 and controller is not null";
        $data = MY_Mgmt::find()->where($condition)->asArray()->all();
        $temp = [];
        foreach ($data as $item) {
            $temp[] = ["id" => $item["name"] . "--" . $item["controller"], "name" => $item["menuname"]];
        }
        return $temp;
    }

    /*
     * 获取后台管理导航菜单
     */

    public static function getMenuData() {
        $data = MY_Mgmt::find()->where("ismenu=1")->orderBy("sortid desc")->asArray()->all();
        $temp = [];
        foreach ($data as $item) {
            if ($item["controller"]) {
                $temp[$item["controller"]]["son"][] = ["title" => $item["menuname"], "url" => $item["name"]];
            } else {
                if (!isset($temp[$item["name"]])) {
                    $temp[$item["name"]] = ["title" => $item["menuname"], "controller" => $item["name"], "sortid" => $item["sortid"], "son" => []];
                }
            }
        }
        return $temp;
    }

    /*
     * 获取后台管理快捷菜单
     * @params $shorttype
     * return array
     */

    public static function getShortcutData($shorttype) {
        $data = MY_Mgmt::find()->where("shorttype=$shorttype")->andWhere("shortcut=1")->orderBy("sortid desc")->asArray()->all();
        $temp = [];
        foreach ($data as $item) {
            $temp[] = ["url" => strtolower($item["controller"]) . "/" . strtolower($item["name"]), "title" => $item["menuname"], "icon" => $item["icon"]];
        }
        return $temp;
    }

    /*
     * 设置菜单选中及操作位置
     * @params $route
     */

    public static function setActivePlace($route) {
        $shorttype = 0;
        if ($route && Yii::$app->defaultRoute !== $route) {
            list($controller, $action) = explode("/", $route);
            $condition = "name ='$action' and controller='" . ucfirst($controller) . "'";
            $model = MY_Mgmt::find()->where($condition)->one();
            if ($model instanceof MY_Mgmt) {
                $shorttype = $model->shorttype;
                if (strstr($model->depends, "--")) { //设置选中菜单
                    $depends = explode('--', $model->depends);
                    $route = strtolower($depends[1] . '/' . $depends[0]);
                }
                //获取位置
                $breadcrumbs = Json::decode($model->breadcrumbs, true);
                if (is_array($breadcrumbs)) {
                    foreach ($breadcrumbs as $key => $item) {
                        if (isset($item["params"])) {
                            $params = explode(",", $item["params"]);
                            foreach ($params as $param) {
                                $link[$param] = Yii::$app->request->get($param);
                            }
                            array_unshift($link, $item["url"]);
                            $breadcrumbs[$key]["url"] = Url::toRoute($link);
                        } else {
                            if ($item["url"] !== "javascript:;") {
                                $breadcrumbs[$key]["url"] = Url::toRoute([$item["url"]]);
                            }
                        }
                    }
                    array_unshift($breadcrumbs, ["label" => "首页", "url" => Yii::$app->homeUrl]);
                } else {
                    $breadcrumbs = [["label" => "首页", "url" => Yii::$app->homeUrl]];
                }
            } else {
                $breadcrumbs = [["label" => "首页", "url" => Yii::$app->homeUrl]];
            }
        } else {
            $breadcrumbs = [];
        }
        return ["route" => $route, "breadcrumbs" => $breadcrumbs, "shorttype" => $shorttype];
    }

    /*
     * 获取公共方法
     * return array
     */

    public static function getPublicFunctions() {
        $res = MY_Mgmt::find()->where("isallowed=1")->asArray()->all();
        $temp = [];
        foreach ($res as $item) {
            $temp[] = $item["module"] ? strtolower($item["module"])."-" : strtolower($item["controller"])."-".strtolower($item["name"]);
        }
        return $temp;
    }

    public static $shorttype = [1 => "常用工具", 2 => "系统设置", 0 => "否"];
    public static $shortcut = [1 => "是", 0 => "否"];

}
