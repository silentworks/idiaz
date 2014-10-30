<?php
namespace Idiaz\Action;

use Idiaz\Domain\IdeaRepository;
use Idiaz\HttpResponse;
use Slim\Http\Request;

class IdeasFeaturedAction
{
    private $idea;
    private $response;
    private $request;

    function __construct(Request $request, IdeaRepository $idea, HttpResponse $response)
    {
        $this->idea = $idea;
        $this->response = $response;
        $this->request = $request;
    }

    public function __invoke()
    {
        $limit = $this->request->get('limit', 6);
        $offset = $this->request->get('page', 0);

        $ideas = $this->idea->paginate($limit, $offset);
        $this->response->make('ideas.twig', compact('ideas'));
    }
} 