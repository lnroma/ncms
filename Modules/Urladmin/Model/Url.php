<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 20:45
 */
class Urladmin_Model_Url extends Core_Model_Abstract
{
    public function __construct()
    {
        $this->setTableName('url_rewrite');
    }
}