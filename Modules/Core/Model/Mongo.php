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
     * @return \MongoDB\Driver\Manager
     */
    static function getConnect() {
        if(!is_null(self::$_connect)) {
            return self::$_connect;
        }
        self::$_connect = new \MongoDB\Driver\Manager(Config_Db::getConf()['mongodb']['connect']);
        return self::$_connect;
    }

    /**
     * insert to mongo db method
     * @param $dataArray
     * @param $collection
     */
    static function insert($dataArray, $collection) {
        /** check exist collection if not exists then create */

        $connect = Core_Model_Mongo::getConnect();

        $write = new MongoDB\Driver\BulkWrite();
        $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY);

        $write->insert($dataArray);
        $connect->executeBulkWrite(Config_Db::getConf()['mongodb']['db'].'.'.$collection,$write,$writeConcern);
    }

    /**
     * delete in mongo db method
     * @param $dataArray
     * @param $collection
     */
    static function delete($dataArray,$collection) {
        $connect = Core_Model_Mongo::getConnect();
        $write = new MongoDB\Driver\BulkWrite();
        $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
//        var_dump($dataArray);die;
        $write->delete($dataArray);
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

    /**
     * create collection
     * @param $name
     * @param bool $capped
     * @param int $size
     * @param int $max
     */
    static function createCollection($name,$capped = true,$size = 10*1024,$max=10) {
        $command = new MongoDB\Driver\Command(array(
            'create' => $name,
            'capped' => $capped,
            'size' => $size,
            'max'   => $max
        ));
        $connect = Core_Model_Mongo::getConnect();
        $connect->executeCommand(Config_Db::getConf()['mongodb']['db'],$command);
    }

    /**
     * @param $key
     * @param $value
     * @param $dbName
     * @return array | MongoCursor
     */
    static function simpleSelect($key,$value,$dbName) {
        $con = Core_Model_Mongo::getConnect();

        $query = new MongoDB\Driver\Query(
            array(
                $key => $value
            )
        );
        return  $con->executeQuery(Config_Db::getConf()['mongodb']['db'].'.'.$dbName,$query);
    }

 }