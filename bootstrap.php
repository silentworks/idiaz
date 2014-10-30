<?php
require_once 'vendor/autoload.php';

$app = new Brill\Application();
$app['resolver'] = new Brill\Resolvers\DependencyResolver($app);

$app['service.manager'] = function () use ($app) {
    return new Supprtz\Support\ServiceManager($app);
};

/* Services setup */
$app['service.manager']->registerServices(require __DIR__ . '/config/providers.php');

/* Database */
require_once 'config/database.php';

/* Middleware */
require_once 'config/middleware.php';

/* Include IoC */
require_once 'config/ioc.php';

/* Include routes */
require_once 'config/routes.php';

return $app;