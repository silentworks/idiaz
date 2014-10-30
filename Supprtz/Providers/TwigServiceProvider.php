<?php
namespace Supprtz\Providers;

use Supprtz\Support\ServiceProvider;

class TwigServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app['twig.options'] = array();
        $this->app['twig.path'] = array();
        $this->app['twig.templates'] = array();

        $this->app['twig'] = function ($app) {
            $app['twig.options'] = array_replace(
                array(
                    'charset' => isset($app['charset']) ? $app['charset'] : 'UTF-8',
                    'debug' => isset($app['debug']) ? $app['debug'] : false,
                    'strict_variables' => isset($app['debug']) ? $app['debug'] : false,
                ), $app['twig.options']
            );

            /** @var \Twig_Environment $twig */
            $twig = $app['twig.environment']($app);
            $twig->addGlobal('app', $app);

            if (isset($app['debug']) && $app['debug']) {
                $twig->addExtension(new \Twig_Extension_Debug());
            }

            return $twig;
        };

        $this->app['twig.loader.filesystem'] = function ($app) {
            return new \Twig_Loader_Filesystem($app['twig.path']);
        };

        $this->app['twig.loader.array'] = function ($app) {
            return new \Twig_Loader_Array($app['twig.templates']);
        };

        $this->app['twig.loader'] = function ($app) {
            return new \Twig_Loader_Chain(array(
                $app['twig.loader.array'],
                $app['twig.loader.filesystem'],
            ));
        };

        $this->app['twig.environment'] = $this->app->protect(function ($app) {
            return new \Twig_Environment($app['twig.loader'], $app['twig.options']);
        });

        $this->app['twig.response'] = function () {
            return new TwigResponse($this->app['twig']);
        };
    }
} 