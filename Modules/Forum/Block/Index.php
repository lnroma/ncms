<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 08.08.16
 * Time: 10:46
 */
namespace Forum\Block;

use \Forum\Model\Forum;

class Index extends \Core\Block\Factory\Grid
{

    /**
     * get collection for grid forum theme
     * @return \MongoDB\Driver\Cursor
     */
    public function getCollection()
    {
        $collection = \Core\Model\Mongo::selectAll(Forum::COLLECTION);
        return $collection;
    }

    /**
     * prepare grid collumn
     * @return $this
     */
    public function _prepareGrid()
    {
        $this
            ->addColumn('name','Название ветки','name')
            ->addColumn('description','Описание','description');
        return $this;
    }

    protected function _getTitle()
    {
        return '<h1>Разделы форума</h1>
            <h2 class="small">На нашем форуме вы найдёте самые интересующие для вас вопросы,
            клёв рыбы уловистые места, погода, прогноз клёва, уровень воды в оби, и мнения экспертов.</h2>
        ';
    }

    protected function _prepareAction()
    {
        return array(
            array(
                'rout' => '/forum/index/view',
                'label' => 'Читать',
                'index' => 'url_key',
                'param' => 'trade'
            )
        );
    }

}