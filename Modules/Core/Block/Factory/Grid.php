<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 25.07.16
 * Time: 17:25
 */
namespace Core\Block\Factory
{
    class Grid extends \Core\Block\AbstractClass
    {

        private $_collection = null;
        private $_column = array();

        public function __construct()
        {
            $this->setTemplate('factory/grid');
        }

        /**
         * get collection for grid
         * @return array
         */
        public function getCollection()
        {
            return array();
        }

        /**
         * pagination and sort options
         * @return array
         */
        protected function _optionsCollection()
        {
            $sort = -1;

            if(isset(\Core\App::getParams()['sort'])) {
                $sortUpOrDown = \Core\App::getParams()['sort'];
                if($sortUpOrDown == 'new_up') {
                    $sort = -1;
                } elseif($sortUpOrDown == 'new_down') {
                    $sort = 1;
                }
            }

            $page = 0;

            if(isset(\Core\App::getParams()['page'])) {
                $page = \Core\App::getParams()['page'];
            }

            return array(
                'sort' => array(
                    'time' => $sort
                ),
                'limit' => 20*($page+1),
            );
        }

        /**
         * prepare grid
         */
        protected function _prepareGrid()
        {
        }

        /**
         * add column to greed
         * @param $id
         * @param $label
         * @param $index
         * @return $this
         */
        public function addColumn($id,$label,$index,$render= null)
        {
            $this->_column[$id] = array(
                'label' => $label,
                'index' => $index,
                'render' => $render
            );
            
            return $this;
        }

        /**
         * rewrite this method for set title action column
         * @return string
         */
        public function getActionTitle()
        {
            return 'Action';
        }

        /**
         * prepare action
         * @return array
         */
        protected function _prepareAction()
        {
            return array();
        }

        /**
         * @return array
         */
        protected function _prepareButton()
        {
            return array();
        }
        
        /**
         * get columns
         * @return array
         */
        public function getColumns()
        {
            if(count($this->_column) == 0) {
                $this->_prepareGrid();
            }

            return $this->_column;
        }

        protected function _getTitle()
        {
            return '';
        }

        /**
         * set header text
         * @param $header
         * @return $this
         */
        public function setHeader($header)
        {
            $this->setData('header',$header);
            return $this;
        }

    }
}