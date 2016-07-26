<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 20:18
 */
namespace Urladmin\Config {
    class Config
    {

        static public function getConfig()
        {
            return array(
                'blocks' => '\Urladmin\Block',
                'models' => '\Urladmin\Model',
                'controllers' => '\Urladmin\Controller',
                'install_script' => '\Urladmin\Install\Install',
                'router_load' => array(
                    'observer' => '\Urladmin\Model\Observer',
                    'method' => 'aliasUrl'
                ),
                'run_application_before' => array(
                    'observer' => '\Urladmin\Model\Observer',
                    'method' => 'redirect301'
                ),
                'get_url_helper' => array(
                    'observer' => '\Urladmin\Model\Observer',
                    'method' => 'getUrlForPage'
                ),
                'menu_admin' => array(
                    array(
                        'rout' => \Config\App::getConfig()['adminurl'] . '/url/',
                        'label' => 'Url rewrite',
                        'sort' => 4,
                    ),
                ),
                'page' => array(
                    'url' => array(
                        'index' => array(
                            'title' => 'Administrative panel',
                            'description' => 'url admin',
                            'activeMenu' => 'Url rewrite'
                        )
                    )
                )
            );

        }
    }
}