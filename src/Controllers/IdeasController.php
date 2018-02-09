<?php
namespace Idiaz\Controllers;

use Idiaz\HttpResponse;
use Idiaz\Entity\Repository\IdeaInterface;

class IdeasController
{
    private $idea;
    private $response;

    public function __construct(
        HttpResponse $response,
        IdeaInterface $idea
    )
    {
        $this->response = $response;
        $this->idea = $idea;
    }

    public function index($request, $response)
    {
        $limit = $request->getParam('limit');
        $offset = $request->getParam('offset');

        $pageTitle = 'All Ideas';
        $ideas = $this->idea->paginate($limit, $offset);

        return $this->response->make($response, 'ideas.twig', compact('pageTitle', 'ideas'));
    }

    public function featured($request, $response)
    {
        $limit = $request->getParam('limit', 6);
        $offset = $request->getParam('page', 0);

        $ideas = $this->idea->paginate($limit, $offset);
        return $this->response->make($response, 'ideas.twig', compact('ideas'));
    }

    public function show($request, $response, $args)
    {
        $idea = $this->idea->find($args['id']);
        return $this->response->make($response, 'idea.twig', compact('idea'));
    }

    public function create($request, $response)
    {
        return $this->response->make($response, 'create.twig');
    }

    public function store($request, $response)
    {
        $title = $request->getParam('title');
        $content = $request->getParam('content');

        $idea = $this->idea->create([
            'title' => $title,
            'content' => $content,
            'public' => 1,
            'display' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        return $this->response->redirectTo($response, 'ideas.show', [
            'id' => $idea->id
        ]);
    }

    public function edit($request, $response, $args)
    {
        $idea = $this->idea->find($args['id']);
        return $this->response->make($response, 'edit.twig', compact('idea'));
    }

    public function update($request, $response, $args)
    {
        $title = $request->getParam('title');
        $content = $request->getParam('content');

        $this->idea->update($args['id'], [
            'title' => $title,
            'content' => $content
        ]);

        return $this->response->redirectTo($response, 'ideas.show', [
            'id' => $args['id']
        ]);
    }
}
