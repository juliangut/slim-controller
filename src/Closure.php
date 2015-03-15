<?php
/**
 * Slim Framework controller creator (https://github.com/juliangut/slim-controller)
 *
 * @link https://github.com/juliangut/slim-controller for the canonical source repository
 * @license https://raw.githubusercontent.com/juliangut/slim-controller/master/LICENSE
 */

namespace Jgut\Slim\Controller;

use Slim\Slim;

/**
 * Closure manager for Slim routes.
 */
class Closure
{
    /**
     * Create closure for Slim route.
     *
     * @param string $route
     * @param string $appName
     * @return \Closure
     */
    public static function get($route, $appName = 'default')
    {
        $app = Slim::getInstance($appName);
        list($controller, $action) = explode(':', $route);

        return function () use ($app, $controller, $action) {
            if ($app->container->has($controller)) {
                $controller = $app->container->get($controller);
            } else {
                $controller = new $controller();
            }

            if ($controller instanceof \Jgut\Slim\Controller\Controller) {
                $controller->setApplication($app);
            }

            return call_user_func_array(array($controller, $action), func_get_args());
        };
    }
}
