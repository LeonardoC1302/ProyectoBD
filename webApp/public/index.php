<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\LoginController;
use Controllers\PagesController;

$router = new Router();

// Authentication routes
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);

$router->get('/logout', [LoginController::class, 'logout']);

$router->get('/forgot', [LoginController::class, 'forgot']);
$router->post('/forgot', [LoginController::class, 'forgot']);

$router->get('/recover', [LoginController::class, 'recover']);
$router->post('/recover', [LoginController::class, 'recover']);

$router->get('/register', [LoginController::class, 'register']);
$router->post('/register', [LoginController::class, 'register']);

$router->get('/verify', [LoginController::class, 'verify']);
$router->get('/message', [LoginController::class, 'message']);

// Pages routes
$router->get('/', [PagesController::class, 'index']);

// Checks and validates the routes, ensuring they exist and assigns them to the Controller functions
$router->checkRoutes();