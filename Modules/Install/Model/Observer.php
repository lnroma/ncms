<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 10.07.16
 * Time: 14:04
 */
namespace Install\Model {
    class Observer
    {
        /**
         * check installed application and run this install
         */
        public function runInstall()
        {
            if ($this->_checkLockedInstall()) {
                $this->_installApplication();
            }
        }

        /**
         * proced install application
         */
        protected function _installApplication()
        {
            $request = trim($_SERVER['REQUEST_URI'], '/');

            if (strpos($request, 'installSave') !== false) {
                $installController = new \Install\Controller\Index();
                $installController->indexAction();
                die;
            }

            $installForm = new \Core\Block\AbstractClass();
            $installForm->setAbsoluteTemplate(\Core\App::getRootPath() . 'Template' . DIRECTORY_SEPARATOR . 'install' . DIRECTORY_SEPARATOR . 'index.phtml');
            $installForm->toHtml();
//        include \Core\App::getRootPath().'Template/install/index.phtml';
            die;
        }

        /**
         * check locked install by file
         * @return bool
         */
        protected function _checkLockedInstall()
        {
            if (file_exists(\Core\App::getRootPath() . 'var/install.lock')) {
                return false;
            } else {
                return true;
            }
        }
    }
}