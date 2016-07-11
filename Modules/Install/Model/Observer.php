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
        if (
            $this->_checkExistConfiguration('Db.php')
            || $this->_checkExistConfiguration('Fs.php')
            || $this->_checkLockedInstall()
        ) {
            $this->_installApplication();
        }
    }

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
        if(file_exists($this->_getTmpPath().'var/install.lock')) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * check exist file configuration
     * @return bool
     */
    protected function _checkExistConfiguration($fileConfig)
    {
        $path = $this->_getTmpPath();
        if (!file_exists($path . 'Config/' . $fileConfig)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * get tmp path to base
     * @return null|string
     */
    protected function _getTmpPath()
    {
        $path = Core_App::getRootPath();
        if (is_null($path)) {
            $path = __FILE__ . '../../../';
        }
        $path = realpath(
            $path
        );
        $path .= '/';

        return $path;
    }
}