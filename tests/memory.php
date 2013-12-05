<?php

use Lavoiesl\PhpBenchmark\Benchmark;

require_once '_autoload.php';

$benchmark = new Benchmark;

// @link http://www.php.net/manual/en/control-structures.declare.php#control-structures.declare.ticks
declare(ticks=1);

$benchmark->add('1024 * 256',       function() { return str_repeat('a', 1024 * 256);  });
$benchmark->add('1024 * 1024',      function() { return str_repeat('a', 1024 * 1024); });
$benchmark->add('1024 * 1024 * 16', function() { return str_repeat('a', 1024 * 1024 * 16);  });

$benchmark->guessCount(2); // aim for 2 seconds per test (default)

$benchmark->run();
