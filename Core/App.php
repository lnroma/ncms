<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 09.10.15
 * Time: 22:51
 */
class Core_App {

    /**
     * this variable path to root directory
     * @var null
     */
    static private $_path = null;
    static private $_baseUrl = null;
    static private $_themes = null;
    static private $_modulConfig = null;
    static private $_controllObject = null;
    static private $_allModulesConfiguration = null;
    static private $_controllecClass = null;
    static private $_loadingClasses = array();
    /**
     * set root path
     * @param $basePath
     * @return null | string
     */
    static public function setRootPath($basePath) {
        self::$_path = $basePath;
        return self::$_path;
    }

    /**
     * get root path
     * @return null | string
     */
    static public function getRootPath() {
        return self::$_path;
    }

    /**
     * set themes
     * @param $themes
     * @return string
     */
    static public function setThemes($themes) {
        self::$_themes = $themes;
        return self::$_themes;
    }

    /**
     * set themes
     * @return string
     */
    static public function getThemes() {
        return self::$_themes;
    }

    /**
     * set base url application
     * @param $baseUrl
     * @return null
     */
    static public function setBaseUrl($baseUrl) {
        self::$_baseUrl = $baseUrl;
        return self::$_baseUrl;
    }

    /**
     * get base url
     * @return null | string
     */
    static public function getBaseUrl() {
        return self::$_baseUrl;
    }

    /**
     * get modules config
     * @return Config_Modules
     */
    static public function getModulesConfig() {
        return Config_Modules::getModulesConfig();
    }

    /**
     * run application
     * @return bool
     */
    static public function runApplet() {
        self::dispathEvent('install',array());
        self::dispathEvent('run_application_before',array());

        $params = self::getParams();

        if(!isset(self::getModulesConfig()[$params['controller']])) {
            throw new Exception_Notfound('Page not found!');
        }

        $modulesConfig = self::getModulesConfig()[$params['controller']];

        if($modulesConfig['enable'] == false) {
            throw new Exception_Notfound('Modul not found');
        }

        $configModul = $modulesConfig['config_class'];
        $configModul = $configModul::getConfig();

        self::$_modulConfig = $configModul;

        self::$_controllObject = self::loadController($configModul,$params);

        self::dispathEvent('run_application_after',array());
        return true;
    }

    /**
     * get current controller
     * @return null
     */
    static public function getConObj() {
        return self::$_controllObject;
    }

    /**
     * load controller
     * @param $modulConfig
     * @param $params
     * @return mixed
     * @throws Exception_Notfound
     */
    static public function loadController($modulConfig,$params) {

        if(!isset($modulConfig['controllers'])) {
            throw new Exception_Notfound('Page not found');
        }

        $controllersModul = $modulConfig['controllers'].'_'.ucfirst($params['controllerName']);

        if(!class_exists($controllersModul)) {
            throw new Exception_Notfound('Not found class controller');
        }

        $object = self::getControllerClass($controllersModul);

        return self::_callControllerAction($object,$params);
    }

    /**
     * get controller once in load class
     * @param $controller
     * @return null
     */
    static public function getControllerClass($controller) {
        if(is_null(self::$_controllecClass)) {
            self::$_controllecClass = new $controller;
        }
        return self::$_controllecClass;
    }

    /**
     * call controller action
     * @param $objectController
     * @param $params
     * @return mixed
     * @throws Exception_Notfound
     */
    static protected function _callControllerAction($objectController,$params) {
        $params = Core_App::getParams();

        $action = $params['action'].'Action';

        if(!method_exists($objectController,$action)) {
            throw new Exception_Notfound('Page not found');
        }

        call_user_func(array($objectController,$action));
        return $objectController;
    }

    /**
     * get config module
     * @return null
     */
    static public function getConfigModul() {
        return self::$_modulConfig;
    }

    /**
     * @param $key
     * @param bool $filtered
     * @param mixed $defaultValue return default value
     * @return mixed|null
     */
    static public function getPost($key,$defaultValue = null,$filtered = true) {

        if(!isset($_POST[$key])) {
            return $defaultValue;
        }

        if(is_array($_POST[$key])) {

            $result = array();

            foreach($_POST[$key] as $_key => $_post) {
                if ($filtered) {
                    $result[$_key] = filter_var($_post,FILTER_SANITIZE_SPECIAL_CHARS);
                } else {
                    $result[$_key] = $_post;
                }
            }

            return $result;
        }

        if($filtered) {
            return filter_var($_POST[$key],FILTER_SANITIZE_SPECIAL_CHARS);
        } else {
            return $_POST[$key];
        }
    }

    /**
     * get params request
     * @return array
     */
    static public function getParams() {
        $result = array();

        $baseUri = parse_url(self::getBaseUrl());

        $requestUri = $_SERVER['REQUEST_URI'];

        if(isset($baseUri['path']) && $baseUri['path'] != '/') {
            $requestUri = str_replace($baseUri['path'],'',$requestUri);
        }

        $params = explode('/',trim($requestUri,'/'));

        // generate controller
        if(reset($params)=='') {
            $result['controller'] = 'index';
        } else {
            $result['controller'] = $params[0];
        }

        // generate controller name
        if(isset($params[1])) {
            $result['controllerName'] = $params[1];
        } else {
            $result['controllerName'] = 'index';
        }

        // generate controller action
        if(isset($params[2])) {
            $result['action'] = $params[2];
        } else {
            $result['action'] = 'index';
        }
        $result = self::adminControllerGenerate($result);
        // alliasses
        $result = self::routeAliassisGenerate($result);
        //router load event
        $result = self::dispathEvent('router_load',$result);
        // generate params
        for ( $i=3; $i<count($params); $i++ ) {
            if( $i%2 != 0 ) {
                if(isset($params[$i+1])) {
                    $result[$params[$i]] = $params[$i+1];
                }
            }
        }

        return $result;
    }

    /**
     * generate alias for admin controllers
     * @param $params
     */
    static private function adminControllerGenerate($params) {
        if($params['controller'] == Config_App::getConfig()['adminurl']) {
            $params['controller'] = 'admin';
        }
        return $params;
    }

    static private function routeAliassisGenerate($params) {
        $aliasis = Config_Route::getConfig();
        if(isset($_SERVER['QUERY_STRING'])) {
            $repl = $_SERVER['QUERY_STRING'];
        } else {
            $repl = '';
        }
        $path = str_replace($repl,'',$_SERVER['REQUEST_URI']);
        $path = trim($path,'/?');
        if(!isset($aliasis[$path])) {
            return $params;
        }
        $pathArr = explode('/',$aliasis[$path]);
        $params['controller'] = $pathArr[0];
        $params['controllerName'] = $pathArr[1];
        $params['action'] = $pathArr[2];
        return $params;
    }

    /**
     * todo for generate rout single page
     * @param $params
     * @return mixed
     */
    static private function pageRoutGenerate($params) {
        return $params;
    }

    static public function getAllModulesConfig() {
        if(is_null(self::$_allModulesConfiguration)) {
            $modules = self::getModulesConfig();
            $tmpConfig = array();
            foreach($modules as $_key => $_mod) {
                if($_mod['enable'] == true) {
                    $tmpConfig[$_key] = $_mod['config_class']::getConfig();
                }
            }
            self::$_allModulesConfiguration = $tmpConfig;
        }
        return self::$_allModulesConfiguration;
    }

    /**
     * get session data by key
     * @param $key
     * @return null
     */
    static public function getSessionData($key) {
        if(isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return null;
        }
    }

    /**
     * dispath event for observer
     * @param $eventKey
     * @param $data
     * @return mixed
     */
    static public function dispathEvent($eventKey,$data) {
        $modules = self::getAllModulesConfig();
        foreach($modules as $_mod) {
            $methods = array();
            if(isset($_mod[$eventKey])) {
                if(!is_array($_mod[$eventKey]['method'])) {
                    $methods[] = $_mod[$eventKey]['method'];
                } else {
                    $methods = array_merge($methods,$_mod[$eventKey]['method']);
                }
                foreach($methods as $_method) {
                    $data = call_user_func(array(
                        new $_mod[$eventKey]['observer'],
                        $_method
                    ), $data);
                }
            }
        }

        return $data;
    }
}

/**
 * autoload  class file
 * @param $className
 */
function __autoload($className) {
    $classPath = explode('_',$className);
    // generate paths to file
    $classFile = Core_App::getRootPath().
        trim(implode(DIRECTORY_SEPARATOR,$classPath),DIRECTORY_SEPARATOR)
        .'.php';
    $classFileModules = Core_App::getRootPath().
        'Modules/'.trim(implode(DIRECTORY_SEPARATOR,$classPath),DIRECTORY_SEPARATOR)
        .'.php';
    $classFileUserModules = Core_App::getRootPath()
        .'Local/Modules/'.trim(implode(DIRECTORY_SEPARATOR,$classPath),DIRECTORY_SEPARATOR)
        .'.php';

    if(file_exists($classFileUserModules)) {
        include_once($classFileUserModules);
    } elseif(file_exists($classFileModules)) {
        include_once($classFileModules);
    } elseif(file_exists($classFile)) {
        include_once($classFile);
    } else {
        autoloadByNamespace($className);
    }
}

function autoloadByNamespace($className)
{
    $classPath = str_replace('\\','/',$className);
    $classPath = Core_App::getRootPath().$classPath.'.php';
    if(file_exists($classPath)) {
        require_once $classPath;
    }
}