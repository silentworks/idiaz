<?php namespace Idiaz;

use Aptoma\Twig\Extension\MarkdownExtension;
use Aptoma\Twig\Extension\MarkdownEngine;

class ServiceProvider extends \Supprtz\Support\ServiceProvider
{
    public function register()
    {
        $app = $this->app;

        /* Register View Directory to Twig */
        $app['twig.path'] = array(
            __DIR__ . '/../view'
        );

        $app['twig']->addExtension(new MarkdownExtension(new MarkdownEngine\MichelfMarkdownEngine()));

        /* Register Controller */
        $app['Idiaz\IdeasController'] = function () use ($app) {
            return new IdeasController($app['idea.repository'], $app['twig.response']);
        };

        /* Register Repository */
        $app['idea.repository'] = function () use ($app) {
            return new SpotIdeaRepository($app['db']->mapper('Idiaz\Idea'));
        };
    }
}