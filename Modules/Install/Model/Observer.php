<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 10.07.16
 * Time: 14:04
 */
class Install_Model_Observer
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
        $request = trim($_SERVER['REQUEST_URI'],'/');

        if(strpos($request,'installSave')!==false) {
            $installController = new Install_Controller_Index();
            $installController->indexAction();
            die;
        }

        include $this->_getTmpPath().'Template/install/index.phtml';
        die;
    }

    /**
     * check locked install by file
     * @return bool
     */
    protected function _checkLockedInstall()
    {
        if(file_exists(\Core\App::getRootPath().'var/install.lock')) {
            return false;
        } else {
            return true;
        }
    }
}