<?php
/* Show all and featured ideas routes */
$app->get('/', 'Idiaz\IdeasController::featured');
$app->get('/ideas', 'Idiaz\IdeasController::index');

/* New idea routes */
$app->get('/ideas/new', 'Idiaz\IdeasController::create');
$app->post('/ideas/new', 'Idiaz\IdeasController::create');

/* Show a route */
$app->get('/ideas/{id}', 'Idiaz\IdeasController::show');

/* Editing idea routes */
$app->get('/ideas/{id}/edit', 'Idiaz\IdeasController::update');
$app->post('/ideas/{id}/edit', 'Idiaz\IdeasController::update');