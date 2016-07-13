<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 18.02.16
 * Time: 14:15
 */
namespace Tasks\Config {
    class Config
    {
        /**
         * structure array see in /documentation/modules/config.md
         * @return array
         */
        static public function getConfig()
        {
            return array(
                'blocks' => 'Tasks_Block',
                'models' => 'Tasks_Model',
                'controllers' => 'Tasks_Controller',
                'menu_frontend' => array(
                    array(
                        'rout' => 'tasks/task/list',
                        'label' => 'List task',
                        'sort' => 5,
                    ),
                ),
                'page' => array(
                    'task' =>
                        array(
                            'list' =>
                                array(
                                    'title' => 'This is page create contact',
                                    'description' => 'This is description index page',
                                    'activeMenu' => 'List task'
                                ),
                            'create' =>
                                array(
                                    'title' => 'This is page create contact',
                                    'description' => 'This is description index page',
                                    'activeMenu' => 'List task'
                                ),
                        )
                )
            );
        }

    }
}