<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 19:58
 */
namespace Admin\Block\Config\Left {
    class Left extends \Core_Block_Abstract
    {

        public function __construct()
        {
            $this->setTemplate('admin/config/left');
        }

    }
}