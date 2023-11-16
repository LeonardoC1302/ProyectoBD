<?php 
// use Model\ActiveRecord;
use Model\User;
use Model\Product;
use Model\ProductType;
use Model\UserServer;
use Model\Warehouse;
use Model\Order;
use Model\Sale;

require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ );
$dotenv->safeLoad();

require 'functions.php';
require 'database.php';

// // Connecting to DB
$db_server = connect_sql_server();
$db_mysql = connect_db_mysql();
$db_postgresql = connect_postgresql();

// ActiveRecord::setDB($db_mysql);
User::setDB($db_mysql);
User::setDbServer($db_server);
UserServer::setDbServer($db_server);
Product::setDB($db_server);
ProductType::setDB($db_server);
Warehouse::setDB($db_server);
Order::setDB($db_postgresql);
User::setDbServer2($db_postgresql);
Sale::setDbServer2($db_postgresql);