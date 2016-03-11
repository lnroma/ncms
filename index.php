<?php
//new MongoClient();
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 09.10.15
 * Time: 22:46
 */
//phpinfo();die;
session_start();

ini_set('error_reporting',E_ALL);
ini_set('display_errors',1);

include 'Core/App.php';
Core_App::setBaseUrl('http://host-most.local/');
// require slash in end
Core_App::setRootPath('/var/www/host-most/');
Core_App::setThemes('default');
// catch exception
try {
    Core_App::runApplet();
} catch (Exception_Notfound $notFound) {
    new Core_Block_Notfound();
} catch (PDOException $errorPdo) {
    new Error_Block_Error();
} catch (Exception_Forbiden $error) {
    header('Location:'.Core_App::getBaseUrl().Config_App::getConfig()['adminurl'].'/login');
} catch (Exception $error) {
    var_dump($error);
    new Core_Block_Error();
}

