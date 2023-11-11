<?php

namespace Model;

class ActiveRecord {
    // DB
    protected static $db;
    protected static $columns_db = [];
    protected static $table = '';

    // Validation
    protected static $alerts = [];

    public static function setDB($database){
        self::$db = $database;
    }

}