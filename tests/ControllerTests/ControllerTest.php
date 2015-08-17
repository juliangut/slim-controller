<?php
/**
 * Slim Framework controller creator (https://github.com/juliangut/slim-controller)
 *
 * @link https://github.com/juliangut/slim-controller for the canonical source repository
 * @license https://raw.githubusercontent.com/juliangut/slim-controller/master/LICENSE
 */

namespace Jgut\Slim\ControllerTests;

use Slim\Container;
use Jgut\Slim\Controller\Controller;

/**
 * @covers Jgut\Slim\Controller\Controller
 */
class ControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Jgut\Slim\Controller\Controller::setContainer
     * @covers Jgut\Slim\Controller\Controller::getContainer
     * @covers Jgut\Slim\Controller\Controller::__isset
     * @covers Jgut\Slim\Controller\Controller::__get
     */
    public function testContainer()
    {
        $settings = ['a', 'b'];

        $container = new Container();
        $container['settings'] = $settings;

        $controller = new Controller;
        $controller->setContainer($container);

        $this->assertInstanceOf('\Slim\Container', $controller->getContainer());
        $this->assertEquals(true, isset($controller->settings));
        $this->assertEquals($settings, $controller->settings);
    }
}
