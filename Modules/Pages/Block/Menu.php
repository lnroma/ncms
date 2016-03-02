<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 01.03.16
 * Time: 23:02
 */
class Pages_Block_Menu extends Pages_Block_Abstract
{

    /**
     * Pages_Block_Menu constructor.
     */
    public function __construct()
    {
        $this->setTemplate('pages/menu');
    }

}