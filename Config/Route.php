<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 15:19
 */
namespace Config {
    class Route
    {
        static public function getConfig()
        {
            $adminRout = \Config\App::getConfig()['adminurl'];
            return array(
                $adminRout . '/login' => 'admin/index/login',
                $adminRout . '/login/check' => 'admin/index/check',
                $adminRout . '/config/index' => 'admin/index/config',
                $adminRout . '/url/index' => 'urladmin/url/index',
                $adminRout . '/url/' => 'urladmin/url/index',
                $adminRout . '/url' => 'urladmin/url/index',
                $adminRout . '/url/add' => 'urladmin/url/add',
                $adminRout . '/pages/index' => 'pages/index/index',
                $adminRout . '/seo/index' => 'seo/index/index',
                $adminRout . '/seo/add' => 'seo/index/add',
                'authgoogle' => 'customer/index/index',
                '/' => 'index/index',
                '' => 'index/index/index',
            );
        }
    }
}