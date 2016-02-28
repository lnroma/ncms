<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 29.02.16
 * Time: 2:06
 */
class Core_Model_Mongo {

    static private $_db = null;

    private function __construct()
    {
    }

    /**
     * @return MongoDB|null
     */
    static function getDb() {
        if(!is_null(self::$_db)) {
            return self::$_db;
        }
        $mongo = new MongoClient(Config_Db::getConf()['mongodb']['connect']);
        self::$_db = $mongo->{Config_Db::getConf()['mongodb']['db']};
        return self::$_db;
    }

}