<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 06.03.16
 * Time: 14:39
 */
class Postgen_Controller_Index extends Core_Controller_Abstract
{

    public function indexAction() {
        $this
            ->setPage('main')
            ->setKey('page')
            ->setContent('Postgen')
            ->render();
    }

    public function viewRespAction() {
        $curl = curl_init();
        // set action
        $query = array();
        foreach($_POST['post'] as $_postField) {
            if($_postField['name'] == '' || $_postField['value'] == '') {
                continue;
            }
            $query[$_postField['name']] = $_postField['value'];
        }

        $cookie = array();
        foreach($_POST['cookie'] as $_cookieField) {
            if($_cookieField['name'] == '' || $_cookieField['value'] == '') {
                continue;
            }
            $cookie[$_cookieField['name']] = $_cookieField['value'];
        }

        curl_setopt($curl,CURLOPT_URL,$_POST['action']);
        curl_setopt($curl,CURLOPT_PORT,isset($_POST['port'])?$_POST['port']:80);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_USERAGENT,$_POST['user_agent']);
        // set post fields clear
        curl_setopt($curl,CURLOPT_POST,true);
        curl_setopt($curl,CURLOPT_POSTFIELDS,http_build_query($query));
        //set coockie
        curl_setopt($curl,CURLOPT_COOKIE,http_build_query($cookie));

        $result = curl_exec($curl);
        if($error = curl_error($curl)) {
            throw new Exception('Error request by curl');
        }
        echo $result;
        die;
    }

}