<?php

namespace Macchiato;

use \JSContext;
use \RuntimeException;

class CoffeeScript {
    private $_compilerCtx;

    public function __construct($coffeePath = 'coffee-script.js') {
        $this->_compilerCtx = $this->createCompilerContext($coffeePath);
    }

    protected function loadCoffeeScript($coffeePath) {
        if (($compilerSource = file_get_contents($coffeePath)) === false) {
            throw new RuntimeException('Unable to load the CoffeeScript compiler library');
        }
        return $compilerSource;
    }

    public function createContext() {
        return new SpiderMonkeyContext();
    }

    protected function createCompilerContext($coffeePath) {
        $compilerSource = $this->loadCoffeeScript($coffeePath);
        $compilerCtx = $this->createContext();
        $compilerCtx->evaluateString("$compilerSource\nnull");
        return $compilerCtx;
    }

    public function getCompilerContext() {
        return $this->_compilerCtx;
    }

    public function compile($code) {
        $compilerCtx = $this->getCompilerContext();
        $compilerCtx->registerVariable('___USRSRC___', $code);
        $script = 'CoffeeScript.compile(___USRSRC___, { bare: true });';
        $compiled = $compilerCtx->evaluateString($script);
        if ($compiled === false) {
            throw new RuntimeException('Unable to compile the provided CoffeeScript code');
        }
        return $compiled;
    }

    public function execute($code, JavaScriptContextInterface $context = null) {
        $context = $context ?: $this->createContext();
        return $context->evaluateString($this->compile($code));
    }

    public function compileFile($path) {
        if (($code = file_get_contents($path)) === false) {
            throw new RuntimeException("Unable to load the CoffeeScript file at $path");
        }
        return $this->compile($code);
    }

    public function executeFile($path, JavaScriptContextInterface $context = null) {
        $context = $context ?: $this->createContext();
        return $context->evaluateString($this->compileFile($path));
    }
}
