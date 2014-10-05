<?php namespace Supprtz\Providers;

use Supprtz\Support\ServiceProvider;

class TwigServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app['twig.options'] = array();
        $this->app['twig.path'] = array();
        $this->app['twig.templates'] = array();

        $this->app['twig'] = function () {
            $app = $this->app;
            $app['twig.options'] = array_replace(
                array(
                    'charset' => isset($app['charset']) ? $app['charset'] : 'UTF-8',
                    'debug' => isset($app['debug']) ? $app['debug'] : false,
                    'strict_variables' => isset($app['debug']) ? $app['debug'] : false,
                ), $app['twig.options']
            );

            /** @var \Twig_Environment $twig */
            $twig = $app['twig.environment'];
            $twig->addGlobal('app', $app);

            if (isset($app['debug']) && $app['debug']) {
                $twig->addExtension(new \Twig_Extension_Debug());
            }

            return $twig;
        };

        $this->app['twig.loader.filesystem'] = function () {
            return new \Twig_Loader_Filesystem($this->app['twig.path']);
        };

        $this->app['twig.loader.array'] = function () {
            return new \Twig_Loader_Array($this->app['twig.templates']);
        };

        $this->app['twig.loader'] = function () {
            return new \Twig_Loader_Chain(array(
                $this->app['twig.loader.array'],
                $this->app['twig.loader.filesystem'],
            ));
        };

        $this->app->getContainer()->add('twig.environment', function () {
            return new \Twig_Environment($this->app['twig.loader'], $this->app['twig.options']);
        });

        $this->app['twig.response'] = function () {
            return new TwigResponse($this->app['twig']);
        };
    }
} 