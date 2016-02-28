<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 28.02.16
 * Time: 20:38
 */
class Pages_Controller_Index extends Admin_Controller_Abstract {

    public function indexAction() {
        $this
            ->setPage('onecollumn')
            ->setKey('admin_page')
            ->setContent('Edit')
            ->render();
    }

    public function addMenuAction() {
        $this
            ->setPage('onecollumn')
            ->setKey('admin_page')
            ->setContent('Addmenu')
            ->render();
    }

    public function saveMenuAction() {
        try {
            $db = Core_Model_Mongo::getDb();

            if(array_search('menu',$db->getCollectionNames(true)) === false) {
                $db->createCollection('menu');
            }

            $coll = $db->selectCollection('menu');
            $coll->insert($_POST);


            unset($coll);

//            var_dump($_POST['back_url']);die;
            header('Location:'.$_POST['back_url']);
        } catch(Exception $err) {
            header('Location:'.$_POST['back_url']);
        }
    }

}