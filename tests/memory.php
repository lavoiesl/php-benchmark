<?php

use Lavoiesl\PhpBenchmark\Benchmark;

require_once '_autoload.php';

$output = '';

$benchmark = new Benchmark;

$benchmark->add('1000',  function() use (&$output) { $output = str_repeat('a', 1024 * 256);  });
$benchmark->add('10000', function() use (&$output) { $output = str_repeat('a', 1024 * 1024); });
$benchmark->add('5000',  function() use (&$output) { $output = str_repeat('a', 1024 * 1024 * 16);  });

$benchmark->guessCount(2); // aim for 2 seconds per test (default)

$benchmark->run();
