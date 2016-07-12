<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 20:02
 */
namespace Admin\Block\Page\Content {
    class Right extends \Core_Block_Abstract
    {

        public function __construct()
        {
            $this->setTemplate('admin/dashboard/right');
        }

    }
}