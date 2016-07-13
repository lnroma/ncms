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
            $connection = \Core\Model\Mongo::getConnect();
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

                \Core\Model\Mongo::update( array(
                        '$set' => array(
                            'child' => $data
                        )
                    ),
                    'menu'
                    ,
                  array('key' => $_POST['parent'])
            );

            } else {
                \Core\Model\Mongo::insert($_POST,'menu');
            }

            \Core\Model\Mongo::getConnect()->close();
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
                \Core\Model\Mongo::update($_POST,'pages',array(
                    '_id' => new MongoDB\BSON\ObjectID($_POST['id'])
                ));
            } else {
                // insert if not exists
                \Core\Model\Mongo::insert($_POST,'pages');
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
            $param = \Core\App::getParams();

            if(isset($param['id'])) {
                /** @var MongoDB $db */
                $db = \Core\Model\Mongo::getDb();
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
            \Core\Model\Mongo::getConnect()->close();
            header('Location:'.\Core\Helper::getUrl('pages/index/index'));
        } catch(Exception $error) {
            header('Location:'.\Core\Helper::getUrl('pages/index/index'));
        }
    }

    public function dropAction()
    {
        $db = \Core\Model\Mongo::getDb();
        $menuCollect = $db->selectCollection('menu');
        $menuCollect->drop();
    }
}