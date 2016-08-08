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
                'blocks' => '\Index\Block',
                'models' => '\Index\Model',
                'controllers' => '\Index\Controller',
                'menu_frontend' => array(
                    array(
                        'rout' => '',
                        'label' => ' ',
                        'icon' => 'glyphicon glyphicon-home',
                        'sort' => 0
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