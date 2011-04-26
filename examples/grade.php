<?php

require 'macchiato.php';

$coffee = new Macchiato\CoffeeScript(COFFEESCRIPT_PATH);

$eldest = $coffee->execute(
<<<EOC
grade = (student) ->
  if student.excellentWork
    "A+"
  else if student.okayStuff
    if student.triedHard then "B" else "B-"
  else
    "C"

eldest = if 24 > 21 then "Liz" else "Ike"
EOC
);

var_dump($eldest);
