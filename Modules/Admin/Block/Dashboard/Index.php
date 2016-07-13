<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 17:02
 */
namespace Admin\Block\Dashboard {
    class Index extends \\Core\Block\AbstractClass
    {

        public function __construct()
        {
            $this->setTemplate('admin/dashboard/index');
        }

    }
}