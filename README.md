[![Build Status](https://travis-ci.org/juliangut/slim-controller.svg?branch=master)](https://travis-ci.org/juliangut/slim-controller)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/juliangut/slim-controller/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/juliangut/slim-controller/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/juliangut/slim-controller/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/juliangut/slim-controller/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/juliangut/slim-controller/v/stable.svg)](https://packagist.org/packages/juliangut/controller)
[![Total Downloads](https://poser.pugx.org/juliangut/slim-controller/downloads.svg)](https://packagist.org/packages/juliangut/slim-controller)

# Juliangut Slim Framework controller creator

Base controller class and controllers registrator for Slim Framework.

Allows you to define controllers on Slim settings so they get automatically registered into the DI container.

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

Defined settings array `controllers` key in `settings.php`

```php
return [
    ...
    'controllers' => [
        'MyController',
    ],
    ...
];
```

```php
// Create Slim app
$settings = require __DIR__ . 'settings.php';
$app = new \Slim\App($settings);

// Fetch DI Container
$container = $app->getContainer();

// Register Controllers registrator
$container->register(new \Jgut\Slim\Controller\Registrator);

// Define route (\MyController has already been registered)
$app->get('hello/app', '\MyController:dispatch');

// Run app
$app->run();
```

If your controller extends `Jgut\Slim\Controller\Controller` it is automatically composed with the DI container so you can access its data the same way you do on a `Closure` route callback

```php
use Jgut\Slim\Controller\Controller;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class MyController extends Controller
{
    public function displatch(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        // Pull Twig view service (\Slim\Views\Twig)
        return $this->view->render($response, 'dispatch.twig');
        ...
    }
}
```

### Caveat

This controller registration method works only for controllers whose constructor doesn't need any parameters. In case you need a controller with paramenters in its `__construct()` method you can still benefit from `\Jgut\Slim\Controller\Controller` but you have to register it yourself

```php
$container['\MyController'] = function($container) {
    $controller = new \MyController('customParameter');
    $controller->setContainer($container);

    return $controller;
}
```

## Contributing

Found a bug or have a feature request? [Please open a new issue](https://github.com/juliangut/slim-controller/issues). Have a look at existing issues before

See file [CONTRIBUTING.md](https://github.com/juliangut/slim-controller/blob/master/CONTRIBUTING.md)

## License

### Release under BSD-3-Clause License.

See file [LICENSE](https://github.com/juliangut/slim-controller/blob/master/LICENSE) included with the source code for a copy of the license terms
