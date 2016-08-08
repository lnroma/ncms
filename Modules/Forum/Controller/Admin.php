<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 08.08.16
 * Time: 14:41
 */
namespace Forum\Controller;

class Admin extends \Admin\Controller\AbstractClass {

    public function indexAction()
    {
        $this
            ->setPage('onecollumn')
            ->setKey('admin_page')
            ->setContent('Admin\Grid')
            ->render();
    }

    public function addAction()
    {
        $this
            ->setPage('onecollumn')
            ->setKey('admin_page')
            ->setContent('Admin\Add')
            ->render();
    }

    /**
     * save this email
     * @throws Exception
     */
    public function addPostAction()
    {
        try {
            if(\Core\App::getPost('id')) {
                \Core\Model\Mongo::update($_POST,\Forum\Model\Forum::COLLECTION,array(
                    '_id' => new \MongoDB\BSON\ObjectID(\Core\App::getPost('id'))
                ));
            } else {
                \Core\Model\Mongo::insert($_POST, \Forum\Model\Forum::COLLECTION);
            }
        } catch (\Exception $error) {
            if($error->getMessage() != 'norepl') {
                throw new \Exception($error->getMessage());
            }
            header('Location:'.\Core\App::getPost('back_url'));
        }
        header('Location:'.\Core\App::getPost('back_url'));
    }

    public function editAction()
    {
        $this->addAction();
    }

}