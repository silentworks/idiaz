<?php
namespace Idiaz\Action;

use Idiaz\Domain\IdeaRepository;
use Idiaz\HttpResponse;

class IdeasFeaturedAction
{
    private $idea;
    private $response;

    function __construct(IdeaRepository $idea, HttpResponse $response)
    {
        $this->idea = $idea;
        $this->response = $response;
    }

    public function __invoke()
    {
        $ideas = $this->idea->paginate(6);
        $this->response->make('ideas.twig', compact('ideas'));
    }
} 