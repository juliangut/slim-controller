<?php
/**
 * Slim Framework controller creator (https://github.com/juliangut/slim-controller)
 *
 * @link https://github.com/juliangut/slim-controller for the canonical source repository
 * @license https://raw.githubusercontent.com/juliangut/slim-controller/master/LICENSE
 */

namespace Jgut\Slim\Controller;

use Interop\Container\ContainerInterface;

class Registrator
{
    /**
     * Register controller's service providers
     *
     * @param \Interop\Container\ContainerInterface $container
     * @param array $settings
     */
    public static function register(ContainerInterface $container, array $settings = [])
    {
        $controllers = [];

        if (!empty($settings)) {
            $controllers = $settings;
        } else {
            $settings = $container->get('settings');

            if (isset($settings['controllers']) && is_array($settings['controllers'])) {
                $controllers = $settings['controllers'];
            }
        }

        foreach ($controllers as $controller) {
            $controller = trim($controller, '\\');
            $FQNController = '\\' . $controller;

            $container[$controller] = function ($container) use ($FQNController) {
                $controller = new $FQNController();

                if ($controller instanceof Controller) {
                    $controller->setContainer($container);
                }

                return $controller;
            };
        }
    }
}
