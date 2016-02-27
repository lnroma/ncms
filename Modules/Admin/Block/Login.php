<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 13:21
 */
class Admin_Block_Login extends Core_Block_Abstract
{

    public function __construct()
    {
        $this->setTemplate('admin/forms/login');
    }
}