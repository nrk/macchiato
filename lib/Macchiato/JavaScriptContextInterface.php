<?php

namespace Macchiato;

interface JavaScriptContextInterface {
    public function getNativeContext();
    public function evaluateString($string);
    public function evaluateFile($uri);
    public function registerVariable($alias, &$value);
    public function registerFunction($alias, $callable);
    public function registerClass($fqn, $alias = null);
}
