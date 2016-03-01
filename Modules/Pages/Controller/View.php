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
        $db = Core_Model_Mongo::getDb();
        /** check exist table */
        if(array_search('comments',$db->getCollectionNames(true)) === false) {
            $db->createCollection('comments');
        }
        /** @var MongoCollection $collectionComment */
        $collectionComment = $db->selectCollection('comments');
        /** @var MongoCursor $col */
        $col = $collectionComment->find(
            array(
                'page_id' => $_POST['page_id']
            )
        );

        $resultArray = array();

        if ($col->count()) {
            // todo need optimization
            $result = iterator_to_array($col);

            $id = key($result);
            $result = reset($result);
            $allcomments = $result['allcoments'];
            $allcomments[] = $_POST;
            $resultArray['page_id'] = $_POST['page_id'];
            $resultArray['allcoments'] = $allcomments;

            $collectionComment->update(
                array(
                    '_id' => new MongoId($id)
                ),
                $resultArray
            );

        } else {
            $resultArray['page_id'] = $_POST['page_id'];
            $resultArray['allcoments'] = array(
                $_POST
            );
            $collectionComment->insert($resultArray);
        }
        $_SESSION['message'] = 'You comment this post';
        $_SESSION['type'] = 'info';
        header('Location:' . $_POST['back_url']);
    }

}