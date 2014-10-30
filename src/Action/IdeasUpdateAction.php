<?php
namespace Idiaz\Action;

use Idiaz\Domain\IdeaRepository;
use Idiaz\HttpResponse;
use Idiaz\RedirectResponse;
use Slim\Http\Request;

class IdeasUpdateAction
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

    public function __invoke($id)
    {
        $title = $this->request->post('title');
        $content = $this->request->post('content');

        $this->idea->update($id, array(
            'title' => $title,
            'content' => $content
        ));

        return $this->redirectResponse->route('ideas.edit', ['id' => $id]);
    }
} 