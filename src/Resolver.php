<?php
/**
 * Slim Framework controller creator (https://github.com/juliangut/slim-controller)
 *
 * @link https://github.com/juliangut/slim-controller for the canonical source repository
 * @license https://raw.githubusercontent.com/juliangut/slim-controller/master/LICENSE
 */

namespace Jgut\Slim\Controller;

use Interop\Container\ContainerInterface;

class Resolver
{
    public static function resolve(ContainerInterface $container, array $controllers)
    {
        $callbacks = [];

        foreach ($controllers as $controller) {
            $controller = trim($controller, '\\');
            $FQNController = '\\' . $controller;

            $callbacks[$controller] = function ($container) use ($FQNController) {
                $controller = new $FQNController();

                if ($controller instanceof Controller) {
                    $controller->setContainer($container);
                }

                return $controller;
            };
        }

        return $callbacks;
    }
}
