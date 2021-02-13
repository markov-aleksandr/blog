<?php
use Phroute\Phroute\RouteCollector;
use \Application\Controllers\HomeController;
$router = new RouteCollector();

//$router->any('/posts', \Application\Controllers\ArticleController::class);
$router->get('/', [HomeController::class, 'index']);

$router->get('/posts/create',[\Application\Controllers\ArticleController::class, 'create']);
$router->get('/posts/{id:\d+}/show',[\Application\Controllers\ArticleController::class, 'posts']);
$router->get('/posts/{id:\d+}/edit',[\Application\Controllers\ArticleController::class, 'edit']);




$router->post('/posts/store',[\Application\Controllers\ArticleController::class, 'store']);
$router->put('/posts/update',[\Application\Controllers\ArticleController::class, 'update']);



$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));