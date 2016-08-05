<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 05.08.16
 * Time: 7:40
 */
namespace Seo\Model {

    class Observer {

        public function changeMetaInformation($metaInformation)
        {
            $request = \Core\App::getParams();
            $key = $request['controller'].'/'.$request['controllerName'].'/'.$request['action'];

            $seoOptions = \Core\Model\Mongo::simpleSelect('page_url',$key,\Seo\Model\Entity::COLLECTION);
            $seo = $seoOptions->toArray();

            if(isset($seo[0])) {
                $metaInformation['title'] = $seo[0]->title;
                $metaInformation['description'] = $seo[0]->description;
            }
            // todo your logical for meta information
            return $metaInformation;
        }

    }

}