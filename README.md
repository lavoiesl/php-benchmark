# PHP Benchmark

Tool to compare different functions in PHP

## Usage

```php
<?php
$benchmark = new Benchmark;

$benchmark->add('md5',   function() { return md5('test');   });
$benchmark->add('sha1',  function() { return sha1('test');  });

$benchmark->run();
?>
```

You can run Benchmark::run(false) to get results without any output

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