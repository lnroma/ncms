<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 29.02.16
 * Time: 0:28
 */
class Pages_Model_Menu {

    public function __construct()
    {
        $mongo = new MongoClient();
        $db = $mongo->ncms;
        $collection = $db->ncms;
    }

}