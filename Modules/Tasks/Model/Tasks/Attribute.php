<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 18.02.16
 * Time: 19:29
 */
class Tasks_Model_Tasks_Attribute extends \Core\Model\AbstractClass
{
    /**
     * Tasks_Model_Tasks_Attribute constructor.
     */
    public function __construct()
    {
        $this->setTableName('task_attribute');
    }

}