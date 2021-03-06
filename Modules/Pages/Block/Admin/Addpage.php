<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 29.02.16
 * Time: 0:23
 */
namespace Pages\Block\Admin {
    class Addpage extends \Core\Block\AbstractClass
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
            $connection = \Core\Model\Mongo::getConnect();
            $query = new \MongoDB\Driver\Query(array());
            $allMenu = $connection->executeQuery(\Core\Helper::getDb()['mongodb']['db'] . '.menu', $query);
            return $allMenu->toArray();
        }

        /**
         * get page
         * @return array|null
         * @throws \Exception
         */
        public function getPage()
        {
            try {
                //if key id not set return empty array
                if (!isset(\Core\App::getParams()['id'])) {
                    return array();
                }

                $connection = \Core\Model\Mongo::getConnect();
                $query = new \MongoDB\Driver\Query(
                    array(
                        '_id' => new \MongoDB\BSON\ObjectID(\Core\App::getParams()['id'])
                    )
                );

                $page = $connection->executeQuery(\Core\Helper::getDb()['mongodb']['db'] . '.pages', $query);
                return $page->toArray();
            } catch (\Exception $err) {
                throw new \Exception('Error with mongo db');
            }
        }

    }
}