<?php namespace Supprtz\Providers;

use Orno\Http\Response;

class TwigResponse
{
    protected $headers = [];
    protected $status = 200;
    /**
     * @var \Twig_Environment
     */
    private $twig;

    function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function setStatus($status = 200)
    {
        $this->status = $status;
    }

    public function setHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    public function setHeaders(array $headers = [])
    {
        $this->headers = $headers;
    }

    public function render($template, array $data = [])
    {
        $templateContent = $this->twig->render($template, $data);
        return new Response($templateContent, $this->status, $this->headers);
    }
}