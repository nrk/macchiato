<?php

require 'macchiato.php';

$coffee = new Macchiato\CoffeeScript(COFFEESCRIPT_PATH);

$context = $coffee->createContext();
$context->evaluateFile('underscore.js');
$context->registerFunction('reducer', function($memo, $num) { return $memo+$num; });

$result = $coffee->execute('sum = _.reduce([1, 2, 3], reducer, 0)', $context);

var_dump($result);
