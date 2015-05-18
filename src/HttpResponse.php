<?php
namespace Idiaz;

use Slim\Http\Response;
use Slim\Router;
use Slim\Views\Twig;
use Supprtz\Providers\TwigResponse;

class HttpResponse
{
    /**
     * @var \Slim\Http\Response
     */
    private $response;

    /**
     * @var \Slim\Router
     */
    private $router;

    /**
     * @var \Slim\Views\Twig
     */
    private $twigResponse;

    function __construct(Response $response, Router $router, Twig $twigResponse)
    {
        $this->response = $response;
        $this->router = $router;
        $this->twigResponse = $twigResponse;
    }

    /**
     * @param $view
     * @param array $data
     */
    public function make($view, array $data = [])
    {
        return $this->response->write(
            $this->twigResponse->fetch($view, $data)
        );
    }

    public function redirectTo($routeName, array $args = [])
    {
    	$urlFor = $this->router->urlFor($routeName, $args);
    	return $this->response->withRedirect($urlFor);
    }

    public function redirect($url)
    {
    	return $this->response->withRedirect($url);
    }
}
