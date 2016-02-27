<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 16:45
 */
class Admin_Controller_Dashboard extends Admin_Controller_Abstract
{

    public function indexAction() {
        $this
            ->setPage('admin')
            ->setKey('admin_page')
            ->setContentLeft('Page_Content_Left')
            ->setContentRight('Page_Content_Right')
            ->setLeft('Page_Leftnav')
            ->render();
    }

}