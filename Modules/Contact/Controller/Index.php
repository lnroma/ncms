<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 18.02.16
 * Time: 14:26
 */
class Contact_Controller_Index extends \Core\Controller\AbstractClass
{
    /**
     * save attribute action
     */
    public function saveAttribAction() {
        $post = array();
        $post['type_input'] = \Core\App::getPost('type_input');
        $post['name'] = \Core\App::getPost('name');
        $post['required'] = \Core\App::getPost('required','');
        $post['placeholder'] = \Core\App::getPost('placeholder','');
        $post['show_in_greed'] = \Core\App::getPost('show_in_greed',0);
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


        if(\Core\App::getParams()['ajax']) {
            // load field by id
            $html = '
                <div class="form-group">
                <label for="control_'.$id.'">'.$post['name'].':</label>
                <input id="control_'.$id.' " type="'.$post['type_input'].'"
                       name="attrib['.$id.']" ';
                if ($post['placeholder']) $html .= 'placeholder = "' . $post['placeholder'] . '" ';
            $html .= $post['required'] .' class="form-control"></input>
                <div class="help-block with-errors"></div>
            </div>';

            echo json_encode(
                  array(
                   'done' => true,
                   'html' => $html,
                   'id' => $id,
                   'name' => $post['name'],
                   'place' => $post['placeholder'],
                   'message'=>$_SESSION['message']
                  )
            );

            $_SESSION['message'] = null;
            die;
        }

        header('Location:' . \Core\App::getPost('url',\Core\App::getBaseUrl(),false));
    }

    /**
     * delete action
     */
    public function deleteAction() {

        if(!\Core\App::getParams()['id']) {
            $_SESSION['message'] = 'Error. You dont have id contact for delete';
            $_SESSION['type'] = 'success';
            header('Location:'.\Core\App::getBaseUrl());
        }

        $contMod = new Contact_Model_Contact();

        $query = 'DELETE FROM `contacts_entity` WHERE `contacts_entity`.`id` = '.\Core\App::getParams()['id'];

        $contMod->executeDirectQuery($query);

        $contModVal = new Contact_Model_Contacts_Attribute_Value();
        $contModVal->executeDirectQuery(
            'DELETE FROM `contacts_attribute_value`
                WHERE `contacts_attribute_value`.`id_contact` = '.\Core\App::getParams()['id']
        );
        $_SESSION['message'] = 'This contact deleted success full';
        $_SESSION['type'] = 'info';
        header('Location:'.\Core\App::getBaseUrl());
    }

    /**
     * attr delete action
     */
    public function attrDelAction() {
        if(!\Core\App::getParams()['id']) {
            $_SESSION['message'] = 'Error. You dont have id attribute for delete';
            $_SESSION['type'] = 'info';
            header('Location:'.\Core\App::getBaseUrl());
        }

        $contModAttr = new Contact_Model_Contacts_Attribute();
        $contModAttr->executeDirectQuery(
            'DELETE FROM `contacts_attribute`
                WHERE `contacts_attribute`.`id` = '.\Core\App::getParams()['id']
        );

        $contModVal = new Contact_Model_Contacts_Attribute_Value();
        $contModVal->executeDirectQuery(
            'DELETE FROM `contacts_attribute_value`
                WHERE `contacts_attribute_value`.`id_attribute` = '.\Core\App::getParams()['id']
        );

        $_SESSION['message'] = 'Attribute delete is success full';
        $_SESSION['type'] = 'info';
        header('Location:'.\Core\App::getBaseUrl());
    }
}
