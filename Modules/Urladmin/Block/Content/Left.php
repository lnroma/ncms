<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 20:48
 */
namespace Urladmin\Block\Content {
    class Left extends \Core\Block\AbstractClass
    {

        public function __construct()
        {
            $this->setTemplate('admin/urladmin/left');
        }

    }
}