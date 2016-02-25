<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 20.02.16
 * Time: 22:09
 */
class Contact_Controller_Save extends Core_Controller_Abstract {

    /**
     * save attribute action
     */
    public function indexAction() {

        if(Core_App::getPost('update') == 1 && Core_App::getPost('id')) {
            $contMod = new Contact_Model_Contact();

            $query = 'DELETE FROM `contacts_entity` WHERE `contacts_entity`.`id` = '.Core_App::getPost('id');

            $contMod->executeDirectQuery($query);

            $contModVal = new Contact_Model_Contacts_Attribute_Value();
            $contModVal->executeDirectQuery(
                'DELETE FROM `contacts_attribute_value`
                WHERE `contacts_attribute_value`.`id_contact` = '.Core_App::getPost('id')
            );
        }

        $post = Core_App::getPost('attrib');
        // create contact entity
        $contact = array(
            'name' => Core_App::getPost('name')
        );

        try {
            $contactModel = new Contact_Model_Contact();
            $idEntity = $contactModel->addDataToSave($contact);

            $contactModelAttributeValue = new Contact_Model_Contacts_Attribute_Value();
            foreach($post as $_idAttr => $_value) {
                $dataForInsert = array(
                    'id_contact' => $idEntity,
                    'id_attribute' => $_idAttr,
                    'value' => $_value
                );

                $contactModelAttributeValue->addDataToSave($dataForInsert);
            }
            $_SESSION['message'] = 'Your contact save success full';
            $_SESSION['type'] = 'success';
        } catch(Exception $error) {
            $_SESSION['message'] = 'Error in proccess save your contact sorry';
            $_SESSION['type'] = 'error';
        }
        header('Location:'.Core_App::getBaseUrl());
    }

}