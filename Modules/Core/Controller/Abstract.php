<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 18.02.16
 * Time: 13:25
 */
class Core_Controller_Abstract {

    /** @var Core_Block_Abstract $__block  */
    private $__block = null;
    private $__pageClass = null;

    public function setPage($pageName) {

        $pathToPage = 'page/'.$pageName;

        $blockInstance = $this->getBlockClass();

        $blockInstance->setTemplate($pathToPage);

        return $this;
    }

    public function setBlock($block) {
        $params = Core_App::getConfigModul();
        $this->__block = $params['blocks'].'_'.$block;
        return $this;
    }

    public function setContent($content) {
        $this->setBlock($content);
//        var_dump($this->__block);die;
        /** @var Core_Block_Abstract $blockObj */
        $blockObj = new $this->__block;
//        var_dump($blockObj);die;
        ob_start();
        $blockObj->toHtml();
        $cont = ob_get_contents();
        ob_end_clean();
        $this->getBlockClass()->setData('content',$cont);
        return $this;
    }

    public function render() {
//        var_dump($this->getBlockClass());
        $this->getBlockClass()->toHtml();
        return $this;
    }

    public function getBlockClass() {
        if(!is_null($this->__pageClass)) {
            return $this->__pageClass;
        }
        $this->__pageClass = new Core_Block_Abstract();
        return $this->__pageClass;
    }
}