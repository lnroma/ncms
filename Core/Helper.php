<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 28.02.16
 * Time: 19:15
 */
class Core_Helper {

    static public function getUrl($rout) {
        $rout = Core_App::dispathEvent('get_url_helper',$rout);
        return $rout;
    }

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

}