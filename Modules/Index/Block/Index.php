<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 09.10.15
 * Time: 22:48
 */
namespace Index\Block {
    /**
     * Class Index
     * @package Index\Block
     */
    class Index extends \Core\Block\AbstractClass
    {
        /**
         * call block and render
         */
        public function __construct()
        {
            $this->setTemplate('index');
        }

    }
}