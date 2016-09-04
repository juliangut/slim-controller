<?php
/**
 * Slim Framework controller creator (https://github.com/juliangut/slim-controller)
 *
 * @link https://github.com/juliangut/slim-controller for the canonical source repository
 *
 * @license https://raw.githubusercontent.com/juliangut/slim-controller/master/LICENSE
 */

namespace Jgut\Slim\Controller\Tests;

use Jgut\Slim\Controller\Base;
use Slim\Container;

/**
 * Base controller test class.
 */
class BaseTest extends \PHPUnit_Framework_TestCase
{
    public function testContainer()
    {
        $settings = ['a', 'b'];

        $container = new Container();
        $container['settings'] = $settings;

        $controller = new Base;
        $controller->setContainer($container);

        static::assertInstanceOf('\Slim\Container', $controller->getContainer());
        static::assertEquals(true, isset($controller->settings));
        static::assertEquals($settings, $controller->settings);
    }
}
