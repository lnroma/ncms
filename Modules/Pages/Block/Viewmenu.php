<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 29.02.16
 * Time: 23:44
 */
class Pages_Block_Viewmenu extends Pages_Block_Abstract
{

    /**
     * Pages_Block_Viewmenu constructor.
     */
    public function __construct()
    {
        $this->setTemplate('pages/blog');
    }

    /**
     * get all pages
     * @return array|mixed
     */
    public function getPages()
    {
        /** @var MongoDB $db */
        $con = \Core\Model\Mongo::getConnect();

        $query = new MongoDB\Driver\Query(
            array(
                'menu_key' => \Core\App::getParams()['id']
            )
        );

        $menuCollection = $con->executeQuery(Config_Db::getConf()['mongodb']['db'] . '.pages', $query);

        return $menuCollection->toArray();
    }
}