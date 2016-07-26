<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 24.07.16
 * Time: 21:03
 */
namespace Customer\Block {
    use \Core\App;
    class Menu {
        static public function getAuthLink() {
            $client = new \Google_Client();
            $client->setAuthConfigFile(App::getRootPath().DIRECTORY_SEPARATOR.'Config'.DIRECTORY_SEPARATOR.'google.json');
            $client->addScope(\Google_Service_Plus::USERINFO_PROFILE);
            $client->addScope(\Google_Service_Oauth2::USERINFO_PROFILE);
            $client->addScope(\Google_Service_Oauth2::USERINFO_EMAIL);
            $client->addScope(\Google_Service_Oauth2::PLUS_LOGIN);
            $url = $client->createAuthUrl();
            return $url;
        }
    }
}