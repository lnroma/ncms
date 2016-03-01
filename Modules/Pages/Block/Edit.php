<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 28.02.16
 * Time: 22:50
 */
class Pages_Block_Edit extends Core_Block_Abstract {

    /**
     * Pages_Block_Edit constructor.
     */
    public function __construct()
    {
        $this->setTemplate('admin/pages/edit');
    }

    /**
     * get pages
     * @return mixed
     */
    public function getPages() {
        $db = Core_Model_Mongo::getDb();
        $collection = $db->selectCollection('pages');
        return $collection->find();
    }

}