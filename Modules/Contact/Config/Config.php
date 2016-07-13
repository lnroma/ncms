<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 18.02.16
 * Time: 14:15
 */
namespace Contact\Config {
    class Config
    {

        static public function getConfig()
        {
            return array(
                'blocks' => '\Contact\Block',
                'models' => '\Contact\Model',
                'controllers' => '\Contact\Controller',
                'install_script' => '\Contact\Install\Install',
                'menu_frontend' => array(
                    array(
                        'rout' => 'contact/create/',
                        'label' => 'Create contact',
                        'sort' => 1,
                    ),
                    array(
                        'rout' => 'contact/create/addAttribute',
                        'label' => 'Create attribute',
                        'sort' => 2,
                    )
                ),
                'page' => array(
                    'create' =>
                        array(
                            'addAttribute' =>
                                array(
                                    'title' => 'This is page create contact',
                                    'description' => 'This is description index page',
                                    'activeMenu' => 'Create attribute'
                                ),
                            'index' =>
                                array(
                                    'title' => 'This is page create contact',
                                    'description' => 'This is description index page',
                                    'activeMenu' => 'Create contact'
                                ),
                        )
                )
            );
        }

    }
}