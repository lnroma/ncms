<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 13.07.16
 * Time: 19:14
 */
namespace Urladmin\Install
{
    class Install extends \Install\Install\Install
    {

        /**
         * install script for this module
         */
        public function install()
        {
            $model = new \Core\Model\AbstractClass();
            $model->executeDirectQuery(
                '
                CREATE TABLE IF NOT EXISTS `url_rewrite` (
  `id` int(11) NOT NULL,
  `from_url` text,
  `to_url` text,
  `type` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1
                '
            );
        }

        /**
         * version for this module
         * @return string
         */
        public static function version()
        {
            return '0.0.1';
        }

        /**
         * key for this module
         * @return string
         */
        public static function key()
        {
            return 'urladmin/url';
        }

    }

}