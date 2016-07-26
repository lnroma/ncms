<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 15.07.16
 * Time: 4:51
 */
namespace Core\Block\Factory {

    class Form extends \Core\Block\AbstractClass
    {
        /**
         * forms elements array
         * @var array
         */
        private $_elements = array();
        private $_form = array();
        
        public function __construct()
        {
            $this->setTemplate('factory/form');
        }

        /**
         * prepare form form for get elements
         * in child class
         */
        protected function _prepareForm()
        {
            $this->createForm(
                array(
                    'action' => 'overideMe.html',
                    'method' => 'post'
                )
            );

            $this->addSubmitButton('submit this form');

            return $this;
        }

        /**
         * add submit button
         * @param $label
         * @return $this
         */
        public function addSubmitButton($label)
        {
            $this->addField('submit',array(
                'name' => 'submit',
                'id'   => 'submit-form',
                'class' => 'btn btn-primary',
                'label' => $label
            ));

            return $this;
        }

        /**
         * add fields to form
         * @param $type
         * @param $options
         */
        public function addField($type, $options)
        {
            $this->_elements[] = array(
                'type' => $type,
                'options' => $options
            );

            return $this;
        }

        /**
         * create form with options
         * @param $options
         */
        public function createForm($options)
        {
            $this->_form = $options;
            return $this;
        }

        /**
         * get form options for reder form
         * @return array
         */
        public function getFormOptions()
        {
            $this->getFormElements();
            return $this->_form;
        }

        /**
         * get form elements as array
         * @return array
         */
        public function getFormElements()
        {
            if(count($this->_elements) == 0) {
                $this->_prepareForm();
            }
            return $this->_elements;
        }

        /**
         * validate form element
         * enable only in developers mode
         * @return bool
         * @throws \Exception
         */
        protected function _validateElements()
        {
            if(FLAG_DEBUG == false) {
                return true;
            }

            foreach ($this->_elements as $_element) {

                if(!isset($_element['options']['name'])) {
                    throw new \Exception('Field name is required for form element');
                }

                if(!isset($_element['options']['label'])) {
                    throw new \Exception('Field label is required in element');
                }

                if(!isset($_elemen['options']['id'])) {
                    throw new \Exception('Field id is required for form element');
                }
            }
        }

        /**
         * validate forms before html outputs
         * @return bool
         * @throws \Exception
         */
        public function toHtml()
        {
            $this->_validateElements();
            return parent::toHtml();
        }

    }

}