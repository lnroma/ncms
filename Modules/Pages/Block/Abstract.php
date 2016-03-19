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

        $con = Core_Model_Mongo::getConnect();

        $query = new MongoDB\Driver\Query(
            array()
        );

        $menuCollection = $con->executeQuery(Config_Db::getConf()['mongodb']['db'].'.menu',$query);

        return $menuCollection->toArray();
    }

    /**
     * get pages
     * @return mixed
     */
    public function getPages() {
        /** @var MongoDB $db */
        $con = Core_Model_Mongo::getConnect();

        $query = new MongoDB\Driver\Query(
            array()
        );

        $menuCollection = $con->executeQuery(Config_Db::getConf()['mongodb']['db'].'.pages',$query);

        return $menuCollection->toArray();
    }


    /**
     * get all pages
     * @return array|mixed
     */
    public function getPage() {
        /** @var MongoDB $db */
        return Core_Model_Mongo::simpleSelect('key',Core_App::getParams()['id'],'pages')->toArray();
    }

    /**
     * @param MongoId $pageId
     * @return mixed
     */
    public function getComentPage($pageId) {
        return Core_Model_Mongo::simpleSelect('page',$pageId,'comments')->toArray();
    }

}