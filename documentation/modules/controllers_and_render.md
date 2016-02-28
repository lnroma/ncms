# how to create controllers
you need create controller file and write class controllers in your config module file
```
 'controllers' => 'Hello_Controller', // controller classes
```

and create the controller Hello.php in folder controller
Modules/Hello/Controller/Hello.php

```
  class Hello_Controller_Hello extends Core_Controller_Abstract {

    /**
     * index action
     */
    public function indexAction() {
        $this
            ->setPage('main') // it's page template for your module the template location in `page` directory
            ->setKey('page') // key for different use on admin(admin_page) and on frontend(page)
            ->setContent('Hello') // this is block for render in content main page
            ->render(); // and after render this page
    }

```

