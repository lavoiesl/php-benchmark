<?php

namespace Lavoiesl\PhpBenchmark;

abstract class AbstractTest
{
    /**
     * @var string
     */
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function run($n = 1)
    {
        $this->prepare();

        gc_collect_cycles(); // clear memory before start

        $memory = memory_get_usage(true);
        $time = microtime(true);

        for ($i=0; $i < $n; $i++) {
            $this->execute();
        }

        $results = array(
            'time'   => microtime(true) - $time,
            'memory' => max(0, memory_get_usage(true) - $memory),
            'n'      => $n,
        );

        $this->cleanup();

        return $results;
    }

    protected function prepare()
    {
    }

    abstract protected function execute();

    protected function cleanup()
    {
    }

    public function guessCount($max_seconds = 1)
    {
        $this->run(); // warmup
        $once = $this->run();

        if ($once['time'] >= $max_seconds) {
            return 1;
        } else {
            return round($max_seconds / $once['time']);
        }
    }
}
