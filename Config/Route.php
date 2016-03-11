<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 15:19
 */
class Config_Route
{
    static public function getConfig() {
        $adminRout = Config_App::getConfig()['adminurl'];
        return array(
            $adminRout.'/login' => 'admin/index/login',
            $adminRout.'/login/check' => 'admin/index/check',
            $adminRout.'/config/index' => 'admin/index/config',
            $adminRout.'/url/index' => 'urladmin/url/index',
            $adminRout.'/url/' => 'urladmin/url/index',
            $adminRout.'/url' => 'urladmin/url/index',
            $adminRout.'/url/add' => 'urladmin/url/add',
            $adminRout.'/pages/index' => 'pages/index/index'
        );
    }
}