<?php
namespace Install\Install {
    /**
     * Created by PhpStorm.
     * User: roman
     * Date: 10.07.16
     * Time: 16:05
     */
    use Core\Model\AbstractClass;
    
    class Install extends \Core\Model\AbstractClass
    {
        use \Install_Install_Abstract;

        /**
         * your install scripts
         */
        public function install()
        {
            self::runInstall();
        }

        /**
         * insert version to table version
         */
        final public function insertVersionAndKey()
        {
            $model = new AbstractClass();
            $model->setTableName('core_version');
            $model->executeDirectQuery(
                'INSERT INTO `version` (`id`, `version`, `key_module`) VALUES (NULL, "'.self::version().'", "'.self::key().'");'
            );
        }

        /**
         * run main install procedure
         */
        final public static function runInstall()
        {
            $model = new AbstractClass();
            try {
                $model
                    ->setTableName('core_version')
                    ->load();
            } catch (\Exception $error) {
                $model->executeDirectQuery(
                    'CREATE TABLE `version`
              ( `id` INT NOT NULL AUTO_INCREMENT,
                `version` VARCHAR(11),
                `key_module` VARCHAR(32),
                PRIMARY KEY (`id`)
              )ENGINE=InnoDB;'
                );
            }
        }

        /**
         * return version for you script install
         * @return string
         */
        public static function version()
        {
            return '0.0.1';
        }

        /**
         * return key for you script install
         * @return string
         */
        public static function key()
        {
            return 'core/install';
        }
    }
}