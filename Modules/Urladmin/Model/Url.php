<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 20:45
 */
class Urladmin_Model_Url extends Core_Model_Abstract
{
    const REWRITE = 0;
    const REDIRECT = 1;

    public function __construct()
    {
        $this->setTableName('url_rewrite');
    }
}