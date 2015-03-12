<?php

namespace Jgut\Slim\ControllerTests;

use Slim\Slim;
use Jgut\Slim\Controller\Closure;

class ControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testClosure()
    {
        $app = new Slim();
        $closure = Closure::get('Jgut\Slim\Controller\Controller:getApplication');

        $this->assertInstanceOf('\Closure', $closure);
        $this->assertEquals($closure(), $app);
    }
}
