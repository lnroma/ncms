<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 29.02.16
 * Time: 2:06
 */
namespace Core\Model {
    class Mongo
    {

        static private $_connect = null;

        private function __construct()
        {
        }

        /**
         * @return \MongoDB\Driver\Manager
         */
        static function getConnect()
        {
            if (!is_null(self::$_connect)) {
                return self::$_connect;
            }

            $config = new \Core\Configuration();
            self::$_connect = new \MongoDB\Driver\Manager($config->getDb()['mongodb']['connect']);
            return self::$_connect;
        }

        /**
         * insert to mongo db method
         * @param $dataArray
         * @param $collection
         */
        static function insert($dataArray, $collection)
        {
            /** check exist collection if not exists then create */

            $connect = \Core\Model\Mongo::getConnect();

            $write = new \MongoDB\Driver\BulkWrite();
            $writeConcern = new \MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY);

            $write->insert($dataArray);
            $connect->executeBulkWrite(Config_Db::getConf()['mongodb']['db'] . '.' . $collection, $write, $writeConcern);
        }

        /**
         * delete in mongo db method
         * @param $dataArray
         * @param $collection
         */
        static function delete($dataArray, $collection)
        {
            $connect = \Core\Model\Mongo::getConnect();
            $write = new \MongoDB\Driver\BulkWrite();
            $writeConcern = new \MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
            $write->delete($dataArray);
            $connect->executeBulkWrite(Config_Db::getConf()['mongodb']['db'] . '.' . $collection, $write, $writeConcern);
        }

        /**
         * update method
         * @param $dataArray
         * @param $collection
         * @param $id
         */
        static function update($dataArray, $collection, $query)
        {
            $connect = \Core\Model\Mongo::getConnect();

            $write = new \MongoDB\Driver\BulkWrite();
            $writeConcern = new \MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);

            $write->update(
                $query,
                $dataArray
            );

            $connect->executeBulkWrite(Config_Db::getConf()['mongodb']['db'] . '.' . $collection, $write, $writeConcern);
        }

        /**
         * create collection
         * @param $name
         * @param bool $capped
         * @param int $size
         * @param int $max
         */
        static function createCollection($name, $capped = true, $size = 10 * 1024, $max = 10)
        {
            $command = new \MongoDB\Driver\Command(array(
                'create' => $name,
                'capped' => $capped,
                'size' => $size,
                'max' => $max
            ));
            $connect = \Core\Model\Mongo::getConnect();
            $configuration = new \Core\Configuration();
            $connect->executeCommand($configuration->getDb()['mongodb']['db'], $command);
        }

        /**
         * @param $key
         * @param $value
         * @param $collection
         * @return array | \MongoCursor
         */
        static function simpleSelect($key, $value, $collection)
        {
            $con = \Core\Model\Mongo::getConnect();

            $query = new \MongoDB\Driver\Query(
                array(
                    $key => $value
                )
            );

            $configuration = new \Core\Configuration();

            return $con->executeQuery($configuration->getDb()['mongodb']['db'] . '.' . $collection, $query);
        }

        /**
         * get all document in collection
         * @param $collection
         * @return \MongoDB\Driver\Cursor
         */
        static function selectAll($collection)
        {
            $query = new \MongoDB\Driver\Query(array());
            $configuration = new \Core\Configuration();
            return self::getConnect()->executeQuery($configuration->getDb()['mongodb']['db'] . '.' . $collection, $query);
        }

    }
}