<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 18.02.16
 * Time: 19:31
 */
class Tasks_Model_Tasks_Attribute_Value extends Core_Model_Abstract
{
    public function __construct()
    {
        $this->setTableName('task_attribute_value');
    }
}
