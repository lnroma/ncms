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
            ->setContent('Admin_Edit')
            ->render();
    }

    /**
     * add menu render
     */
    public function addMenuAction() {
        $this
            ->setPage('onecollumn')
            ->setKey('admin_page')
            ->setContent('Admin_Addmenu')
            ->render();
    }

    /**
     * add page render
     */
    public function addPageAction() {
        $this
            ->setPage('onecollumn')
            ->setKey('admin_page')
            ->setContent('Admin_Addpage')
            ->render();
    }

    /**
     * save menu
     */
    public function saveMenuAction() {
        try {
            $connection = Core_Model_Mongo::getConnect();
            $query = new MongoDB\Driver\Query(array('key' => $_POST['parent']));
            $existCursor = $connection->executeQuery(Config_Db::getConf()['mongodb']['db'].'.menu',$query);
            $existCursor = $existCursor->toArray();
            $existCursor = reset($existCursor);

            if(count($existCursor) > 0) {
                $data = array($_POST);
                $dataOld = $existCursor;

                if(isset($dataOld->child)) {
                    $data = array_merge($data,$dataOld->child);
                }

                Core_Model_Mongo::update( array(
                        '$set' => array(
                            'child' => $data
                        )
                    ),
                    'menu'
                    ,
                  array('key' => $_POST['parent'])
            );

            } else {
                Core_Model_Mongo::insert($_POST,'menu');
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
            //if exist update
            if(isset($_POST['id'])) {
                Core_Model_Mongo::update($_POST,'pages',array(
                    '_id' => new MongoDB\BSON\ObjectID($_POST['id'])
                ));
            } else {
                // insert if not exists
                Core_Model_Mongo::insert($_POST,'pages');
            }
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