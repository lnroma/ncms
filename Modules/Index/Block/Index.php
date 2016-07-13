<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 09.10.15
 * Time: 22:48
 */
class Index_Block_Index extends \Core\Block\AbstractClass
{
    /**
     * call block and render
     */
    public function __construct() {
        $this->setTemplate('index');
    }

}
