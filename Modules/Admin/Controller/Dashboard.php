<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 16:45
 */
namespace Admin\Controller {
    class Dashboard extends \Admin\Controller\AbstractClass
    {

        /**
         * index action
         */
        public function indexAction()
        {
            $this
                ->setPage('admin')
                ->setKey('admin_page')
                ->setContentLeft('Page\Content\Left')
                ->setContentRight('Page\Content\Right')
                ->setLeft('Page\Leftnav')
                ->render();
        }

    }
}