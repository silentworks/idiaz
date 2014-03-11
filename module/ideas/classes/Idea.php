<?php
namespace Idiaz;
use Illuminate\Database\Eloquent\Model;

/**
 * Idea
 */
class Idea extends Model
{
    protected $table = 'ideas';

    protected $fillable = array('title', 'content');
}
