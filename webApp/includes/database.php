<?php
// MYSQL
function connect_db_mysql() : mysqli {
    $host = $_ENV['MYSQL_HOST'];
    $user = $_ENV['MYSQL_USER'];
    $pass = $_ENV['MYSQL_PASS'];
    $db = $_ENV['MYSQL_DB'];

    $db_mysql = new mysqli(
    $host, 
    $user, 
    $pass, 
    $db
    );

$db_mysql->set_charset("utf8");

    if(!$db_mysql) {
        echo "Error connecting to database";
        exit;
    }

    return $db_mysql;
}

// SQL SERVER
function connect_sql_server(){
    $host = $_ENV['SQL_SERVER_HOST'];
    $port = $_ENV['SQL_SERVER_PORT'];
    $database = $_ENV['SQL_SERVER_DB'];
    $username = $_ENV['SQL_SERVER_USER'];
    $password = $_ENV['SQL_SERVER_PASS'];

    try{
        $db_server = new PDO("sqlsrv:Server={$host}, {$port};Database={$database}", $username, $password);
        // echo " Connected to SQL SERVER ";
    } catch(PDOException $e){
        echo "Error while connecting to database: " . $e->getMessage();
    }
    return $db_server;
}

// POSTGRESQL

function connect_postgresql() {
    $host = $_ENV['POSTGRESQL_HOST'];
    $dbname = $_ENV['POSTGRESQL_DB'];
    $user = $_ENV['POSTGRESQL_USER'];
    $password = $_ENV['POSTGRESQL_PASS'];

    try {
        $db = new PDO("pgsql:host=$host;dbname=$dbname;user=$user;password=$password");
        // echo " Connected to PostgreSQL ";
    } catch (PDOException $e) {
        echo "Error while connecting to PostgreSQL: " . $e->getMessage();
        exit;
    }

    return $db;
}