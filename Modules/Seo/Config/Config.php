<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 28.02.16
 * Time: 20:30
 */
namespace Seo\Config {
    class Config
    {
        static public function getConfig()
        {
            return array(
                'blocks' => '\Seo\Block',
                'models' => '\Seo\Model',
                'controllers' => '\Seo\Controller',
                'render_seo_meta' => array(
                    'observer' => '\Seo\Model\Observer',
                    'method'   => array(
                       'changeMetaInformation'
                    )
                ),
                'menu_admin' => array(
                    array(
                        'rout' => \Config\App::getConfig()['adminurl'] . '/seo',
                        'label' => 'SEO',
                        'sort' => 10,
                    )
                ),
                'page' => array(
                    'index' => array(
                        'index' => array(
                            'title' => 'Manage seo attributes',
                            'description' => 'Manage seo for page',
                            'activeMenu' => 'SEO'
                        ),
                        'add' => array(
                            'title' => 'Manage seo attributes',
                            'description' => 'Manage seo for page',
                            'activeMenu' => 'SEO'
                        ),
                        'edit' => array(
                            'title' => 'Edit seo attributes',
                            'description' => 'Manage seo for page',
                            'activeMenu' => 'SEO'
                        )
                    )
                )
            );
        }
    }
}