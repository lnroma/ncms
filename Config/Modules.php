<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 18.02.16
 * Time: 1:14
 */
namespace Config {
    class Modules
    {

        static public function getModulesConfig()
        {
            return array(
                'install' => array(
                    'config_class' => '\Install\Config\Config',
                    'enable' => true
                ),
                'index' => array(
                    'config_class' => '\Index\Config\Config',
                    'enable' => true
                ),
                'contact' => array(
                    'config_class' => '\Contact\Config\Config',
                    'enable' => false
                ),
                'tasks' => array(
                    'config_class' => '\Tasks\Config\Config',
                    'enable' => false
                ),
                'admin' => array(
                    'config_class' => '\Admin\Config\Config',
                    'enable' => true
                ),
                'urladmin' => array(
                    'config_class' => '\Urladmin\Config\Config',
                    'enable' => true
                ),
                'pages' => array(
                    'config_class' => '\Pages\Config\Config',
                    'enable' => true
                ),
                'postgen' => array(
                    'config_class' => '\Postgen\Config\Config',
                    'enable' => true
                )
            );
        }

    }
}