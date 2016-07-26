<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 24.07.16
 * Time: 21:00
 */
namespace Customer\Config {

    class Config
    {

        static public function getConfig()
        {

            $configuration = array(
                'blocks' => '\Customer\Block',
                'models' => '\Customer\Model',
                'controllers' => '\Customer\Controller',
                'page' => array(
                    'index' => array(
                        'accaunt' => array(
                            'title' => 'Your accaunt',
                            'description' => 'Your accaunt',
                            'activeMenu' => 'Accaunt'
                        )
                    ),
                )
            );

            if (\Customer\Model\Customer::isLogin()) {

                $configuration['menu_frontend'][] = array(
                    'rout' => 'customer/mail/index',
                    'label' => 'Mail',
                    'sort' => 11,
                );


                $configuration['menu_frontend'][] = array(
                    'rout' => 'customer/index/accaunt',
                    'label' => 'My Accaunt',
                    'sort' => 12,
                );

                $configuration['menu_frontend'][] = array(
                    'rout' => 'customer/index/all',
                    'label' => 'All users',
                    'sort' => 13
                );

                $configuration['page']['mail']['index'] = array(
                    'title' => 'Emails',
                    'description' => 'Email',
                    'activeMenu' => 'Mail'
                );

                $configuration['page']['index']['all'] = array(
                    'title' => 'All users',
                    'description' => 'Users list',
                    'activeMenu' => 'All users'
                );

                $configuration['page']['mail']['send'] = array(
                    'title' => 'Send email to user',
                    'description' => 'send mail',
                    'activeMenu' => ''
                );

            } else {
                $configuration['menu_frontend'] = array(
                    array(
                        'rout' => \Customer\Block\Menu::getAuthLink(),
                        'label' => 'Google+',
                        'sort' => 10,
                    )
                );
            }

            return $configuration;
        }

    }
}