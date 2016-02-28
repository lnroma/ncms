<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 29.02.16
 * Time: 0:27
 */
class Pages_Menu_Pages extends Core_Model_Abstract
{
    public function __construct()
    {
        $this->setTableName('pages');
    }
}