<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 09.10.15
 * Time: 22:46
 * check this account active 2
 */
session_start();

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

const FLAG_DEBUG = 1;

include 'Core/App.php';
try {
    require_once __DIR__.DIRECTORY_SEPARATOR.'Core'.DIRECTORY_SEPARATOR.'autoloader.php';
    require_once __DIR__.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
    \Core\App::setRootPath(__DIR__.DIRECTORY_SEPARATOR);
    \Core\App::setThemes('default');
    \Core\App::runApplet();
} catch (\Exception\Notfound $notFound) {
    if(FLAG_DEBUG) {
        $block = new \Core\Block\AbstractClass();
        $block->setData('error',$notFound);
        $block->setAbsoluteTemplate(\Core\App::getRootPath().'Template'.DIRECTORY_SEPARATOR.'error'.DIRECTORY_SEPARATOR.'error.phtml');
        $block->toHtml();
    } else {
        new Core_Block_Notfound();
    }
} catch (\PDOException $errorPdo) {
    if(FLAG_DEBUG) {
        $block = new \Core\Block\AbstractClass();
        $block->setData('error',$errorPdo);
        $block->setAbsoluteTemplate(\Core\App::getRootPath().'Template'.DIRECTORY_SEPARATOR.'error'.DIRECTORY_SEPARATOR.'error.phtml');
        $block->toHtml();
    } else {
        new \Error_Block_Error();
    }
} catch (\Exception\Forbiden $error) {
    header('Location:' . \Core\App::getBaseUrl() . \Config\App::getConfig()['adminurl'] . '/login');
} catch (\Exception $errorException) {
    if(FLAG_DEBUG) {
        $block = new \Core\Block\AbstractClass();
        $block->setData('error',$errorException);
        $block->setAbsoluteTemplate(\Core\App::getRootPath().'Template'.DIRECTORY_SEPARATOR.'error'.DIRECTORY_SEPARATOR.'error.phtml');
        $block->toHtml();
    }
}


//catch (Exception $error) {
//    var_dump($error);
//    new Core_Block_Error();
//}

