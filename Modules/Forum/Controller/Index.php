<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 08.08.16
 * Time: 10:45
 */
namespace Forum\Controller;

use Ratchet\Wamp\Exception;

/**
 *
 * Class Index
 *
 *
 * @package Forum\Controller
 */
class Index extends \Core\Controller\AbstractClass
{

    /**
     * show index forum page
     */
    public function indexAction()
    {
        $this
            ->setKey('page')
            ->setPage('main')
            ->setContent('Index')
            ->render();
    }

    public function viewAction()
    {
        if (isset(\Core\App::getParams()['trade_id'])) {
            $this
                ->setKey('page')
                ->setPage('forum_read')
                ->setMessage('Trade\Message\Trade')
                ->setContent('Trade\Message\View')
                ->setForm('Trade\Message\Add')
                ->render();
        } else {
            $this
                ->setKey('page')
                ->setPage('main')
                ->setContent('Trade\View')
                ->render();
        }
    }

    public function addAction()
    {
        $this
            ->setKey('page')
            ->setPage('main')
            ->setContent('Trade\Add')
            ->render();
    }

    public function addPostAction()
    {
        try {
            if (!\Core\App::getPost('id')) {
               $result =  \Core\Model\Mongo::insert(
                    $_POST,
                    \Forum\Model\Forum\Trade::COLLECTION
                );
                var_dump($result);
            } else {
                \Core\Model\Mongo::update(
                    $_POST
                    , \Forum\Model\Forum\Trade::COLLECTION,
                    array(
                        '_id' => new \MongoDB\BSON\ObjectID(\Core\App::getPost('id'))
                    )
                );
            }
        } catch (Exception $error) {

        }
        header('Location:' . \Core\App::getPost('back_url'));
    }

    public function addPostMessageAction()
    {
        try {
            \Core\Model\Mongo::insert(
                $_POST,
                \Forum\Model\Forum\Trade\Message::COLLECTION
            );
        } catch (Exception $error) {

        }
        header('Location:' . \Core\App::getPost('back_url'));
    }

}