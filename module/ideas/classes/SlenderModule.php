<?php
namespace Idiaz;

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Events\Dispatcher;
use Slender\Interfaces\ModuleInvokableInterface;

/**
 * SlenderModule
 */
class SlenderModule implements ModuleInvokableInterface
{
    public function invoke(\Slender\App &$app)
    {
        $capsule = new Manager;
        $capsule->addConnection($app['settings']['db']['default']);

        $capsule->setEventDispatcher(new Dispatcher(new Container));

        // If you want to use the Eloquent ORM...
        $capsule->bootEloquent();

        /* DB methods accessible via Slim instance */
        $capsule->setAsGlobal();

        $app['idea'] = function () {
            return new EloquentIdeaRepository();
        };
    }
}
