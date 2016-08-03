<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 02.08.16
 * Time: 8:06
 */
namespace Customer\Controller {

    use Core\App;

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

        public function removeAction()
        {
            $file = \Core\App::getRootPath().'uploads'.DIRECTORY_SEPARATOR.$_SESSION['customer_id'].DIRECTORY_SEPARATOR.\Core\App::getPost('file');
            if(file_exists($file)) {
                unlink($file);
            }
            header('Location:'.\Core\App::getPost('back_url'));
        }

        public function interAction()
        {
            $directory = \Core\App::getRootPath().'uploads'.DIRECTORY_SEPARATOR.$_SESSION['customer_id'];

            if(md5(\Core\App::getPost('password')) == trim(file_get_contents($directory.DIRECTORY_SEPARATOR.'.htpasswd'))) {
                $_SESSION[\Core\App::getPost('user_id')] = true;
            }
            header('Location:'.\Core\App::getPost('back_url'));
        }

        public function setAvatarAction()
        {
            $url = \Core\App::getBaseUrl().'uploads'.DIRECTORY_SEPARATOR.$_SESSION['customer_id'].DIRECTORY_SEPARATOR.\Core\App::getPost('file');
            try {
                \Core\Model\Mongo::update(
                    array(
                        '$set' => array(
                            'avatar' => $url
                        )
                    ),
                    'customer',
                    array(
                        'id' => $_SESSION['customer_id']
                    )
                );
            } catch (\Exception $error) {
                //todo make loging
            }
            header('Location:'.\Core\App::getPost('back_url'));
        }

        public function passwordAction()
        {
            if(\Core\App::getPost('password')) {
                $directory = \Core\App::getRootPath().'uploads'.DIRECTORY_SEPARATOR.$_SESSION['customer_id'];
                if(!file_exists($directory)) {
                    mkdir($directory);
                }

                file_put_contents($directory.DIRECTORY_SEPARATOR.'.htpasswd',md5(\Core\App::getPost('password')));

                header('Location:'.\Core\App::getPost('back_url'));
            }
        }
    }
}