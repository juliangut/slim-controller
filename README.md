[![PHP version](https://img.shields.io/badge/PHP-%3E%3D5.5-8892BF.svg?style=flat-square)](http://php.net)
[![Latest Version](https://img.shields.io/packagist/vpre/juliangut/slim-controller.svg?style=flat-square)](https://packagist.org/packages/juliangut/slim-controller)
[![License](https://img.shields.io/github/license/juliangut/slim-controller.svg?style=flat-square)](https://github.com/juliangut/slim-controller/blob/master/LICENSE)

[![Build status](https://img.shields.io/travis/juliangut/slim-controller.svg?style=flat-square)](https://travis-ci.org/juliangut/slim-controller)
[![Style](https://styleci.io/repos/59418987/shield)](https://styleci.io/repos/qvy45V)
[![Code Quality](https://img.shields.io/scrutinizer/g/juliangut/slim-controller.svg?style=flat-square)](https://scrutinizer-ci.com/g/juliangut/slim-controller)
[![Code Coverage](https://img.shields.io/coveralls/juliangut/slim-controller.svg?style=flat-square)](https://coveralls.io/github/juliangut/slim-controller)
[![Total Downloads](https://img.shields.io/packagist/dt/juliangut/slim-controller.svg?style=flat-square)](https://packagist.org/packages/juliangut/slim-controller)

# Slim3 controller management

Class route creation boilerplate, allows you to define your controller classes as services to be pulled out from container easily, extending from a base controller class.

I strongly suggest you don't use this library but for rapid prototyping or certain use cases. If you really want to follow SOLID principles, don't use this package and either directly inject your dependencies in the controller class, use the container to create and inject dependencies or try another container such as PHP-DI with [juliangut/slim-php-di](https://github.com/juliangut/slim-php-di)

> I cannot stress this enough, this library is meant to be used with default Slim container and for certain cases only.

## Installation

Best way to install is using [Composer](https://getcomposer.org/):

```
composer require juliangut/slim-controller
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

// Create Slim app and fetch DI Container
$app = new \Slim\App();
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

If your controller extends `Jgut\Slim\Controller\Base` you can also directly access container services the same way you do on a `Closure` route callback. Simply take care to not define class attributes with the same name as services in the container. To do this container is injected in the controller and `__get` and `__isset` magic methods are defined to look into the container.

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

You can use the resolver to define your `class` routes callback and not implement `Controller` or extend `Base` on those classes, in this case your controller won't have access to the container but it will still be a valid callback.

### Important notice

As a general rule of thumb directly injecting container is considered a bad practice as you are actually hiding your dependencies, by fetching them from the container, instead of defining them in the class. You'll be using the container as a service locator rather than a true DIC.

### Caveat

This controller registration works only for controllers whose constructor doesn't need any parameters. In case you need a controller with paramenters in its `__construct()` method you can still benefit from `\Jgut\Slim\Controller\Controller` but you have to register it yourself.

```php
use Jgut\Slim\Controller\Controller;

$container['\MyController'] = function($container) {
    $controller = new \MyController('customParameter');

    // Set container into the controller
    if ($controller instanceof Controller) {
        $controller->setContainer($container);
    }

    return $controller;
}
```

## Contributing

Found a bug or have a feature request? [Please open a new issue](https://github.com/juliangut/slim-controller/issues). Have a look at existing issues before

See file [CONTRIBUTING.md](https://github.com/juliangut/slim-controller/blob/master/CONTRIBUTING.md)

## License

### Release under BSD-3-Clause License.

See file [LICENSE](https://github.com/juliangut/slim-controller/blob/master/LICENSE) included with the source code for a copy of the license terms
