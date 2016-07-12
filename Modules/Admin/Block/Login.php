<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 13:21
 */
namespace Admin\Block {
    /**
     * Class Login
     * @package Admin\Block
     */
    class Login extends \Core_Block_Abstract
    {

        public function __construct()
        {
            $this->setTemplate('admin/forms/login');
        }
    }
}