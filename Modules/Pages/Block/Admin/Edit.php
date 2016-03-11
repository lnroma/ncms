<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 28.02.16
 * Time: 22:50
 */
class Pages_Block_Admin_Edit extends Core_Block_Abstract {

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
        $connection = Core_Model_Mongo::getConnect();
        $query = new MongoDB\Driver\Query(array());
        $allPage = $connection->executeQuery(Config_Db::getConf()['mongodb']['db'].'.pages',$query);
        return $allPage->toArray();
    }

}