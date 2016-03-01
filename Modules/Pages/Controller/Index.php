<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 28.02.16
 * Time: 20:38
 */
class Pages_Controller_Index extends Admin_Controller_Abstract {

    /**
     * index page render
     */
    public function indexAction() {
        $this
            ->setPage('onecollumn')
            ->setKey('admin_page')
            ->setContent('Edit')
            ->render();
    }

    /**
     * add menu render
     */
    public function addMenuAction() {
        $this
            ->setPage('onecollumn')
            ->setKey('admin_page')
            ->setContent('Addmenu')
            ->render();
    }

    /**
     * add page render
     */
    public function addPageAction() {
        $this
            ->setPage('onecollumn')
            ->setKey('admin_page')
            ->setContent('Addpage')
            ->render();
    }

    /**
     * save menu
     */
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

    /**
     * save and update action
     */
    public function savePageAction() {
        try {
            /** @var MongoDB $db */
            $db = Core_Model_Mongo::getDb();

            if(array_search('pages',$db->getCollectionNames(true)) === false) {
                $db->createCollection('pages');
            }
            /** @var MongoCollection $coll */
            $coll = $db->selectCollection('pages');
            // if exist id page
            if(isset($_POST['id'])) {
                $coll->update(
                    array(
                        '_id' => new MongoId($_POST['id'])
                    ),
                    $_POST
                );
            } else {
                // insert if not exists
                $coll->insert($_POST);
            }

            Core_Model_Mongo::getConnect()->close();

            header('Location:'.$_POST['back_url']);
        } catch(Exception $err) {
            header('Location:'.$_POST['back_url']);
        }
    }

    /**
     * delete page action
     */
    public function deletePageAction() {
        try {
            $param = Core_App::getParams();

            if(isset($param['id'])) {
                /** @var MongoDB $db */
                $db = Core_Model_Mongo::getDb();
                /** @var MongoCollection $pageCollection */
                $pageCollection = $db->selectCollection('pages');
                /** @var MongoCursor $document */
                $pageCollection->remove(
                    array(
                        '_id' => new MongoId($param['id']
                        )
                    )
                );
            }
            Core_Model_Mongo::getConnect()->close();
            header('Location:'.Core_Helper::getUrl('pages/index/index'));
        } catch(Exception $error) {
            header('Location:'.Core_Helper::getUrl('pages/index/index'));
        }
    }

    public function dropAction()
    {
        $db = Core_Model_Mongo::getDb();
        $menuCollect = $db->selectCollection('menu');
        $menuCollect->drop();
    }
}