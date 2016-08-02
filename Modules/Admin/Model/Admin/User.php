<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 13:22
 */
namespace Admin\Model\Admin {
    class User extends \Core\Model\AbstractClass
    {

        public function __construct()
        {
            $this->setTableName('admin_user');
        }

    }
}
