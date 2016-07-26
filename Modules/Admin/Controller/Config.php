<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 20.03.16
 * Time: 20:42
 */
class Admin_Controller_Config extends Admin_Controller_Abstract
{

    public function saveDisAction()
    {
        try {
            if(\Core\Model\Mongo::simpleSelect('')) {
                \Core\Model\Mongo::insert($_POST, 'config');
            }
        } catch(Exception $error) {
            var_dump($error);
            die;
        }
        header('Location:'.\Core\App::getBaseUrl().\Config\App::getConfig()['adminurl'].'/'.'config/index');
    }

    public function saveBaseAction()
    {

    }

}