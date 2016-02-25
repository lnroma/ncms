<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 20.02.16
 * Time: 22:08
 */
class Contact_Controller_Create extends Core_Controller_Abstract {

    /**
     * create action
     */
    public function indexAction() {
        $this
            ->setPage('main')
            ->setContent('Create')
            ->render();
    }

    /**
     * add attribute action
     */
    public function addAttributeAction() {
        $this
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
        $block = new Core_Block_Abstract();
        $contactBlock = new Contact_Block_Create();
        $contactBlock->setId($idEditted);
        $block->setTemplate('contact/forms/create');
        ob_start();
         $block->toHtml();
         $html = ob_get_contents();
        ob_end_clean();

        if(isset(Core_App::getParams()['isAjax'])) {
            echo json_encode(array(
                'html' => $html
            ));
            die;
        }
        return $html;
    }

}