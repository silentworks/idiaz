<?php
namespace Idiaz\Action;

use Idiaz\Domain\IdeaRepository;
use Idiaz\HttpResponse;

class IdeasEditAction
{
    private $response;
    private $idea;

    function __construct(IdeaRepository $idea, HttpResponse $response)
    {
        $this->response = $response;
        $this->idea = $idea;
    }

    public function __invoke($id)
    {
        $idea = $this->idea->find($id);
        $this->response->make('edit.twig', compact('idea'));
    }
} 