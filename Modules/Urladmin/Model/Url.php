<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 20:45
 */
namespace Urladmin\Model {
    class Url extends \Core\Model\AbstractClass
    {
        const REWRITE = 0;
        const REDIRECT = 1;

        public function __construct()
        {
            $this->setTableName('url_rewrite');
        }
    }
}