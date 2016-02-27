<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 20:29
 */
class Urladmin_Model_Observer {

    public function aliasUrl($data) {
        $model = new Urladmin_Model_Url();
        $path = str_replace($_SERVER['QUERY_STRING'],'',$_SERVER['REQUEST_URI']);
        $path = trim($path,'/?');
        $result = $model
            ->addFieldToFilter('from_url',$path)
            ->load();
        $result = reset($result);
        if(isset($result['to_url'])) {
            $routTo = explode('/',$result['to_url']);
            $data['controller'] = $routTo[0];
            $data['controllerName'] = $routTo[1];
            $data['action'] = $routTo[2];
        }
        return $data;
    }

}