<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 05.08.16
 * Time: 8:29
 */
namespace Forum\Block\Admin {
    class Add extends \Core\Block\Factory\Form
    {
        protected function _prepareForm()
        {
            $this->createForm(
                array(
                    'action' => \Core\Helper::getUrl('forum/admin/addPost'),
                    'method' => 'post',
                )
            );

            $values = new \stdClass();

            $values->name = '';
            $values->sort = '';
            $values->url_key = '';
            $values->description = '';


            if(isset(\Core\App::getParams()['id'])) {
                $values = \Forum\Model\Forum::load(\Core\App::getParams()['id']);
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
                'name' => 'name',
                'id' => 'forum_name',
                'class' => 'form-control',
                'label' => 'Name forum trade',
                'value' => $values->name
            ));

            $this->addField('text',array(
                'name' => 'sort',
                'id' => 'sort',
                'class' => 'form-control',
                'label' => 'Sort for using in frontend',
                'value' => $values->sort
            ));

            $this->addField('text',array(
                'name' => 'url_key',
                'id' => 'url_key',
                'class' => 'form-control',
                'label' => 'Url key for forum trade',
                'value' => $values->url_key
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