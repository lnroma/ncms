<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 18.02.16
 * Time: 13:36
 */
class Core_Block_Error extends Core_Block_Abstract
{
    /**
     * Core_Block_Error constructor.
     */
    public function __construct()
    {
        $this->setTemplate('error/error');
        $this->toHtml();
    }

}