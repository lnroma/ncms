<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 13:19
 */
class Admin_Config_Config
{

    static public function getConfig() {
        return array(
            'blocks' => 'Admin_Block',
            'models' => 'Admin_Model',
            'controllers' => 'Admin_Controller',
            'menu_admin' => array(
                array(
                    'rout' => Config_App::getConfig()['adminurl'].'/dashboard',
                    'label' => 'Dashboard',
                    'sort' => 1,
                ),
                array(
                    'rout' => Config_App::getConfig()['adminurl'].'/config/',
                    'label' => 'Configuration',
                    'sort'  => 2,
                ),
            ),
            'page' => array(
                'index' => array(
                    'login' => array(
                        'title' => 'Login in admin panel',
                        'description' => 'Login in admin',
                        'activeMenu' => 'Configuration'
                    ),
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