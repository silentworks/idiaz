<?php
namespace Idiaz;

use Slim\Http\Response;
use Supprtz\Providers\TwigResponse;

class HttpResponse
{
    /**
     * @var \Slim\Http\Response
     */
    private $response;
    /**
     * @var \Supprtz\Providers\TwigResponse
     */
    private $twigResponse;

    function __construct(Response $response, TwigResponse $twigResponse)
    {
        $this->response = $response;
        $this->twigResponse = $twigResponse;
    }

    /**
     * @param $view
     * @param array $data
     */
    public function make($view, array $data = [])
    {
        $this->response->write($this->twigResponse->render($view, $data));
    }
}