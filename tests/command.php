<?php

use Lavoiesl\PhpBenchmark\Benchmark;
use Lavoiesl\PhpBenchmark\CommandTest;

require_once '_autoload.php';

$benchmark = new Benchmark;

$commands = array(
    'ls'   => "ls -1 **/*.php",
    'find' => "find . -name '*.php'",
);

foreach ($commands as $name => $command) {
    $benchmark->addTest(new CommandTest($name, $command));
}

$benchmark->run();
