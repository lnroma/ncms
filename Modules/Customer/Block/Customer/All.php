<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 25.07.16
 * Time: 17:50
 */
namespace Customer\Block\Customer {
    class All extends \Core\Block\Factory\Grid
    {

        /**
         * get collection for prepare grid
         * @return array|\MongoDB\Driver\Cursor
         */
        public function getCollection()
        {
            $userCollection = \Core\Model\Mongo::selectAll('customer');
            $userCollection = $userCollection->toArray();
            return $userCollection;
        }

        /**
         * prepare grid
         */
        protected function _prepareGrid()
        {
            $this
                ->addColumn('name', 'Name', 'name')
                ->addColumn('email', 'Email', 'email');
        }

        /**
         * prepare action table
         * @return array
         */
        protected function _prepareAction()
        {
            return array(
                array(
                    'rout' => '/customer/mail/send',
                    'label' => 'send mail',
                    'index' => 'id'
                ),
                array(
                    'rout' => '/customer/index/accaunt',
                    'label' => 'accaunt',
                    'index' => 'id'
                )
            );
        }


    }
}