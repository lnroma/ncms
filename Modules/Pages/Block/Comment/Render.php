<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 02.03.16
 * Time: 11:42
 */
namespace Pages\Block\Comment {
    class Render extends \Pages\Block\AbstractClass
    {

        /**
         * Pages_Block_Viewmenu constructor.
         */
        public function __construct()
        {
            $this->setTemplate('pages/comment/comment');
            $this->toHtml();
        }

        public function toHtml()
        {
            return parent::toHtml(); // TODO: Change the autogenerated stub
        }

    }
}