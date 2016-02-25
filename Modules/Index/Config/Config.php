<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 18.02.16
 * Time: 1:03
 */
class Index_Config_Config
{

    static public function getConfig()
    {
        return array(
            'blocks' => 'Index_Block',
            'models' => 'Index_Model',
            'controllers' => 'Index_Controller',
            'menu_frontend' => array(array(
                'rout' => '',
                'label' => 'Home',
                'sort' => 0
            )),
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