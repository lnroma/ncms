<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 29.02.16
 * Time: 0:23
 */
class Pages_Block_Addmenu extends Core_Block_Abstract
{

    public function __construct()
    {
        $this->setTemplate('admin/pages/addmenu');
    }

    public function getMenu() {
        $db = Core_Model_Mongo::getDb();
        $collection = $db->selectCollection('menu');
        return $collection->find();
    }

}