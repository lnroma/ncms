<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 29.02.16
 * Time: 23:44
 */
class Pages_Block_View extends Core_Block_Abstract {

    /**
     * Pages_Block_View constructor.
     */
    public function __construct()
    {
        $this->setTemplate('pages/view');
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