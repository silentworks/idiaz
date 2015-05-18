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

    public function index($request)
    {
        $limit = $request->getParam('limit');
        $offset = $request->getParam('offset');

        $pageTitle = 'All Ideas';
        $ideas = $this->idea->paginate($limit, $offset);

        return $this->response->make('ideas.twig', compact('pageTitle', 'ideas'));
    }

    public function featured($request)
    {
        $limit = $request->getParam('limit', 6);
        $offset = $request->getParam('page', 0);

        $ideas = $this->idea->paginate($limit, $offset);
        return $this->response->make('ideas.twig', compact('ideas'));
    }

    public function show($request, $response, $args)
    {
        $idea = $this->idea->find($args['id']);
        return $this->response->make('idea.twig', compact('idea'));
    }

    public function create()
    {
        return $this->response->make('create.twig');
    }

    public function store($request)
    {
        $title = $request->getParam('title');
        $content = $request->getParam('content');

        $idea = $this->idea->create(array(
            'title' => $title,
            'content' => $content,
            'public' => 1,
            'display' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ));

        return $this->response->redirectTo('ideas.show', [
        	'id' => $idea->id
    	]);
    }

    public function edit($request, $response, $args)
    {
    	$idea = $this->idea->find($args['id']);
        return $this->response->make('edit.twig', compact('idea'));
    }

    public function update($request, $response, $args)
    {
    	$title = $request->getParam('title');
        $content = $request->getParam('content');

        $this->idea->update($args['id'], array(
            'title' => $title,
            'content' => $content
        ));

        return $this->response->redirectTo('ideas.edit', [
        	'id' => $args['id']
    	]);
    }
}
