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
        public function addColumn($id,$label,$index)
        {
            $this->_column[$id] = array(
                'label' => $label,
                'index' => $index
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