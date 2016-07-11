<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 10.07.16
 * Time: 16:02
 */
trait Install_Install_Abstract {

    public abstract static function runInstall();
    public abstract static function version();
    public abstract static function key();

}