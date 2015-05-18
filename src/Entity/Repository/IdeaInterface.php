<?php
namespace Idiaz\Entity\Repository;

/**
 * IdeaRepository
 */
interface IdeaInterface
{
    public function all();

    public function paginate($limit = 10, $offset = 0);

    public function find($id);

    public function create(array $attributes);

    public function update($id, array $attributes);

    public function delete($id);
}
