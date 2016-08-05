<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 05.08.16
 * Time: 10:15
 */
namespace Seo\Model {

    use Core\Model\Mongo;

    class Entity {
        const COLLECTION = 'seo';

        public static function load($id)
        {
            $id = new \MongoDB\BSON\ObjectID($id);

            return Mongo::simpleSelect('_id',$id,self::COLLECTION);
        }
    }

}