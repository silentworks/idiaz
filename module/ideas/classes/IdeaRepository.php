<?php
namespace Idiaz;

/**
 * IdeaRepository
 */
interface IdeaRepository
{
    public function all();

    public function paginate($limit = 10, $offset = 0);

    public function find($id);

    public function create(array $attributes);

    public function update($id, array $attributes);

    public function delete($id);
}
