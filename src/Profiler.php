<?php

namespace Lavoiesl\PhpBenchmark;

class Profiler
{
    private $start_memory = 0;

    private $max_memory = 0;

    private $start_time = null;

    private $end_time = null;

    public function start()
    {
        $this->start_memory = $this->max_memory = memory_get_usage(true);
        $this->start_time = microtime(true);

        register_tick_function( array( $this, "tick" ) );
    }

    public function tick()
    {
        $this->max_memory = max($this->max_memory, memory_get_usage(true));
    }

    public function stop()
    {
        $this->tick();
        $this->end_time = microtime(true);

        unregister_tick_function( array( $this, "tick" ) );
    }

    function getMemoryUsage()
    {
        return $this->max_memory - $this->start_memory;
    }

    function getTime()
    {
        return $this->end_time - $this->start_time;
    }
}
