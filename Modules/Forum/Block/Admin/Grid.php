<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 08.08.16
 * Time: 14:44
 */
namespace Forum\Block\Admin;

class Grid extends \Core\Block\Factory\Grid
{

    public function getCollection()
    {
        return \Core\Model\Mongo::selectAll(\Forum\Model\Forum::COLLECTION);
    }

    public function _prepareGrid()
    {
        $this
            ->addColumn('name','name','name')
            ->addColumn('description','description','description')
            ->addColumn('url_key','Url key','url_key')
            ->addColumn('sort','sort','sort');
    }

    protected function _getTitle()
    {
        return '<h1>Редактирование разделов форума:</h1>';
    }


    protected function _prepareAction()
    {
        return array(
            array(
                'rout' => '/forum/admin/edit',
                'label' => 'edit',
                'index' => '_id',
                'param' => 'id'
            )
        );
    }

    protected function _prepareButton()
    {
        return array(
            array(
                'href' => '/'.\Config\App::getConfig()['adminurl'].'/forum/add',
                'title' => '<span class="glyphicon glyphicon-plus"></span>'
            )
        );
    }

}