<?php
namespace Idiaz\Action;

use Idiaz\Domain\IdeaRepository;
use Idiaz\HttpResponse;
use Slim\Http\Request;

class IdeasShowAction
{
    private $request;
    private $idea;
    private $response;

    function __construct(Request $request, IdeaRepository $idea, HttpResponse $response)
    {
        $this->idea = $idea;
        $this->response = $response;
        $this->request = $request;
    }

    public function __invoke($id)
    {
        $idea = $this->idea->find($id);

        $this->response->make('idea.twig', compact('idea'));
    }
} 