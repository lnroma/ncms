<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 08.08.16
 * Time: 10:41
 */
namespace Forum\Model;

use Core\Model\Mongo;

class Forum  {
    const COLLECTION='forum';

    public static function load($id)
    {
        $id = new \MongoDB\BSON\ObjectID($id);

        return Mongo::simpleSelect('_id',$id,self::COLLECTION);
    }
}