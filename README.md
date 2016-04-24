# PHP Benchmark

Tool to compare different functions in PHP

## Install

Via Composer

```bash
composer require lavoiesl/php-benchmark
```

## Usage

```php
<?php
$benchmark = new Benchmark;

$benchmark->add('md5',   function() { return md5('test');   });
$benchmark->add('sha1',  function() { return sha1('test');  });

$benchmark->run();
?>
```

You can run `$benchmark->run(false)` to get results without any output

### Notes about memory usage

Memory usage is monitored using [`register_tick_function`](http://www.php.net/manual/en/function.register-tick-function.php) but this does not do a good job at analysing small statements since the memory gets cleaned too quickly.

A simple trick is the return the value, the `AbstractTest` stores it temporarily.

To ensure proper tick analysis, use `declare(ticks = 1);` as early as possible.

See [the memory test](tests/memory.php).

## Output

```
Running tests 3000 times.
Testing 2/2 : sha1

Test       Time   Time (%)   Memory   Memory (%)
md5     1304 ms                 0 B
sha1    2077 ms       59 %      0 B
```

## Optimal test count guessing

By default, Benchmark will try to find an optimal number of runs so that each test takes a maximum of 2 seconds.

You can change this by forcing it with `$benchmark->setCount($n)` or change the time with `$benchmark->guessCount($max_seconds)`.

## Writing custom tests

You can extend `AbstractTest` and provide your own wrapper.

For an example of this, see the [command test](tests/command.php) and the corresponding [class](src/CommandTest.php).

A full example can be seen here: https://github.com/lavoiesl/php-cache-comparison
