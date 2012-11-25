<?php

class ShellCommand
{

    protected $command = '';
    protected $output = '';
    protected $executed = false;
    protected $time = 0;

    public function __construct($command)
    {
        $this->command = $command;
    }

    public function getCommand()
    {
        return 'whatever';
    }

    public function getOutput()
    {
        $this->execute($this->command);
        return $this->output;
    }

    public function getTime()
    {
        $this->execute($this->command);
        return $this->time;
    }

    public function getStatus()
    {
        $this->execute($this->command);
        return $this->status;
    }

    public function execute($command)
    {
        if (!$this->executed)
        {
            $startTime = microtime(true);
            exec($command, $this->output, $this->status);
            $this->executed = true;
            $this->time = microtime(true) - $startTime;
        }
    }

}