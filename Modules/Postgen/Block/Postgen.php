<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 06.03.16
 * Time: 14:47
 */
class Postgen_Block_Postgen extends Core_Block_Abstract {

    public function __construct()
    {
        $this->setTemplate('postgen/index');
    }

    public function getUserAgent() {
        if(isset($_SERVER['HTTP_USER_AGENT'])) {
            return $_SERVER['HTTP_USER_AGENT'];
        } else {
            return '';
        }
    }

}