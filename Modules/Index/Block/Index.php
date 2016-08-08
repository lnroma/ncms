<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 09.10.15
 * Time: 22:48
 */
namespace Index\Block {
    /**
     * Class Index
     * @package Index\Block
     */
    class Index extends \Core\Block\AbstractClass
    {
        /**
         * call block and render
         */
        public function __construct()
        {
            $this->setTemplate('index');
        }

        public function getPhobos()
        {
            $pathToCache = \Core\App::getRootPath().'cache'.DIRECTORY_SEPARATOR.'phobos.array';

            if(file_exists($pathToCache)) {
                return unserialize(file_get_contents($pathToCache));
            }

            $information = file_get_contents(
                'http' .
                '://api.openweathermap.org/data/2.5/forecast?' .
                'q=barnaul&APPID=b56f458955dd11e1bceb67e5b952b367' .
                '&units=metric' .
                '&lang=ru' .
                '&cnt=12'
            );

            $temperature = json_decode($information);
            $result = array();
            
            foreach ($temperature->list as $_list) {
                $result[] = array(
                    'temperature' => $_list->main->temp,
                    'weather' => $_list->weather[0]->description,
                    'icon' => 'http://openweathermap.org/img/w/' . $_list->weather[0]->icon . '.png',
                    'wind' => array(
                        'speed' => $_list->wind->speed,
                        'deg' => $_list->wind->deg
                    ),
                    'date' => $_list->dt_txt
                );
            }
            
            file_put_contents($pathToCache,serialize($result));
            
            return $result;
        }

    }
}