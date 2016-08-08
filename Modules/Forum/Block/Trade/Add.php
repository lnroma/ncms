<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 05.08.16
 * Time: 8:29
 */
namespace Forum\Block\Trade {
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
                    'action' => \Core\Helper::getUrl('forum/index/addPost'),
                    'method' => 'post',
                )
            );

            $values = new \stdClass();

            $values->title = '';
            $values->message = '';
            $values->url_key = '';

            if(isset(\Core\App::getParams()['trade_id'])) {
                $trade = new \Forum\Model\Forum\Trade();
                $values = $trade->load(\Core\App::getParams()['trade_id']);
                $values = $values->toArray()[0];
                $this->addField('hidden',array(
                    'name' => 'id',
                    'id' => 'mongo_id',
                    'class' => 'form-control',
                    'label' => 'id',
                    'value' => \Core\App::getParams()['trade_id']
                ));
            }

            $this->addField('text',array(
                'name' => 'title',
                'id' => 'forum_name',
                'class' => 'form-control',
                'label' => 'Название поста',
                'value' => $values->title
            ));

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
                'name' => 'trade',
                'id' => 'trade',
                'class' => 'form-control',
                'label' => '',
                'value' => \Core\App::getParams()['trade']
            ));

            $this->addSubmitButton('Save','glyphicon glyphicon-floppy-disk');
        }
    }
}