<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 18.02.16
 * Time: 1:05
 */
class Index_Controller_Index extends \Core\Controller\AbstractClass
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
        header('location:'.\Core\App::getBaseUrl());
    }

    /**
     * set lang english
     */
    public function englishAction() {
        setcookie('locale','en');
        $_SESSION['locale'] = 'en';
        header('location:'.\Core\App::getBaseUrl());
    }
}