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
     * controllers settings.
     *
     * @var array
     */
    private $settings;

    /**
     * @param array $settings
     */
    public function __construct(array $settings = [])
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

            if (isset($container[$controller])) {
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
        if (!empty($this->settings)) {
            return $this->settings;
        } elseif (isset($container['settings']['controllers']) && is_array($container['settings']['controllers'])) {
            return $container['settings']['controllers'];
        }

        return [];
    }
}
