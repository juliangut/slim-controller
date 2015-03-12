<?php

namespace Jgut\Slim\Controller;

use Slim\Slim;

class Closure
{
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
