<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 29.02.16
 * Time: 2:06
 */
class Core_Model_Mongo {

    static private $_connect = null;

    private function __construct()
    {
    }

    /**
     * @return MongoDB|null
     */
    static function getConnect() {
        if(!is_null(self::$_connect)) {
            return self::$_connect;
        }
        self::$_connect = new MongoClient(Config_Db::getConf()['mongodb']['connect']);
        return self::$_connect;
    }

    /**
     * get db connect
     * @return MongoCollection
     */
    static function getDb() {
        $con = self::getConnect();
        return $con->{Config_Db::getConf()['mongodb']['db']};
    }

}