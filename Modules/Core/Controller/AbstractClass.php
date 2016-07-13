<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 18.02.16
 * Time: 13:25
 */
namespace Core\Controller {
    class AbstractClass
    {

        /** @var \Core\Block\AbstractClass $__block */
        private $__block = null;
        private $__pageClass = array();
        private $_data = array();

        public function __construct()
        {
        }

        /**
         * set page template for layout
         * @param $pageName
         * @return $this
         */
        public function setPage($pageName)
        {

            $pathToPage = 'page/' . $pageName;

            $blockInstance = $this->getBlockClass('page');

            $blockInstance->setTemplate($pathToPage);

            return $this;
        }

        /**
         * set block to class singleton
         * @param $block
         * @return $this
         */
        public function setBlock($block)
        {
            $params = \Core\App::getConfigModul();
            $this->__block = $params['blocks'] . '\\' . $block;
            return $this;
        }

        /**
         * render block class
         * @return $this
         */
        public function render()
        {
            $this->getBlockClass('page')->toHtml();
            return $this;
        }

        /**
         * get block class singleton
         * @return \Core\Block\AbstractClass|null
         */
        public function getBlockClass($key)
        {
            if (isset($this->__pageClass[$key])) {
                return $this->__pageClass[$key];
            }

            $this->__pageClass[$key] = new \Core\Block\AbstractClass();

            return $this->__pageClass[$key];
        }

        public function __call($name, $arguments)
        {
            // TODO: Implement __call() method.
            $method = substr($name, 0, 3);
            $key = strtolower(substr($name, 3, strlen($name)));
            if ($method == 'set') {
                $this->setBlock($arguments[0]);
                $blockObj = new $this->__block;
                ob_start();
                $blockObj->toHtml();
                $cont = ob_get_contents();
                ob_end_clean();
                $this->getBlockClass($this->getKey())->setData($key, $cont);
                return $this;
            }
        }

        /**
         * set key controller
         * @param $key
         * @return $this
         */
        public function setKey($key)
        {
            $this->_data['key'] = $key;
            return $this;
        }

        /**
         * get controller key
         * @return mixed
         */
        public function getKey()
        {
            return $this->_data['key'];
        }
    }
}