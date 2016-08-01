<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 25.07.16
 * Time: 17:34
 */
namespace Customer\Block\Mail {

    class Send extends \Core\Block\Factory\Form
    {

        public function _prepareForm()
        {
            $this->createForm(
                array(
                    'action' => \Core\Helper::getUrl('customer/mail/postSend'),
                    'method' => 'post'
                )
            );

            $userId = null;

            if(isset(\Core\App::getParams()['id'])) {
                $userId = \Core\App::getParams()['id'];
            } elseif(isset(\Core\App::getParams()['sender'])) {
                $userId = \Core\App::getParams()['sender'];
            }

            $this->addField('hidden',array(
                'name' => 'to_email',
                'id' => 'to_email',
                'class' => 'form-control',
                'label' => 'To email',
                'value' => $userId
            ));


            $this->addField('hidden',array(
                'name' => 'back_url',
                'id' => 'back_url',
                'class' => 'form-control',
                'label' => '',
                'value' => $_SERVER['REQUEST_URI']
            ));

            $this->addField('text',array(
                'name' => 'message',
                'id' => 'message',
                'class' => 'form-control',
                'label' => \Core\Helper::__('Your message'),
                'value' => ''
            ));

            $this->addSubmitButton('','glyphicon glyphicon-send');
        }

    }

}