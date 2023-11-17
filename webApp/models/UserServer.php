<?php

namespace Model;

class UserServer extends ActiveRecordServer {
    protected static $db;
    protected static $table = 'users';
    protected static $columns_db = ['id', 'name', 'surname', 'email', 'password', 'phone', 'admin', 'verified', 'token', 'location'];

    public $id;
    public $name;
    public $surname;
    public $email;
    public $password;
    public $phone;
    public $admin;
    public $verified;
    public $token;
    public $location;

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
        $randomPoint = "POINT(" . rand(0, 100) . " " . rand(0, 100) . ")";
        $this->location = $args['location'] ?? $randomPoint;
    }

    public static function setDbServer($database){
        self::$db = $database;
    }

    public function formatLocation()
    {
        // Assuming $this->location contains the WKT representation of the geometry point
        // Adjust the column name and table name as needed
        $sql = "SELECT TOP 1 location.STAsText() AS location_text FROM " . static::$table . " WHERE id = :id";
        $stmt = self::$db->prepare($sql);
        $stmt->bindParam(':id', $this->id, \PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            // Assuming 'location_text' is the alias used in the SQL query
            $wkt = $result['location_text'];
            // Convert POINT (97 18) to POINT(97, 18, 0)
            $modifiedWkt = preg_replace('/POINT \((\d+(?:\.\d+)?) (\d+(?:\.\d+)?)\)/', 'Point($1, $2, 0)', $wkt);

            return $modifiedWkt;
        } else {
            return null; // or handle the case where the location is not found
        }
    }


}