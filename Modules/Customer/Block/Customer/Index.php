<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 25.07.16
 * Time: 14:57
 */
namespace Customer\Block\Customer {
    class Index extends \Core\Block\Factory\Form
    {

        public function _prepareForm()
        {
            $this->createForm(
                array(
                    'action' => \Core\Helper::getUrl('customer/accaunt/save'),
                    'method' => 'post'
                )
            );

            $customerInformation = \Customer\Model\Customer::getCustomer();

            $this->addField('text',array(
                'name' => 'hello_text',
                'id' => 'customer_hello_text',
                'class' => 'form-control',
                'label' => 'Your hello text',
                'value' => $customerInformation->getHelloText()
            ));

            $this->addField('text',array(
                'name' => 'name',
                'id' => 'customer_name',
                'class' => 'form-control',
                'label' => 'Your name',
                'value' => $customerInformation->getName()
            ));

            $this->addField('text',array(
                'name' => 'age',
                'id'   => 'customer_age',
                'class' => 'form-control',
                'label' => 'Your age',
                'value' => $customerInformation->getAge()
            ));

            $this->addField('textarea',array(
                'name' => 'about_self',
                'id' => 'customer_about',
                'class' => 'form-control',
                'label' => 'About self',
                'value' => $customerInformation->getAboutSelf()
            ));

            $this->addSubmitButton('','glyphicon glyphicon-floppy-disk');
        }

    }
}