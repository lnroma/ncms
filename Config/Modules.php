<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 18.02.16
 * Time: 1:14
 */
class Config_Modules
{

    static public function getModulesConfig()
    {
        return array(
            'index' => array(
                'config_class' => 'Index_Config_Config',
                'enable' => true
            ),
            'contact' => array(
                'config_class' => 'Contact_Config_Config',
                'enable' => true
            ),
            'tasks' => array(
                'config_class' => 'Tasks_Config_Config',
                'enable' => false
            ),
            'admin' => array(
                'config_class' => 'Admin_Config_Config',
                'enable' => true
            ),
            'urladmin' => array(
                'config_class' => 'Urladmin_Config_Config',
                'enable' => true
            ),
            'pages' => array(
                'config_class' => 'Pages_Config_Config',
                'enable' => true
            ),
        );
    }

}