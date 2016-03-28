<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 13:23
 */
class Admin_Controller_Index extends Admin_Controller_Abstract
{

    public function indexAction() {

    }

    /**
     * login action
     */
    public function loginAction() {
        $this
            ->setPage('login')
            ->setKey('admin_page')
            ->setContent('Login')
            ->render();
    }

    /**
     * check action
     */
    public function checkAction() {

        $userModel = new Admin_Model_Admin_User();

        $result = $userModel
            ->addFieldToFilter('login',Core_App::getPost('username'))
            ->addFieldToFilter('pass',md5(Core_App::getPost('password')))
            ->load();

        $result = reset($result);

        if(isset($result['id_entity'])) {
            $_SESSION['is_admin_user'] = true;
        }

        header('Location:'.Core_App::getBaseUrl().Config_App::getConfig()['adminurl'].'/dashboard');
    }

    /**
     * render configuration page
     */
    public function configAction() {
        $this
            ->setKey('admin_page')
            ->setPage('admin')
            ->setContentLeft('Config_Left_Left')
            ->setContentRight('Config_Right_Right')
            ->render();
    }

    /**
     * save configuration
     */
    public function saveConfigAction()
    {
        Core_Model_Mongo::insert($_POST);
        header('location:'.Config_App::getConfig()['adminurl'].'/config/');
    }

}