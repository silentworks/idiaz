<?php
namespace Idiaz\Action;

use Idiaz\Domain\IdeaRepository;
use Idiaz\HttpResponse;
use Slim\Http\Request;

class IdeasBrowseAction
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

    public function __invoke()
    {
        $limit = $this->request->get('limit', 10);
        $offset = $this->request->get('offset', 0);

        $pageTitle = 'All Ideas';
        $ideas = $this->idea->paginate($limit, $offset);

        $this->response->make('ideas.twig', compact('pageTitle', 'ideas'));
    }
} 