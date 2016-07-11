<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 11.07.16
 * Time: 15:22
 */
namespace Core {
    /**
     * Class Configuration
     * core configuration provider
     * @package Core
     */
    class Configuration {

        private $_configuration = array();
        private $_path = null;

        /**
         * initialization and load configuration file
         * Configuration constructor.
         */
        public function __construct()
        {
            $path = \Core_App::getRootPath();
            $this->_configuration = array(
                'db' => $path.'Config/Db.php',
                'fs' => $path.'Config/Fs.php',
                'app' => $path.'Config/App.php',
                'modules' => $path.'Config/Modules.php',
                'route' => $path.'Config/Route.php'
            );

            $this->_configuration = array_merge(
                $this->_configuration,
                $this->_loadOtherConfiguration()
            );
        }

        /**
         * this function for register module configuration file
         * @return array
         */
        protected function _loadOtherConfiguration()
        {
            return array();
        }

        /**
         * create automaticaly getter for configuration
         * @param $name
         * @param $arguments
         * @return mixed|null
         */
        public function __call($name, $arguments)
        {
            if(strpos($name,'get') !== false) {
                $key = substr($name,3,strlen($name));
                $key = strtolower($key);
                if(isset($this->_configuration[$key])) {
                    return include $this->_configuration[$key];
                } else {
                    return null;
                }
            }
        }
    }
}