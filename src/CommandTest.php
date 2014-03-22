<?php

namespace Lavoiesl\PhpBenchmark;

class CommandTest extends AbstractTest
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

    public function __construct($name, $cmd)
    {
        parent::__construct($name);

        $this->execute = $cmd;
    }

    public function setPrepare($cmd)
    {
        $this->prepare = $cmd;

        return $this;
    }

    protected function prepare()
    {
        if ($this->prepare) {
            exec($this->prepare);
        }
    }

    protected function execute()
    {
        exec($this->execute);
    }


    public function setCleanup($cmd)
    {
        $this->cleanup = $cmd;

        return $this;
    }

    protected function cleanup()
    {
        if ($this->cleanup) {
            exec($this->cleanup);
        }
    }
}
