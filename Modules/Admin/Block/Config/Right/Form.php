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
        $this->_setHeader(\Core\Helper::__('Base configuration'));
        $this->_setFooter(\Core\Helper::__('Settings base configuration url, base path or over'));

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
                    'label' => \Core\Helper::__('Base url'),
                    'name'  => 'url',
                    'placeholder' => \Core\Helper::__('base url'),
                )
            )
            ->_addElement('text', 'basePath',
                array(
                    'label' => \Core\Helper::__('Base path'),
                    'name'  => 'basePath',
                    'placeholder' => \Core\Helper::__('Path to base'),
                )
            )
        ;

        return $this;
    }

}