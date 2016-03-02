<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 29.02.16
 * Time: 23:44
 */
class Pages_Block_View extends Pages_Block_Abstract {

    /**
     * Pages_Block_View constructor.
     */
    public function __construct()
    {
        $this->setTemplate('pages/view');
    }

}