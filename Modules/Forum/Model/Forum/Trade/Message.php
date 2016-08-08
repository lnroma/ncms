<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 08.08.16
 * Time: 15:37
 */
namespace Forum\Model\Forum\Trade;

use \Core\Model\Mongo;

class Message  {
    
    const COLLECTION = 'forum_trade_message';
    
    public function load($id) 
    {
        $id = new \MongoDB\BSON\ObjectID($id);

        return Mongo::simpleSelect('_id',$id,self::COLLECTION);
    }
    
    public function loadByAttribute($attribute,$value) 
    {
        return Mongo::simpleSelect($attribute,$value,self::COLLECTION);
    }
    
}