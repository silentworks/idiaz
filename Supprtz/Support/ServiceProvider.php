<?php namespace Supprtz\Support;

use Proton\Application;

abstract class ServiceProvider
{
    /**
     * The application instance
     *
     * @var \Proton\Application
     */
    protected $app;

    /**
     * @param \Proton\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function boot() {}

    abstract public function register();
} 