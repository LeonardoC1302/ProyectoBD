<?php 
use Model\ActiveRecord;
require __DIR__ . '/../vendor/autoload.php';

require 'functions.php';
require 'database.php';

// // Connecting to DB
$db_server = connect_sql_server();
$db_mysql = connect_db_mysql();
$db_postgresql = connect_postgresql();

// ActiveRecord::setDB($db);