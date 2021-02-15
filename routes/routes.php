<?php
use Phroute\Phroute\RouteCollector;
$router = new RouteCollector();

$router->get('/', [\Application\Controllers\PostController::class, 'index']);

$router->get('/posts/create',[\Application\Controllers\PostController::class, 'create']);
$router->get('/posts/{id:\d+}/show',[\Application\Controllers\PostController::class, 'posts']);
$router->get('/posts/{id:\d+}/edit',[\Application\Controllers\PostController::class, 'edit']);

$router->post('/posts/{id:\d+}/comment/{parent_id:\d+}?',[\Application\Controllers\PostController::class, 'addComment']);

$router->post('/posts/store',[\Application\Controllers\PostController::class, 'store']);
$router->post('/posts/update/{id:\d+}',[\Application\Controllers\PostController::class, 'update']);
$router->get('/posts/{id:\d+}/delete',[\Application\Controllers\PostController::class, 'delete']);



$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));