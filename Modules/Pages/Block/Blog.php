<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 29.02.16
 * Time: 23:44
 */
namespace Pages\Block {
    class Blog extends \Pages\Block\AbstractClass
    {

        /**
         * Pages_Block_Blog constructor.
         */
        public function __construct()
        {
            $this->setTemplate('pages/blog');
        }

    }
}