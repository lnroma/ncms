<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 18.02.16
 * Time: 13:36
 */
class Core_Block_Notfound extends \Core\Block\AbstractClass {

    public function __construct()
    {
        $this->setTemplate('error/notfound');
        $this->toHtml();
    }

}