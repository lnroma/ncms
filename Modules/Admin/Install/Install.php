<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 12.07.16
 * Time: 10:04
 */
namespace Admin\Install {

    /**
     * install administration modules
     * Class Admin_Install_Install
     * @package Admin\Install
     */
    class Install extends \Install\Install\Install
    {
        /**
         * run install process
         */
        public function install()
        {
            $model = new \Core_Model_Abstract();
            $model->executeDirectQuery('
CREATE TABLE IF NOT EXISTS `admin_user` (
  `id_entity` int(11) NOT NULL,
  `login` varchar(11) DEFAULT NULL,
  `pass` varchar(32) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT=\'user administrators\'
');
            $model->executeDirectQuery(
                'CREATE TABLE IF NOT EXISTS `admin_user_role` (
  `entity_id` int(11) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1'
            );
            
            
            parent::install();
        }

        /**
         * return modules version for this script
         * @return string
         */
        public static function version() {
            return '0.0.1';
        }

        /**
         * return key for this module
         * @return string
         */
        public static function key()
        {
            return 'core/admin';
        }
    }
}