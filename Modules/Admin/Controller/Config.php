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
            if(Core_Model_Mongo::simpleSelect(''))
            Core_Model_Mongo::insert($_POST, 'config');
        } catch(Exception $error) {
            var_dump($error);
            die;
        }
        header('Location:'.\Core\App::getBaseUrl().Config_App::getConfig()['adminurl'].'/'.'config/index');
    }

    public function saveBaseAction()
    {

    }

}