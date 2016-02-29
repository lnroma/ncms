<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 28.02.16
 * Time: 20:30
 */
class Pages_Config_Config
{
    static public function getConfig()
    {
        return array(
            'blocks' => 'Pages_Block',
            'models' => 'Pages_Model',
            'controllers' => 'Pages_Controller',
            'router_load' => array(
                'observer' => 'Pages_Model_Observer',
                'method' => 'aliasForPage'
            ),
            'menu_admin' => array(
                array(
                    'rout' => Config_App::getConfig()['adminurl'] . '/pages',
                    'label' => 'Pages',
                    'sort' => 10,
                ),
            ),
            'menu_frontend' => array(
                array(
                    'rout' => 'pages/view/blog',
                    'label' => 'Pages',
                    'sort' => 11,
                ),
            ),
            'page' => array(
                'index' => array(
                    'index' => array(
                        'title' => 'Manage cms page',
                        'description' => 'Manage cms page',
                        'activeMenu' => 'Pages'
                    ),
                    'addMenu' => array(
                        'title' => 'Manage menu for page',
                        'description' => 'Manage menu for page',
                        'activeMenu' => 'Pages'
                    ),
                    'addPage' => array(
                        'title' => 'Manage page',
                        'description' => 'Manage page',
                        'activeMenu' => 'Pages'
                    )
                ),
                'view' => array(
                    'index' => array(
                        'title' => 'View page',
                        'description' => 'View page',
                        'activeMenu' => 'Pages'
                    ),
                    'blog' => array(
                        'title' => 'Blog page',
                        'description' => 'Blog page',
                        'activeMenu' => 'Pages'
                    )
                )
            )
        );
    }
}