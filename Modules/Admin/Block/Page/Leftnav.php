<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 17:36
 */
namespace Admin\Block\Page {
    /**
     * Class Leftnav
     * @package Admin\Block\Pagem
     */
    class Leftnav extends \Core\Block\AbstractClass
    {

        public function __construct()
        {
            $this->setTemplate('admin/navigation/nav');
        }

    }
}