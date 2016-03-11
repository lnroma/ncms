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
        self::$_connect = new \MongoDB\Driver\Manager(Config_Db::getConf()['mongodb']['connect']);
//        var_dump(self::$_connect);die;
        return self::$_connect;
    }

    /**
     * insert to mongo db method
     * @param $dataArray
     * @param $collection
     */
    static function insert($dataArray, $collection) {
        $connect = Core_Model_Mongo::getConnect();

        $write = new MongoDB\Driver\BulkWrite();
        $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);

        $write->insert($dataArray);
        $connect->executeBulkWrite(Config_Db::getConf()['mongodb']['db'].'.'.$collection,$write,$writeConcern);
    }

    /**
     * update method
     * @param $dataArray
     * @param $collection
     * @param $id
     */
    static function update($dataArray,$collection,$query) {
        $connect = Core_Model_Mongo::getConnect();

        $write = new MongoDB\Driver\BulkWrite();
        $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY,1000);

        $write->update(
            $query,
            $dataArray
        );

        $connect->executeBulkWrite(Config_Db::getConf()['mongodb']['db'].'.'.$collection,$write,$writeConcern);
    }

 }