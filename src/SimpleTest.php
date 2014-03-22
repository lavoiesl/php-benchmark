<?php

namespace Lavoiesl\PhpBenchmark;

class SimpleTest extends AbstractTest
{
    /**
     * @var \Closure
     */
    private $prepare = null;

    /**
     * @var \Closure
     */
    private $execute;

    /**
     * @var \Closure
     */
    private $cleanup = null;

    public function __construct($name, \Closure $execute)
    {
        parent::__construct($name);

        $this->execute = $execute;
    }

    public function setPrepare(\Closure $prepare)
    {
        $this->prepare = $prepare;

        return $this;
    }

    protected function prepare()
    {
        if ($prepare = $this->prepare) {
            $prepare();
        }
    }

    protected function execute()
    {
        return call_user_func($this->execute);
    }


    public function setCleanup(\Closure $cleanup)
    {
        $this->cleanup = $cleanup;

        return $this;
    }

    protected function cleanup()
    {
        if ($cleanup = $this->cleanup) {
            $cleanup();
        }
    }
}
