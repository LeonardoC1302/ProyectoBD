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

    public static function where($columnName, $columnValue) {
        try {
            $query = "SELECT * FROM " . static::$table . " WHERE $columnName = :columnValue";
    
            // Assuming self::$db is a PDO connection to SQL Server
            $stmt = self::$db->prepare($query);
            $stmt->bindParam(':columnValue', $columnValue, \PDO::PARAM_STR); // Adjust the parameter type based on your column type
            $stmt->execute();
    
            // Fetch the result as an associative array
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $array = [];
            foreach($result as $register){
                $array[] = static::createObject($register);
            }
    
            if ($result === false) {
                // Handle record not found
                return null;
            }
    
            return $array;
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

    public function save(){
        if(!is_null($this->id)){
            $result = $this->update();
        } else {
            $result = $this->create();
        }
        return $result;
    }

    public function create(){
        $attributes = $this->attributes();
        $query = "INSERT INTO " . static::$table . " (";
        $query .= join(', ', array_keys($attributes));
        $query .= ") VALUES ('";
        $query .= join("', '", array_values($attributes));
        $query .= "')";

        $result = self::$db->query($query);
        return [
            'result' =>  $result,
            'id' => self::$db->insert_id
         ];
    }

    public function update(){
        $attributes = $this->attributes();
        $values = [];
        foreach ($attributes as $key=>$value) {
            $values[] = "{$key}='{$value}'";
        }
        
        $query = "UPDATE " . static::$table . " SET ";
        $query .= join(', ', $values);
        $query .= " WHERE id = '" . $this->id . "' ";

        $result = self::$db->query($query);
        return $result;
    }

    // Identify all the attributes of the object
    public function attributes(){
        $attributes = [];
        foreach (static::$columns_db as $column) {
            if($column === 'id')  continue; 
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

    public function sanitizeData(){
        $attributes = $this->attributes();
        $sanitized = [];
        foreach ($attributes as $key=>$value) {
            $sanitized[$key] = self::$db->escape_string($value);
        }
        return $sanitized;
    }

    public function delete(){
        $query = "DELETE FROM " . static::$table . " WHERE id = '" . $this->id . "' ";
        $result = self::$db->query($query);
        return $result;
    }
    
}