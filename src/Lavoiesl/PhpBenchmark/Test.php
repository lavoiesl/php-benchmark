<?php

namespace Lavoiesl\PhpBenchmark;

class Test
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var \Closure
     */
    private $prepare = null;

    /**
     * @var \Closure
     */
    private $run;

    /**
     * @var \Closure
     */
    private $cleanup = null;

    public function __construct($name, \Closure $run)
    {
        $this->name = $name;
        $this->run = $run;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setPrepare(\Closure $prepare)
    {
        $this->prepare = $prepare;

        return $this;
    }

    private function prepare()
    {
        if ($this->prepare) {
            call_user_func($this->prepare, $this->n);
        }
    }

    public function run($n = 1)
    {
        $this->prepare();

        $run = $this->run;

        gc_collect_cycles(); // clear memory before start

        $memory = memory_get_usage();
        $time = microtime(true);

        for ($i=0; $i < $n; $i++) {
            $run();
        }

        $results = array(
            'time'   => microtime(true) - $time,
            'memory' => max(0, memory_get_usage() - $memory),
            'n'      => $n,
        );

        $this->cleanup();

        return $results;
    }

    public function setCleanup(\Closure $cleanup)
    {
        $this->cleanup = $cleanup;

        return $this;
    }

    private function cleanup()
    {
        if ($this->cleanup) {
            call_user_func($this->cleanup, $this->n);
        }
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
