<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 29.02.16
 * Time: 23:32
 */
class Pages_Model_Observer
{

    /**
     * router for page
     * @param $data
     * @return array
     */
    public function aliasForPage($data)
    {
        $db = Core_Model_Mongo::getDb();
        $collection = $db->selectCollection('pages');
        $col = $collection->find(array('key' => $this->_getPath()));
        if ($col->count()) {
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
        /** @var MongoDB $db */
        $db = Core_Model_Mongo::getDb();
        $menuCollection = $db->selectCollection('menu');
        $arrayKey = array();

        // todo this code need rewrite more optimize
        foreach (iterator_to_array($menuCollection->find()) as $menu) {

            if (isset($menu['key'])) {
                $arrayKey[] = $menu['key'];
            }

            if (isset($menu['child'])) {
                foreach ($menu['child'] as $_child) {
                    if (isset($_child['key'])) {
                        $arrayKey[] = $_child['key'];
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
        $path = str_replace($_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']);
        $path = trim($path, '/?');
        return $path;
    }
}