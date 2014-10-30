<?php
namespace Idiaz;

use Brill\Application;

class RedirectResponse
{
    protected $app;
    protected $url;
    protected $statusCode = 302;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function route($routeName, array $params = [])
    {
        $url = $this->app->urlFor($routeName, $params);
        $this->url = $url;
        return $this->now();
    }

    public function to($url)
    {
        $this->$url = $url;
        return $this->now();
    }

    public function statusCode($statusCode = 302)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function with($key, $value)
    {
        $this->app['flash']->next($key, $value);
        return $this;
    }

    public function withErrors($value)
    {
        $this->app['flash']->next('errors', $value);
        return $this;
    }

    public function withInput()
    {
        $this->app['session']->set('input', $this->app['request']->params());
    }

    public function now()
    {
        $url = $this->url;

        /**@var \Slim\Http\Response $response */
        $response = $this->app['response'];
        $response->write(
            sprintf('<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="refresh" content="1;url=%1$s" />

        <title>Redirecting to %1$s</title>
    </head>
    <body>
        Redirecting to <a href="%1$s">%1$s</a>.
    </body>
</html>', htmlspecialchars($url, ENT_QUOTES, 'UTF-8')),
            true);

        $response->redirect($url, $this->statusCode);
        return $this;
    }
}
