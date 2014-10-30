<?php namespace Idiaz;

use Aptoma\Twig\Extension\MarkdownExtension;
use Aptoma\Twig\Extension\MarkdownEngine;
use Idiaz\Action\IdeasBrowseAction;
use Idiaz\Action\IdeasCreateAction;
use Idiaz\Action\IdeasEditAction;
use Idiaz\Action\IdeasFeaturedAction;
use Idiaz\Action\IdeasShowAction;
use Idiaz\Action\IdeasStoreAction;
use Idiaz\Action\IdeasUpdateAction;
use Idiaz\Domain\SpotIdeaRepository;
use Supprtz\Providers\TwigUrlExtension;

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
        $app['twig']->addExtension(new TwigUrlExtension($app));

        /* Register Response */
        $app['http.response'] = function () use ($app) {
            return new HttpResponse($app['response'], $app['twig.response']);
        };

        /* Register Actions */
        $app['Idiaz\Action\IdeasBrowseAction'] = function () use ($app) {
            return new IdeasBrowseAction($app['request'], $app['idea.repository'], $app['http.response']);
        };
        $app['Idiaz\Action\IdeasFeaturedAction'] = function () use ($app) {
            return new IdeasFeaturedAction($app['request'], $app['idea.repository'], $app['http.response']);
        };
        $app['Idiaz\Action\IdeasCreateAction'] = function () use ($app) {
            return new IdeasCreateAction($app['http.response']);
        };
        $app['Idiaz\Action\IdeasStoreAction'] = function () use ($app) {
            return new IdeasStoreAction($app['request'], $app['idea.repository'], $app['http.response']);
        };
        $app['Idiaz\Action\IdeasEditAction'] = function () use ($app) {
            return new IdeasEditAction($app['idea.repository'], $app['http.response']);
        };
        $app['Idiaz\Action\IdeasUpdateAction'] = function () use ($app) {
            return new IdeasUpdateAction($app['request'], $app['idea.repository'], $app['http.response']);
        };
        $app['Idiaz\Action\IdeasShowAction'] = function () use ($app) {
            return new IdeasShowAction($app['request'], $app['idea.repository'], $app['http.response']);
        };

        /* Register Repository */
        $app['idea.repository'] = function () use ($app) {
            return new SpotIdeaRepository($app['db']->mapper('Idiaz\Domain\Idea'));
        };
    }
}