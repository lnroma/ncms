<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 10.07.16
 * Time: 16:05
 */
class Install_Install_Install extends Core_Model_Abstract
{
    use Install_Install_Abstract;

    /**
     * your install scripts
     */
    public function install() {
        self::run();
    }

    /**
     * run installation
     */
    final public static function run()
    {
        self::runInstall();
        self::insertVersionAndKey();
    }

    /**
     * insert version to table version
     */
    final protected static function insertVersionAndKey()
    {
        $model = new Core_Model_Abstract();
        $model->setTableName('core_version');
        $model->executeDirectQuery(
            'INSERT INTO `version` set (`version`,`key_module`) VALUE ("'.self::version().'","'.self::key().'")'
        );
    }

    /**
     * run main install procedure
     */
    final public static function runInstall()
    {
        $model = new Core_Model_Abstract();
        try {
            $model
                ->setTableName(`core_version`)
                ->load();
        } catch (Exception $error) {
            $model->executeDirectQuery(
                'CREATE TABLE `version`
              ( `id` INT NOT NULL AUTO_INCREMENT,
                `version` VARCHAR(11),
                `key_module` VARCHAR(11),
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