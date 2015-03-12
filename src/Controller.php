<?php

namespace Jgut\Slim\Controller;

use Slim\Slim;

class Controller
{
    protected $app;

    final public function setApplication(Slim $app)
    {
        $this->app = $app;

        return $this;
    }

    final public function getApplication()
    {
        return $this->app;
    }
}
