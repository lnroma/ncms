<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 13:24
 */
namespace Admin\Controller {
    class AbstractClass extends \Core\Controller\AbstractClass
    {

        /**
         * constructor
         * Admin_Controller_Abstract constructor.
         */
        public function __construct()
        {
            if (
                !$this->_isAllow()
                && \Core\App::getParams()['action'] != 'check'
                && \Core\App::getParams()['action'] != 'login'
            ) {
                throw new \Exception\Forbiden('Forbidden');
            }
        }

        /**
         * set page template
         * @param $pageName
         * @return $this
         */
        public function setPage($pageName)
        {
            $pathToPage = 'admin/page/' . $pageName;

            $blockInstance = $this->getBlockClass('admin_page');
            $blockInstance->setTemplate($pathToPage);

            return $this;
        }

        /**
         * render blocks
         * @return $this
         */
        public function render()
        {
            $this->getBlockClass('admin_page')->toHtml();
            return $this;
        }

        /**
         * check admin section
         * @return bool
         */
        public function _isAllow()
        {
            if (\Core\App::getSessionData('is_admin_user')) {
                return true;
            } else {
                return false;
            }
        }

        /**
         * is login redirect
         * @return null
         */
        public function _isLoginRedirect()
        {
            return \Core\App::getSessionData('login_redirect');
        }

    }
}