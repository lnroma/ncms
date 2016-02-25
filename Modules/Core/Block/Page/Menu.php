<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 24.02.16
 * Time: 1:05
 */
class Core_Block_Page_Menu extends Core_Block_Abstract {

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
    public function getMenuModules() {
        $config = Core_App::getAllModulesConfig();
        $tmp = array();

        foreach($config as $_conf) {
            $tmp = array_merge($_conf['menu_frontend'],$tmp);
        }

        $arraySortable = array();

        foreach($tmp as $_tmp) {
            $arraySortable[$_tmp['sort']] = $_tmp;
        }

        ksort($arraySortable);

        return $arraySortable;
    }

    public function getCurrentActive() {
        $config = Core_App::getAllModulesConfig();
        $request = Core_App::getParams();
        $configThisPage = $config[$request['controller']]['page'][$request['controllerName']][$request['action']];
        return $configThisPage['activeMenu'];
    }

}