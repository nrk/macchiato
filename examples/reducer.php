<?php

require 'shared.php';

cache_coffeescript();
cache_underscore();

$coffee = new Macchiato\CoffeeScript(COFFEESCRIPT_PATH);

$context = $coffee->createContext();
$context->evaluateFile(UNDERSCOREJS_PATH);
$context->registerFunction('reducer', function($memo, $num) { return $memo+$num; });

$result = $coffee->execute('sum = _.reduce([1, 2, 3], reducer, 0)', $context);

var_dump($result);
