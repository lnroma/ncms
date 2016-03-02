<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 02.03.16
 * Time: 11:45
 */
class Pages_Block_Abstract extends Core_Block_Abstract
{

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


    /**
     * get all pages
     * @return array|mixed
     */
    public function getPage() {
        $db = Core_Model_Mongo::getDb();
        $collection = $db->selectCollection('pages');
        $content = $collection->find(array(
            'key' => Core_App::getParams()['id']
        ));

        $content = iterator_to_array($content);
        $content = reset($content);
        Core_Model_Mongo::getConnect()->close();
        return $content;
    }

    /**
     * @param MongoId $pageId
     * @return mixed
     */
    public function getComentPage($pageId) {
        $db = Core_Model_Mongo::getDb();
        $collection = $db->selectCollection('comments');
        $comments = $collection->find(
            array(
                'page_id' => (string)$pageId
            )
        );
        return $comments;
    }

}