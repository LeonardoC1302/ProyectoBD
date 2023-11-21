<?php

namespace Model;

class User extends ActiveRecord {
    protected static $db_server;
    protected static $db_postgreSQL;
    protected static $table = 'users';
    protected static $columns_db = ['id', 'name', 'surname', 'email', 'password', 'phone', 'admin', 'verified', 'token'];

    public $id;
    public $name;
    public $surname;
    public $email;
    public $password;
    public $phone;
    public $admin;
    public $verified;
    public $token;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->surname = $args['surname'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->phone = $args['phone'] ?? '';
        $this->admin = $args['admin'] ?? 0;
        $this->verified = $args['verified'] ?? 0;
        $this->token = $args['token'] ?? '';
    }

    public static function setDbServer($database){
        self::$db_server = $database;
    }
    public static function setDbServer2($database){
        self::$db_postgreSQL = $database;
    }

    public function validateLogin(){
        if(!$this->email) {
            self::$alerts['error'][] = 'The email is mandatory';
        }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alerts['error'][] = 'The email is not valid';
        }
        if(!$this->password) {
            self::$alerts['error'][] = 'The password is mandatory';
        }
        return self::$alerts;
    }

    public function validateRegister() {
        if(!$this->name) {
            self::$alerts['error'][] = 'The name is mandatory';
        }
        if(!$this->surname) {
            self::$alerts['error'][] = 'The last name is mandatory';
        }
        if(!$this->email) {
            self::$alerts['error'][] = 'The email is mandatory';
        }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alerts['error'][] = 'The email is not valid';
        }
        if(!$this->password) {
            self::$alerts['error'][] = 'The password is mandatory';
        }
        if($this->password && strlen($this->password) < 6) {
            self::$alerts['error'][] = 'The password must be at least 6 characters';
        }
        if(!$this->phone) {
            self::$alerts['error'][] = 'The phone is mandatory';
        }
        return self::$alerts;
    }

    public function validateUpdate(){
        if(!$this->name) {
            self::$alerts['error'][] = 'The name is mandatory';
        }
        if(!$this->surname) {
            self::$alerts['error'][] = 'The last name is mandatory';
        }
        if(!$this->email) {
            self::$alerts['error'][] = 'The email is mandatory';
        }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alerts['error'][] = 'The email is not valid';
        }
        if(!$this->phone) {
            self::$alerts['error'][] = 'The phone is mandatory';
        }
        return self::$alerts;
    }

    public function validatePasswordChange($currentPassword, $password1, $password2){
        if(!$currentPassword) {
            self::$alerts['error'][] = 'The current password is mandatory';
        }
        // Check if current password is correct
        $result = password_verify($currentPassword, $this->password);
        if(!$result){
            self::$alerts['error'][] = 'The current password is incorrect';
        }
        if(!$password1) {
            self::$alerts['error'][] = 'The new password is mandatory';
        }
        if($password1 && strlen($password1) < 6) {
            self::$alerts['error'][] = 'The new password must be at least 6 characters';
        }
        if(!$password2) {
            self::$alerts['error'][] = 'The password confirmation is mandatory';
        }
        if($password1 && $password2 && $password1 !== $password2) {
            self::$alerts['error'][] = 'The passwords do not match';
        }
        return self::$alerts;
    }

    public function verifyPasswordVerified($password){
        $result = password_verify($password, $this->password);
    
        if(!$result || !$this->verified){
            self::$alerts['error'][] = 'The password is incorrect or the account is not verified';
        } else {
            return true;
        }
    }

    public function exists(){
        $query = "SELECT * FROM " . self::$table . " WHERE email = '" . $this->email . "' LIMIT 1";
        $result = self::$db->query($query);

        if($result->num_rows) {
            self::$alerts['error'][] = 'The email is already registered';
        }

        return $result;
    }

    public function validateEmail(){
        if(!$this->email) {
            self::$alerts['error'][] = 'The email is mandatory';
        }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alerts['error'][] = 'The email is not valid';
        }
        return self::$alerts;
    }

    public function validatePassword(){
        if(!$this->password) {
            self::$alerts['error'][] = 'The password is mandatory';
        }else if(strlen($this->password) < 6) {
            self::$alerts['error'][] = 'The password must be at least 6 characters';
        }
        return self::$alerts;
    }

    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
    
    public function generateToken() {
        $this->token = uniqid();
    }


    public static function syncSQLServer(){
        $users = self::all();
        foreach ($users as $user) {
            $attributes = $user->sanitizeData();
    
            // Build the merge statement
            $randomPoint = "POINT(" . rand(0, 100) . " " . rand(0, 100) . ")";
            $query = "MERGE INTO " . self::$table . " AS target ";
            $query .= "USING (VALUES ('" . join("', '", array_values($attributes)) .  "' , '" . $randomPoint . "')) AS source (" . join(', ', array_keys($attributes)) . ", location) ";
            $query .= "ON target.email = source.email ";  // Assuming email is a unique key
            $query .= "WHEN MATCHED THEN UPDATE SET ";
            
            // Append the update values for each column
            foreach ($attributes as $column => $value) {
                $query .= "target." . $column . " = source." . $column . ", ";
            }
    
            // Remove the trailing comma and space
            $query = rtrim($query, ', ');
    
            $query .= " WHEN NOT MATCHED THEN INSERT (";
            $query .= join(', ', array_keys($attributes));
            $query .= ", location) VALUES ('";
            $query .= join("', '", array_values($attributes));
            $query .= "', '" . $randomPoint . "');";

            // Execute the query
            $result = self::$db_server->query($query);
        }
    }
    public static function syncPostgre($fullName = null){
        $users = self::all();
        if($fullName){
            foreach ($users as $user) {
                $attributes = $user->sanitizeData();
                $query = "DO
                $$
                BEGIN
                IF EXISTS (SELECT 1 FROM clients WHERE name ='". $fullName ."' ) THEN
                    -- Update the existing record
                    UPDATE clients SET name ='". $attributes["name"]. " ". $attributes["surname"]."'  WHERE name ='". $fullName ."' ;
                ELSE
                    -- Insert a new record
                    INSERT INTO clients (name) VALUES ('". $attributes["name"]. " ". $attributes["surname"]."');
                END IF;
                END
                $$;";
                $stmt = self::$db_postgreSQL->prepare($query);
                $stmt->execute();
        }
        }else{
            $user = end($users);
            $attributes = $user->sanitizeData();
            $query = "DO
            $$
            BEGIN
                -- Insert a new record
                INSERT INTO clients (name) VALUES ('". $attributes["name"]. " ". $attributes["surname"]."');
            END
            $$;";
            $stmt = self::$db_postgreSQL->prepare($query);
            $stmt->execute();
        }
    }
}