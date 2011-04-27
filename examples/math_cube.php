<?php

require 'shared.php';

cache_coffeescript();

$coffee = new Macchiato\CoffeeScript(COFFEESCRIPT_PATH);

$result = $coffee->execute(
<<<EOC
square = (x) -> x * x
math =
  root:   Math.sqrt
  square: square
  cube:   (x) -> x * square x
math.cube(42)
EOC
);

var_dump($result);
