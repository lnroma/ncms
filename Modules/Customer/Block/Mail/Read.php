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
                ->addColumn('message','Message','message');

            return $this;
        }

        protected function _getUserInfo($userId)
        {
            if(isset($this->_userData[$userId])) {
                return $this->_userData[$userId];
            }

            $userInfo = \Core\Model\Mongo::simpleSelect('id',$userId,'customer');
            $userInfo = $userInfo->toArray();

            $this->_userData[$userId] = reset($userInfo) ;
            return $this->_userData[$userId];
        }

        public function render($userId) {
            $userInfo = $this->_getUserInfo($userId);
            $name = $userInfo->name;
            if($userId == $_SESSION['customer_id']) {
                $name = \Core\Helper::__('I').'('.$name.')';
            }
            $html = '
            <span class="glyphicon glyphicon-user">'.$name.'</span>
            ';
            return $html;
        }

    }
}