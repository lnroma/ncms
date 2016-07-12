<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 20:02
 */
namespace Admin\Block\Page\Content {
    /**
     * Class Left
     * @package Admin\Block\Page\Content
     */
    class Left extends \Core_Block_Abstract
    {

        public function __construct()
        {
            $this->setTemplate('admin/dashboard/left');
        }

    }
}