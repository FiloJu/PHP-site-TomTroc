<?php
require_once '../vendor/autoload.php';

use App\BadParameterException;
use App\Route;
use App\Router;
use Controllers\HomeController;
use Controllers\BookController;
use Controllers\MessageController;
use Controllers\AuthController;
use Controllers\ErrorsController;
use Middlewares\Authentication;

session_start();

$action = $_GET['action'] ?? '';

try {
    $router = new Router($action, [
        new Route([
            'action' => '',
            'controller' => HomeController::class,
            'method' => 'index',
        ]),
        new Route([
            'action' => 'createUser',
            'controller' => AuthController::class,
            'method' => 'createUser',
            'verb' => 'POST',
        ]),
        new Route([
            'action' => 'login',
            'controller' => AuthController::class,
            'method' => 'verifyLogin',
            'verb' => 'POST',
        ]),
        new Route([
            'action' => 'login',
            'controller' => AuthController::class,
            'method' => 'login',
        ]),
        new Route([
            'action' => 'register',
            'controller' => AuthController::class,
            'method' => 'register',
        ]),
        new Route([
            'action' => 'logout',
            'controller' => AuthController::class,
            'method' => 'logout',
        ]),
        new Route([
            'action' => 'books',
            'controller' => BookController::class,
            'method' => 'findAll',
        ]),
        new Route([
            'action' => 'book',
            'controller' => BookController::class,
            'method' => 'findOne',
            'parameters' => ['id' => ['format' => '[0-9]+']]
        ]),
        new Route([
            'action' => 'create-book',
            'controller' => BookController::class,
            'method' => 'create',
            'verb' => 'GET',
        ]),
        new Route([
            'action' => 'create-book',
            'controller' => BookController::class,
            'method' => 'create',
            'verb' => 'POST',
        ]),
        new Route([
            'action' => 'delete-book',
            'controller' => BookController::class,
            'method' => 'delete',
            'verb' => 'POST',
            'parameters' => ['id' => ['format' => '[0-9]+']],
            'middlewares' => [
                Authentication::class => 'checkAuth'
            ]
        ]),
        new Route([
            'action' => 'messages',
            'controller' => MessageController::class,
            'method' => 'index',
            'verb' => 'GET',
            'middlewares' => [
                Authentication::class => 'checkAuth'
            ]
        ]),
        new Route([
            'action' => 'messagerie',
            'controller' => MessageController::class,
            'method' => 'index',
            'verb' => 'GET',
            'middlewares' => [
                Authentication::class => 'checkAuth'
            ]
        ]),
        new Route([
            'action' => 'create-message',
            'controller' => MessageController::class,
            'method' => 'create',
            'verb' => 'GET',
            'middlewares' => [
                Authentication::class => 'checkAuth'
            ]
        ]),
        new Route([
            'action' => 'create-message',
            'controller' => MessageController::class,
            'method' => 'create',
            'verb' => 'POST',
            'middlewares' => [
                Authentication::class => 'checkAuth'
            ]
        ]),
    ]);
    $router->errorRoutes([
        new Route([
            'action' => '403', 
            'controller' => ErrorsController::class, 
            'method' => 'error403'
        ]),
        new Route([
            'action' => '404', 
            'controller' => ErrorsController::class, 
            'method' => 'error404'
        ]),
        new Route([
            'action' => '400', 
            'controller' => ErrorsController::class, 
            'method' => 'error400'
        ]),
    ]);
    $router->route();
} catch (InvalidArgumentException $e) {
    echo $e->getMessage();
} catch (BadParameterException $e) {
    return header('location: index.php?action=400');
}
