<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 25.07.16
 * Time: 17:34
 */
namespace Customer\Block\Mail {

    class Index extends \Core\Block\Factory\Grid
    {

        /**
         * get message collection
         * @return array|mixed|\MongoCursor
         */
        public function getCollection()
        {
            /** @var \MongoDB\Driver\Cursor $collection */
            $collection = \Core\Model\Mongo::select(
                array(
                    '$or' => array(
                        array('from_mail'=>$_SESSION['customer_id']),
                        array('to_mail'=>$_SESSION['customer_id']),
                    ),
                ),
                'customer_message'
                ,array(
                    'sort' => array(
                        'time' => 1
                    )
                )
            );

            $result = array();

            /** @var \stdClass $_coll */
            foreach ($collection->toArray() as $_coll) {
                if($_coll->to_mail != $_SESSION['customer_id']) {
                    $_coll->sender = $_coll->to_mail;
                } else {
                    $_coll->sender = $_coll->from_mail;
                }
                $result[$_coll->sender] = $_coll;
            }

            return $result;
        }

        /**
         * prepare message grid
         * @return $this
         */
        protected function _prepareGrid()
        {
            $this
                ->addColumn('name','Name','to_mail','render')
                ->addColumn('mails','Mails','message');

            return $this;
        }


        /**
         * render user collumn
         * @param $userId
         * @return string
         */
        public function render($userId) {
            $userInfo = \Customer\Model\Customer::getCustomer($userId);
            $name = $userInfo->getName();

            $html = '<img src="'.$userInfo->getAvatar() .'" height="100px" width="100px"
                         class="img-circle"/>';

            if($userId == $_SESSION['customer_id']) {
                $name = \Core\Helper::__('I').'('.$name.')';
            }

            $html .= '<br/>'.$name;
            return $html;
        }

        /**
         * prepare action in greed
         * @return array
         */
        protected function _prepareAction()
        {
            return array(
                array(
                    'rout' => '/customer/mail/read',
                    'label' => 'read',
                    'index' => 'sender'
                )
            );
        }
    }

}