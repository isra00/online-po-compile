<?php

require '../ShellCommand.php';

class ShellCommandTest extends PHPUnit_Framework_TestCase
{

    /**
     * An instance of the ShellCommand class for testing.
     * @var ShellCommand. 
     */
    protected $cmd;

    public function setUp()
    {
        $this->cmd = new ShellCommand('ls /etc/passwd');
    }

    public function testGetCommand()
    {
        $this->assertEquals('whatever', $this->cmd->getCommand());
    }

    public function testGetTime()
    {
        $this->assertGreaterThan(0, $this->cmd->getTime());
    }

    public function testGetOutput()
    {
        $this->assertEquals(array('/etc/passwd'), $this->cmd->getOutput());
    }

    public function testGtStatus()
    {
        $this->assertEquals(0, $this->cmd->getStatus());
    }

}