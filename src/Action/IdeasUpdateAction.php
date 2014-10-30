<?php
namespace Idiaz\Action;

use Idiaz\Domain\IdeaRepository;
use Idiaz\HttpResponse;
use Slim\Http\Request;

class IdeasUpdateAction
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
        $title = $this->request->get('title');
        $content = $this->request->get('content');

        $this->idea->update($id, array(
            'title' => $title,
            'content' => $content
        ));
    }
} 