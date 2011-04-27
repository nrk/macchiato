<?php

require 'shared.php';

cache_coffeescript();

$coffee = new Macchiato\CoffeeScript(COFFEESCRIPT_PATH);

$context = $coffee->createContext();
$context->registerFunction('alert', function($msg) { echo "$msg\n"; });

$coffee->execute(
<<<EOC
class Animal
  constructor: (@name) ->

  move: (meters) ->
    alert @name + " moved " + meters + "m."

class Snake extends Animal
  move: ->
    alert "Slithering..."
    super 5

class Horse extends Animal
  move: ->
    alert "Galloping..."
    super 45

sam = new Snake "Sammy the Python"
tom = new Horse "Tommy the Palomino"

sam.move()
tom.move()
EOC
, $context);
