<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 24.02.16
 * Time: 1:05
 */
class Core_Block_Page_Menu extends Core_Block_Abstract {

    /**
     * Core_Block_Page_Menu constructor.
     */
    public function __construct()
    {
        $this
            ->setTemplate('chunks/_menu')
            ->toHtml();
    }

    /**
     * get modules menu
     * @return array
     */
    public function getMenuModules($keyMenu = 'menu_frontend') {
        $config = Core_App::getAllModulesConfig();
        $tmp = array();

        foreach($config as $_conf) {
            if(!isset($_conf[$keyMenu])) {
                continue;
            }
            $tmp = array_merge($_conf[$keyMenu],$tmp);
        }

        $arraySortable = array();

        foreach($tmp as $_tmp) {
            // if it's menu have sort key set randomize key postfix
            if(isset($arraySortable[$_tmp['sort']])) {
                $arraySortable[$_tmp['sort'].rand(10,100)] = $_tmp;
            } else {
                $arraySortable[$_tmp['sort']] = $_tmp;
            }
        }

        ksort($arraySortable);

        return $arraySortable;
    }

    /**
     * get current active
     * @return mixed
     */
    public function getCurrentActive() {
        $config = Core_App::getAllModulesConfig();
        $request = Core_App::getParams();
        $configThisPage = $config[$request['controller']]['page'][$request['controllerName']][$request['action']];
        return $configThisPage['activeMenu'];
    }

}