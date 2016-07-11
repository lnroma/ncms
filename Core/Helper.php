<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 28.02.16
 * Time: 19:15
 */
class Core_Helper {

    /**
     * get url routering
     * @param $rout
     * @return mixed
     */
    static public function getUrl($rout) {
        $rout = Core_App::dispathEvent('get_url_helper',$rout);
        return $rout;
    }

    /**
     * translate string
     * @param $string
     * @param array ...$args
     * @return string
     */
    static public function __($string, ...$args) {
        $locale = 'en';

        if(isset($_COOKIE['locale'])) {
            $locale = $_COOKIE['locale'];
        } else {
            if(isset($_SESSION['locale'])) {
                $locale = $_SESSION['locale'];
            }
        }

        $translateArr = include Core_App::getRootPath().'locale'.DIRECTORY_SEPARATOR.$locale.'.php';

        // by default
        $translate = $string;

        if(isset($translateArr[$string])) {
            $translate = $translateArr[$string];
        }

        return vsprintf($translate,$args);
    }

    /**
     * todo realisation function for configuration system
     * @param $key
     * @return null
     */
    static public function getConfig($key)
    {
        return null;
    }

    static $_configClass = null;

    /**
     * get configuration class
     * @return \Core\Configuration|null
     */
    static private function _getConfigClass()
    {
        if(is_null(self::$_configClass)) {
            self::$_configClass = new Core\Configuration();
        }
        return self::$_configClass;
    }

    static public function getDb()
    {
        return self::_getConfigClass()->getDb();
    }

    static public function getFs()
    {
        return self::_getConfigClass()->getFs();
    }
}