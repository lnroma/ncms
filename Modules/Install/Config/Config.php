<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 10.07.16
 * Time: 13:57
 */
class Install_Config_Config
{
    public static function getConfig() {
        return array(
            'blocks' => 'Install_Block',
            'models' => 'Install_Model',
            'install_script' => 'Install_Install_Install',
            'controllers' => 'Install_Controller',
            'install' => array(
                'observer' => 'Install_Model_Observer',
                'method' => array(
                    'runInstall'
                )
            )
        );
    }
}