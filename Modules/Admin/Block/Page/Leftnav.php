<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 17:36
 */
namespace Admin\Block\Page {
    class Leftnav extends \Core_Block_Abstract
    {

        public function __construct()
        {
            $this->setTemplate('admin/navigation/nav');
        }

    }
}