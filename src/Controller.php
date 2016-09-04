<?php
/**
 * Slim Framework controller creator (https://github.com/juliangut/slim-controller)
 *
 * @link https://github.com/juliangut/slim-controller for the canonical source repository
 *
 * @license https://raw.githubusercontent.com/juliangut/slim-controller/master/LICENSE
 */

namespace Jgut\Slim\Controller;

use Interop\Container\ContainerInterface;

/**
 * Slim Framework controller interface.
 */
interface Controller
{
    /**
     * Set DI container.
     *
     * @param \Interop\Container\ContainerInterface $container
     */
    public function setContainer(ContainerInterface &$container);

    /**
     * Get DI container.
     *
     * @return \Interop\Container\ContainerInterface
     */
    public function getContainer();
}
