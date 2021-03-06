<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 09.10.15
 * Time: 22:48
 * @method Core\Block\AbstractClass setData()
 * @method mixed getData()
 */
namespace Core\Block {
    /**
     *
     * Class AbstractClass
     * @package Core\Block
     *
     * @method setData($key,$value)
     */
    class AbstractClass
    {

        /**
         * private variable path to template
         * @var null
         */
        private $_template = null;
        private $_data = array();

        /**
         * set template for block
         * @param $src
         * @return null | string
         */
        public function setTemplate($src)
        {
            $this->_template = \Core\App::getRootPath() . 'Template' . DIRECTORY_SEPARATOR .
                \Core\App::getThemes() . DIRECTORY_SEPARATOR .
                $src . '.phtml';
            return $this;
        }

        /**
         * set template by absolute path
         * @param $src
         */
        public function setAbsoluteTemplate($src)
        {
            $this->_template = $src;
        }

        /**
         * get template
         * @return null | string
         */
        public function getTemplate()
        {
            return $this->_template;
        }

        /**
         * render block to html
         * @return bool
         */
        public function toHtml()
        {
//        var_dump($this->getTemplate());
//        echo '<div style="border:1px solid red; width: 100%;">
//        <div style="background: yellowgreen;">';
//        echo $this->getTemplate();
//        echo '</div>';
            return include($this->getTemplate());
//        echo '<div>';
        }

        /**
         * get post value by key
         * @param $key
         * @return null | string
         */
        public function getPost($key)
        {
            if (isset($_POST[$key])) {
                return $_POST[$key];
            } else {
                return null;
            }
        }

        /**
         * get chunk for template
         * @param $chanckPath
         * @return bool
         */
        public function getChunk($chanckPath, $class = null)
        {
            if (is_null($class)) {
                include \Core\App::getRootPath() . 'Template' . DIRECTORY_SEPARATOR . \Core\App::getThemes() . DIRECTORY_SEPARATOR . $chanckPath;
            } else {
                return new $class;
            }
        }

        /**
         * automatically setData and getData
         * @param $name
         * @param $arguments
         * @return null
         */
        public function __call($name, $arguments)
        {
            // TODO: Implement __call() method.
            if ($name == 'setData') {
                $this->_data[$arguments[0]] = $arguments[1];
                return $this;
            } elseif ($name == 'getData') {
                if (isset($this->_data[$arguments[0]])) {
                    return $this->_data[$arguments[0]];
                } else {
                    return null;
                }
            }
        }

    }
}
