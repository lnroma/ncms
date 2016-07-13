<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 18.02.16
 * Time: 14:14
 */
class Contact_Model_Contact extends \Core\Model\AbstractClass {

    public function __construct()
    {
        $this->setTableName('contacts_entity');
    }

}