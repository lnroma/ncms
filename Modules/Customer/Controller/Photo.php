<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 02.08.16
 * Time: 8:06
 */
namespace Customer\Controller {
    class Photo extends \Core\Controller\AbstractClass
    {
        public function indexAction()
        {
            $this
                ->setKey('page')
                ->setPage('main')
                ->setContent('Photo\Index')
                ->render();
        }

        /**
         * upload image action
         */
        public function uploadAction()
        {
            if(isset($_FILES['file'])) {
                $directory = \Core\App::getRootPath().'uploads'.DIRECTORY_SEPARATOR.$_SESSION['customer_id'];
                if(!file_exists($directory)) {
                    mkdir($directory);
                }
                if($_FILES['file']['error'] == 0) {
                    move_uploaded_file($_FILES['file']['tmp_name'],
                        $directory.DIRECTORY_SEPARATOR.$_FILES['file']['name']);
                }
            }
            header('Location:'.$_POST['url']);
        }
    }
}