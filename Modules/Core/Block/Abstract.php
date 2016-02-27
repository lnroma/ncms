<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 09.10.15
 * Time: 22:48
 */
class Core_Block_Abstract {

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
        $this->_template = Core_App::getRootPath().'Template'.DIRECTORY_SEPARATOR.
            Core_App::getThemes().DIRECTORY_SEPARATOR.
            $src.'.phtml';
        return $this;
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
      return include($this->getTemplate());
    }

    /**
     * get post value by key
     * @param $key
     * @return null | string
     */
    public function getPost($key)
    {
        if(isset($_POST[$key])) {
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
    public function getChunk($chanckPath,$class = null)
    {
        if(is_null($class)) {
            include Core_App::getRootPath() . 'Template' . DIRECTORY_SEPARATOR . Core_App::getThemes() . DIRECTORY_SEPARATOR . $chanckPath;
        } else {
            return new $class;
        }
    }

    public function __call($name, $arguments)
    {
//        var_dump($this->_data);die;
        // TODO: Implement __call() method.
        if($name == 'setData') {
            $this->_data[$arguments[0]] = $arguments[1];
        } elseif($name == 'getData') {
            if(isset($this->_data[$arguments[0]])) {
                return $this->_data[$arguments[0]];
            } else {
                return null;
            }
        }
    }

}
