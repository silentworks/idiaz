<?php
namespace Idiaz\Domain;

class SpotIdeaRepository implements IdeaRepository
{
    /**
     * @var \Spot\MapperInterface
     */
    private $mapper;

    function __construct(\Spot\MapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    public function all()
    {
        return $this->mapper->all();
    }

    public function paginate($limit = 10, $offset = 0)
    {
        return $this->mapper->where(['display' => 1])
            ->limit($limit, $offset)
            ->order(['id' => 'desc']);
    }

    public function find($id)
    {
        return $this->mapper->get($id);
    }

    public function create(array $attributes)
    {
        return $this->mapper->create($attributes);
    }

    public function update($id, array $attributes)
    {
        $idea = $this->mapper->get($id);

        if ($idea) {
            foreach ($attributes as $k => $v) {
                $idea->{$k} = $v;
            }
            $this->mapper->update($idea);
        }
    }

    public function delete($id)
    {
        $idea = $this->mapper->get($id);

        if ($idea) {
            $this->mapper->delete($idea);
        }
    }
}