<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 19:58
 */
namespace Admin\Block\Config {
    /**
     * Class Index
     * @package Admin\Block\Config
     */
    class Index extends \Core\Block\AbstractClass
    {
        
        public function __construct()
        {
            $this->setTemplate('admin/config/index');
        }

    }
}