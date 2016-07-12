<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 19.03.16
 * Time: 14:45
 */
namespace Admin\Block\Config\Left {
    class Form extends \Core_Block_Abstract
    {

        private $_layerElement = array();

        /**
         * \Admin\Block\Config\Left\Form constructor.
         */
        public function __construct()
        {
            $this->_setHeader(\Core\Helper::__('Design configuration'));
            $this->_setAction(\Core\App::getBaseUrl() . '/' . Config_App::getConfig()['adminurl'] . '/config/saveDis/');
            $this->_setFooter(\Core\Helper::__('this is settings design, for your application'));
            $this->_setTemplate();
            $this->_prepareForm();
            return $this;
        }

        /**
         * rewrite this function for set custom template
         */
        protected function _setTemplate()
        {
            $this->setTemplate('admin/config/form');
        }

        /**
         * prepare form
         * @return $this
         */
        protected function _prepareForm()
        {
//        var_dump(Core_Model_Mongo::selectAll('config')->toArray());die;
            $this
                ->_addElement('text', 'dis',
                    array(
                        'label' => \Core\Helper::__('Design theme'),
                        'name' => 'theme',
                        'placeholder' => \Core\Helper::__('theme'),
                    )
                );
            return $this;
        }

        /**
         * set action to form
         * @param $action
         * @return $this
         */
        protected function _setAction($action)
        {
            $this->setData('action', $action);
            return $this;
        }

        /**
         * set header to panel
         * @param $header
         * @return $this
         */
        protected function _setHeader($header)
        {
            $this->setData('header', $header);
            return $this;
        }

        /**
         * set footer for panel
         * @param $footer
         * @return $this
         */
        protected function _setFooter($footer)
        {
            $this->setData('footer', $footer);
            return $this;
        }

        /**
         * add elements to form
         * @param $type
         * @param $id
         * @param $attributes
         * @return $this
         */
        protected function _addElement($type, $id, $attributes)
        {
            /** @var \Admin\Block\Config\Left\Form\Element $element */
            $element = $this->getChunk(null, '\Admin\Block\Config\Left\Form\Element');
            $element
                ->setData('type', $type)
                ->setData('id', $id)
                ->setData('attributes', $attributes);

            $this->_layerElement[$id] = $element;

            return $this;
        }

        /**
         * get layer elements
         * @return array
         */
        public function getLayerElement()
        {
            return $this->_layerElement;
        }

    }
}