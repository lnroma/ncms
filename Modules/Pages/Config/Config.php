<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 28.02.16
 * Time: 20:30
 */
namespace Pages\Config {
    class Config
    {
        static public function getConfig()
        {
            return array(
                'blocks' => '\Pages\Block',
                'models' => '\Pages\Model',
                'controllers' => '\Pages\Controller',
                'install_script' => '\Pages\Install\Install',
                'router_load' => array(
                    'observer' => '\Pages\Model\Observer',
                    'method' => array(
                        'aliasForPage',
                        'aliasMenu'
                    )
                ),
                'menu_admin' => array(
                    array(
                        'rout' => \Config\App::getConfig()['adminurl'] . '/pages',
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
                        ),
                        'menu' => array(
                            'title' => 'Blog page menu',
                            'description' => 'Blog page',
                            'activeMenu' => 'Pages'
                        )
                    )
                )
            );
        }
    }
}