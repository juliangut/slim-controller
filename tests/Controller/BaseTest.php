<?php
/**
 * Slim Framework controller creator (https://github.com/juliangut/slim-controller)
 *
 * @link https://github.com/juliangut/slim-controller for the canonical source repository
 * @license https://raw.githubusercontent.com/juliangut/slim-controller/master/LICENSE
 */

namespace Jgut\Slim\Controller\Tests;

use Slim\Container;
use Jgut\Slim\Controller\Base;

/**
 * @covers Jgut\Slim\Controller\Base
 */
class BaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Jgut\Slim\Controller\Base::setContainer
     * @covers Jgut\Slim\Controller\Base::getContainer
     * @covers Jgut\Slim\Controller\Base::__isset
     * @covers Jgut\Slim\Controller\Base::__get
     */
    public function testContainer()
    {
        $settings = ['a', 'b'];

        $container = new Container();
        $container['settings'] = $settings;

        $controller = new Base;
        $controller->setContainer($container);

        $this->assertInstanceOf('\Slim\Container', $controller->getContainer());
        $this->assertEquals(true, isset($controller->settings));
        $this->assertEquals($settings, $controller->settings);
    }
}
