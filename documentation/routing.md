# routing #
when application is run autoload skaning modules and classes dir in order:
1. load custom modules in folder `Local/Modules/`
2. load modules in folder `Modules/`
3. and after load Core classis in folder `Core/`

for rewrite core modules you can copy module class from `Modules/` to `Local/Modules/` and input your change
in the updated file. But this bad way for you, because you can use observer method in your application...
