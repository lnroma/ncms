<?php
namespace Postgen\Block
{

    use \Core\App;
    /**
     * Class Test
     * @package Postgen\Block
     */
    class Test extends \Core\Block\Factory\Form
    {

        public function __construct()
        {
            $this->testing();
        }

        /**
         * prepare form
         */
        protected function _prepareForm()
        {
            $this->createForm(
                array(
                    'action' => '/test/action',
                    'method' => 'post'
                )
            );

            $this->addField('text',array(
                'name' => 'testing',
                'placeholder' => 'huesting',
                'class' => 'form-control',
                'id' => 'testing',
                'label' => 'This is is test'
            ));

            $this->addSubmitButton('Submit');
        }

        public function testing()
        {
            $client = new \Google_Client();
            $client->setAuthConfigFile(App::getRootPath().DIRECTORY_SEPARATOR.'Config'.DIRECTORY_SEPARATOR.'google.json');
            $client->addScope(\Google_Service_Plus::USERINFO_PROFILE);
            $url = $client->createAuthUrl();
            echo '<a href="'.$url.'">testing google+</a>';die;
        }
    }

}