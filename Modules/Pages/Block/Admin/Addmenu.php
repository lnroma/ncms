<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 29.02.16
 * Time: 0:23
 */
class Pages_Block_Admin_Addmenu extends \Core\Block\AbstractClass
{

    /**
     * Pages_Block_Addmenu constructor.
     */
    public function __construct()
    {
        $this->setTemplate('admin/pages/addmenu');
    }

    /**
     * get menu tree
     * @return mixed
     */
    public function getMenu() {
        $connection = \Core\Model\Mongo::getConnect();
        $query = new MongoDB\Driver\Query(array());
        $allMenu = $connection->executeQuery(Config_Db::getConf()['mongodb']['db'].'.menu',$query);
        return $allMenu->toArray();
    }

}