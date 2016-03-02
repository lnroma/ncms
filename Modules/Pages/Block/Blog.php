<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 29.02.16
 * Time: 23:44
 */
class Pages_Block_Blog extends Pages_Block_Abstract {

    /**
     * Pages_Block_Blog constructor.
     */
    public function __construct()
    {
        $this->setTemplate('pages/blog');
    }

}