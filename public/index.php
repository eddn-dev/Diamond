<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AuthController;
use MVC\Router;

session_start();

$router = new Router();

$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);

$router->dispatch();