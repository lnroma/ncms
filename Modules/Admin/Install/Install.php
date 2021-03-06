<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 12.07.16
 * Time: 10:04
 */
namespace Admin\Install {
    use Core\Model\AbstractClass as AbstractClassPsevdo;
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
            $model = new AbstractClassPsevdo();
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

            $model->executeDirectQuery('ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id_entity`);');

            $model->executeDirectQuery('ALTER TABLE `admin_user_role`
  ADD PRIMARY KEY (`entity_id`);
');

            $model->executeDirectQuery('
  ALTER TABLE `admin_user`
  MODIFY `id_entity` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;'
            );

            $model->executeDirectQuery('
                ALTER TABLE `admin_user_role`
  MODIFY `entity_id` int(11) NOT NULL AUTO_INCREMENT;
            ');
//            echo
//                'INSERT INTO `admin_user` ( `login`, `pass`) VALUES
//                ("'.$_POST['admin']['user'].'", "'.md5($_POST['admin']['password']).'")';die;

            $model->executeDirectQuery(
                'INSERT INTO `admin_user` (`id_entity`, `login`, `pass`) VALUES
                (NULL , "'.$_POST['admin']['user'].'", "'.md5($_POST['admin']['password']).'")'
            );

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