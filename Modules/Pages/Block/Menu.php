<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 01.03.16
 * Time: 23:02
 */
class Pages_Block_Menu extends Core_Block_Abstract
{

    /**
     * Pages_Block_Menu constructor.
     */
    public function __construct()
    {
        $this->setTemplate('pages/menu');
    }

    /**
     * get menu
     * @return MongoCursor
     */
    public function getMenu()
    {
        /** @var MongoDB $db */
        $db = Core_Model_Mongo::getDb();
        /** @var MongoCollection $collectionMenu */
        $collectionMenu = $db->selectCollection('menu');
        return $collectionMenu->find();
    }

}