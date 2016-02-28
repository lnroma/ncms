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

}