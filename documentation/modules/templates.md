# how to create template for my module?
You need create .phtml template on your module folder and set this path in your block
early we create `hello` block and config, write now we create phtml template for block

Template/default/hello/hello.phtml; when `default` this is themes path and `hello/hello` with out extensions .phtml this is
path to template in your block php file

see your block class Hello_Block_Hello

```
 $this->setTemplate('hello/hello');
```

So, we create this file and look him listen

```
 hello world!
```


