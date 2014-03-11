<?php
namespace Idiaz;

use Slender\Core\DependencyInjector\Annotation as Slender;
use Slender\Module\RouteManager\Controller\AbstractController;
use Slim\View;

/**
 *
 */
class IdeasController extends AbstractController
{
    /**
     * @var IdeaRepository
     * @Slender\Inject
     */
    protected $idea;

    /**
     * @param Idea $idea
     */
    public function setIdea($idea)
    {
        $this->idea = $idea;
    }

    public function index()
    {
        $limit = $this->request->get('limit', 10);
        $offset = $this->request->get('offset', 0);

        $data = array(
            'pageTitle' => 'All Ideas',
            'ideas' => $this->idea->paginate($limit, $offset),
        );

        $this->render('ideas.twig', $data);
    }

    public function featured()
    {
        $data = array(
            'ideas' => $this->idea->paginate(6),
        );

        $this->render('ideas.twig', $data);
    }

    public function show($id)
    {
        $data['idea'] = $this->idea->find($id);

        $this->render('idea.twig', $data);
    }

    public function create()
    {
        if ($this->request->isPost()) {
            $title = $this->request->post('title');
            $content = $this->request->post('content');

            $this->idea->create(array(
                'title' => $title,
                'content' => $content
            ));
        }

        $this->render('idea_form.twig');
    }

    public function update($id)
    {
        if ($this->request->isPost()) {
            $title = $this->request->post('title');
            $content = $this->request->post('content');

            $this->idea->update($id, array(
                'title' => $title,
                'content' => $content
            ));
        }

        $data['idea'] = $this->idea->find($id);
        $this->render('idea_form.twig', $data);
    }
}
