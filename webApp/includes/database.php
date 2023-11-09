<?php
// MYSQL
function connect_db_mysql() : mysqli {
    $host = "localhost";
    $user = "root";
    $pass = "123";
    $db = "recursos_humanos";

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
    } else {
        echo " Conectado a MYSQL ";
    }

    return $db_mysql;
}

// SQL SERVER
function connect_sql_server(){
    $host = "localhost";
    $port = 1433;
    $database = "storage";
    $username = "sa";
    $password = "123";

    try{
        $db_server = new PDO("sqlsrv:Server={$host}, {$port};Database={$database}", $username, $password);
        echo " Conectado a SQL SERVER ";
    } catch(PDOException $e){
        echo "Error al conectarse a la base de datos: " . $e->getMessage();
    }
    return $db_server;
}

// POSTGRESQL

function connect_postgresql() {
    $host = "localhost";
    $dbname = "servicio_cliente";
    $user = "root";
    $password = "123";

    try {
        $db = new PDO("pgsql:host=$host;dbname=$dbname;user=$user;password=$password");
        echo " Conectado a PostgreSQL ";
    } catch (PDOException $e) {
        echo "Error connecting to PostgreSQL: " . $e->getMessage();
        exit;
    }

    return $db;
}