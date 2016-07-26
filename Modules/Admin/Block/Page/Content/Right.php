<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 20:02
 */
namespace Admin\Block\Page\Content {
    /**
     * Class Right
     * @package Admin\Block\Page\Content
     */
    class Right extends \Core\Block\AbstractClass
    {

        public function __construct()
        {
            $this->setTemplate('admin/dashboard/right');
        }

    }
}