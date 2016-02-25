<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 18.02.16
 * Time: 14:26
 */
class Contact_Controller_Index extends Core_Controller_Abstract
{
    /**
     * save attribute action
     */
    public function saveAttribAction() {
        $post = array();
        $post['type_input'] = Core_App::getPost('type_input');
        $post['name'] = Core_App::getPost('name');
        $post['required'] = Core_App::getPost('required')?Core_App::getPost('required'):'';
        $post['placeholder'] = Core_App::getPost('placeholder')?Core_App::getPost('placeholder'):'';
        $post['show_in_greed'] = Core_App::getPost('show_in_greed')?Core_App::getPost('show_in_greed'):0 ;

        $modelAttrib = new Contact_Model_Contacts_Attribute();

        $id = NULL;

        try {
            $id = $modelAttrib->addDataToSave($post);
        } catch(Exception $error) {
            $_SESSION['message'] = $error->getMessage();
            $_SESSION['type'] = 'error';
        }

        $_SESSION['message'] = "The attribute is saved!";
        $_SESSION['type'] = "success";

        if(Core_App::getParams()['ajax']) {
            echo json_encode(
                  array(
                   'done' => true,
                   'id' => $id,
                   'name' => $post['name'],
                   'place' => $post['placeholder'],
                   'message'=>$_SESSION['message']
                  )
            );

            $_SESSION['message'] = null;
            die;
        }

        if(!is_null(Core_App::getPost('url'))) {
            header('Location:' . Core_App::getPost('url',false));
        } else {
            header('Location:'.Core_App::getBaseUrl());
        }
    }

    /**
     * delete action
     */
    public function deleteAction() {

        if(!Core_App::getParams()['id']) {
            $_SESSION['message'] = 'Error. You dont have id contact for delete';
            $_SESSION['type'] = 'success';
            header('Location:'.Core_App::getBaseUrl());
        }

        $contMod = new Contact_Model_Contact();

        $query = 'DELETE FROM `contacts_entity` WHERE `contacts_entity`.`id` = '.Core_App::getParams()['id'];

        $contMod->executeDirectQuery($query);

        $contModVal = new Contact_Model_Contacts_Attribute_Value();
        $contModVal->executeDirectQuery(
            'DELETE FROM `contacts_attribute_value`
                WHERE `contacts_attribute_value`.`id_contact` = '.Core_App::getParams()['id']
        );
        $_SESSION['message'] = 'This contact deleted success full';
        $_SESSION['type'] = 'info';
        header('Location:'.Core_App::getBaseUrl());
    }

    /**
     * attr delete action
     */
    public function attrDelAction() {
        if(!Core_App::getParams()['id']) {
            $_SESSION['message'] = 'Error. You dont have id attribute for delete';
            $_SESSION['type'] = 'info';
            header('Location:'.Core_App::getBaseUrl());
        }

        $contModAttr = new Contact_Model_Contacts_Attribute();
        $contModAttr->executeDirectQuery(
            'DELETE FROM `contacts_attribute`
                WHERE `contacts_attribute`.`id` = '.Core_App::getParams()['id']
        );

        $contModVal = new Contact_Model_Contacts_Attribute_Value();
        $contModVal->executeDirectQuery(
            'DELETE FROM `contacts_attribute_value`
                WHERE `contacts_attribute_value`.`id_attribute` = '.Core_App::getParams()['id']
        );

        $_SESSION['message'] = 'Attribute delete is success full';
        $_SESSION['type'] = 'info';
        header('Location:'.Core_App::getBaseUrl());
    }
}
