<?php

require 'shared.php';

cache_coffeescript();

$coffee = new Macchiato\CoffeeScript(COFFEESCRIPT_PATH);

$context = $coffee->createContext();
$result = null;
$context->registerFunction('storeResult', function($object) use (&$result) {
    $result = $object;
});

$coffee->execute(
<<<EOC
# Assignment:
number   = 42
opposite = true

# Conditions:
number = -42 if opposite

# Functions:
square = (x) -> x * x

# Arrays:
list = [1, 2, 3, 4, 5]

# Objects:
math =
  root:   Math.sqrt
  square: square
  cube:   (x) -> x * square x

# Splats:
race = (winner, runners...) ->
  print winner, runners

# Existence:
alert "I knew it!" if elvis?

# Array comprehensions:
cubes = (math.cube num for num in list)
storeResult cubes
EOC
, $context);

var_dump($result);
