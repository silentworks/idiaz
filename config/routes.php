<?php
/* Show all and featured ideas routes */
$app->get('/', 'Idiaz\Controllers\IdeasController:index')
	->setName('ideas');
$app->get('/ideas', 'Idiaz\Controllers\IdeasController:featured')
	->setName('ideas.featured');

/* New idea routes */
$app->get('/ideas/new', 'Idiaz\Controllers\IdeasController:create')
	->setName('ideas.create');
$app->post('/ideas/new', 'Idiaz\Controllers\IdeasController:store')
	->setName('ideas.store');

/* Show a route */
$app->get('/ideas/{id}', 'Idiaz\Controllers\IdeasController:show')
	->setName('ideas.show');

/* Editing idea routes */
$app->get('/ideas/{id}/edit', 'Idiaz\Controllers\IdeasController:edit')
	->setName('ideas.edit');
$app->post('/ideas/{id}/edit', 'Idiaz\Controllers\IdeasController:update')
	->setName('ideas.update');

/* Migrations */
$app->get('/migrations/up', 'Idiaz\Controllers\MigrationsController:up');
