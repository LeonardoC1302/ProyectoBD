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

    public static function clientQuery($id) {
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
    public static function create($description,$resolved, $typeId, $clientId, $orderId) {
        $query = "INSERT INTO " . static::$table . " (description, resolved, \"typeId\", \"clienteId\", \"ordenID\") VALUES (:description, :resolved, :typeId, :clientId, :orderId)";

        $stmt = self::$db->prepare($query);
    
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':typeId', $typeId);
        $stmt->bindParam(':clientId', $clientId);
        $stmt->bindParam(':orderId', $orderId);
        $stmt->bindParam(':resolved', $resolved);
        
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