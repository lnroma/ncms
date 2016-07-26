<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 28.02.16
 * Time: 22:50
 */
namespace Pages\Block\Admin {
    class Edit extends \Core\Block\AbstractClass
    {

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
        public function getPages()
        {
            $connection = \Core\Model\Mongo::getConnect();
            $query = new \MongoDB\Driver\Query(array());
            $allPage = $connection->executeQuery(\Core\Helper::getDb()['mongodb']['db'] . '.pages', $query);
            return $allPage->toArray();
        }

    }
}