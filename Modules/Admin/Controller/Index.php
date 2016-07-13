<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 13:23
 */
namespace Admin\Controller {
    class Index extends \Admin\Controller\AbstractClass
    {

        public function indexAction()
        {

        }

        /**
         * login action
         */
        public function loginAction()
        {
            $this
                ->setPage('login')
                ->setKey('admin_page')
                ->setContent('Login')
                ->render();
        }

        /**
         * check action
         */
        public function checkAction()
        {

            $userModel = new \Admin_Model_Admin_User();

            $result = $userModel
                ->addFieldToFilter('login', \Core\App::getPost('username'))
                ->addFieldToFilter('pass', md5(\Core\App::getPost('password')))
                ->load();

            $result = reset($result);

            if (isset($result['id_entity'])) {
                $_SESSION['is_admin_user'] = true;
            }

            header('Location:' . \Core\App::getBaseUrl() . \Config\App::getConfig()['adminurl'] . '/dashboard');
        }

        /**
         * render configuration page
         */
        public function configAction()
        {
            $this
                ->setKey('admin_page')
                ->setPage('admin')
                ->setContentLeft('Config\Left\Left')
                ->setContentRight('Config\Right\Right')
                ->render();
        }

        /**
         * save configuration
         */
        public function saveConfigAction()
        {
            \Core\Model\Mongo::insert($_POST);
            header('location:' . \Config\App::getConfig()['adminurl'] . '/config/');
        }

    }
}