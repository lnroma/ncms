<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 29.02.16
 * Time: 23:44
 */
namespace Pages\Block {
    class View extends \Pages\Block\AbstractClass
    {

        /**
         * Pages_Block_View constructor.
         */
        public function __construct()
        {
            $this->setTemplate('pages/view');
        }

    }
}