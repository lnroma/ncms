<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 18.02.16
 * Time: 1:03
 */
namespace Index\Config {
    class Config
    {

        static public function getConfig()
        {
            return array(
                'blocks' => 'Index_Block',
                'models' => 'Index_Model',
                'controllers' => 'Index_Controller',
                'menu_frontend' => array(
                    array(
                        'rout' => '',
                        'label' => 'Home',
                        'sort' => 0
                    ),
                    array(
                        'rout' => 'index/index/ru',
                        'label' => 'Русский',
                        'sort' => 12
                    ),
                    array(
                        'rout' => 'index/index/english',
                        'label' => 'English',
                        'sort' => 13
                    )
                ),
                'menu_admin' => array(
                    array(
                        'rout' => \Config\App::getConfig()['adminurl'] . '/index/admin/',
                        'label' => 'Home page',
                        'sort' => 4,
                    ),
                ),
                'page' => array(
                    'index' => array(
                        'index' => array(
                            'title' => 'This is index page',
                            'description' => 'This is description index page',
                            'activeMenu' => 'Home'
                        )
                    ),
                )
            );
        }

    }
}