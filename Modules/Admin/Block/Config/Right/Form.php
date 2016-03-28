<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 19.03.16
 * Time: 14:45
 */
class Admin_Block_Config_Right_Form extends Admin_Block_Config_Left_Form
{

    /**
     * Admin_Block_Config_Left_Form constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->_setHeader(Core_Helper::__('Base configuration'));
        $this->_setFooter(Core_Helper::__('Settings base configuration url, base path or over'));

    }

    /**
     * prepare form
     * @return $this
     */
    protected function _prepareForm()
    {
        $this
            ->_addElement('text', 'baseUrl',
                array(
                    'label' => Core_Helper::__('Base url'),
                    'name'  => 'url',
                    'placeholder' => Core_Helper::__('base url'),
                )
            )
            ->_addElement('text', 'basePath',
                array(
                    'label' => Core_Helper::__('Base path'),
                    'name'  => 'basePath',
                    'placeholder' => Core_Helper::__('Path to base'),
                )
            )
        ;

        return $this;
    }

}