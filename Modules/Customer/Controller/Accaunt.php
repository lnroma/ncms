<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 01.08.16
 * Time: 7:06
 */
namespace Customer\Controller {

    class Accaunt extends \Core\Controller\AbstractClass
    {
        /**
         * save customer information
         */
        public function saveAction()
        {

            $customer = \Core\Model\Mongo::simpleSelect('id', $_SESSION['customer_id'],'customer');

            $customerArr = json_decode(json_encode($customer->toArray()),true);
            $customerArr = reset($customerArr);
            $arrayRes = array_merge($customerArr,$_POST);
            unset($arrayRes['_id']);
            \Core\Model\Mongo::update($arrayRes,'customer',
                array(
                    'id' => $_SESSION['customer_id']
                )
            );

            $_POST['id'] = $_SESSION['customer_id'];

            header('Location:'.\Core\Helper::getUrl('customer\index\index'));
        }

    }

}
