[![Latest Version](https://img.shields.io/packagist/vpre/juliangut/slim-controller.svg?style=flat-square)](https://packagist.org/packages/juliangut/slim-controller)
[![License](https://img.shields.io/packagist/l/juliangut/slim-controller.svg?style=flat-square)](https://github.com/juliangut/slim-controller/blob/master/LICENSE)

[![Build status](https://img.shields.io/travis/juliangut/slim-controller.svg?style=flat-square)](https://travis-ci.org/juliangut/slim-controller)
[![Code Quality](https://img.shields.io/scrutinizer/g/juliangut/slim-controller.svg?style=flat-square)](https://scrutinizer-ci.com/g/juliangut/slim-controller)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/juliangut/slim-controller.svg?style=flat-square)](https://scrutinizer-ci.com/g/juliangut/slim-controller)
[![Total Downloads](https://img.shields.io/packagist/dt/juliangut/slim-controller.svg?style=flat-square)](https://packagist.org/packages/juliangut/slim-controller)

# Slim3 controller management

Class route creation boilerplate, allows you to define your controller classes as services to be pulled out from container easily, extending from a base controller class.

In your class route you can access services as you would in a function route.

This package is specially created for DI containers that doesn't provide auto discovery of services. Default Slim container based on Pimple does not. If you use another DI container such as [PHP-DI](https://github.com/PHP-DI/PHP-DI) you don't need this package so give it a try with [juliangut/slim-php-di](https://github.com/juliangut/slim-php-di)

## Installation

Best way to install is using [Composer](https://getcomposer.org/):

```
php composer.phar require juliangut/slim-controller
```

Then require_once the autoload file:

```php
require_once './vendor/autoload.php';
```

## Usage

```php
use \Jgut\Slim\Controller\Resolver;

// Define your controllers
$controllers = [
    'MyController',
];

// Create Slim app
$app = new \Slim\App();

// Fetch DI Container
$container = $app->getContainer();

// Register Controllers
foreach (Resolver::resolve($controllers) as $controller => $callback) {
    $container[$controller] = $callback;
}

// Define route (\MyController has already been registered)
$app->get('hello/app', '\MyController:dispatch');

// Run app
$app->run();
```

If your controller implements `Jgut\Slim\Controller\Controller` it has the DI container automatically injected, you can access it by `getContainer` method.

If your controller extends `Jgut\Slim\Controller\Base` you can also directly access container services the same way you do on a `Closure` route callback. Simply take care to not define class attributes with the same name as services in the container.

```php
use Jgut\Slim\Controller\Base as BaseController;

class MyController extends BaseController
{
    public function displatch($request, $response, array $args)
    {
        // Pull Twig view service given it was defined
        return $this->view->render($response, 'dispatch.twig');
    }
}
```

You can use the resolver to define your `Class` routes callback and not implement `Controller` or extend `Base` on those classes, in this case your controller won't have access to the container but it will still be a valid callback.

### Caveat

This controller registration method works only for controllers whose constructor doesn't need any parameters. In case you need a controller with paramenters in its `__construct()` method you can still benefit from `\Jgut\Slim\Controller\Controller` but you have to register it yourself

```php
use Jgut\Slim\Controller\Controller;

$container['\MyController'] = function($container) {
    $controller = new \MyController('customParameter');

    // Register container into the controller
    if ($controller instanceof Controller) {
        $controller->setContainer($container);
    }

    return $controller;
}
```

For more complex scenarios in which you need to setup your controller with constructor parameters or setters you should definitely try using a different DI container. For example PHP-DI container will take care of your controller class dependencies extracting them from the container itself, or allow you to define them with specific dependencies definitions. Give it a look at [juliangut/slim-php-di](https://github.com/juliangut/slim-php-di).

## Contributing

Found a bug or have a feature request? [Please open a new issue](https://github.com/juliangut/slim-controller/issues). Have a look at existing issues before

See file [CONTRIBUTING.md](https://github.com/juliangut/slim-controller/blob/master/CONTRIBUTING.md)

## License

### Release under BSD-3-Clause License.

See file [LICENSE](https://github.com/juliangut/slim-controller/blob/master/LICENSE) included with the source code for a copy of the license terms
