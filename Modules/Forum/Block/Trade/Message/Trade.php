<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 08.08.16
 * Time: 18:20
 */
namespace Forum\Block\Trade\Message;

class Trade extends \Core\Block\AbstractClass 
{
    
    public function __construct()
    {
        $this->setTemplate('forum/trade/view');
    }

    public function getPostInfo()
    {
        $trade = new \Forum\Model\Forum\Trade();
        return $trade->load(\Core\App::getParams()['trade_id']);
    }
}