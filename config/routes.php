<?php
/* Show all and featured ideas routes */
$app->get('/', 'Idiaz\Action\IdeasBrowseAction:__invoke')->name('ideas');
$app->get('/ideas', 'Idiaz\Action\IdeasFeaturedAction:__invoke')->name('ideas.featured');

/* New idea routes */
$app->get('/ideas/new', 'Idiaz\Action\IdeasCreateAction:__invoke')->name('ideas.create');
$app->post('/ideas/new', 'Idiaz\Action\IdeasStoreAction:__invoke')->name('ideas.store');

/* Show a route */
$app->get('/ideas/:id', 'Idiaz\Action\IdeasShowAction:__invoke')->name('ideas.show');

/* Editing idea routes */
$app->get('/ideas/:id/edit', 'Idiaz\Action\IdeasEditAction:__invoke')->name('ideas.edit');
$app->post('/ideas/:id/edit', 'Idiaz\Action\IdeasUpdateAction:__invoke')->name('ideas.update');
