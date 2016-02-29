<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 29.02.16
 * Time: 23:32
 */
class Pages_Model_Observer {

    public function aliasForPage($data) {
        $db = Core_Model_Mongo::getDb();
        $collection = $db->selectCollection('pages');
        $col = $collection->find(array('key'=>$this->_getPath()));
        if($col->count()) {
            $data = array(
                'controller' => 'pages',
                'controllerName' => 'view',
                'action' => 'index',
                'id'     => $this->_getPath()
            );
        }
        return $data;
    }

    /**
     * get current url path path
     * @return mixed|string
     */
    private function _getPath() {
        $path = str_replace($_SERVER['QUERY_STRING'],'',$_SERVER['REQUEST_URI']);
        $path = trim($path,'/?');
        return $path;
    }
}