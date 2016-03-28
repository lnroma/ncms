<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 18.02.16
 * Time: 14:14
 */
class Tasks_Model_Tasks extends Core_Model_Abstract
{
    /**
     * Tasks_Model_Tasks constructor.
     */
    public function __construct()
    {
        $this->setTableName('task_entity');
    }

}