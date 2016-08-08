<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 24.07.16
 * Time: 21:00
 */
namespace Forum\Config;

/**
 * configuration class module Forum
 * Class Config
 * @package Index\Config
 */
class Config
{
    /**
     * return configuration array for this modules
     * @return array
     */
    static public function getConfig()
    {
        $configuration = array(
            'blocks' => '\Forum\Block',
            'models' => '\Forum\Model',
            'controllers' => '\Forum\Controller',
            'page' => array(
                'index' => array(
                    'index' => array(
                        'title' => 'Main forum theme',
                        'description' => 'theme forum',
                        'activeMenu' => 'Forum'
                    ),
                    'view' => array(
                        'title' => 'Edit forum tred',
                        'description' => 'theme forum',
                        'activeMenu' => 'Forum'
                    ),
                    'add' => array(
                        'title' => 'Add new trade',
                        'description' => 'Add new trade',
                        'activeMenu' => 'Forum'
                    ),
                ),
                'admin' => array(
                    'index' => array(
                        'title' => 'Edit forum tred',
                        'description' => 'theme forum',
                        'activeMenu' => 'Настройска форума'
                    ),
                    'add' => array(
                        'title' => 'Edit forum tred',
                        'description' => 'theme forum',
                        'activeMenu' => 'Настройска форума'
                    ),
                    'edit' => array(
                        'title' => 'Edit forum tred',
                        'description' => 'theme forum',
                        'activeMenu' => 'Настройска форума'
                    )
                )
            )
        );

        $configuration['menu_frontend'] = array(
            array(
                'rout' => '/forum/index/index',
                'label' => 'Форум',
                'icon' => 'glyphicon glyphicon-bullhorn',
                'sort' => 100,
            )
        );

        $configuration['menu_admin'] = array(
            array(
                'rout' => \Config\App::getConfig()['adminurl'] . '/forum',
                'label' => 'Настройка форума',
                'sort' => 10,
            )
        );

        return $configuration;
    }
}