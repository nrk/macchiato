# Macchiato #

## About ##

__Macchiato__ is a small and __highly experimental__ PHP library, built on top of the
[SpiderMonkey](http://pecl.php.net/package/spidermonkey) PECL extension, that compiles
[CoffeeScript](http://coffeescript.org/) code to JavaScript, or directly executes it.

Unfortunately the SpiderMonkey PECL extension cannot be considered stable at this point.
Compiling CoffeeScript to JavaScript should not pose any problem, but code execution can
lead to random segmentation fault errors.


## A few examples ##

### Create an instance of Macchiato ###

Macchiato requires the CoffeeScript _client_ compiler library in order to work, so you
must pass a valid path or URI for the JavaScript file to the constructor method:

``` php
<?php
$pathToCoffeeScript = 'coffee-script.js';
$coffee = new Macchiato\CoffeeScript($pathToCoffeeScript);
```

### Compile CoffeeScript to JavaScript ###

You can pass your CoffeeScript code to Macchiato and compile it to JavaScript:

``` php
<?php
var_dump($coffee->compile('square = (x) -> x * x'));
/*
string(64) "var square;
 square = function(x) {
   return x * x;
 };"
*/
```

### Execute CoffeeScript directly in PHP ###

It is also possible to execute your CoffeeScript snippets directly in PHP:

``` php
<?php
var_dump($coffee->execute("
square = (x) -> x * x
square 42
"));
// int(1764)
```


## Dependencies ##

- PHP >= 5.3.0
- [SpiderMonkey PECL](http://pecl.php.net/package/spidermonkey) >= 0.1.4 (beta)


## Links ##

### Project ###
- [Source code](http://github.com/nrk/macchiato/)

### Related ###
- [CoffeeScript](http://coffeescript.org/)
- [SpiderMonkey](http://www.mozilla.org/js/spidermonkey/)
- [PHP](http://php.net/)


## Author ##

- [Daniele Alessandri](mailto:suppakilla@gmail.com) ([twitter](http://twitter.com/JoL1hAHN))


## License ##

The code for Macchiato is distributed under the terms of the MIT license (see LICENSE).
