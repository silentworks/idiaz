<?php
namespace Idiaz\Action;

use Idiaz\Domain\IdeaRepository;
use Idiaz\HttpResponse;
use Slim\Http\Request;

class IdeasStoreAction
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
        $title = $this->request->get('title');
        $content = $this->request->get('content');

        $this->idea->create(array(
            'title' => $title,
            'content' => $content
        ));
    }
} 