<?php 
// use Model\ActiveRecord;
use Model\User;
use Model\Product;

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
Product::setDB($db_server);