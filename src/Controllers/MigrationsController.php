<?php
namespace Idiaz\Controllers;

use Spot\Locator;
use Spot\Mapper;

/**
 * MigrationsController
 */
class MigrationsController
{
  public function __construct(Locator $db)
  {
    $this->db = $db;
  }

  public function up()
  {
    $mapper = $this->db->mapper('Idiaz\Entity\Idea');
    $mapper->migrate();
  }
}
