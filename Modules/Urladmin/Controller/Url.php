<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 20:47
 */
class Urladmin_Controller_Url extends Admin_Controller_Abstract
{

    public function indexAction() {
        $this
            ->setPage('admin')
            ->setKey('admin_page')
            ->setContentLeft('Content_Left')
            ->setContentRight('Content_Right')
            ->render();
    }

    public function addAction() {
        $rewrite = new Urladmin_Model_Url();
        $rewrite->addDataToSave($_POST);
        header('Location:'.Core_App::getBaseUrl().Config_App::getConfig()['adminurl'].'/url/');
    }

}