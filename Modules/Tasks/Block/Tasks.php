<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 18.02.16
 * Time: 14:30
 */
class Tasks_Block_Tasks extends Core_Block_Abstract
{
    /**
     * Tasks_Block_Tasks constructor.
     */
    public function __construct()
    {
        $this->setTemplate('tasks/list');
    }

}