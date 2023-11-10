<?php

namespace Model;

class ActiveRecordServer {
    // DB
    protected static $db;
    protected static $columns_db = [];
    protected static $table = '';

    // Validation
    protected static $alerts = [];

    public static function setDB($database){
        self::$db = $database;
    }

    public static function all() {
        try {
            $query = "SELECT * FROM " . static::$table;
    
            // Assuming self::$db is a PDO connection to SQL Server
            $stmt = self::$db->query($query);
    
            if ($stmt === false) {
                // Handle query error
                return [];
            }
    
            // Fetch all rows as associative arrays
            $array = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
            return array_map([static::class, 'createObject'], $array);
        } catch (\PDOException $e) {
            // Handle the exception, e.g., log or print the error
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public static function find($id) {
        try {
            $query = "SELECT * FROM " . static::$table . " WHERE id = :id";
    
            // Assuming self::$db is a PDO connection to SQL Server
            $stmt = self::$db->prepare($query);
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();
    
            // Fetch the result as an associative array
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    
            if ($result === false) {
                // Handle record not found
                return null;
            }
    
            return static::createObject($result);
        } catch (\PDOException $e) {
            // Handle the exception, e.g., log or print the error
            echo "Error: " . $e->getMessage();
            return null;
        }
    }    

    protected static function createObject($register){
        $object = new static;
        foreach($register as $key=>$value){
            if(property_exists($object, $key)){
                $object->$key = $value;
            }
        }
        return $object;
    }
    
}