<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 20:49
 */
class Urladmin_Block_Content_Right extends Core_Block_Abstract
{

    private $_rewrite = null;

    public function __construct()
    {
        $this->setTemplate('admin/urladmin/right');
    }

    public function getAllRewrite() {
        if(!is_null($this->_rewrite)) {
            return $this->_rewrite;
        }
        $model = new Urladmin_Model_Url();
        $this->_rewrite = $model->load();
        return $this->_rewrite;
    }

}