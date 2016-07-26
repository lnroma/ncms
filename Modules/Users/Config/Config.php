<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 16.07.16
 * Time: 19:12
 */
namespace Users\Config {
    /**
     * Class Config
     * @package Users\Config
     */
    class Config
    {
        static public function getConfig()
        {
            return array(
                'blocks' => '\Users\Block',
                'models' => '\Users\Model',
                'controllers' => '\Users\Controller\'
            );
        }
    }
}