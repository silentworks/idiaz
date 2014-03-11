<?php
namespace Idiaz;

use Slender\Core\DependencyInjector\Annotation as Slender;

/**
 * Eloquent Repository
 */
class EloquentIdeaRepository implements IdeaRepository
{
    public function all($limit = null, $offset = null)
    {
        return Idea::all()
            ->toArray();
    }

    public function paginate($limit = 10, $offset = 0)
    {
        return Idea::where('display', 1)
            ->limit($limit)
            ->offset($offset)
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();
    }

    public function find($id)
    {
        return Idea::find($id)
            ->toArray();
    }

    public function create(array $attributes = array())
    {
        $idea = Idea::create($attributes);
        return $idea->id;
    }

    public function update($id, array $attributes)
    {
        $idea = Idea::find($id);
        return $idea->update($attributes);
    }

    public function delete($id)
    {
        return Idea::destroy($id);
    }

    public function setIdea($idea)
    {
        $this->idea = $idea;
    }
}
