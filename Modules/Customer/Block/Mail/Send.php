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

            $customerInformation = \Customer\Model\Customer::getCustomer();

            $this->addField('text',array(
                'name' => 'to_email',
                'id' => 'to_email',
                'class' => 'form-control',
                'label' => 'To email',
                'value' => \Core\App::getParams()['id']
            ));

            $this->addField('textarea',array(
                'name' => 'message',
                'id' => 'message',
                'class' => 'form-control',
                'label' => 'Your message',
                'value' => ''
            ));

            $this->addSubmitButton('Send email');
        }

    }

}