<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 25.07.16
 * Time: 17:23
 */
namespace Customer\Controller
{
    class Mail extends \Core\Controller\AbstractClass
    {

        public function indexAction()
        {
            $this
                ->setKey('page')
                ->setPage('main')
                ->setContent('Mail\Index')
                ->render();
        }

        public function sendAction()
        {
            $this
                ->setKey('page')
                ->setPage('main')
                ->setContent('Mail\Send')
                ->render();
        }

        /**
         * send email to post
         */
        public function postSendAction()
        {
            $mailInformation = array(
                'to_mail' => \Core\App::getPost('to_email'),
                'from_mail' => $_SESSION['customer_id'],
                'message' => \Core\App::getPost('message'),
                'time' => time(),
                'read' => false
            );
            
            \Core\Model\Mongo::insert($mailInformation,'customer_message');
            
            header('Location:/customer/mail/index');
        }

    }
}