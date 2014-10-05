<?php
namespace Idiaz;

use Supprtz\Providers\TwigResponse;
use Orno\Http\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 */
class IdeasController
{
    /**
     * @var IdeaRepository
     */
    protected $idea;
    private $twig;

    function __construct(IdeaRepository $idea, TwigResponse $twig)
    {
        $this->idea = $idea;
        $this->twig = $twig;
    }

    public function index(Request $request)
    {
        $limit = $request->get('limit', 10);
        $offset = $request->get('offset', 0);

        $pageTitle = 'All Ideas';
        $ideas = $this->idea->paginate($limit, $offset);

        return $this->twig->render('ideas.twig', compact('pageTitle', 'ideas'));
    }

    public function featured()
    {
        $ideas = $this->idea->paginate(6);
        return $this->twig->render('ideas.twig', compact('ideas'));
    }

    public function show(Request $request, Response $response, $args)
    {
        $idea = $this->idea->find($args['id']);
        return $this->twig->render('idea.twig', compact('idea'));
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $title = $request->get('title');
            $content = $request->get('content');

            $this->idea->create(array(
                'title' => $title,
                'content' => $content
            ));
        }

        return $this->twig->render('idea_form.twig');
    }

    public function update(Request $request, Response $response, $args)
    {
        $id = $args['id'];
        if ($request->isMethod('post')) {
            $title = $request->get('title');
            $content = $request->get('content');

            $this->idea->update($id, array(
                'title' => $title,
                'content' => $content
            ));
        }

        $idea = $this->idea->find($id);
        return $this->twig->render('idea_form.twig', compact('idea'));
    }
}
