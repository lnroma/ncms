<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 13:19
 */
namespace Admin\Config {
    class Config
    {

        static public function getConfig()
        {
            return array(
                'blocks' => '\Admin\Block',
                'models' => '\Admin\Model',
                'controllers' => '\Admin\Controller',
                'install_script' => 'Admin\Install\Install',
                'menu_admin' => array(
                    array(
                        'rout' => \Config\App::getConfig()['adminurl'] . '/dashboard',
                        'label' => 'Dashboard',
                        'sort' => 1,
                    ),
                    array(
                        'rout' => \Config\App::getConfig()['adminurl'] . '/config/',
                        'label' => 'Configuration',
                        'sort' => 2,
                    ),
                ),
                'page' => array(
                    'index' => array(
                        'login' => array(
                            'title' => 'Login in admin panel',
                            'description' => 'Login in admin',
                            'activeMenu' => 'Configuration'
                        ),
                        'config' => array(
                            'title' => 'Config your applet',
                            'description' => 'Config your applet',
                            'activeMenu' => 'Configuration'
                        )
                    ),
                    'dashboard' => array(
                        'index' => array(
                            'title' => 'Administrative panel',
                            'description' => 'Dashboard',
                            'activeMenu' => 'Dashboard'
                        )
                    )
                )
            );
        }

    }
}