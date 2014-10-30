<?php namespace Supprtz\Support;

use Slim\App;

abstract class ServiceProvider
{
    /**
     * The application instance
     *
     * @var \Slim\App
     */
    protected $app;

    /**
     * @param \Slim\App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function boot() {}

    abstract public function register();
} 