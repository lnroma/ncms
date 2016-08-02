<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 01.08.16
 * Time: 14:19
 */
require_once '/var/www/ncms/Core/App.php';
require_once '/var/www/ncms/Core/autoloader.php';
require_once '/var/www/ncms/vendor/autoload.php';

Core\App::setRootPath('/var/www/ncms/');

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Customer\Socket\Customer;

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Customer()
        )
    ),
    8081
);

$server->run();