<?php
namespace Idiaz;

use Slim\Http\Response;
use Slim\Router;
use Slim\Views\Twig;

class HttpResponse
{
    /**
     * @var \Slim\Router
     */
    private $router;

    /**
     * @var \Slim\Views\Twig
     */
    private $twig;

    function __construct(Router $router, Twig $twig)
    {
        $this->router = $router;
        $this->twig = $twig;
    }

    /**
     * @param $view
     * @param array $data
     */
    public function make(Response $response, $view, array $data = [])
    {
        return $response->write(
            $this->twig->fetch($view, $data)
        );
    }

    public function redirectTo(Response $response, $routeName, array $args = [])
    {
        $urlFor = $this->router->urlFor($routeName, $args);
        return $response->withRedirect($urlFor);
    }

    public function redirect(Response $response, $url)
    {
        return $response->withRedirect($url);
    }
}
