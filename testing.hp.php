<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 24.07.16
 * Time: 20:37
 */
require_once './vendor/autoload.php';
$testing = new Google_Client();
echo $testing->createAuthUrl();