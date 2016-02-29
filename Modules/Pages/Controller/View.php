<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 29.02.16
 * Time: 23:39
 */
class Pages_Controller_View extends Core_Controller_Abstract {

    public function indexAction() {
        $this
            ->setKey('page')
            ->setPage('main')
            ->setContent('View')
            ->render();
    }

    public function blogAction() {
        $this
            ->setKey('page')
            ->setPage('main')
            ->setContent('Blog')
            ->render();
    }

}