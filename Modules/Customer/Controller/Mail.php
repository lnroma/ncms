<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 25.07.16
 * Time: 17:23
 */
namespace Customer\Controller
{

    use Ratchet\Wamp\Exception;

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

        public function readAction()
        {
            $messageUnread = \Core\Model\Mongo::select(
                array(
                    'to_mail' => $_SESSION['customer_id'],
                    'read' => false
                ),
                'customer_message',
                array()
            );

            foreach ($messageUnread as $_unread) {
                \Core\Model\Mongo::update(
                    array(
                        '$set' => array(
                            'read' => true
                        )
                    ),
                    'customer_message',
                    array(
                        '_id' => $_unread->_id
                    )
                );
            }
            $this
                ->setKey('page')
                ->setPage('mail')
                ->setContent('Mail\Read')
                ->setForm('Mail\Send')
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
            try {
                $mailInformation = array(
                    'to_mail' => \Core\App::getPost('to_email'),
                    'from_mail' => $_SESSION['customer_id'],
                    'message' => \Core\App::getPost('message'),
                    'time' => time(),
                    'read' => false
                );

                \Core\Model\Mongo::insert($mailInformation, 'customer_message');

                header('Location:' . \Core\App::getPost('back_url'));
            } catch (\Exception $error) {
                if($error->getMessage() == 'norepl') {
                    header('Location:' . \Core\App::getPost('back_url'));
                } else {
                    throw new \Exception($error->getMessage());
                }
            }
        }

    }
}