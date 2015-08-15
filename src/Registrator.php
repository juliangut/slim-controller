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
        foreach ($this->getControllers($container) as $controller) {
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

    /**
     * Get controller's settings.
     *
     * @return array
     */
    private function getControllers(Container $container)
    {
        $settings = $this->settings ?: $container['settings'];

        return is_array($settings) && isset($settings['controllers']) ? $settings['controllers'] : [];
    }
}
