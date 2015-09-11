<?php
/**
 * Slim Framework controller creator (https://github.com/juliangut/slim-controller)
 *
 * @link https://github.com/juliangut/slim-controller for the canonical source repository
 * @license https://raw.githubusercontent.com/juliangut/slim-controller/master/LICENSE
 */

namespace Jgut\Slim\Controller\Tests;

use Slim\Container;
use Jgut\Slim\Controller\Resolver;

/**
 * @covers Jgut\Slim\Controller\Resolver
 */
class ResolverTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Jgut\Slim\Controller\Resolver::resolve
     */
    public function testDefaultRegistration()
    {
        $controllers = [
            'Jgut\Slim\Controller\Base',
        ];

        $container = new Container();
        foreach (Resolver::resolve($controllers) as $controller => $callback) {
            $container[$controller] = $callback;
        }

        $this->assertInstanceOf(
            'Jgut\Slim\Controller\Base',
            $container->get('Jgut\Slim\Controller\Base')
        );
    }
}
