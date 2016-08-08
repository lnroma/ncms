<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 05.08.16
 * Time: 8:29
 */
namespace Forum\Block\Trade\Message {
    class Add extends \Core\Block\Factory\Form
    {

        public function __construct()
        {
            $this->setTemplate('forum/trade/form');
        }

        protected function _prepareForm()
        {
            $this->createForm(
                array(
                    'action' => \Core\Helper::getUrl('forum/index/addPostMessage'),
                    'method' => 'post',
                )
            );

            $values = new \stdClass();

            $values->title = '';
            $values->message = '';
            $values->url_key = '';

            if(isset(\Core\App::getParams()['message_id'])) {
                $values = \Forum\Model\Forum::load(\Core\App::getParams()['message_id']);
                $values = $values->toArray()[0];
                $this->addField('hidden',array(
                    'name' => 'id',
                    'id' => 'mongo_id',
                    'class' => 'form-control',
                    'label' => 'id',
                    'value' => \Core\App::getParams()['message_id']
                ));
            }

            $this->addField('textarea',array(
                'name' => 'message',
                'id' => 'message',
                'class' => 'form-control',
                'label' => 'Ваше сообщение',
                'value' => $values->message
            ));

            $this->addField('hidden',array(
                'name' => 'back_url',
                'id' => 'back_url',
                'class' => 'form-control',
                'label' => 'Title for the page',
                'value' => $_SERVER['REQUEST_URI']
            ));

            $this->addField('hidden',array(
                'name' => 'owner',
                'id' => 'owner',
                'class' => 'form-control',
                'label' => 'Title for the page',
                'value' => $_SESSION['customer_id']
            ));

            $this->addField('hidden',array(
                'name' => 'time',
                'id' => 'time',
                'class' => 'form-control',
                'label' => '',
                'value' => time()
            ));

            $this->addField('hidden',array(
                'name' => 'post_id',
                'id' => 'post_id',
                'class' => 'form-control',
                'label' => '',
                'value' => \Core\App::getParams()['trade_id']
            ));

            $this->addSubmitButton('Отправить');
        }
    }
}