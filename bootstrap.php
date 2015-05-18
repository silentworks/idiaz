<?php
require_once 'vendor/autoload.php';

$app = new Slim\App();
$app->register(new \Slim\Views\Twig(__DIR__ . '/view'))
    ->register(new \Idiaz\ServiceProvider());

/* Database */
require_once 'config/database.php';

/* Middleware */
require_once 'config/middleware.php';

/* Include routes */
require_once 'config/routes.php';

return $app;
