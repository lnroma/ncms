<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 09.10.15
 * Time: 22:46
 */
session_start();

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

include 'Core/App.php';
try {
    Core_App::setBaseUrl('http://flnau.ru/');
// require slash in end
    Core_App::setRootPath(__DIR__.'/');
    Core_App::setThemes('default');
// catch exception
    Core_App::runApplet();
} catch (Exception_Notfound $notFound) {
    var_dump($error);
    new Core_Block_Notfound();
} catch (PDOException $errorPdo) {
    var_dump($error);
    new Error_Block_Error();
} catch (Exception_Forbiden $error) {
    header('Location:' . Core_App::getBaseUrl() . Config_App::getConfig()['adminurl'] . '/login');
}
//catch (Exception $error) {
//    var_dump($error);
//    new Core_Block_Error();
//}

