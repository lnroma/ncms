# how to create block file
I'm again take `hello world` for example your need create `Block` directory on your module directory for example:
`Modules/Hello/Hello.php`
```
  class Hello_Block_Hello extends \Core\Block\AbstractClass
  {
      /**
       * Hello_Block_Hello constructor.
       */
      public function __construct()
      {
          $this->setTemplate('hello/hello');
      }
  
  }
```
and you need write your class in `Config.php`

```
 'blocks' => 'Hello_Block', // this namespace for your block classes
```