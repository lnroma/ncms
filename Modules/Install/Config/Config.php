<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 10.07.16
 * Time: 13:57
 */
namespace Install\Config {
    class Config
    {
        public static function getConfig()
        {
            return array(
                'blocks' => 'Install_Block',
                'models' => 'Install_Model',
                'install_script' => '\Install\Install\Install',
                'controllers' => 'Install_Controller',
                'install' => array(
                    'observer' => '\Install\Model\Observer',
                    'method' => array(
                        'runInstall'
                    )
                )
            );
        }
    }
}