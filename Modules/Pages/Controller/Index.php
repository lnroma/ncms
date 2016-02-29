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

    public function addPageAction() {
        $this
            ->setPage('onecollumn')
            ->setKey('admin_page')
            ->setContent('Addpage')
            ->render();
    }

    public function saveMenuAction() {
        try {
            $db = Core_Model_Mongo::getDb();

            if(array_search('menu',$db->getCollectionNames(true)) === false) {
                $db->createCollection('menu');
            }

            $coll = $db->selectCollection('menu');

            /** @var MongoCursor $existArray */
            $existCursor = $coll->find(array('key' => $_POST['parent']));

            if($existCursor->count() > 0) {
                $data = array($_POST);
                $dataOld = iterator_to_array($existCursor);
                $dataOld = reset($dataOld);
                if(isset($dataOld['child'])) {
                    $data = array_merge($data,$dataOld['child']);
                }
                $coll->update(array('key' => $_POST['parent']),array(
                    '$set' => array(
                        'child' => $data
                    )
                ));
            } else {
                $coll->insert($_POST);
            }
            Core_Model_Mongo::getConnect()->close();
            header('Location:'.$_POST['back_url']);
        } catch(Exception $err) {
            header('Location:'.$_POST['back_url']);
        }
    }

    public function savePageAction() {
        try {

            $db = Core_Model_Mongo::getDb();

            if(array_search('pages',$db->getCollectionNames(true)) === false) {
                $db->createCollection('pages');
            }

            $coll = $db->selectCollection('pages');
            $coll->insert($_POST);

            Core_Model_Mongo::getConnect()->close();

            header('Location:'.$_POST['back_url']);
        } catch(Exception $err) {
            header('Location:'.$_POST['back_url']);
        }
    }

    public function dropAction() {
        $db = Core_Model_Mongo::getDb();
        /** @var MongoCollection $coll */
        $coll = $db->selectCollection('menu');
        var_dump($coll->drop());
    }

}