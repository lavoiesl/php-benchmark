<?php

use Lavoiesl\PhpBenchmark\Benchmark;

require_once '_autoload.php';

// Generate long string for tests
$string = '';
for ($i=0; $i < 5000; $i++) { 
    $string .= sha1(microtime(true));
}

$benchmark = new Benchmark;

$benchmark->add('md5',   function() use ($string) { return md5($string);   });
$benchmark->add('sha1',  function() use ($string) { return sha1($string);  });
$benchmark->add('crc32', function() use ($string) { return crc32($string); });

$benchmark->guessCount(2); // aim for 2 seconds per test (default)

$benchmark->run();
