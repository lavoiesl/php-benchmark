<?php

if (!class_exists('Composer\Autoload\ClassLoader')) {
    $autoload = __DIR__ . '/../vendor/autoload.php';

    if (is_file($autoload)) {
        require $autoload;
    } else {
        foreach (glob(__DIR__ . '/../src/Lavoiesl/PhpBenchmark/*.php') as $file) {
            require $file;
        }
    }
}
