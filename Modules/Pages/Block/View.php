<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 29.02.16
 * Time: 23:44
 */
class Pages_Block_View extends Core_Block_Abstract {

    public function __construct()
    {
        $this->setTemplate('pages/view');
    }

    public function getPage() {
        $db = Core_Model_Mongo::getDb();
        $collection = $db->selectCollection('pages');
        $content = $collection->find(array(
            'key' => Core_App::getParams()['id']
        ));

        $content = iterator_to_array($content);
        $content = reset($content);
        return $content;
    }

}