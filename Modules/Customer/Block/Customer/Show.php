<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 01.08.16
 * Time: 8:31
 */
namespace Customer\Block\Customer {
    class Show extends \Core\Block\AbstractClass
    {
        
        public function __construct()
        {
            $this->setTemplate('customer/show');
        }
    }
}