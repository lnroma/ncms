<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 12.07.16
 * Time: 10:21
 */
namespace Contact\Install {

    class Install  extends \Install\Install\Install
    {
        /**
         * run install scripts
         */
        public function install()
        {
            $model = new \Core\Model\AbstractClass();
            $model->executeDirectQuery('
                CREATE TABLE IF NOT EXISTS `contacts_attribute` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `type_input` varchar(32) NOT NULL,
  `required` text,
  `placeholder` varchar(30) NOT NULL,
  `show_in_greed` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
            ');

            $model->executeDirectQuery('
            INSERT INTO `contacts_attribute` (`id`, `name`, `type_input`, `required`, `placeholder`, `show_in_greed`) VALUES
(12, \'First name\', \'text\', \'required\', \'Your first name\', 1),
(13, \'stnstnstn\', \'text\', \'required\', \'stn\', 1),
(31, \'create attribute for testing\', \'email\', \'required\', \'1234\', 0);
            ');

            $model->executeDirectQuery(
              '
CREATE TABLE IF NOT EXISTS `contacts_attribute_value` (
  `id` int(11) NOT NULL,
  `id_contact` int(11) NOT NULL,
  `id_attribute` int(11) NOT NULL,
  `value` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              '
            );

            $model->executeDirectQuery('CREATE TABLE IF NOT EXISTS `contacts_entity` (
  `id` int(11) NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;
');

        }

        /**
         * set version for module contact
         * @return string
         */
        public static function version()
        {
            return '0.0.1';
        }

        /**
         * set key for module contact
         * @return string
         */
        public static function key()
        {
            return  'core/contact';
        }

    }

}