<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 13:24
 */
class Admin_Controller_Abstract extends Core_Controller_Abstract
{

    public function __construct()
    {
        if(
            !$this->_isAllow()
            && Core_App::getParams()['action'] != 'check'
            && Core_App::getParams()['action'] != 'login'
        ) {
            throw new Exception_Forbiden('Forbidden');
        }
    }

    public function setPage($pageName)
    {
        $pathToPage = 'admin/page/'.$pageName;

        $blockInstance = $this->getBlockClass('admin_page');
        $blockInstance->setTemplate($pathToPage);

        return $this;
    }

    public function render()
    {
        $this->getBlockClass('admin_page')->toHtml();
        return $this;
    }

    /**
     * check admin section
     * @return bool
     */
    public function _isAllow() {
        if(Core_App::getSessionData('is_admin_user')) {
            return true;
        } else {
            return false;
        }
    }

    public function _isLoginRedirect() {
        return Core_App::getSessionData('login_redirect');
    }

}