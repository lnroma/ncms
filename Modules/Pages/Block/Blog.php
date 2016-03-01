<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 29.02.16
 * Time: 23:44
 */
class Pages_Block_Blog extends Core_Block_Abstract {

    /**
     * Pages_Block_Blog constructor.
     */
    public function __construct()
    {
        $this->setTemplate('pages/blog');
    }

    /**
     * get menu
     * @return mixed
     */
    public function getMenu() {
        /** @var MongoDB $db */
        $db = Core_Model_Mongo::getDb();
        /** @var MongoCollection $collection */
        $collection = $db->selectCollection('menu');
        return $collection->find();
    }

    /**
     * get pages
     * @return mixed
     */
    public function getPages() {
        /** @var MongoDB $db */
        $db = Core_Model_Mongo::getDb();
        /** @var MongoCollection $collection */
        $collection = $db->selectCollection('pages');
        return $collection->find();
    }

}