# Activation your module for autoload 
for activation your module in autoload you need write your module name in `Config/Modules.php`
for example I again take `Hello world`
```
  'hello' => array( //this key you module name
                'config_class' => 'Hello_Config_Config', // class load your config file
                'enable'      => true   // this flag enable or don't enable module
               ),
```