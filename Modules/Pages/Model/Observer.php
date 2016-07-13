<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 29.02.16
 * Time: 23:32
 */

use MongoDB\Driver;

class Pages_Model_Observer
{

    /**
     * router for page
     * @param $data
     * @return array
     */
    public function aliasForPage($data)
    {
        /** @var Driver\Manager $connect */
        $connect = \Core\Model\Mongo::getConnect();

        $man = new MongoDB\Driver\Query(
            array(
                'key' => $this->_getPath()
            )
        );

        $config = new \Core\Configuration();
        $collection = $connect->executeQuery($config->getDb()['mongodb']['db'] . '.pages', $man);

        if (count($collection->toArray())) {
            $data = array(
                'controller' => 'pages',
                'controllerName' => 'view',
                'action' => 'index',
                'id' => $this->_getPath()
            );
        }

        return $data;
    }

    /**
     * alias for rout menu page
     * @param $data
     * @return array
     */
    public function aliasMenu($data)
    {
        /** @var MongoDB\Driver\Manager $db */
        $connection = \Core\Model\Mongo::getConnect();

        $query = new  MongoDB\Driver\Query(
            array()
        );

        $config = new \Core\Configuration();

        $menuCollection = $connection->executeQuery($config->getDb()['mongodb']['db'].'.menu',$query);
        // todo this code need rewrite more optimize
        $arrayKey = array();
        foreach ($menuCollection->toArray() as $menu) {

            if (isset($menu->key)) {
                $arrayKey[] = $menu->key;
            }

            if (isset($menu->child)) {
                foreach ($menu->child as $_child) {
                    if (isset($_child->key)) {
                        $arrayKey[] = $_child->key;
                    }
                }
            }

        }

        /**
         * rewrite action parameters
         */
        if (array_search($this->_getPath(), $arrayKey) !== false) {
            $data = array(
                'controller' => 'pages',
                'controllerName' => 'view',
                'action' => 'menu',
                'id' => $this->_getPath()
            );
        }

        return $data;
    }

    /**
     * get current url path path
     * @return mixed|string
     */
    private function _getPath()
    {
        if(isset($_SERVER['QUERY_STRING'])) {
            $repl = $_SERVER['QUERY_STRING'];
        } else {
            $repl = '';
        }
        $path = str_replace($repl, '', $_SERVER['REQUEST_URI']);
        $path = trim($path, '/?');
        return $path;
    }
}