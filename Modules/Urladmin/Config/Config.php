<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 20:18
 */
class Urladmin_Config_Config
{

    static public function getConfig()
    {
        return array(
            'blocks' => 'Urladmin_Block',
            'models' => 'Urladmin_Model',
            'controllers' => 'Urladmin_Controller',
            'router_load' => array(
                'observer' => 'Urladmin_Model_Observer',
                'method'   => 'aliasUrl'
            ),
            'menu_admin' => array(
                array(
                    'rout' => Config_App::getConfig()['adminurl'] . '/url/',
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