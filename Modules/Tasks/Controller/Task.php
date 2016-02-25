<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 18.02.16
 * Time: 14:26
 */
class Tasks_Controller_Task extends Core_Controller_Abstract
{

    public function listAction() {
        $this
            ->setPage('main')
            ->setContent('Tasks')
            ->render();
    }
}
