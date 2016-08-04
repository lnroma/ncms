<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 02.08.16
 * Time: 8:09
 */
namespace Customer\Block\Photo
{

    class Index extends \Core\Block\AbstractClass
    {

        public function __construct()
        {
            $this->setTemplate('customer/photo/index');
        }

        /**
         * get url to image
         * @return string
         */
        public function getUrlToPicture()
        {
            return \Core\App::getBaseUrl().'/uploads/'.\Core\App::getParams()['id'].'/';
        }

        protected function _prepareDirectory($directory)
        {
//            var_dump(\Core\App::getParams());die;
        }

        /**
         * get all file in current directory
         * @return array
         */
        public function getAllFile()
        {
            $directory = \Core\App::getRootPath().'uploads'.DIRECTORY_SEPARATOR.\Core\App::getParams()['id'].DIRECTORY_SEPARATOR;

            $glob = array();

            if(file_exists($directory)) {
                $glob = glob($directory.'*');
            }

            foreach ($glob as $_key => $_file) {
                $glob[$_key] = array(
                    'file' => $_file,
                    'type' => mime_content_type($_file),
                    'name' => str_replace($directory, '', $_file)
                );
            }

            return $glob;
        }

        /**
         * get customer information
         * @return \Customer\Model\Customer\Information
         */
        public function getCustomerInfo()
        {
            $customer = \Customer\Model\Customer::getCustomer(\Core\App::getParams()['id']);
            return $customer;
        }

        public function getDirectoryPath()
        {
            return \Core\App::getRootPath().'uploads'.DIRECTORY_SEPARATOR.\Core\App::getParams()['id'].DIRECTORY_SEPARATOR;
        }

    }

}