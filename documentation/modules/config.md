# how to create module configuration
So, for create module configuration your need create directory and set name as Name your module, for example
you want develop module "Hello world"...
you need create directory `Hello` in modules directory `Modules`
Modules/Hello, urgent you need use large first literal
after create the folder your need create directory `Config`
Modules/Hello/Config and create config file Config.php

and write you configuration class for module

```
 class Hello_Config_Config_
 {
 
     // this is function run after load your module
     static public function getConfig()
     {
         // and return config array 
         return array(
             'blocks' => 'Hello_Block', // this namespace for your block classes
             'models' => 'Hello_Model',  // namespace for your model classes
             'controllers' => 'Hello_Controller', // controller classes
             'menu_frontend' => array( // when configuration mine menu application
                 array(  //important use always two array
                     'rout' => 'hello/hello/', // rout to page you module
                     'label' => 'Create contact', // label for menu item 
                     'sort'  => 1, // sort item in mine menu
                 ),
             ),
             'page' => array( // it's page section, key in each array is /controller/action
                 'hello' =>  // it's controller name
                     array(
                         'index' => // it's your action
                             array(
                                 'title' => 'This is page create contact', // title your new page
                                 'description' => 'This is description index page', // description page
                                 'activeMenu' => 'Create attribute' // active menu item in mine menu
                             ),
                     )
             )
         );
     }
 }

```