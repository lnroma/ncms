<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 06.03.16
 * Time: 14:34
 */
namespace Postgen\Config {
    class Config
    {
        static public function getConfig()
        {
            return array(
                'blocks' => 'Postgen_Block',
                'models' => 'Postgen_Model',
                'controllers' => 'Postgen_Controller',
                'menu_frontend' => array(
                    array(
                        'rout' => 'postgen/index/index',
                        'label' => 'Post generator',
                        'sort' => 12,
                    ),
                ),
                'page' => array(
                    'index' => array(
                        'index' => array(
                            'title' => 'Post request generator',
                            'description' => 'The post request generator',
                            'activeMenu' => 'Post generator'
                        )
                    )
                )
            );
        }
    }
}