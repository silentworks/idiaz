<?php namespace Idiaz;

use Aptoma\Twig\Extension\MarkdownExtension;
use Aptoma\Twig\Extension\MarkdownEngine;
use Idiaz\Controllers\IdeasController;
use Idiaz\Controllers\MigrationsController;
use Idiaz\Entity\Repository\IdeaRepository;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Idiaz\TwigUrlExtension;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['db.config'] = function () {
            return require dirname(__DIR__) . '/config/database.php';
        };

        $app['db'] = function () use ($app) {
            $dbConfig = $app['db.config'];
            $cfg = new \Spot\Config();
            $cfg->addConnection(
            	$dbConfig['default'], 
            	$dbConfig['connections'][$dbConfig['default']]
        	);
            return new \Spot\Locator($cfg);
        };

        $app['view']->getEnvironment()->addExtension(
        	new MarkdownExtension(new MarkdownEngine\MichelfMarkdownEngine())
    	);
        $app['view']->getEnvironment()->addExtension(
        	new TwigUrlExtension($app['request'], $app['router'])
		);

        /* Register Response */
        $app['http.response'] = function () use ($app) {
            return new HttpResponse($app['response'], $app['router'], $app['view']);
        };

        /* Register Actions */
        $app['Idiaz\Controllers\IdeasController'] = function () use ($app) {
            return new IdeasController($app['http.response'], $app['idea.repository']);
        };

        $app['Idiaz\Controllers\MigrationsController'] = function () use ($app) {
            return new MigrationsController($app['db']);
        };

        /* Register Repository */
        $app['idea.repository'] = function () use ($app) {
            return new IdeaRepository($app['db']->mapper('Idiaz\Entity\Idea'));
        };
    }
}
