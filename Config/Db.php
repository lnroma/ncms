<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 24.10.15
 * Time: 12:18
 */

class Config_Db {

    /**
     * get config
     * @return array
     */
    static function getConf() {
        return array(
            'db_host' => 'mysql:host=localhost;dbname=contacts',
            'user'  => 'root',
            'pass'  => '123',
            'mongodb' => array(
                'connect' => 'mongodb://ncms:ncms123@localhost:27017/ncms',
                'db' => 'ncms'
            )
        );
    }

}