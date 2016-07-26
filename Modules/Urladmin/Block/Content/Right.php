<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 20:49
 */
namespace Urladmin\Block\Content {
    class Right extends \Core\Block\AbstractClass
    {

        private $_rewrite = null;
        private $_redirect = null;

        public function __construct()
        {
            $this->setTemplate('admin/urladmin/right');
        }

        /**
         * get all rewrite collection
         * @return array|null
         */
        public function getAllRewrite()
        {
            if (!is_null($this->_rewrite)) {
                return $this->_rewrite;
            }
            $model = new \Urladmin\Model\Url();
            $model->addFieldToFilter('type', \Urladmin\Model\Url::REWRITE);
            $this->_rewrite = $model->load();
            return $this->_rewrite;
        }

        /**
         * get all redirect collection
         * @return array|null
         */
        public function getAllRedirect()
        {
            if (!is_null($this->_redirect)) {
                return $this->_redirect;
            }
            $model = new \Urladmin\Model\Url();
            $model->addFieldToFilter('type', \Urladmin\Model\Url::REDIRECT);
            $this->_redirect = $model->load();
            return $this->_redirect;
        }

    }
}