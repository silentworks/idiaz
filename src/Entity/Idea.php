<?php
namespace Idiaz\Entity;

/**
 * Idea
 */
class Idea extends \Spot\Entity
{
    protected static $table = 'ideas';

    public static function fields()
    {
        return [
            'id' => ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
            'title' => ['type' => 'string', 'required' => true],
            'content' => ['type' => 'text', 'required' => true],
            'public' => ['type' => 'integer', 'default' => 1, 'index' => true],
            'display' => ['type' => 'integer', 'default' => 1, 'index' => true],
            'created_by' => ['type' => 'integer'],
            'updated_by' => ['type' => 'integer'],
            'created_at' => ['type' => 'datetime', 'value' => new \DateTime()],
            'updated_at' => ['type' => 'datetime', 'value' => new \DateTime()],
        ];
    }
}
