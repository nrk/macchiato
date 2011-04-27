<?php

if (!defined('JSCACHE_DIR')) {
    define('JSCACHE_DIR', __DIR__ . '/../jscache/');
}

function setup_cache() {
    if (!file_exists(JSCACHE_DIR)) {
        mkdir(JSCACHE_DIR);
    }
}

function cache_file($url, $path) {
    if (file_exists($path)) {
        return;
    }
    if (($contents = file_get_contents($url)) === false) {
        throw new RuntimeException("Unable to download $url");
    }
    file_put_contents($path, $contents);
}

function cache_coffeescript() {
    cache_file(COFFEESCRIPT_URL, COFFEESCRIPT_PATH);
}

function cache_underscore() {
    cache_file(UNDERSCOREJS_URL, UNDERSCOREJS_PATH);
}

/* -------------------------------------------------------------------------- */

setup_cache();

define('COFFEESCRIPT_URL', 'http://github.com/jashkenas/coffee-script/raw/master/extras/coffee-script.js');
define('COFFEESCRIPT_PATH', JSCACHE_DIR . 'coffee-script.js');
define('UNDERSCOREJS_URL', 'http://github.com/documentcloud/underscore/raw/master/underscore.js');
define('UNDERSCOREJS_PATH', JSCACHE_DIR . 'underscore.js');

spl_autoload_register(function($class) {
    $file = __DIR__.'/../lib/'.strtr($class, '\\', '/').'.php';
    if (file_exists($file)) {
        require $file;
        return true;
    }
});
