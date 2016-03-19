<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 29.02.16
 * Time: 23:39
 */
class Pages_Controller_View extends Core_Controller_Abstract
{

    /**
     * index action render page
     */
    public function indexAction()
    {
        $this
            ->setKey('page')
            ->setPage('blog')
            ->setMenu('Menu')
            ->setContent('View')
            ->render();
    }

    /**
     * blog action
     */
    public function blogAction()
    {
        $this
            ->setKey('page')
            ->setPage('blog')
            ->setMenu('Menu')
            ->setContent('Blog')
            ->render();
    }

    /**
     * menu action
     */
    public function menuAction()
    {
        $this
            ->setKey('page')
            ->setPage('blog')
            ->setMenu('Menu')
            ->setContent('Viewmenu')
            ->render();
    }

    /**
     * add comment action
     */
    public function addCommentAction()
    {
        /** @var MongoDB $db */
        $db = Core_Model_Mongo::getConnect();
//        Core_Model_Mongo::createCollection('comment8');die;
        /** check exist table */
        $time = time();

        //insert new comment to the page
        $arrData =  array(
            'page' => $_POST['page_id'],
            'time' => $time,
            'name' => $_POST['name'],
            'comment' => $_POST['comment']
        );

        $connect = Core_Model_Mongo::getConnect();

        $write = new MongoDB\Driver\BulkWrite();
        $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY);

        if(isset($_POST['reply']) && !empty($_POST['reply'])) {
            $reply = $_POST['reply'];

            if(isset($_POST['path']) && !empty($_POST['path'])) {
                $path = $_POST['path'];
            } else {
                $path = 'replies';
            }

            $write->update(
                array('_id' => new MongoDB\BSON\ObjectID($reply)),
                array('$push' => array($path => $arrData) )
            );
        } else {
            $write->insert($arrData);
        }
        try {
            $connect->executeBulkWrite(Config_Db::getConf()['mongodb']['db'] . '.comments', $write, $writeConcern);
        } catch(MongoDB\Driver\Exception\BulkWriteException $error) {
            header('Location:' . $_POST['back_url']);
        }


        header('Location:' . $_POST['back_url']);
    }

    public function delCommentAllAction()
    {

    }

}