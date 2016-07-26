<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 06.03.16
 * Time: 14:47
 */
namespace Postgen\Block {
    class Postgen extends \Core\Block\AbstractClass
    {

        public function __construct()
        {
            $this->setTemplate('postgen/index');
        }

        public function getUserAgent()
        {
            if (isset($_SERVER['HTTP_USER_AGENT'])) {
                return $_SERVER['HTTP_USER_AGENT'];
            } else {
                return '';
            }
        }

    }
}