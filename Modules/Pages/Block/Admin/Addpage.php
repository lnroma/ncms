<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 29.02.16
 * Time: 0:23
 */
class Pages_Block_Admin_Addpage extends Core_Block_Abstract
{

    /**
     * Pages_Block_Addpage constructor.
     */
    public function __construct()
    {
        $this->setTemplate('admin/pages/addpage');
    }

    /**
     * get menu
     * @return mixed
     */
    public function getMenu()
    {
        /** @var MongoDB $db */
        $db = Core_Model_Mongo::getDb();
        /** @var MongoCollection $collection */
        $collection = $db->selectCollection('menu');
        return $collection->find();
    }

    /**
     * get page
     * @return array|null
     * @throws Exception
     */
    public function getPage()
    {
        try {
            //if key id not set return empty array
            if(!isset(Core_App::getParams()['id'])) {
                return array();
            }
            /** @var MongoDB $db */
            $db = Core_Model_Mongo::getDb();
            /** @var MongoCollection $collection */
            $collection = $db->selectCollection('pages');

            return $collection->findOne(
                array(
                    '_id' => new MongoId(Core_App::getParams()['id'])
                )
            );

        } catch (Exception $err) {
            throw new Exception('Error with mongo db');
        }
    }

}