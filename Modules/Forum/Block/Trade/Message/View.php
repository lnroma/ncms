<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 08.08.16
 * Time: 15:35
 */
namespace Forum\Block\Trade\Message;

class View extends \Core\Block\Factory\Grid
{

    public function getCollection()
    {
        return \Core\Model\Mongo::select(
            array(
                'post_id' => \Core\App::getParams()['trade_id']
            ),
            \Forum\Model\Forum\Trade\Message::COLLECTION,
            $this->_optionsCollection()
        );
    }

    /**
     * get count
     * @return int
     */
    public function getCount()
    {
        $common = \Core\Model\Mongo::simpleSelect(
            'post_id'
            ,\Core\App::getParams()['trade_id']
            ,\Forum\Model\Forum\Trade\Message::COLLECTION
        );

        return count($common->toArray());
    }

    public function _prepareGrid()
    {
        $this
            ->addColumn('owner','Автор','owner','render')
            ->addColumn('message','Сообщение','message');
    }

    public function render($index,$collection)
    {
        $user = \Customer\Model\Customer::getCustomer($index);
        $render = '<img width="100px"  src="'.$user->getAvatar().'" /><br/>';
        $render .= date('Y|m|d',$collection->time).'<br/>';
        $render .= date('H:i',$collection->time).'<br/>';
        return $render.$user->getName();
    }

    public function renderMessage($message,$collection)
    {
        $render = $message.'<div class="panel-footer">testing|mesting</div>';
        return $render;
    }

}