<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 13:22
 */
class Admin_Model_Admin_User extends Core_Model_Abstract
{

     public function __construct()
     {
         $this->setTableName('admin_user');
     }

}
