<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 05.08.16
 * Time: 7:35
 */
namespace Seo\Controller {

    use Ratchet\Wamp\Exception;

    class Index extends \Admin\Controller\AbstractClass {

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

        public function editAction()
        {
            $this->addAction();
        }

        /**
         * save this email
         * @throws Exception
         */
        public function addPostAction()
        {
            try {
                if(\Core\App::getPost('id')) {
                    \Core\Model\Mongo::update($_POST,\Seo\Model\Entity::COLLECTION,array(
                        '_id' => new \MongoDB\BSON\ObjectID(\Core\App::getPost('id'))
                    ));
                } else {
                    \Core\Model\Mongo::insert($_POST, \Seo\Model\Entity::COLLECTION);
                }
            } catch (\Exception $error) {
                file_put_contents('logMongo.log',$error->getMessage(),FILE_APPEND);
                if($error->getMessage() != 'norepl') {
                    throw new Exception($error->getMessage());
                }
                header('Location:'.\Core\App::getPost('back_url'));
            }
            file_put_contents('logMongo.log','mongo save good',FILE_APPEND);
            header('Location:'.\Core\App::getPost('back_url'));
        }

    }
}