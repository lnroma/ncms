<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 29.02.16
 * Time: 23:44
 */
namespace Pages\Block {
    class Viewmenu extends \Pages\Block\AbstractClass
    {

        /**
         * Pages_Block_Viewmenu constructor.
         */
        public function __construct()
        {
            $this->setTemplate('pages/blog');
        }

        /**
         * get all pages
         * @return array|mixed
         */
        public function getPages()
        {
            /** @var MongoDB $db */
            $con = \Core\Model\Mongo::getConnect();

            $query = new \MongoDB\Driver\Query(
                array(
                    'menu_key' => \Core\App::getParams()['id']
                )
            );

            $menuCollection = $con->executeQuery(\Core\Helper::getDb()['mongodb']['db'] . '.pages', $query);

            return $menuCollection->toArray();
        }
    }
}