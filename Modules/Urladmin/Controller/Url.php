<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 20:47
 */
namespace Urladmin\Controller {
    class Url extends \Admin\Controller\AbstractClass
    {

        public function indexAction()
        {
            $this
                ->setPage('admin')
                ->setKey('admin_page')
                ->setContentLeft('Content\Left')
                ->setContentRight('Content\Right')
                ->render();
        }

        public function addAction()
        {
            $rewrite = new \Urladmin\Model\Url();
            $rewrite->addDataToSave($_POST);
            header('Location:' . \Core\App::getBaseUrl() . \Config\App::getConfig()['adminurl'] . '/url/');
        }

    }
}