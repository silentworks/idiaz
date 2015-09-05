<?php namespace Idiaz;

use Aptoma\Twig\Extension\MarkdownExtension;
use Aptoma\Twig\Extension\MarkdownEngine;
use Idiaz\Controllers\IdeasController;
use Idiaz\Controllers\InstallController;
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

        $app['view'] = function ($c)
        {
            $view = new \Slim\Views\Twig(dirname(__DIR__) . '/view');

            // Instantiate and add Slim specific extension
            $view->addExtension(new \Slim\Views\TwigExtension(
                $c['router'],
                $c['request']->getUri()
            ));

            $view->addExtension(
                new MarkdownExtension(new MarkdownEngine\MichelfMarkdownEngine())
            );
            $view->addExtension(
                new TwigUrlExtension($c['request'], $c['router'])
            );

            return $view;
        };

        /* Register Response */
        $app['http.response'] = function () use ($app) {
            return new HttpResponse($app['router'], $app['view']);
        };

        /* Register Actions */
        $app['Idiaz\Controllers\IdeasController'] = function () use ($app) {
            return new IdeasController($app['http.response'], $app['idea.repository']);
        };

        $app['Idiaz\Controllers\InstallController'] = function () use ($app) {
            return new InstallController($app['http.response'], $app['db']->mapper('Idiaz\Entity\Idea'));
        };

        /* Register Repository */
        $app['idea.repository'] = function () use ($app) {
            return new IdeaRepository($app['db']->mapper('Idiaz\Entity\Idea'));
        };
    }
}
