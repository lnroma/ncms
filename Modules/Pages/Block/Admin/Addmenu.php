<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 29.02.16
 * Time: 0:23
 */
class Pages_Block_Admin_Addmenu extends Core_Block_Abstract
{

    /**
     * Pages_Block_Addmenu constructor.
     */
    public function __construct()
    {
        $this->setTemplate('admin/pages/addmenu');
    }

    /**
     * get menu tree
     * @return mixed
     */
    public function getMenu() {
        /** @var MongoDB $db */
        $db = Core_Model_Mongo::getDb();
        /** @var MongoCollection $collection */
        $collection = $db->selectCollection('menu');
        return $collection->find();
    }

}