<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 05.08.16
 * Time: 7:47
 */
namespace Seo\Block\Admin {
    class Grid extends \Core\Block\Factory\Grid
    {

        public function getCollection()
        {
            $collection = \Core\Model\Mongo::select(
                array(),
                \Seo\Model\Entity::COLLECTION,
                $this->_optionsCollection()
            );
            return $collection;
        }

        protected function _prepareGrid()
        {
            $this
                ->addColumn('id','ID','_id')
                ->addColumn('rout','Rout','page_url')
                ->addColumn('title','Title','title');
        }

        protected function _prepareAction()
        {
            return array(
                array(
                    'rout' => '/seo/index/edit',
                    'label' => 'edit',
                    'index' => '_id',
                    'param' => 'id'
                )
            );
        }

        /**
         * prepare button
         * @return array
         */
        protected function _prepareButton()
        {
            return array(
                array(
                    'href' => '/'.\Config\App::getConfig()['adminurl'].'/seo/add',
                    'title' => '<span class="glyphicon glyphicon-plus"></span>'
                )
            );
        }

    }
}