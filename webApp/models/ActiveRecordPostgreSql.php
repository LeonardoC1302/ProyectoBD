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
    public static function iDQuery($id) {
        $query = "SELECT * FROM " . static::$table . " WHERE id = :id";

        $stmt = self::$db->prepare($query);

        $stmt->bindParam(':id', $id);
        
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    public static function all() {
        $query = "SELECT * FROM " . static::$table;

        $stmt = self::$db->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }
    public static function dateQuery($date) {
        $query = "SELECT * FROM " . static::$table . " WHERE date = :date ";

        $stmt = self::$db->prepare($query);

        $stmt->bindParam(':date', $date);
        
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }
    public static function dateAll() {
        $query = "SELECT * FROM " . static::$table;

        $stmt = self::$db->prepare($query);
        
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }
    public static function create($description,$resolved, $typeId, $clientId, $orderId, $date) {
        $query = "INSERT INTO " . static::$table . " (description, resolved, \"typeId\", \"clienteId\", \"ordenID\", date) VALUES (:description, :resolved, :typeId, :clientId, :orderId, :date)";

        $stmt = self::$db->prepare($query);
    
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':typeId', $typeId);
        $stmt->bindParam(':clientId', $clientId);
        $stmt->bindParam(':orderId', $orderId);
        $stmt->bindParam(':resolved', $resolved);
        $stmt->bindParam(':date', $date);
        $stmt->execute();
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