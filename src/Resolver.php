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

class Resolver
{
    /**
     * Create service callbacks.
     *
     * @param array $controllers
     *
     * @return array
     */
    public static function resolve(array $controllers)
    {
        $callbacks = [];

        foreach ($controllers as $controller) {
            $qualifiedController = '\\' . trim($controller, '\\');

            $callbacks[$controller] = function (ContainerInterface $container) use ($qualifiedController) {
                $controller = new $qualifiedController();

                if ($controller instanceof Controller) {
                    $controller->setContainer($container);
                }

                return $controller;
            };
        }

        return $callbacks;
    }
}
