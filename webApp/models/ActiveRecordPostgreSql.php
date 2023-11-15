<?php

namespace Model;

class ActiveRecordPostgreSql {
    // DB
    protected static $db;
    protected static $columns_db = [];
    protected static $table = '';

    // Validation
    protected static $alerts = [];

    public static function setDB($database){
        self::$db = $database;
    }
    public static function find($id){
        $query = "SELECT * FROM " . static::$table . " WHERE id = :id";

        $stmt = self::$db->prepare($query);

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result;
    }
    public static function orderQuery($id) {
        $query = "SELECT * FROM " . static::$table . " WHERE id = :id";

        $stmt = self::$db->prepare($query);

        $stmt->bindParam(':id', $id);
        
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    public static function getAlerts() {
        return static::$alerts;
    }

    public static function setAlerts($type, $message){
        static::$alerts[$type][] = $message;
    }

    public function validate(){
        static::$alerts = [];
        return static::$alerts;
    }
}