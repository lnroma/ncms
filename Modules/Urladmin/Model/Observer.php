<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.02.16
 * Time: 20:29
 */
namespace Urladmin\Model {
    class Observer
    {

        /**
         * aliassis for controller action
         * @param $data
         * @return mixed
         */
        public function aliasUrl($data)
        {
            $model = new \Urladmin\Model\Url();
            $result = $model
                ->addFieldToFilter('from_url', $this->_getPath())
                ->addFieldToFilter('type', \Urladmin\Model\Url::REWRITE)
                ->load();
            $result = reset($result);
//            var_dump($result);die;
            if (isset($result['to_url'])) {
                $routTo = explode('/', $result['to_url']);
                $data['controller'] = $routTo[0];
                $data['controllerName'] = $routTo[1];
                $data['action'] = $routTo[2];
            }
            return $data;
        }

        /**
         * 301 redirect
         * @param $data
         * @return mixed
         */
        public function redirect301($data)
        {
            $model = new \Urladmin\Model\Url();
            $result = $model
                ->addFieldToFilter('from_url', $this->_getPath())
                ->addFieldToFilter('type', \Urladmin\Model\Url::REDIRECT)
                ->load();
            $result = reset($result);
            if (isset($result['to_url'])) {
                header('HTTP/1.1 301 Moved Permanently');
                header('Location:' . \Core\App::getBaseUrl() . trim($result['to_url']), '/');
            }
            return $data;
        }

        /**
         * get url for page
         * @param $url
         * @return null|string
         */
        public function getUrlForPage($url)
        {
            if(strpos($url,'http') !== false) {
                return $url;
            }
            $url = trim($url, '/');
            $url = $this->_rewriteUrlKey($url);
            $model = new \Urladmin\Model\Url();

            $result = $model
                ->addFieldToFilter('to_url', $url)
                ->load();

            $result = reset($result);

            $url = \Core\App::getBaseUrl() . $url;
            if (isset($result['from_url'])) {
                $url = \Core\App::getBaseUrl();
                $url .= trim($result['from_url']);
            }

            return $url;
        }

        /**
         * rewrite url key
         * @param $url
         * @return string
         */
        private function _rewriteUrlKey($url)
        {

            $url = explode('/', $url);

            if (count($url) < 3) {
                for ($i = count($url); $i < 3; $i++) {
                    $url[$i] = 'index';
                }
            }

            return trim(implode('/', $url), '/');
        }

        /**
         * get current url path path
         * @return mixed|string
         */
        private function _getPath()
        {
            if (isset($_SERVER['QUERY_STRING'])) {
                $repl = $_SERVER['QUERY_STRING'];
            } else {
                $repl = '';
            }
            $path = str_replace($repl, '', $_SERVER['REQUEST_URI']);
            $path = trim($path, '/?');
            return $path;
        }

    }
}