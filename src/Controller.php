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
 * Base Slim Framework controller.
 */
class Controller
{
    /**
     * @var \Slim\Slim
     *
     * Slim application
     */
    protected $app;

    /**
     * Get Slim application.
     *
     * @return \Slim\Slim
     */
    final public function getApplication()
    {
        return $this->app;
    }

    /**
     * Set Slim application.
     *
     * @param \Slim\Slim $app
     */
    final public function setApplication(Slim $app)
    {
        $this->app = $app;

        return $this;
    }
}
