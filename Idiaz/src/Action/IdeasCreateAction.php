<?php
namespace Idiaz\Action;

use Idiaz\Domain\IdeaRepository;
use Idiaz\HttpResponse;
use Slim\Http\Request;

class IdeasCreateAction
{
    private $response;

    function __construct(HttpResponse $response)
    {
        $this->response = $response;
    }

    public function __invoke()
    {
        $this->response->make('create.twig');
    }
} 