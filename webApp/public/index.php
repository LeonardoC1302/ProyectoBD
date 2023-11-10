<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\LoginController;
use Controllers\PagesController;
use Controllers\HelpController;
use Controllers\ProductController;
use Controllers\AdminController;

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
$router->get('/products', [PagesController::class, 'products']);
$router->get('/product', [PagesController::class, 'product']);
$router->get('/contact', [PagesController::class, 'contact']);
$router->get('/about', [PagesController::class, 'about']);
$router->get('/cart', [PagesController::class, 'cart']);
$router->get('/account', [PagesController::class, 'account']);
$router->get('/orders', [PagesController::class, 'orders']);


$router->get('/apply', [HelpController::class, 'apply']);
$router->get('/service', [HelpController::class, 'service']);
$router->get('/returns', [HelpController::class, 'returns']);
$router->get('/international', [HelpController::class, 'international']);
$router->get('/policies', [HelpController::class, 'policies']);

$router->get('/employees', [AdminController::class, 'employees']);
$router->get('/employeeSearch', [AdminController::class, 'employeeSearch']);

$router->get('/admin', [AdminController::class, 'index']);
// Checks and validates the routes, ensuring they exist and assigns them to the Controller functions
$router->checkRoutes();