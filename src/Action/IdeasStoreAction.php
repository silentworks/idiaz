<?php
namespace Idiaz\Action;

use Idiaz\Domain\IdeaRepository;
use Idiaz\HttpResponse;
use Idiaz\RedirectResponse;
use Slim\Http\Request;

class IdeasStoreAction
{
    private $request;
    private $idea;
    private $redirectResponse;

    function __construct(Request $request, IdeaRepository $idea, RedirectResponse $redirectResponse)
    {
        $this->idea = $idea;
        $this->request = $request;
        $this->redirectResponse = $redirectResponse;
    }

    public function __invoke()
    {
        $title = $this->request->post('title');
        $content = $this->request->post('content');

        $idea = $this->idea->create(array(
            'title' => $title,
            'content' => $content,
            'public' => 1,
            'display' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ));

        return $this->redirectResponse->route('ideas.show', ['id' => $idea->id]);
    }
} 