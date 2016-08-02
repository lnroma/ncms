<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.07.16
 * Time: 9:00
 */
namespace Customer\Block\Mail 
{
    class Read extends \Core\Block\Factory\Grid
    {
        private $_userData = array();
        /**
         * get collection
         * @return \MongoDB\Driver\Cursor
         */
        public function getCollection()
        {
            $sender = \Core\App::getParams();
            $sender = $sender['sender'];

            /** @var \MongoDB\Driver\Cursor $collection */
            $collection = \Core\Model\Mongo::select(
                array(
                    '$or' => array(
                        array(
                            'from_mail'=>$_SESSION['customer_id'],
                            'to_mail'=>$sender,
                        ),
                        array(
                            'to_mail'=>$_SESSION['customer_id'],
                            'from_mail' => $sender,
                        ),
                    ),
                ),
                'customer_message'
                , $this->_optionsCollection()
            );
            
            return $collection;
        }

        /**
         * prepare grid
         * @return $this
         */
        protected function _prepareGrid()
        {
            $this
                ->addColumn('name','Name','from_mail','render')
                ->addColumn('message','Message','message')
                ->addColumn('read','Status','read','renderReadStatus');

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

            $html .= '
            <span class="glyphicon glyphicon-user">'.$name.'</span>
            ';
            return $html;
        }

        public function renderReadStatus($readStatus)
        {
            if($readStatus == false) {
                return \Core\Helper::__('not read');
            } else {
                return \Core\Helper::__('read');
            }
        }

    }
}