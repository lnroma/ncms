<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 25.07.16
 * Time: 15:34
 */
namespace Customer\Model\Customer
{
    /**
     *
     * Class Information
     * @package Customer\Model\Customer
     *
     * @method getId() get user id in system
     * @method getName() get user name
     * @method getGender() get user gender
     * @method getAge() get user age
     * @method getMail() get email address
     * @method getHelloText() get hello text
     * @method getAboutSelf() get about self
     */
    class Information {

        private $_data = array();

        /**
         * set data to object
         * @param $data
         * @return $this
         */
        public function setData($data)
        {
            $this->_data = $data;
            return $this;
        }

        /**
         * adding data to array data in last element 
         * @param $key
         * @param $value
         * @return $this
         */
        public function addData($key,$value)
        {
            $this->_data[$key]= $value;
            return $this;
        }

        /**
         * @return mixed|string
         */
        public function getAvatar()
        {
            if(isset($this->_data['avatar'])) {
                return $this->_data['avatar'];
            } else {
                return \Core\App::getBaseUrl().'static/src/noavatar.jpg';
            }
        }

        /**
         * magik getter function
         * @param $name
         * @param $arguments
         * @return mixed|null
         */
        public function __call($name, $arguments)
        {
            if(strpos($name,'get') !== false)
            {
                $key = substr($name,3,strlen($name));
                $key = lcfirst($key);

                $key = preg_replace_callback('/[A-Z]/',function ($args) {
                    if(isset($args[0])) {
                        return '_'.strtolower($args[0]);
                    }
                },$key);

                if(isset($this->_data[$key])) {
                    return $this->_data[$key];
                } else {
                    return null;
                }
            } elseif(strpos($name,'set') !== false) {
                $key = substr($name,3,strlen($name));
                $key = lcfirst($key);
                if(isset($arguments[0])) {
                    $this->addData($key, $arguments[0]);
                }
            }
        }

    }
}