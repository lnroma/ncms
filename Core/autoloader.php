<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 13.07.16
 * Time: 18:09
 */
//function __autoload($className)
//{
//    $classPath = explode('_', $className);
//     generate paths to file
//    $classFile = \Core\App::getRootPath() .
//        trim(implode(DIRECTORY_SEPARATOR, $classPath), DIRECTORY_SEPARATOR)
//        . '.php';
//    $classFileModules = \Core\App::getRootPath() .
//        'Modules/' . trim(implode(DIRECTORY_SEPARATOR, $classPath), DIRECTORY_SEPARATOR)
//        . '.php';
//    $classFileUserModules = \Core\App::getRootPath()
//        . 'Local/Modules/' . trim(implode(DIRECTORY_SEPARATOR, $classPath), DIRECTORY_SEPARATOR)
//        . '.php';
//
//    if (file_exists($classFileUserModules)) {
//        include_once($classFileUserModules);
//    } elseif (file_exists($classFileModules)) {
//        include_once($classFileModules);
//    } elseif (file_exists($classFile)) {
//        include_once($classFile);
//    } else {
//        autoloadByNamespace($className);
//    }
//}

/**
 * autoload by namespace
 * @param $className
 * @throws Exception
 */
function autoloadByNamespace($className)
{
}

spl_autoload_register(function ($className) {
    $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    $classPathRoot = \Core\App::getRootPath() . $classPath . '.php';
    $classPathModules = \Core\App::getRootPath() . 'Modules' . DIRECTORY_SEPARATOR . $classPath . '.php';
    $rootDirectoryClass = \Core\App::getRootPath() . DIRECTORY_SEPARATOR .$classPath.'.php';

    if (file_exists($classPathRoot)) {
        require_once $classPathRoot;
    } elseif (file_exists($classPathModules)) {
        require_once $classPathModules;
    } elseif (file_exists($rootDirectoryClass)) {
        require_once $rootDirectoryClass;
    } 
});