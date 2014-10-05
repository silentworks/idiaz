<?php

$app['db.config'] = function () {
    return require __DIR__ . '/database.php';
};

$app['db'] = function () use ($app) {
    $dbConfig = $app['db.config'];
    $cfg = new Spot\Config();
    $cfg->addConnection($dbConfig['default'], $dbConfig['connections'][$dbConfig['default']]);
    return new Spot\Locator($cfg);
};