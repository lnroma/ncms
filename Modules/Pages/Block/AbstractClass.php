<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 02.03.16
 * Time: 11:45
 */
namespace Pages\Block {
    class AbstractClass extends \Core\Block\AbstractClass
    {

        /**
         * get menu
         * @return mixed
         */
        public function getMenu()
        {
            /** @var MongoDB $db */

            $con = \Core\Model\Mongo::getConnect();

            $query = new \MongoDB\Driver\Query(
                array()
            );
            $menuCollection = $con->executeQuery(\Core\Helper::getDb()['mongodb']['db'] . '.menu', $query);

            return $menuCollection->toArray();
        }

        /**
         * get pages
         * @return mixed
         */
        public function getPages()
        {
            /** @var MongoDB $db */
            $con = \Core\Model\Mongo::getConnect();

            $query = new \MongoDB\Driver\Query(
                array()
            );

            $menuCollection = $con->executeQuery(\Core\Helper::getDb()['mongodb']['db'] . '.pages', $query);

            return $menuCollection->toArray();
        }


        /**
         * get all pages
         * @return array|mixed
         */
        public function getPage()
        {
            /** @var \MongoDB $db */
            return \Core\Model\Mongo::simpleSelect('key', \Core\App::getParams()['id'], 'pages')->toArray();
        }

        /**
         * @param MongoId $pageId
         * @return mixed
         */
        public function getComentPage($pageId)
        {
            return \Core\Model\Mongo::simpleSelect('page', $pageId, 'comments')->toArray();
        }

    }
}