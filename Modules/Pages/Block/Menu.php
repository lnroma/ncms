<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 01.03.16
 * Time: 23:02
 */
namespace Pages\Block {
    class Menu extends \Pages\Block\AbstractClass
    {

        /**
         * Pages_Block_Menu constructor.
         */
        public function __construct()
        {
            $this->setTemplate('pages/menu');
        }

    }
}