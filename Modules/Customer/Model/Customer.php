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
        static $_customer = null;

        /**
         * get customer information from database
         * @return \Customer\Model\Customer\Information
         */
        public static function getCustomer()
        {
            if(self::$_customer) {
                return self::$_customer;
            }
            $customerObj = new \Customer\Model\Customer\Information();
            $customer = self::simpleSelect('id', $_SESSION['customer_id'],'customer');
            $customer = $customer->toArray();
            /** @var \stdClass $customer */
            $customer = reset($customer);
            $customerArray = json_decode(json_encode($customer),true);
            $customerObj->setData($customerArray);
            self::$_customer = $customerObj;
            return self::$_customer;
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