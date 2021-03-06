<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 20.02.16
 * Time: 22:08
 */
class Contact_Controller_Create extends \Core\Controller\AbstractClass {

    /**
     * create action
     */
    public function indexAction() {
        $this
            ->setKey('page')
            ->setPage('main')
            ->setContent('Create')
            ->render();
    }

    /**
     * add attribute action
     */
    public function addAttributeAction() {
        $this
            ->setKey('page')
            ->setPage('main')
            ->setContent('Attribute')
            ->render();
    }

    /**
     * render modal action
     * @param null $idEditted
     * @return string
     */
    public function renderModalAction($idEditted = null)
    {
        $block = new \Core\Block\AbstractClass();
        $contactBlock = new Contact_Block_Create();
        $contactBlock->setId($idEditted);
        $block->setTemplate('contact/forms/create');
        ob_start();
         $block->toHtml();
         $html = ob_get_contents();
        ob_end_clean();

        if(isset(\Core\App::getParams()['isAjax'])) {
            echo json_encode(array(
                'html' => $html
            ));
            die;
        }
        return $html;
    }

}