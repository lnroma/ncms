<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 29.02.16
 * Time: 23:44
 */
class Pages_Block_Blog extends Core_Block_Abstract {

    public function __construct()
    {
        $this->setTemplate('pages/blog');
    }

    public function getMenu() {
        $db = Core_Model_Mongo::getDb();
        $collection = $db->selectCollection('menu');
        return $collection->find();
    }

    public function getPages() {
        $db = Core_Model_Mongo::getDb();
        $collection = $db->selectCollection('pages');
        return $collection->find();
    }

}