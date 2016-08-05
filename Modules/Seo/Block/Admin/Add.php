<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 05.08.16
 * Time: 8:29
 */
namespace Seo\Block\Admin {
    class Add extends \Core\Block\Factory\Form
    {
        protected function _prepareForm()
        {
            $this->createForm(
                array(
                    'action' => \Core\Helper::getUrl('seo/index/addPost'),
                    'method' => 'post',
                )
            );

            $values = new \stdClass();

            $values->page_url = '';
            $values->title = '';
            $values->description = '';


            if(isset(\Core\App::getParams()['id'])) {
                $values = \Seo\Model\Entity::load(\Core\App::getParams()['id']);
                $values = $values->toArray()[0];
                $this->addField('hidden',array(
                    'name' => 'id',
                    'id' => 'mongo_id',
                    'class' => 'form-control',
                    'label' => 'id',
                    'value' => \Core\App::getParams()['id']
                ));
            }

            $this->addField('text',array(
                'name' => 'page_url',
                'id' => 'page_url',
                'class' => 'form-control',
                'label' => 'Page url',
                'value' => $values->page_url
            ));

            $this->addField('text',array(
                'name' => 'title',
                'id' => 'title',
                'class' => 'form-control',
                'label' => 'Title for the page',
                'value' => $values->title
            ));

            $this->addField('textarea',array(
                'name' => 'description',
                'id' => 'description',
                'class' => 'form-control',
                'label' => 'Description',
                'value' => $values->description
            ));

            $this->addField('hidden',array(
                'name' => 'back_url',
                'id' => 'back_url',
                'class' => 'form-control',
                'label' => 'Title for the page',
                'value' => $_SERVER['REQUEST_URI']
            ));

            $this->addSubmitButton('Save','glyphicon glyphicon-floppy-disk');
        }
    }
}