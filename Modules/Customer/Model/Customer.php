<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 25.07.16
 * Time: 15:00
 */
namespace Customer\Model {

    class Customer extends \Core\Model\Mongo
    {
        static $_customer = array();

        const ENTITY = 'customer';

        /**
         * get customer information from database
         * @return \Customer\Model\Customer\Information
         */
        public static function getCustomer($id = null)
        {
            if($id == null) {
                $id = $_SESSION['customer_id'];
            }

            if(isset(self::$_customer[$id])) {
                return self::$_customer[$id];
            }

            $customerObj = new \Customer\Model\Customer\Information();
            $customer = self::simpleSelect('id',$id ,'customer');
            $customer = $customer->toArray();
            /** @var \stdClass $customer */
            $customer = reset($customer);
            $customerArray = json_decode(json_encode($customer),true);
            $customerObj->setData($customerArray);

            self::$_customer[$id] = $customerObj;

            return self::$_customer[$id];
        }

        /**
         * check user is login
         * @return bool
         */
        public static function isLogin()
        {
            if(isset($_SESSION['customer_id'])) {
                return true;
            } else {
                return false;
            }
        }

    }

}