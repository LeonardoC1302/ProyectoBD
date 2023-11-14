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
$router->get('/checkout', [PagesController::class, 'checkout']);
$router->post('/checkout', [PagesController::class, 'checkout']);
$router->get('/account', [PagesController::class, 'account']);
$router->get('/orders', [PagesController::class, 'orders']);


$router->get('/apply', [HelpController::class, 'apply']);
$router->get('/service', [HelpController::class, 'service']);
$router->get('/customerService', [HelpController::class, 'serviceEmp']);
$router->get('/orderInfo', [HelpController::class, 'serviceEmp2']);
$router->get('/orderReport', [HelpController::class, 'report']);
$router->get('/returns', [HelpController::class, 'returns']);
$router->get('/international', [HelpController::class, 'international']);
$router->get('/policies', [HelpController::class, 'policies']);

// ADMIN ROUTES
$router->get('/admin', [AdminController::class, 'index']);

$router->get('/admin/employees', [AdminController::class, 'employees']);
$router->get('/admin/employeeSearch', [AdminController::class, 'employeeSearch']);
$router->post('/admin/employeeSearch', [AdminController::class, 'employeeSearch']);
$router->get('/admin/employeeReport', [AdminController::class, 'employeeReport']);

$router->get('/admin/products', [AdminController::class, 'products']);

$router->get('/admin/products/create', [AdminController::class, 'createProduct']);
$router->post('/admin/products/create', [AdminController::class, 'createProduct']);

$router->get('/admin/products/update', [AdminController::class, 'updateProduct']);
$router->post('/admin/products/update', [AdminController::class, 'updateProduct']);

$router->post('/admin/products/delete', [AdminController::class, 'deleteProduct']);


// Checks and validates the routes, ensuring they exist and assigns them to the Controller functions
$router->checkRoutes();