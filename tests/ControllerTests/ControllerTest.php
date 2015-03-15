<?php
/**
 * Slim Framework controller creator (https://github.com/juliangut/slim-controller)
 *
 * @link https://github.com/juliangut/slim-controller for the canonical source repository
 * @license https://raw.githubusercontent.com/juliangut/slim-controller/master/LICENSE
 */

namespace Jgut\Slim\ControllerTests;

use Slim\Slim;
use Jgut\Slim\Controller\Closure;

/**
 * @covers Jgut\Slim\Controller\Closure
 * @covers Jgut\Slim\Controller\Controller
 */
class ControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Jgut\Slim\Controller\Closure::get
     * @covers Jgut\Slim\Controller\Controller::getApplication
     * @covers Jgut\Slim\Controller\Controller::setApplication
     */
    public function testClosure()
    {
        $app = new Slim();
        $closure = Closure::get('Jgut\Slim\Controller\Controller:getApplication');

        $this->assertInstanceOf('\Closure', $closure);
        $this->assertEquals($closure(), $app);
    }
}
