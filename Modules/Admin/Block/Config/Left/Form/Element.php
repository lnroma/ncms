<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 19.03.16
 * Time: 14:54
 */
namespace Admin\Block\Config\Left\Form {
    /**
     * Class Element
     * @package Admin\Block\Config\Left\Form
     */
    class Element extends \Core_Block_Abstract
    {

        public function __construct()
        {
            $this->setTemplate('admin/config/form/element');
        }

    }
}