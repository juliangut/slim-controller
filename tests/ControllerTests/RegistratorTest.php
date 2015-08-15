<?php
/**
 * Slim Framework controller creator (https://github.com/juliangut/slim-controller)
 *
 * @link https://github.com/juliangut/slim-controller for the canonical source repository
 * @license https://raw.githubusercontent.com/juliangut/slim-controller/master/LICENSE
 */

namespace Jgut\Slim\ControllerTests;

use Slim\Container;
use Jgut\Slim\Controller\Registrator;

/**
 * @covers Jgut\Slim\Controller\Registrator
 */
class RegistratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Jgut\Slim\Controller\Registrator::register
     * @expectedException RuntimeException
     */
    public function testNoRegistration()
    {
        $container = new Container();
        $container->register(new Registrator());

        $container->get('Jgut\Slim\Controller\Controller');
    }

    /**
     * @covers Jgut\Slim\Controller\Registrator::register
     */
    public function testRegistration()
    {
        $settings = [
            'Jgut\Slim\Controller\Controller',
            'Jgut\Slim\Controller\Controller',
        ];

        $container = new Container();
        $container->register(new Registrator($settings));

        $this->assertInstanceOf(
            'Jgut\Slim\Controller\Controller',
            $container->get('Jgut\Slim\Controller\Controller')
        );
    }
}
