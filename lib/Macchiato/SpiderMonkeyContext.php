<?php

namespace Macchiato;

use \Exception;

class SpiderMonkeyContext implements JavaScriptContextInterface {
    private $_context;

    public function __construct() {
        $this->_context = new \JSContext();
    }

    public function getNativeContext() {
        return $this->_context;
    }

    public function evaluateString($source) {
        return $this->getNativeContext()->evaluateScript($source);
    }

    public function evaluateFile($uri) {
        if (($source = file_get_contents($uri)) === false) {
            throw new Exception("Unable to load $uri");
        }
        return $this->evaluateString($source);
    }

    public function registerVariable($alias, &$value) {
        $this->getNativeContext()->assign($alias, $value);
    }

    public function registerFunction($alias, $callable) {
        $this->getNativeContext()->registerFunction($callable, $alias);
    }

    public function registerClass($fqn, $alias = null) {
        $ctx = $this->getNativeContext();
        $args = isset($alias) ? array($fqn, $alias) : array($fqn);
        call_user_func_array(array($ctx, 'registerClass'), $args);
    }
}
