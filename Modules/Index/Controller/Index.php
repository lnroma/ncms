<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 18.02.16
 * Time: 1:05
 */
class Index_Controller_Index extends Core_Controller_Abstract
{

    /**
     * render main page
     */
    public function indexAction() {
        $this
            ->setKey('page')
            ->setPage('main')
            ->setContent('Index')
            ->render();
    }

    /**
     * set Russian lang
     */
    public function ruAction() {
        setcookie('locale','ru');
        $_SESSION['locale'] = 'ru';
        header('location:'.Core_App::getBaseUrl());
    }

    /**
     * set lang english
     */
    public function englishAction() {
        setcookie('locale','en');
        $_SESSION['locale'] = 'en';
        header('location:'.Core_App::getBaseUrl());
    }
}