<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 24.07.16
 * Time: 20:58
 */
namespace Customer\Controller {

    use Ratchet\Wamp\Exception;

    /**
     * Class Index
     * @package Authgoogle\Controller
     */
    class Index extends \Core\Controller\AbstractClass {

        /**
         * index action
         * @throws \Exception
         */
        public function indexAction()
        {
            try {
                if (isset($_GET['error'])) {
                    throw new \Exception($_GET['error']);
                }

                if (!isset($_GET['code'])) {
                    header('Location:' . \Core\Helper::getUrl('/'));
                }

                $client = new \Google_Client();

                $client->setAuthConfigFile(\Core\App::getRootPath() . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'google.json');
                $client->authenticate($_GET['code']);
                $accessToken = $client->getAccessToken();
                $client->setAccessToken($accessToken);

                $customer = new \Google_Service_Oauth2($client);
                $customerInfo = $customer->userinfo->get();
                /** @var \MongoDB\Driver\Cursor $user */
                $user = \Core\Model\Mongo::simpleSelect('id', $customerInfo->getId(), 'customer');
                if (count($user->toArray()) == 0) {
                    $this->_createUser($customerInfo);
                } else {
                    $_SESSION['customer_id'] = $customerInfo->getId();
                    header('Location:' . \Core\Helper::getUrl('customer/index/accaunt'));
                }
            } catch (Exception $error) {
                if($error->getMessage() == 'norepl') {
                    header('Location:' . \Core\Helper::getUrl('customer/index/accaunt'));
                } else {
                    throw new \Exception($error->getMessage());
                }
            }
        }

        public function accauntAction() {
            if(isset(\Core\App::getParams()['id'])) {
                $this
                    ->setKey('page')
                    ->setPage('main')
                    ->setContent('Customer\Show')
                    ->render();
            } else {
                $this
                    ->setKey('page')
                    ->setPage('main')
                    ->setContent('Customer\Index')
                    ->render();
            }
        }

        /**
         * logout action
         */
        public function logoutAction()
        {
            unset($_SESSION['customer_id']);
            header('Location:'.\Core\App::getBaseUrl());
        }

        /**
         * @param $customerInfo
         */
        protected function _createUser($customerInfo)
        {
            $customerInformation = array(
                'name' => $customerInfo->getName(),
                'id' => $customerInfo->getId(),
                'email' => $customerInfo->getEmail(),
                'gender' => $customerInfo->getGender(),
            );

            \Core\Model\Mongo::insert($customerInformation,'customer');

            $_SESSION['customer_id'] = $customerInformation['id'];

            header('Location:'.\Core\Helper::getUrl('customer/index/accaunt'));
        }

        public function allAction()
        {
            $this
                ->setKey('page')
                ->setPage('main')
                ->setContent('Customer\All')
                ->render();
        }

        public function clearAction()
        {

//            \Core\Model\Mongo::delete(array(),'customer');
            \Core\Model\Mongo::delete(array(),'customer_message');

        }

    }
}