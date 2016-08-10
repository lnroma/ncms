<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 08.08.16
 * Time: 15:35
 */
namespace Forum\Block\Trade;

class View extends \Core\Block\Factory\Grid
{

    /**
     * get collection
     * @return \MongoDB\Driver\Cursor
     */
    public function getCollection()
    {
        return \Core\Model\Mongo::select(
            array(
                'trade' => \Core\App::getParams()['trade']
            ),
            \Forum\Model\Forum\Trade::COLLECTION,
            $this->_optionsCollection()
        );
    }

    public function getCount()
    {
        $common = \Core\Model\Mongo::simpleSelect(
            'trade',
            \Core\App::getParams()['trade'],
            \Forum\Model\Forum\Trade::COLLECTION
        );
        return count($common->toArray());
    }

    public function _prepareGrid()
    {
        $this
            ->addColumn('title','Тема','title')
            ->addColumn('message','Сообщение','message');
    }

    protected function _prepareButton()
    {
        if(!isset($_SESSION['customer_id'])) {
            return array();
        }

        return array(
            array(
                'href' => '/forum/index/add/trade/'.\Core\App::getParams()['trade'],
                'title' => '<span class="glyphicon glyphicon-plus"></span>'
            )
        );
    }

    protected function _prepareAction()
    {
        return array(
            array(
                'rout' => '/forum/index/view/trade/'.\Core\App::getParams()['trade'],
                'label' => 'Читать',
                'index' => '_id',
                'param' => 'trade_id'
            )
        );
    }

}