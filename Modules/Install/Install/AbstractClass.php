<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 10.07.16
 * Time: 16:02
 */
namespace Install\Install {
    trait AbstractClass
    {

        public abstract static function runInstall();

        public abstract static function version();

        public abstract static function key();

    }
}