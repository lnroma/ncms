<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 23.02.16
 * Time: 23:07
 */
namespace Core\Block\Page {
    class Head extends \Core\Block\AbstractClass
    {

        public function __construct()
        {
            $this
                ->setTemplate('chunks/_head')
                ->toHtml();
        }

        public function getPageConfig()
        {
            $config = \Core\App::getAllModulesConfig();
            $request = \Core\App::getParams();
            $configThisPage = $config[$request['controller']]['page'][$request['controllerName']][$request['action']];
            return $configThisPage;
        }

    }
}