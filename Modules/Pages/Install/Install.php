<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 12.07.16
 * Time: 10:43
 */
namespace Pages\Install {

    class Install extends \Install\Install\Install
    {

        public function install()
        {
            $model = new \Core_Model_Abstract();
            $model->executeDirectQuery('
CREATE TABLE IF NOT EXISTS `pages` (
  `id_entity` int(11) NOT NULL,
  `title` text,
  `description` text,
  `content` text,
  `menu_id` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT=\'cms page\'
');


            parent::install(); 
        }

        /**
         * @return string
         */
        public static function version()
        {
            return '0.0.1';
        }
        
        public static function key()
        {
            return 'cms/page';
        }
    }
}