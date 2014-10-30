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
        $title = $this->request->get('title');
        $content = $this->request->get('content');

        $idea = $this->idea->create(array(
            'title' => $title,
            'content' => $content
        ));

        return $this->redirectResponse->route('ideas.show', ['id' => $idea->id]);
    }
} 