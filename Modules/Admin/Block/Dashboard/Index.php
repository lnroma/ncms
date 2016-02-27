<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 17:02
 */
class Admin_Block_Dashboard_Index extends Core_Block_Abstract {

    public function __construct()
    {
        $this->setTemplate('admin/dashboard/index');
    }

}