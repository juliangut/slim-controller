<?php
/**
 * Slim Framework controller creator (https://github.com/juliangut/slim-controller)
 *
 * @link https://github.com/juliangut/slim-controller for the canonical source repository
 * @license https://raw.githubusercontent.com/juliangut/slim-controller/master/LICENSE
 */

namespace Jgut\Slim\Controller;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class Registrator implements ServiceProviderInterface
{
    /**
     * \Slim\App settings.
     *
     * @var array
     */
    private $settings;

    /**
     * @param array $settings
     */
    public function __construct($settings = null)
    {
        $this->settings = $settings;
    }

    /**
     * Register controller's service providers
     *
     * @param  \Pimple\Container $container
     */
    public function register(Container $container)
    {
        $settings = $this->settings ?: $container->get('settings');

        if (!is_array($settings)) {
            return;
        }

        $controllers = $settings['controllers'] ?: [];

        foreach ($controllers as $controller) {
            $controller = trim($controller, '\\');
            $FQNController = '\\' . $controller;

            if ($container->has($controller)) {
                continue;
            }

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
